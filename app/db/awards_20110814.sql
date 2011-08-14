USE awards;

ALTER TABLE votes ADD COLUMN comments TEXT AFTER votee_user_id;