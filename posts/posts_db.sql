-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2014 at 05:35 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `posts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` text NOT NULL,
  `post_id` text NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdDate` datetime NOT NULL,
  `delete_status` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_id`, `post_id`, `email`, `name`, `comment`, `time_stamp`, `createdDate`, `delete_status`) VALUES
(1, 'f3a87287de844faeb3c0db1599b9cf14', '4d589156f3ce858e416477a8998b3b69', 'test@test.com', 'Test', 'Test comment', '2014-05-08 15:35:03', '2014-05-08 21:05:03', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `post_id` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `text` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `spam` enum('false','true') NOT NULL DEFAULT 'false',
  `delete_status` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_id`, `name`, `email`, `text`, `createdDate`, `time_stamp`, `spam`, `delete_status`) VALUES
(1, '4d589156f3ce858e416477a8998b3b69', 'Test', 'test@test.com', 'Test post', '2014-05-08 21:02:15', '2014-05-08 15:32:15', 'false', 'false');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
