CREATE DATABASE poll;

USE poll;
SET NAMES utf8;

CREATE TABLE poll_results (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  candidate VARCHAR(30),
  num_votes INT UNSIGNED
);

INSERT INTO poll_results(candidate, num_votes) VALUES
  ('Jan Novák', 0),
  ('Eva Krátká', 0),
  ('Josef Hájek', 0);

GRANT ALL PRIVILEGES
  ON poll.*
  TO poll@localhost
  IDENTIFIED BY 'poll';
