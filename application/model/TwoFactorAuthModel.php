<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 07/04/16
 * Time: 23.42
 * Project: huge
 * File: TwoFactorAuthModel.php
 */
class TwoFactorAuthModel
{
    public static function verifyScratchCode($user_id, $scratch_code)
    {
        //TODO: Use transaction
        //Check if the scratch code exits for the user
        $connection = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT s.scid, s.sccode, s.scvalid 
                  FROM scratchcodes s 
                    INNER JOIN totp t ON t.tid = s.tid 
                    INNER JOIN users u ON u.user_id = t.user_id 
                  WHERE u.user_id = :user_id AND s.sccode = :scrachcode AND s.scvalid = TRUE';

        $query = $connection->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':scrachcode' => $scratch_code));
        if ($query->rowCount() != 1)
            return false;
        $result = $query->fetch();

        //If it exists, invalidate it
        $sql = 'UPDATE scratchcodes 
                  SET scvalid = FALSE, scinvalidated = current_timestamp
                  WHERE scid = :scid';
        $sth = $connection->prepare($sql);
        $sth->execute(array(':scid' => $result->scid));
        return $sth->rowCount() == 1;
    }

    public static function verifyToken($user_id, $token)
    {
        $connection = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT t.tsecret FROM totp t WHERE t.user_id = :user_id';

        $query = $connection->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        if ($query->rowCount() != 1)
            return false;

        return TotpAuth::verifyToken($query->fetch()->tsecret, $token);
    }

    public static function generateScratchCodesForUser($user_id)
    {
        if (($user_tid = self::getTidForUser($user_id)) == false && !self::hasUserValidScratchCodes($user_id))
            return false;

        $connection = DatabaseFactory::getFactory()->getConnection();

        $codes = TotpAuth::generateRandomScratchCodes(Config::get('TWO_FACTOR_AUTH_SCRATCH_CODES_COUNT'));
        $sql = 'INSERT INTO scratchcodes (tid, sccode, scvalid) VALUES ';
        $insertQuery = array();
        $insertData = array();
        foreach ($codes as $code) {
            $insertQuery[] = '(?, ?, TRUE)';
            $insertData[] = $user_tid;
            $insertData[] = $code;
        }

        if (!empty($insertQuery)) {
            $sql .= implode(', ', $insertQuery);
            $stmt = $connection->prepare($sql);
            $stmt->execute($insertData);

            return $stmt->rowCount() == count($codes);
        }
        return false;
    }

    public static function hasUserValidScratchCodes($user_id)
    {
        if (($user_tid = self::getTidForUser($user_id)) == false)
            return false;

        $connection = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT * FROM scratchcodes WHERE tid = :tid AND scratchcodes.scvalid = TRUE';
        $query = $connection->prepare($sql);
        $query->execute(array(':tid' => $user_tid));

        return $query->rowCount() > 0;
    }

    public static function generateSecretForUser($user_id)
    {
        if (!self::hasUserTotopEntry($user_id))
            return self::generateTotpEntryForUser($user_id);

        $connection = DatabaseFactory::getFactory()->getConnection();
        $sql = 'UPDATE totp
                  SET tsecret = :secret, tsecretgenerated = current_timestamp
                  WHERE user_id = :user_id';
        $sth = $connection->prepare($sql);
        $sth->execute(array(':secret' => TotpAuth::genertateBase32Secret(), ':user_id' => $user_id));
        return $sth->rowCount() == 1;
    }

    public static function setTwoFactorAuthenticationEnabledForUsers($user_id, $enabled = false)
    {
        if (self::hasUserTotopEntry($user_id) == false)
            return self::generateTotpEntryForUser($user_id, true);

        $connection = DatabaseFactory::getFactory()->getConnection();
        $sql = 'UPDATE totp
                  SET tenabled = :enabled 
                  WHERE user_id = :user_id';
        $sth = $connection->prepare($sql);
        $sth->execute(array(':enabled' => (int)$enabled, ':user_id' => $user_id));
        return $sth->rowCount() == 1;
    }

    public static function getSecretForUser($user_id)
    {
        if (!self::hasUserTotopEntry($user_id))
            return false;
        $connection = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT tsecret FROM totp WHERE user_id = :user_id';
        $query = $connection->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        if ($query->rowCount() == 1)
            return $query->fetch()->tsecret;
        return false;
    }

    public static function getTidForUser($user_id)
    {
        if (!self::hasUserTotopEntry($user_id))
            return false;
        $connection = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT tid FROM totp INNER JOIN users ON totp.user_id = users.user_id WHERE users.user_id = :user_id';
        $query = $connection->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        return $query->rowCount() == 1 ? $query->fetch()->tid : false;
    }

    private static function hasUserTotopEntry($user_id)
    {
        $connection = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM totp WHERE user_id = :user_id';
        $query = $connection->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        return $query->rowCount() == 1;
    }

    private static function generateTotpEntryForUser($user_id, $enabled = false)
    {
        $connection = DatabaseFactory::getFactory()->getConnection();

        $sql = 'INSERT INTO totp (user_id, tsecret, tenabled) VALUES (:user_id, :secret, :enabled);';
        $sth = $connection->prepare($sql);
        $sth->execute(array(':user_id' => $user_id, ':secret' => TotpAuth::genertateBase32Secret(), ':enabled' => (int)$enabled));

        return $sth->rowCount() == 1;
    }
}