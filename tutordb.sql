# Host: localhost    Database: tutorDB
# ------------------------------------------------------
# Server version 5.0.51b-community-nt-log

DROP DATABASE IF EXISTS `tutorDB`;
CREATE DATABASE `tutorDB` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tutorDB`;

#
# Source for table users
#

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `username` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY  (username)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Login_data`;
CREATE TABLE `Login_data` (
    `username` varchar(15) NOT NULL,
    `password_sha` char(255) NOT NULL,
    `last_login` TIMESTAMP,
    `num_failed_attempts` int UNSIGNED,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Parent`;
CREATE TABLE `Parent` (
    `username` varchar(15) NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Tutor;
CREATE TABLE Tutor (
    username varchar(15) NOT NULL,
    bio varchar(500),
    education varchar(500),
    house_num int NOT NULL,
    street varchar(255) NOT NULL,
    city varchar(100) NOT NULL,
    postal_code varchar(6) NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Tutor_topic_knowledge;
CREATE TABLE Tutor_topic_knowledge (
    username varchar(15) NOT NULL,
    topic_id int UNSIGNED NOT NULL,
    knowledge_level int UNSIGNED NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
