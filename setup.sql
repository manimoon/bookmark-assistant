-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2014 at 04:10 PM
-- Server version: 5.5.33a-MariaDB
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookmarks`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
drop database if exists `bookmarks`;
create database `bookmarks`;
use `bookmarks`;


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_text` text,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `link_id` (`link_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes_dislikes`
--

CREATE TABLE IF NOT EXISTS `likes_dislikes` (
  `likes_dislikes_id` int(11) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `likedislike` text,
  KEY `link_id` (`link_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11),
  `title` text,
  `category` text,
  `url` text,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE IF NOT EXISTS `share` (
  `share_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  PRIMARY KEY (`share_id`),
  KEY `link_id` (`link_id`),
  KEY `from` (`from`),
  KEY `to` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text,
  `first_name` text,
  `last_name` text,
  `password` text,
  `email_id` text,
  `profile_pic` text,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--


INSERT INTO `user` (`user_id`,`username`, `first_name`, `last_name`, `password`, `email_id`, `profile_pic`, `dob`) VALUES
(0,'ratanraj', 'Ratanraj', 'Ravuri', 'killjoy', 'ratanraj.r@gmail.com', '', '1990-05-25');
INSERT INTO `user` (`user_id`,`username`, `first_name`, `last_name`, `password`, `email_id`, `profile_pic`, `dob`) VALUES
(1,'manimoon', 'Nagamani', 'Pilla', 'killjoy', 'mnmn151@gmail.com', '', '1991-10-20');
INSERT INTO `user` (`user_id`,`username`, `first_name`, `last_name`, `password`, `email_id`, `profile_pic`, `dob`) VALUES
(2,'aditya', 'Aditya', 'Reddy', 'killjoy', 'aditya.p@gmail.com', '', '1990-05-30');

--
--
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `likes_dislikes`
--
ALTER TABLE `likes_dislikes`
  ADD CONSTRAINT `likes_dislikes_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`),
  ADD CONSTRAINT `likes_dislikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `links`
--

--
-- Constraints for table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `share_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`),
  ADD CONSTRAINT `share_ibfk_2` FOREIGN KEY (`from`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `share_ibfk_3` FOREIGN KEY (`to`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
