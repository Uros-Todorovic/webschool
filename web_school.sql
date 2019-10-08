-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2019 at 06:30 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternate_text` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`) VALUES
(40, 'Tinker', NULL, NULL, 'Tinker.PNG', NULL, 'image/png', 1035424),
(41, 'Present', '', '<p><span style=\"color: #878787; font-family: Georgia, Times New Roman, Times, serif;\">Art or Photography Bootstrap Clean Design Gallery jQuery Minimalistic Personal Portfolio Responsive</span></p>\r\n<ul style=\"margin: 0px; padding: 0px; list-style: none; background-color: #ffffff;\">\r\n<li style=\"color: #878787; font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 16px; margin: 0px 15px 10px 0px; padding: 0px; display: inline-block;\">&nbsp;</li>\r\n</ul>', 'Present.PNG', '', 'image/png', 550999),
(42, 'SMBarber', NULL, NULL, 'SMBarber.PNG', NULL, 'image/png', 529322),
(43, 'Cloapedia', NULL, NULL, 'Cloapedia.PNG', NULL, 'image/png', 1257385),
(44, 'Xlight', NULL, NULL, 'Xlight.PNG', NULL, 'image/png', 1278617),
(45, 'GameInfo', NULL, NULL, 'GameInfo.PNG', NULL, 'image/png', 1144727),
(46, 'Marble', NULL, NULL, 'Marble.PNG', NULL, 'image/png', 732393),
(47, 'Chevesic', NULL, NULL, 'Chevesic.PNG', NULL, 'image/png', 523551),
(48, 'Kalay', NULL, NULL, 'Kalay.PNG', NULL, 'image/png', 1361484);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`) VALUES
(1, 'Urosh', '123', 'Uros', 'Todorovic', 'darth_vader.jpg'),
(54, 'admin', 'admin', 'Admin', 'Admin', 'r2d2.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
