CREATE DATABASE chat CHARACTER SET utf8 COLLATE utf8_general_ci;

use chat;
CREATE TABLE chatlog(
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  message TEXT,
  sent_by VARCHAR(50),
  time_created INT(11)
);