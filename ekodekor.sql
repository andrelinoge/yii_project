-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2014 at 02:20 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ekodekor`
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
  `type` char(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `category_id` (`category_id`),
  KEY `type_2` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `content`, `meta_keywords`, `meta_description`, `cover_image`, `created_at`, `updated_at`, `alias`, `type`) VALUES
(1, 3, 'Collectio 1', '<p>sadsad</p>\r\n', '', '', '1.jpg', '2014-04-07 09:11:58', '0000-00-00 00:00:00', 'collectio1', 'Product'),
(2, 3, 'Collection 2', '<p>asd</p>\r\n', '', '', '2.jpg', '2014-04-07 09:28:54', '2014-04-07 09:31:13', 'collection2', 'Product'),
(3, 0, 'Тестова нивна 1', '<h2>Варианты организации категорий</h2>\r\n\r\n<p>В определённый момент число моделей категорий начнёт расти. Появятся категории блога, категории магазина, категории портфолио и т.д. с методом <code>getMenuList()</code> для генерации пунктов меню. Для вложенных категорий и вложенных статических страниц нам уже потребовалось ввести свои методы <code>findByPath()</code>. Было бы неплохо сделать несколько удобных методов для построения различных списков. Разброс наборов одинаковых методов по разным моделям засоряет код, поэтому целесообразнее сделать универсальными и собрать все в одном месте. Рассмотрим два варианта.</p>\r\n\r\n<h3>1. Выделение общих методов в базовый класс</h3>\r\n\r\n<p>Для объединения общего кода можно выделить базовый абстрактный или конкретный класс Category, от которого наследовать все модели категорий.</p>\r\n', '', '', '6.jpg', '2014-04-07 21:23:33', '0000-00-00 00:00:00', 'testovanivna1', 'News'),
(4, 0, 'Тестова нoвbна 2', '<p class="para">This can be more reliable than simply adding or subtracting the number of seconds in a day or month to a timestamp because of daylight saving time.</p>\r\n\r\n<p class="para">Some examples of <span class="function"><strong>date()</strong></span> formatting. Note that you should escape any other characters, as any which currently have a special meaning will produce undesirable results, and other characters may be assigned meaning in future PHP versions. When escaping, be sure to use single quotes to prevent characters like \\n from becoming newlines.</p>\r\n', '', '', '5.jpg', '2014-04-08 09:43:14', '0000-00-00 00:00:00', 'testovanovbna2', 'News'),
(5, 0, 'Тестова нoвина 3', '<p class="para">This can be more reliable than simply adding or subtracting the number of seconds in a day or month to a timestamp because of daylight saving time.</p>\r\n\r\n<p class="para">Some examples of <span class="function"><strong>date()</strong></span> formatting. Note that you should escape any other characters, as any which currently have a special meaning will produce undesirable results, and other characters may be assigned meaning in future PHP versions. When escaping, be sure to use single quotes to prevent characters like \\n from becoming newlines.</p>\r\n', '', '', '5.jpg', '2014-04-08 09:46:12', '0000-00-00 00:00:00', 'testovanovina3', 'News');

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `type` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `content`, `meta_description`, `meta_keywords`, `alias`, `type`, `parent_id`) VALUES
(1, 'Длинные карнизы', '', '', '', 'dlinnyekarnizy', 0, 0),
(2, 'Карнизы с орнаментом', '', '', '', 'karnizysornamentom', 0, 0),
(3, 'Молдинги с орнаментом', '', '', '', 'moldingisornamentom', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `content`) VALUES
(1, 'Question 1', '<p>Достоинство этого подхода (с выносом подзапроса в именованное представление) в том, что можно настраивать поиск для каждого сайта прямо в схеме базы, не влезая в программный код приложения.</p>\r\n'),
(2, 'Question 2', '<p>Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n'),
(3, 'Question 3', '<p>Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Ut adipiscing, leo nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu, vehicula ac mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` char(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` char(20) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `title`, `description`, `type`, `owner_id`) VALUES
(7, '61139684882024.jpg', '', '', 'Slider', 0),
(8, '88139684882061.jpg', '', '', 'Slider', 0),
(9, '4013968490111.jpg', '', '', 'Slider', 0),
(10, '45139684906086.jpg', '', '', 'Slider', 0),
(11, '16139684911698.jpg', '', '', 'Slider', 0),
(12, '74139684917169.jpg', '', '', 'Slider', 0),
(13, '4513968523428.jpg', '', '', 'Slider', 0),
(14, '1.jpg', 'Test 1', 'Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.', 'WorkGallery', 0),
(15, '3.jpg', 'test 2', 'Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.', 'WorkGallery', 0),
(16, '5.jpg', 'test 3', 'Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.', 'WorkGallery', 0),
(17, '6.jpg', 'test 4', 'Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.', 'WorkGallery', 0),
(24, '8413969436004.jpg', '', '', 'Product', 1),
(25, '51139694360041.jpg', '', '', 'Product', 1),
(26, '0139694360037.jpg', '', '', 'Product', 1),
(29, '97139704126560.jpg', 'test 5', 'Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.', 'WorkGallery', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `meta_keywords`, `meta_description`, `alias`) VALUES
(1, 'Головна', '<h3>Scandinavian Style Interiors</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id augue eget mauris sollicitudin malesuada. Nulla facilisi. Nam eleifend facilisis dui at cursus. Nunc lorem sapien, auctor a vestibulum nec, viverra a orci. Vestibulum fringilla lectus et enim ultricies eu ultrices ligula scelerisque.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="/application/public/uploads/files/flinch_wiki.odt">Lore</a>m ipsum dolor sit amet, consectetur adipiscing elit. Integer id augue eget mauris sollicitudin malesuada. Nulla facilisi. Nam eleifend facilisis dui at cursus. Nunc lorem sapien, auctor a vestibulum nec, viverra a orci. Vestibulum fringilla lectus et enim ultricies eu ultrices ligula scelerisque.</p>\r\n', '', '', 'home'),
(2, 'Новини', '<p>Если Вы не любите использовать DAO или если ссылки в вашем проекте генерируются не очень банально (например, если проект многоязычный и нужно использовать указание языка в адресе), то можно воспользоваться достоинствами ActiveRecord.</p>\r\n\r\n<h2><strong>Использование ActiveRecord</strong></h2>\r\n\r\n<p>Замечательной особенностью представлений в БД является то, что они воспринимаются внешним миром как таблицы. Соответственно, для работы с этой виртуальной таблицей как с реальной мы можем использовать модель <code>CActiveRecord</code>.</p>\r\n', 's', '', 'news'),
(3, 'cont', 'A', '', '', 'contact'),
(4, 'gallery', 'gallery', '', '', 'gallery'),
(5, 'print_catalog', '', '', '', 'print_catalog'),
(6, 'faq', 'faq', '', '', 'faq');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `salt`, `first_name`, `last_name`, `photo`, `created_at`, `updated_at`) VALUES
(2, 1, 'admin@mail.com', '730c77392d2e8bcd0a4d1a444dac515a0d85f46c', 'c029b58504', 'admin', 'admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
