CREATE DATABASE auth CHARACTER SET utf8 COLLATE utf8_general_ci;

USE auth;
SET NAMES utf8;

CREATE TABLE authorized_users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30),
  password VARCHAR(50)
);

INSERT INTO authorized_users(name, password) VALUES
  ('karelm', sha1('1234')),
  ('emils', sha1('1234')),
  ('kajam', sha1('1234'));

GRANT ALL PRIVILEGES
  ON auth.*
  TO webauth@localhost
  IDENTIFIED BY 'webauth';