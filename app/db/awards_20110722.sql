USE awards;

ALTER TABLE rounds ADD COLUMN round_status tinyint(4) DEFAULT 1;
ALTER TABLE rounds MODIFY round_date TIMESTAMP DEFAULT '0000-00-00 00:00:00';