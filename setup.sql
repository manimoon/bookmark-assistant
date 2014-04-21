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

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `title` text,
  `category_id` int(11) DEFAULT NULL,
  `url` text,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`),
  KEY `category_id` (`category_id`)
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
(0,'ratanraj', 'Ratanraj', 'Ravuri', 'killjoy', 'ratanraj.r@gmail.com', '', '0000-00-00');

--
-- Constraints for dumped tables
--

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
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

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
