--
-- Creating a small table.
-- Create a database and a user having access to this database,
-- this must be done by hand, se commented rows on how to do it.
--



--
-- Create a database for test
--
-- DROP DATABASE anaxdb;
-- CREATE DATABASE IF NOT EXISTS anaxdb;
USE anaxdb;



--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table Book
--
DROP TABLE IF EXISTS Comm;
CREATE TABLE Comm (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userid` VARCHAR(80) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `title` VARCHAR(256) NOT NULL,    
    `comment` VARCHAR(1000) NOT NULL,
    `parentid` VARCHAR(80),
    `created` DATETIME,
    `updated` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

/*
From SHOW CREATE TABLE Comm\G

CREATE TABLE `Comm` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
 `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
 `title` varchar(256) COLLATE utf8_swedish_ci NOT NULL,
 `comment` varchar(1000) COLLATE utf8_swedish_ci NOT NULL,
 `parentid` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
 `created` datetime DEFAULT NULL,
 `updated` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `index_title` (`title`(255))
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci
*/
