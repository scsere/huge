CREATE TABLE IF NOT EXISTS notes (
  note_id   SERIAL NOT NULL,
  note_text TEXT   NOT NULL,
  user_id   INT    NOT NULL,
  PRIMARY KEY (note_id)
);
