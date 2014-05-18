-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2014 at 10:06 AM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diploma`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `alias` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `content`, `meta_keywords`, `meta_description`, `cover_image`, `created_at`, `updated_at`, `alias`, `type`) VALUES
(8, 1, 'Про вікна 1 - 1', '<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis.</p>\r\n', '', '', 'what-the-cameras-saw-was-astounding.jpg.png', '2014-05-02 16:17:56', '2014-05-02 16:18:41', 'provikna', 0),
(9, 1, 'Про вікна 1 - 2', '<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis.</p>\r\n', '', '', '113596.jpg', '2014-05-02 16:18:12', '2014-05-02 16:20:15', 'provikna12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `content`, `alias`, `meta_keywords`, `meta_description`, `type`, `parent_id`) VALUES
(1, 'Вікна 1', '', 'vikna1', '', '', 0, 0),
(2, 'Вікна 2', '', 'vikna2', '', '', 0, 0),
(3, 'Про двері', '', 'prodveri', '', '', 0, 0),
(4, 'ще щось', '', 'scheschos', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `content`, `created_at`, `updated_at`, `is_read`) VALUES
(1, 'AAA', 'aa@aaa.com', 'sadsadsad k jkhdhjksagd sa dsadsadsad k jkhdhjksagd sa dsadsadsad k jkhdhjksagd sa dsadsadsad k jkhdhjksagd sa dsadsadsad k jkhdhjksagd sa d sadsadsad k jkhdhjksagd sa d sadsadsad k jkhdhjksagd sa d', '2014-03-05 22:47:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `content`) VALUES
(1, 'Питання', '<p>Відповідь</p>\r\n'),
(2, 'Question 2', '<p>Answer 2</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` char(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` char(20) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `title`, `description`, `type`, `owner_id`) VALUES
(1, '16139581270061.jpg', 'test', 'test', 'Article', 1),
(2, '22139903679437.png', '', '', 'Article', 8),
(3, '62139903679594.jpg', '', '', 'Article', 8),
(4, '29139903679514.jpeg', '', '', 'Article', 8),
(5, '97139903679544.jpg', '', '', 'Article', 8),
(6, '9139903682287.jpg', '', '', 'Article', 9),
(7, '17139903682224.jpg', '', '', 'Article', 9),
(8, '211399036823100.jpg', '', '', 'Article', 9),
(9, '0139903682391.jpg', '', '', 'Article', 9),
(10, 'url.jpeg', 'zxczxc', 'vcbcvb c cb bcvbcvbcv', 'Slider', 0),
(11, '4781382676_edbae5c8e2_b.jpg', 'sdf sdfsdf', 'sfsdfsd sdfsdfsd sdfdsf', 'Slider', 0),
(12, '113596.jpg', 'bbb', 'bvbcb', 'Slider', 0),
(13, 'what-the-cameras-saw-was-astounding.jpg.png', 'Title 1', 'Title 1Title 1Title 1Title 1Title 1Title 1', 'WorkGallery', 0),
(27, '36139909902294.jpg', 'Title 2', 'Title 2Title 2Title 2Title 2', 'WorkGallery', 0),
(28, '18139909902254.jpeg', 'Title 3', 'Title 3Title 3Title 3Title 3', 'WorkGallery', 0),
(29, '85139909902211.png', 'Title 4', 'Title 4Title 4Title 4Title 4', 'WorkGallery', 0),
(30, '100139909902244.jpg', '', '', 'WorkGallery', 0),
(31, '3139909902238.jpg', '', '', 'WorkGallery', 0),
(32, '6913990990233.jpg', '', '', 'WorkGallery', 0),
(33, '62139909902385.jpg', '', '', 'WorkGallery', 0),
(34, '691399099023100.jpg', '', '', 'WorkGallery', 0),
(35, '5139909902363.jpg', '', '', 'WorkGallery', 0),
(36, '18139909902354.jpg', '', '', 'WorkGallery', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_1` varchar(255) NOT NULL,
  `phone_2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `phone_1`, `phone_2`) VALUES
(1, '111-1111-11', '2222-222-2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `email` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `salt` char(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `photo` char(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `salt`, `first_name`, `last_name`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@mail.com', '01017791ef4d68075a9fcf9c4e6d857f4453781d', '4bffabff2f', 'admin', 'admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
