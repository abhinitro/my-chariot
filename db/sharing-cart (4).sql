-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 09:04 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharing-cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `title`, `description`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(1, 'dff', 'dff', 0, 0, '2018-05-04 20:44:51', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `cookie_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `create_user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `amount`, `quantity`, `detail`, `url`, `state_id`, `type_id`, `created_on`, `updated_on`, `cookie_id`, `create_user_id`) VALUES
(1, 20, '56', 1, NULL, NULL, 0, 0, NULL, NULL, 'Pcwr0jGXCkaV3xU', 0),
(3, 13, '24.75', 1, NULL, NULL, 0, 0, NULL, NULL, 'Pcwr0jGXCkaV3xU', 0),
(4, 15, '189.2', 1, NULL, NULL, 0, 0, NULL, NULL, 'Pcwr0jGXCkaV3xU', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `keyword`, `slug`, `description`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(3, 'dfdf', NULL, NULL, 'fdfff', 0, 0, '2018-05-04 20:03:51', NULL, 1),
(4, 'df', NULL, NULL, 'fgtg', 0, 0, '2018-05-04 20:13:03', '2018-05-04 20:32:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_use` int(11) DEFAULT '0',
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_applied`
--

CREATE TABLE `coupons_applied` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT '1',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`id`, `title`, `slug`, `description`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(3, 'g', 'g', 'fg', 1, 0, '2018-05-14 18:21:30', NULL, 1),
(4, 'printer', 'printer', 'printer', 1, 0, '2018-05-14 19:50:12', NULL, 1),
(5, 'printerssss', 'printer', 'printer', 1, 0, '2018-05-14 19:50:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id`, `title`, `model_id`, `model_type`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(1, '4', 22, 'app\\models\\Product', 0, 0, '2018-05-30 19:05:21', NULL, 1),
(2, '45', 22, 'app\\models\\Product', 0, 0, '2018-05-30 19:05:21', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_id`, `model_type`, `size`, `title`, `file_name`, `thumb_file`, `alt`, `original_name`, `extension`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(1, 3, 'app\\models\\Category', '201366', NULL, 'new7m[1]_1525457031.jpg', 'new7m[1]_1525457031-thumb.jpg', NULL, 'new7m[1]', 'jpg', 0, 0, NULL, NULL, 1),
(2, 4, 'app\\models\\Category', '413480', NULL, 'new5s[1]_1525458736.jpg', 'new5s[1]_1525458736-thumb.jpg', NULL, 'new5s[1]', 'jpg', 0, 0, NULL, NULL, 1),
(3, 1, 'app\\models\\Brand', '201366', NULL, 'new7m[1]_1525459492.jpg', 'new7m[1]_1525459492-thumb.jpg', NULL, 'new7m[1]', 'jpg', 0, 0, NULL, NULL, 1),
(4, 1, 'app\\models\\SubCategory', '219955', NULL, 'new0a[1]_1525590427.jpg', 'new0a[1]_1525590427-thumb.jpg', NULL, 'new0a[1]', 'jpg', 0, 0, NULL, NULL, 1),
(5, 2, 'app\\models\\SubCategory', '314745', NULL, 'new2d[1] - Copy_1525593432.jpg', 'new2d[1] - Copy_1525593432-thumb.jpg', NULL, 'new2d[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(6, 1, 'app\\models\\Product', '210638', NULL, 'new1v[1] - Copy_1525635906.jpg', 'new1v[1] - Copy_1525635907-thumb.jpg', NULL, 'new1v[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(7, 2, 'app\\models\\Product', '210638', NULL, 'new1v[1]_1525636205.jpg', 'new1v[1]_1525636205-thumb.jpg', NULL, 'new1v[1]', 'jpg', 0, 0, NULL, NULL, 1),
(8, 3, 'app\\models\\Product', '219955', NULL, 'new0a[1]_1525710672.jpg', 'new0a[1]_1525710673-thumb.jpg', NULL, 'new0a[1]', 'jpg', 0, 0, NULL, NULL, 1),
(9, 4, 'app\\models\\Product', '210638', NULL, 'new1v[1] - Copy_1525712276.jpg', 'new1v[1] - Copy_1525712276-thumb.jpg', NULL, 'new1v[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(11, 5, 'app\\models\\Product', '210638', NULL, 'new1v[1]_1525809144.jpg', 'new1v[1]_1525809149-thumb.jpg', NULL, 'new1v[1]', 'jpg', 0, 0, NULL, NULL, 1),
(12, 5, 'app\\models\\Product', '314745', NULL, 'new2d[1] - Copy_1525809150.jpg', 'new2d[1] - Copy_1525809150-thumb.jpg', NULL, 'new2d[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(13, 5, 'app\\models\\Product', '338997', NULL, 'new3h[1]_1525809151.jpg', 'new3h[1]_1525809152-thumb.jpg', NULL, 'new3h[1]', 'jpg', 0, 0, NULL, NULL, 1),
(14, 1, 'app\\models\\Deal', '219955', NULL, 'new0a[1]_1526069187.jpg', 'new0a[1]_1526069188-thumb.jpg', NULL, 'new0a[1]', 'jpg', 0, 0, NULL, NULL, 1),
(15, 2, 'app\\models\\Deal', '210638', NULL, 'new1v[1]_1526069224.jpg', 'new1v[1]_1526069224-thumb.jpg', NULL, 'new1v[1]', 'jpg', 0, 0, NULL, NULL, 1),
(16, 6, 'app\\models\\Product', '210638', NULL, 'new1v[1] - Copy_1526069344.jpg', 'new1v[1] - Copy_1526069345-thumb.jpg', NULL, 'new1v[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(17, 6, 'app\\models\\Product', '210638', NULL, 'new1v[1]_1526069345.jpg', 'new1v[1]_1526069345-thumb.jpg', NULL, 'new1v[1]', 'jpg', 0, 0, NULL, NULL, 1),
(18, 6, 'app\\models\\Product', '314745', NULL, 'new2d[1] - Copy_1526069345.jpg', 'new2d[1] - Copy_1526069345-thumb.jpg', NULL, 'new2d[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(19, 3, 'app\\models\\Deal', '338997', NULL, 'new3h[1] - Copy_1526314891.jpg', 'new3h[1] - Copy_1526314893-thumb.jpg', NULL, 'new3h[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(26, 13, 'app\\models\\Product', '210638', NULL, 'new1v[1]_1526318958.jpg', 'new1v[1]_1526318959-thumb.jpg', NULL, 'new1v[1]', 'jpg', 0, 0, NULL, NULL, 1),
(27, 13, 'app\\models\\Product', '314745', NULL, 'new2d[1] - Copy - Copy_1526318959.jpg', 'new2d[1] - Copy - Copy_1526318959-thumb.jpg', NULL, 'new2d[1] - Copy - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(28, 13, 'app\\models\\Product', '338997', NULL, 'new3h[1]_1526318959.jpg', 'new3h[1]_1526318959-thumb.jpg', NULL, 'new3h[1]', 'jpg', 0, 0, NULL, NULL, 1),
(29, 13, 'app\\models\\Product', '88104', NULL, 'new4e[1] - Copy_1526318959.jpg', 'new4e[1] - Copy_1526318959-thumb.jpg', NULL, 'new4e[1] - Copy', 'jpg', 0, 0, NULL, NULL, 1),
(30, 4, 'app\\models\\Deal', '19428', NULL, 'dsnew-printers-drawer-2-1b_1526320213.jpg', 'dsnew-printers-drawer-2-1b_1526320214-thumb.jpg', NULL, 'dsnew-printers-drawer-2-1b', 'jpg', 0, 0, NULL, NULL, 1),
(31, 15, 'app\\models\\Product', '73185', 'df', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526581352.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526581352-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(32, 16, 'app\\models\\Product', '5975', 'fd', 'prinert_1526582494.jpg', 'prinert_1526582494-thumb_200x200.jpg', NULL, 'prinert', 'jpg', 0, 0, NULL, NULL, 1),
(33, 17, 'app\\models\\Product', '73185', 'df45', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526582648.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526582648-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(34, 18, 'app\\models\\Product', '73185', 'fg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526582694.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526582694-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(35, 18, 'app\\models\\Product', '19428', 'fg', 'dsnew-printers-drawer-2-1b_1526583547.jpg', 'dsnew-printers-drawer-2-1b_1526583547-thumb_200x200.jpg', NULL, 'dsnew-printers-drawer-2-1b', 'jpg', 0, 0, NULL, NULL, 1),
(36, 18, 'app\\models\\Product', '73185', 'fg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526583594.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526583594-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(37, 18, 'app\\models\\Product', '73185', 'fg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526583826.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1526583826-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(38, 18, 'app\\models\\Product', '15976', 'fg', 'hp_1526583890.jpg', 'hp_1526583890-thumb_200x200.jpg', NULL, 'hp', 'jpg', 0, 0, NULL, NULL, 1),
(39, 18, 'app\\models\\Product', '15976', 'fg', 'hp_1526583901.jpg', 'hp_1526583901-thumb_200x200.jpg', NULL, 'hp', 'jpg', 0, 0, NULL, NULL, 1),
(40, 19, 'app\\models\\Product', '73185', 'rfgf', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527011746.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527011746-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(41, 20, 'app\\models\\Product', '73185', 'sdfg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527014200.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527014200-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1),
(43, 22, 'app\\models\\Product', '73185', '4545', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527699921.jpg', 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT_1527699921-thumb_200x200.jpg', NULL, 'cR4RklWx5iReAO71Hz0_i6KgIP5NEFLT', 'jpg', 0, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1525455203),
('m180429_172439_create_coupons_applied_table', 1525455213),
('m180429_191351_add_start_date_column_to_coupon_table', 1525455214),
('m180429_191651_add_end_date_column_to_coupon_table', 1525455216),
('m180501_160231_create_auth_table', 1525455219);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `deal_id` int(11) DEFAULT '0',
  `part_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_ids` text COLLATE utf8_unicode_ci,
  `package_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `youtube_link` text COLLATE utf8_unicode_ci,
  `discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `category_id`, `sub_category_id`, `brand_id`, `deal_id`, `part_number`, `amount`, `slug`, `product_ids`, `package_detail`, `youtube_link`, `discount`, `description`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(13, 'tyy', 3, 1, 1, 3, '34345', '45', 'tyy', NULL, '', NULL, '45', 'fg455', 1, 0, '2018-05-14 19:29:18', NULL, 1),
(15, 'df', 3, 2, 1, 3, '344', '344', 'df', '', '', NULL, '45', '344', 1, 0, '2018-05-17 20:22:32', NULL, 1),
(16, 'fd', 3, 2, 1, 4, '45', '45', 'fd', '13,15', '', NULL, '45', '45', 1, 0, '2018-05-17 20:41:34', NULL, 1),
(17, 'df45', 3, 1, 1, 3, 'fr', '34', 'df45', '', '', NULL, '34', '34', 1, 0, '2018-05-17 20:44:08', NULL, 1),
(18, 'fg', 3, 2, 1, 4, '56', '56', 'fg', '13,15', '', NULL, '56', '56', 1, 0, '2018-05-17 20:44:54', '2018-05-17 21:07:35', 1),
(19, 'rfgf', 3, 2, 1, 4, '676', '67', 'rfgf', '13,15', '', NULL, '67', '67', 1, 0, '2018-05-22 19:55:45', '2018-05-22 19:57:00', 1),
(20, 'sdfg', 3, 1, 1, 3, 'ftg', '56', 'sdfg', '13,15,16,17,18,19', '', 'https://www.youtube.com/embed/OGGHKpV01cs', '', '', 1, 0, '2018-05-22 20:36:39', NULL, 1),
(22, '4545', 3, 2, 1, 5, 'ytu', '45', '4545', '13', '[{\"package\":\"rt\",\"quantity\":\"rt\"},{\"package\":\"8\",\"quantity\":\"8\"}]', 'https://www.youtube.com/embed/OGGHKpV01cs', '56', 'yu', 1, 0, '2018-05-30 19:05:21', '2018-05-30 19:49:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `title`, `product_id`, `min_quantity`, `max_quantity`, `price`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(12, 'tyy', 13, 2, 4, '4', 0, 0, '2018-05-14 19:29:20', NULL, 1),
(15, 'fg', 18, 3, 4, '4', 0, 0, '2018-05-17 21:07:35', NULL, 1),
(16, 'fg', 18, 3, 4, '4', 0, 0, '2018-05-17 21:07:35', NULL, 1),
(20, 'rfgf', 19, 56, 56, '56', 0, 0, '2018-05-22 19:57:00', NULL, 1),
(21, 'sdfg', 20, 2, 3, '3', 0, 0, '2018-05-22 20:36:41', NULL, 1),
(28, '4545', 22, 78, 8, '78', 0, 0, '2018-05-30 19:49:08', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `ratings` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `title`, `slug`, `category_id`, `sub_category_id`, `description`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(1, 'rgt', NULL, 3, 0, 'df', 0, 0, '2018-05-06 09:07:02', NULL, 1),
(2, 'ghyg', NULL, 3, 1, 'ggg', 0, 0, '2018-05-06 09:57:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '2',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `create_user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `full_name`, `contact_no`, `profile_image`, `address`, `latitude`, `longitude`, `auth_key`, `access_token`, `password`, `oauth_client`, `oauth_client_user_id`, `email`, `status`, `created_on`, `updated_on`, `last_login`, `logged_at`, `state_id`, `role_id`, `type_id`, `create_user_id`) VALUES
(1, 'admin', 'admin', '', NULL, NULL, NULL, NULL, '', '', '$2y$13$.mrtF37GBWR9QuyU2EpswuvmfgujAwVfa8PbnMcibvHvsNpZ.ym4O', NULL, NULL, 'admin@gmail.com', 2, NULL, NULL, '2018-05-30 07:22:40', NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupon`
--

CREATE TABLE `user_coupon` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-auth-user_id-user-id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brand_create_user_id` (`create_user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_create_user_id` (`create_user_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coupon_create_user_id` (`create_user_id`);

--
-- Indexes for table `coupons_applied`
--
ALTER TABLE `coupons_applied`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-coupons-applied-coupon_id` (`coupon_id`),
  ADD KEY `idx-coupons-applied-create_user_id` (`create_user_id`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_deal_create_user_id` (`create_user_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_file_create_user_id` (`create_user_id`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_keyword_create_user_id` (`create_user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_create_user_id` (`create_user_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_page_create_user_id` (`create_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_create_user_id` (`create_user_id`),
  ADD KEY `fk_product_sub_category_id` (`sub_category_id`),
  ADD KEY `fk_product_brand_id` (`brand_id`),
  ADD KEY `fk_product_category_id` (`category_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_price_product_id` (`product_id`),
  ADD KEY `fk_product_price_create_user_id` (`create_user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_review_product_id` (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_category_create_user_id` (`create_user_id`),
  ADD KEY `fk_sub_category_category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_coupon`
--
ALTER TABLE `user_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_coupon_create_user_id` (`create_user_id`),
  ADD KEY `fk_user_coupon_coupon_id` (`coupon_id`),
  ADD KEY `fk_user_coupon_user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wishlist_product_id` (`product_id`),
  ADD KEY `fk_wishlist_create_user_id` (`create_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_applied`
--
ALTER TABLE `coupons_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_coupon`
--
ALTER TABLE `user_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk-auth-user_id-user-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_brand_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_category_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_coupon_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coupons_applied`
--
ALTER TABLE `coupons_applied`
  ADD CONSTRAINT `fk-post_tag-coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`),
  ADD CONSTRAINT `fk-post_tag-create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `deal_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_deal_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_file_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `keyword`
--
ALTER TABLE `keyword`
  ADD CONSTRAINT `fk_keyword_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `keyword_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_page_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_sub_category_id` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `fk_product_price_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_price_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_price_ibfk_2` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_category_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sub_category_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sub_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `user_coupon`
--
ALTER TABLE `user_coupon`
  ADD CONSTRAINT `fk_user_coupon_coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_coupon_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_coupon_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_coupon_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_coupon_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_coupon_ibfk_3` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wishlist_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
