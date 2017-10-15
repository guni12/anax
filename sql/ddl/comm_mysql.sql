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
