CREATE TABLE IF NOT EXISTS users (
  user_id                       SERIAL      NOT NULL,
  session_id                    VARCHAR(48)          DEFAULT NULL,
  user_name                     VARCHAR(64) NOT NULL UNIQUE,
  user_password_hash            VARCHAR(255)         DEFAULT NULL,
  user_email                    VARCHAR(64) NOT NULL UNIQUE,
  user_active                   BOOLEAN     NOT NULL DEFAULT FALSE,
  user_deleted                  BOOLEAN     NOT NULL DEFAULT FALSE,
  user_account_type             INTEGER     NOT NULL DEFAULT 0,
  user_has_avatar               BOOLEAN     NOT NULL DEFAULT FALSE,
  user_remember_me_token        VARCHAR(64)          DEFAULT NULL,
  user_creation_timestamp       BIGINT               DEFAULT NULL,
  user_suspension_timestamp     BIGINT               DEFAULT NULL,
  user_last_login_timestamp     BIGINT               DEFAULT NULL,
  user_failed_logins            INT     NOT NULL DEFAULT 0,
  user_last_failed_login        INT                  DEFAULT NULL,
  user_activation_hash          VARCHAR(40)          DEFAULT NULL,
  user_password_reset_hash      CHAR(40)             DEFAULT NULL,
  user_password_reset_timestamp BIGINT               DEFAULT NULL,
  user_provider_type            TEXT,
  PRIMARY KEY (user_id)
);

INSERT INTO users (user_id,  session_id ,  user_name ,  user_password_hash ,  user_email ,  user_active ,  user_deleted ,  user_account_type ,
 user_has_avatar ,  user_remember_me_token ,  user_creation_timestamp ,  user_suspension_timestamp ,  user_last_login_timestamp ,
 user_failed_logins ,  user_last_failed_login ,  user_activation_hash ,  user_password_reset_hash ,
 user_password_reset_timestamp ,  user_provider_type ) VALUES
  (1, NULL, 'demo', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo@demo.com', TRUE , FALSE , 0, FALSE, NULL,
      1422205178, NULL, 1422209189, 0 , NULL, NULL, NULL, NULL, 'DEFAULT'),
  (2, NULL, 'demo2', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo2@demo.com', TRUE , FALSE , 1, FALSE , NULL,
      1422205178, NULL, 1422209189, 0 , NULL, NULL, NULL, NULL, 'DEFAULT');
