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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Login_data`;
CREATE TABLE `Login_data` (
    `username` varchar(15) NOT NULL,
    `password_sha` char(255) NOT NULL,
    `last_login` TIMESTAMP,
    `num_failed_attempts` int UNSIGNED,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Parent`;
CREATE TABLE `Parent` (
    `username` varchar(15) NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Tutor;
CREATE TABLE Tutor (
    username varchar(15) NOT NULL,
    bio varchar(500),
    education varchar(500),
    house_num int NOT NULL,
    street varchar(100) NOT NULL,
    city varchar(100) NOT NULL,
    postal_code varchar(6) NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Tutor_topic_knowledge;
CREATE TABLE Tutor_topic_knowledge (
    username varchar(15) NOT NULL,
    topic_id int UNSIGNED NOT NULL,
    knowledge_level int UNSIGNED NOT NULL,
    PRIMARY KEY (username,topic_id),
    FOREIGN KEY (topic_id) REFERENCES Topic(topic_id),
    FOREIGN KEY (username) REFERENCES User(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Topic;
CREATE TABLE Topic (
    topic_id int UNSIGNED NOT NULL,
    name varchar(50) NOT NULL,
    description varchar(500),
    PRIMARY KEY (topic_id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Review;
CREATE TABLE Review (
    parent_uname varchar(15) NOT NULL,
    tutor_uname varchar(15) NOT NULL,
    time_stamp TIMESTAMP,
    comment varchar(500),
    rating int UNSIGNED NOT NULL,
    PRIMARY KEY (parent_uname,tutor_uname),
    FOREIGN KEY (parent_uname) REFERENCES Parent(username),
    FOREIGN KEY (tutor_uname) REFERENCES Tutor(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Student;
CREATE TABLE Student (
    student_id int UNSIGNED NOT NULL,
    dob DATE NOT NULL,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    parent_uname varchar(15) NOT NULL,
    PRIMARY KEY (parent_uname),
    FOREIGN KEY (parent_uname) REFERENCES Parent(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Class;
CREATE TABLE Class (
    class_id int UNSIGNED NOT NULL,
    name varchar(50) NOT NULL,
    description varchar(500),
    enroll_open boolean NOT NULL DEFAULT TRUE,
    tutor_uname varchar(15) NOT NULL,
    topic_id int UNSIGNED NOT NULL,
    PRIMARY KEY (class_id),
    FOREIGN KEY (tutor_uname) REFERENCES Tutor(username),
    FOREIGN KEY (topic_id) REFERENCES Topic(topic_id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Enrolled;
CREATE TABLE Enrolled (
    student_id int UNSIGNED NOT NULL,
    class_id int UNSIGNED NOT NULL,
    enrollment_date TIMESTAMP NOT NULL,
    PRIMARY KEY (student_id,class_id),
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Session;
CREATE TABLE Session (
    class_id int UNSIGNED NOT NULL,
    session_num int UNSIGNED NOT NULL,
    summary varchar(500),
    location_id int UNSIGNED NOT NULL,
    sched_item_id int UNSIGNED NOT NULL,
    PRIMARY KEY (class_id,session_num),
    FOREIGN KEY (class_id) REFERENCES Class(class_id),
    FOREIGN KEY (location_id) REFERENCES Location(location_id),
    FOREIGN KEY (sched_item_id) REFERENCES Schedule_item(schitem_id)
)  ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Location;
CREATE TABLE Location (
    location_id int UNSIGNED NOT NULL,
    bld_number int UNSIGNED NOT NULL,
    street varchar(100) NOT NULL,
    city varchar(100) NOT NULL,
    postal_code varchar(6) NOT NULL,
    building_name varchar(100),
    PRIMARY KEY (location_id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Schedule_item;
CREATE TABLE Schedule_item (
    schitem_id int UNSIGNED NOT NULL,
    start_time TIMESTAMP NOT NULL,
    end_time TIMESTAMP NOT NULL,
    ddmmyyyy DATE NOT NULL,
    tutor_uname varchar(15) NOT NULL,
    avail_flag boolean NOT NULL DEFAULT TRUE,
    sessionitem_flag boolean NOT NULL,
    PRIMARY KEY (schitem_id),
    FOREIGN KEY (tutor_uname) REFERENCES Tutor(username)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;