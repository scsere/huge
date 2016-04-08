<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 07/04/16
 * Time: 20.44
 * Project: huge
 * File: TotpAuth.php
 */
class TotpAuth
{
    public static function verifyToken($secret, $token)
    {
        if (!Config::get('TWO_FACTOR_AUTH_ENABLED'))
            return false;
        //Setup totp
        $totp = new \OTPHP\TOTP('', $secret, Config::get('TWO_FACTOR_AUTH_VALID_PERIOD'),
            Config::get('TWO_FACTOR_AUTH_ALGORITHM'), Config::get('TWO_FACTOR_AUTH_DIGITS'));
        return $totp->verify($token);
    }

    public static function generateBase64QrCode($secret, $label = 'Login')
    {
        $totp = new \OTPHP\TOTP($label . Config::get('DEFAULT_HEAD_TITLE'), $secret, Config::get('TWO_FACTOR_AUTH_VALID_PERIOD'),
            Config::get('TWO_FACTOR_AUTH_ALGORITHM'), Config::get('TWO_FACTOR_AUTH_DIGITS'));
        $totp->setIssuer(Config::get('TWO_FACTOR_AUTH_QR_ISSUER'));
        $qrCode = new \Endroid\QrCode\QrCode();
        $img = $qrCode
            ->setText($totp->getProvisioningUri(true))
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabel('Scan with Authenticator')
            ->setLabelFontSize(16)
            ->get('png');
        return base64_encode($img);
    }

    public static function genertateBase32Secret()
    {
        $bits = '';

        $fp = @fopen('/dev/urandom', 'rb');
        if ($fp !== false){
            $bits .= @fread($fp, ceil((5./8.)*(float)Config::get('TWO_FACTOR_AUTH_SECRET_DIGITS')));
            @fclose($fp);
        }
        
        if (strlen($bits) < ceil(5/8*Config::get('TWO_FACTOR_AUTH_SECRET_DIGITS')))
            $bits = openssl_random_pseudo_bytes(ceil(5/8*Config::get('TWO_FACTOR_AUTH_SECRET_DIGITS')));
        
        return (new \Base32\Base32())->encode($bits);
    }

    public static function generateRandomScratchCodes($num = 10){
        $codes = array();
        for ($i = 0; $i < 10; $i++)
            array_push($codes, self::generateRandomDigits(Config::get('TWO_FACTOR_AUTH_SCRATCH_CODES_DIGITS')));
        return $codes;
    }

    private static function generateRandomDigits($digits){
        $random = '';
        for ($i = 0; $i < $digits; $i++)
            $random .= rand(0, 9);
        return $random;
    }

}