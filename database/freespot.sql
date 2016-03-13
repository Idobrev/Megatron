-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2016 at 02:09 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `freespot`
--

-- --------------------------------------------------------

--
-- Table structure for table `freespots`
--

CREATE TABLE IF NOT EXISTS `freespots` (
  `fs_id` int(60) unsigned NOT NULL AUTO_INCREMENT COMMENT 'FreeSport ID',
  `fs_metaInfo` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Unique Metainfo for the spot',
  `fa_comments` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Comments about the spot',
  `fs_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Current name of the spot',
  `fs_lat` double unsigned NOT NULL COMMENT 'Latitude',
  `fs_lng` double unsigned NOT NULL COMMENT 'Longtitude',
  PRIMARY KEY (`fs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `freespots`
--

INSERT INTO `freespots` (`fs_id`, `fs_metaInfo`, `fa_comments`, `fs_name`, `fs_lat`, `fs_lng`) VALUES
(1, 'BSSID + Frequency + MAC Address + SSID', 'The password here is: ', 'First Spot', 42.1604, 24.7536),
(3, 'BSSID + Frequency + MAC Address + SSID', 'The password here is: ', 'First Spot', 42.160192, 24.7536),
(4, 'BSSID + Frequency + MAC Address + SSID', 'No comments', 'Free spot', 42.1604, 24.7539);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_fname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` int(5) unsigned DEFAULT NULL COMMENT 'Level of the user',
  `user_token` varchar(35) CHARACTER SET utf8 NOT NULL COMMENT 'User token',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  FULLTEXT KEY `user_token` (`user_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_lname`, `user_fname`, `user_level`, `user_token`) VALUES
(9, 'admin', 'd68363dbd71f155631988dea6aadd44c0a6658af', 'jony_92@mail.bg', 'Ð”Ð¾Ð±Ñ€ÐµÐ²', 'Ð˜Ð²Ð°Ð½', 1, '8743d999faa77322556b1dc4b058ba87'),
(11, 'ivnon', 'b7f54b0639368f36f2fb98921f4a3ced08bf71bd', 'i.n.dobrev@mail.bg', 'Ð”Ð¾Ð±Ñ€ÐµÐ²', 'Ð˜Ð²Ð°Ð½', NULL, '4434c8da8a4874f3849cd044daf62472'),
(20, 'admin1', 'b7f54b0639368f36f2fb98921f4a3ced08bf71bd', 'thetormentor@mail.bg', 'Ð”Ð¾Ð±Ñ€ÐµÐ²', 'Ð˜Ð²Ð°Ð½', NULL, 'bd91bbd27742ce9b529a3fdbcdde5042'),
(23, 'admin1', 'b7f54b0639368f36f2fb98921f4a3ced08bf71bd', 'jony_922@mail.bg', 'Ð”Ð¾Ð±Ñ€ÐµÐ²', 'Ð˜Ð²Ð°Ð½', NULL, '93dc48ea363483e294fb24b5c3133b9a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
