-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2014 at 02:33 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `content`, `meta_keywords`, `meta_description`, `cover_image`, `created_at`, `updated_at`, `alias`, `type`) VALUES
(8, 1, 'Про вікна 1 - 1', '<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis.</p>\r\n', '', '', '4.jpg', '2014-05-02 16:17:56', '2014-05-03 17:08:21', 'provikna', 0),
(9, 1, 'Про вікна 1 - 2', '<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam id dolor id nibh ultricies. Cras justo odio, dapibus ac facilisis. Cras justo odio, dapibus ac facilisis.</p>\r\n', '', '', '3.jpg', '2014-05-02 16:18:12', '2014-05-03 17:02:54', 'provikna12', 0),
(10, 2, 'test 3', '<p>sadasdjhgh</p>\r\n', '', '', '7.jpg', '2014-05-03 16:52:16', '2014-05-03 17:03:05', 'test3', 0),
(11, 1, 'qweasd', '<p>fgbhgfhgfh</p>\r\n', '', '', '8.jpg', '2014-05-03 16:52:32', '2014-05-03 17:03:25', 'qweasd', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `content`, `alias`, `meta_keywords`, `meta_description`, `type`, `parent_id`) VALUES
(1, 'Вікна 1', '', 'vikna1', '', '', 0, 0),
(2, 'Вікна 2', '', 'vikna2', '', '', 0, 0),
(3, 'Про двері', '', 'prodveri', '', '', 0, 0),
(4, 'ще щось', '', 'scheschos', '', '', 0, 0),
(5, 'Нова катергорія', '<p>Нова катергоріяНова катергоріяНова катергорія</p>\r\n\r\n<p>Нова катергоріяНова катергоріяНова катергоріяНова катергорія</p>\r\n\r\n<p>Нова катергоріяНова катергоріяНова катергорія</p>\r\n', 'novakatergoriya', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `construction_type`
--

CREATE TABLE IF NOT EXISTS `construction_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coefficient` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Table structure for table `furniture`
--

CREATE TABLE IF NOT EXISTS `furniture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `furnitures`
--

CREATE TABLE IF NOT EXISTS `furnitures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coefficient` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `title`, `content`, `alias`, `meta_keywords`, `meta_description`, `type`, `parent_id`) VALUES
(1, 'Вікна', '', 'vikna', '', '', 0, 0),
(2, 'Двері', '', 'dveri', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `glass`
--

CREATE TABLE IF NOT EXISTS `glass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='склопакет' AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `title`, `description`, `type`, `owner_id`) VALUES
(1, '16139581270061.jpg', 'test', 'test', 'Article', 1),
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
(36, '18139909902354.jpg', '', '', 'WorkGallery', 0),
(37, '12139912698064.jpg', '', '', 'Article', 8),
(38, '88139912698019.jpg', '', '', 'Article', 8),
(39, '80139912698079.jpg', '', '', 'Article', 8),
(40, '77139912698036.jpeg', '', '', 'Article', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `meta_keywords`, `meta_description`, `alias`) VALUES
(1, 'Головна', '<h3>Scandinavian Style Interiors</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id augue eget mauris sollicitudin malesuada. Nulla facilisi. Nam eleifend facilisis dui at cursus. Nunc lorem sapien, auctor a vestibulum nec, viverra a orci. Vestibulum fringilla lectus et enim ultricies eu ultrices ligula scelerisque.</p>\r\n', '', '', 'home'),
(3, 'cont', '<p>AaSDSADSAD SADSAD ASDdsfds fdss fddsf dsf</p>\r\n', '', '', 'contact'),
(4, 'gallery', 'gallery', '', '', 'gallery'),
(6, 'faq', 'faq', '', '', 'faq'),
(7, 'about', 'adsasd', '', '', 'about'),
(8, 'Калькулятор', 'текст', '', '', 'calc');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_1` varchar(255) NOT NULL,
  `phone_2` varchar(255) NOT NULL,
  `google_map` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_3` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `phone_1`, `phone_2`, `google_map`, `address`, `phone_3`, `skype`) VALUES
(1, '111-1111-11', '2222-222-2', '<iframe width="100%" height="542" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ua/maps?f=q&amp;source=s_q&amp;hl=uk&amp;geocode=&amp;q=%D0%86%D0%B2%D0%B0%D0%BD%D0%BE-%D0%A4%D1%80%D0%B0%D0%BD%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA,+%D0%B2%D1%83%D0%BB.+%D0%94%D0%BE%D0%B2%D0%B3%D0%B0+60&amp;aq=t&amp;sll=48.911773,24.717129&amp;sspn=0.261515,0.454903&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%B2%D1%83%D0%BB.+%D0%94%D0%BE%D0%B2%D0%B3%D0%B0,+60,+%D0%86%D0%B2%D0%B0%D0%BD%D0%BE-%D0%A4%D1%80%D0%B0%D0%BD%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA,+%D0%86%D0%B2%D0%B0%D0%BD%D0%BE-%D0%A4%D1%80%D0%B0%D0%BD%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&amp;ll=48.928194,24.701548&amp;spn=0.00602,0.009645&amp;t=m&amp;z=14&amp;output=embed&language=ua"></iframe>', 'Місто, вул, будинок', '333-333-33', 'andrelinoge87');

-- --------------------------------------------------------

--
-- Table structure for table `sizer_requests`
--

CREATE TABLE IF NOT EXISTS `sizer_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sizer_requests`
--

INSERT INTO `sizer_requests` (`id`, `name`, `phone`, `created_at`, `updated_at`, `is_read`, `address`, `content`) VALUES
(1, 'zxc', 'zc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'zxc', 'sdf'),
(2, 'zxc', 'zc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'zxc', 'sdf'),
(3, 'zxc', 'zc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'zxc', 'sdf'),
(4, 'zxc', 'zc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'zxc', 'sdf'),
(5, 'zxc', 'zxc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'zc', 'sadf');

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

-- --------------------------------------------------------

--
-- Table structure for table `window_systems`
--

CREATE TABLE IF NOT EXISTS `window_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coefficient` float NOT NULL,
  `profile_frame` float NOT NULL,
  `profile_leaf` float NOT NULL,
  `profile_impost` float NOT NULL,
  `reinforcement` float NOT NULL,
  `seal` float NOT NULL,
  `glazing` float NOT NULL,
  `window_sill_prfile` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `work_gallery`
--

CREATE TABLE IF NOT EXISTS `work_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` char(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` char(20) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `work_gallery`
--

INSERT INTO `work_gallery` (`id`, `image`, `title`, `description`, `type`, `owner_id`, `category_id`) VALUES
(1, '1.jpg', 'qwewqe qwewqe', 'qwewqe qwe wqewqe', 'WorkGallery', 0, 1),
(2, '7.jpg', 'fdgdfg', 'dfgdfg', 'WorkGallery', 0, 2),
(3, '12.jpg', 'dfgdfg', 'dfgfdg', 'WorkGallery', 0, 1),
(5, '11.jpeg', 'sadasd', 'asdasdsad', 'WorkGallery', 0, 2),
(6, '2.jpg', 'asd', 'sadsad', 'WorkGallery', 0, 2),
(7, '10.jpg', 'asdasd', 'asdasd', 'WorkGallery', 0, 1),
(8, '13.jpg', 'asasd', 'asd', 'WorkGallery', 0, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
