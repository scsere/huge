ROLLBACK;
START TRANSACTION;
CREATE TABLE IF NOT EXISTS totp (
  tid              SERIAL,
  user_id          INT,
  tsecret          VARCHAR(256)             NOT NULL,
  tsecretgenerated TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT current_timestamp,
  tenabled         BOOLEAN                  NOT NULL,

  CONSTRAINT pk_tid PRIMARY KEY (tid),
  CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users (user_id) MATCH SIMPLE
);

CREATE TABLE IF NOT EXISTS scratchcodes (
  scid          SERIAL,
  tid           INT          NOT NULL,
  sccode        VARCHAR(128) NOT NULL,
  scvalid       BOOLEAN                  DEFAULT TRUE,
  scinvalidated TIMESTAMP WITH TIME ZONE DEFAULT NULL,
  CONSTRAINT pk_scid PRIMARY KEY (scid),
  CONSTRAINT u_sccode_tid UNIQUE (scid, tid),
  CONSTRAINT fk_tid FOREIGN KEY (tid) REFERENCES totp (tid) MATCH SIMPLE
);

COMMIT;