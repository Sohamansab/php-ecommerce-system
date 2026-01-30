-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2026 at 04:04 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category_image`) VALUES
(1, 'Electronics', 'electronics.jpg'),
(2, 'Fashion', 'fashion.jpg'),
(3, 'Home & Kitchen', 'home_kitchen.jpg'),
(4, 'Books', 'books.jpg'),
(5, 'Beauty', 'beauty.jpg'),
(6, 'Toys', 'toys.jpg'),
(7, 'Grocery', 'grocery.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

DROP TABLE IF EXISTS `dashboard`;
CREATE TABLE IF NOT EXISTS `dashboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `last_action` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dashboard` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_login` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`) VALUES
(1, 25, '25/1760416916_nasa 1.jpg', '2025-10-14 04:41:56'),
(6, 26, '26/1760417527_nasa 6.jpg', '2025-10-14 04:52:07'),
(3, 25, '25/1760416916_nasa 3.jpg', '2025-10-14 04:41:56'),
(12, 27, '27/1760420855_cup2.jpg', '2025-10-14 05:47:35'),
(5, 25, '25/1760416916_nasa 5.jpg', '2025-10-14 04:41:56'),
(13, 27, '27/1760420855_cup3.jpg', '2025-10-14 05:47:35'),
(8, 26, '26/1760417527_nasa 2.jpg', '2025-10-14 04:52:07'),
(11, 27, '27/1760420855_cup1.jpg', '2025-10-14 05:47:35'),
(10, 26, '26/1760417527_nasa 4.jpg', '2025-10-14 04:52:07'),
(14, 27, '27/1760420855_cup4.jpg', '2025-10-14 05:47:35'),
(15, 27, '27/1760420855_cup5.jpg', '2025-10-14 05:47:35'),
(16, 28, '28/1760421073_68ede4d143ae5_cup1.jpg', '2025-10-14 05:51:13'),
(17, 28, '28/1760421073_68ede4d144348_cup2.jpg', '2025-10-14 05:51:13'),
(22, 28, '28/1760423141_68edece589cae_nasa_3.jpg', '2025-10-14 06:25:41'),
(19, 28, '28/1760421073_68ede4d14615a_cup4.jpg', '2025-10-14 05:51:13'),
(21, 28, '28/1760423141_68edece58993e_nasa_2.jpg', '2025-10-14 06:25:41'),
(29, 29, '29/1760423639_68edeed73d902_nasa_1.jpg', '2025-10-14 06:33:59'),
(31, 29, '29/1760423739_68edef3b6a4f3_cup3.jpg', '2025-10-14 06:35:39'),
(25, 29, '29/1760423303_68eded872a52b_nasa_3.jpg', '2025-10-14 06:28:23'),
(30, 29, '29/1760423739_68edef3b6a13f_cup2.jpg', '2025-10-14 06:35:39'),
(27, 29, '29/1760423303_68eded872be06_nasa_5.jpg', '2025-10-14 06:28:23'),
(84, 43, '43/1760503070_68ef251e408f4_Apple-Watch.jpg', '2025-10-15 04:37:50'),
(83, 43, '43/1760503070_68ef251e40418_applew.jpg', '2025-10-15 04:37:50'),
(82, 43, '43/1760503070_68ef251e400eb_apple_watch-.jpg', '2025-10-15 04:37:50'),
(81, 43, '43/1760503070_68ef251e3fcf3_Apple_watch.jpg', '2025-10-15 04:37:50'),
(80, 30, '30/1760442555_68ee38bb09a2e_cup3.jpg', '2025-10-14 11:49:15'),
(52, 32, '32/1760424385_68edf1c1f2a14_cup2.jpg', '2025-10-14 06:46:26'),
(47, 31, '31/1760424261_68edf14515e26_toy4.jpg', '2025-10-14 06:44:21'),
(48, 31, '31/1760424261_68edf14516372_toy3.jpg', '2025-10-14 06:44:21'),
(51, 31, '31/1760424302_68edf16e62778_nasa_5.jpg', '2025-10-14 06:45:02'),
(50, 31, '31/1760424261_68edf145196fc_toy1.jpg', '2025-10-14 06:44:21'),
(53, 32, '32/1760424386_68edf1c2003fb_cup3.jpg', '2025-10-14 06:46:26'),
(54, 32, '32/1760424386_68edf1c200756_cup4.jpg', '2025-10-14 06:46:26'),
(55, 32, '32/1760424446_68edf1fea6954_favicon.png', '2025-10-14 06:47:26'),
(56, 33, '33/1760425391_68edf5af3645f_toy1.jpg', '2025-10-14 07:03:11'),
(57, 33, '33/1760425391_68edf5af367e9_toy3.jpg', '2025-10-14 07:03:11'),
(58, 33, '33/1760425391_68edf5af370bc_toy4.jpg', '2025-10-14 07:03:11'),
(60, 33, '33/1760428007_68edffe76fb85_nasa_3.jpg', '2025-10-14 07:46:47'),
(61, 33, '33/1760428007_68edffe770521_nasa_4.jpg', '2025-10-14 07:46:47'),
(62, 34, '34/1760428155_68ee007ba6de1_kit5.jpg', '2025-10-14 07:49:15'),
(63, 34, '34/1760428155_68ee007ba9e60_kit4.png', '2025-10-14 07:49:15'),
(64, 34, '34/1760428155_68ee007baaad3_kit3.png', '2025-10-14 07:49:15'),
(65, 34, '34/1760428155_68ee007bab15e_kit2.jpg', '2025-10-14 07:49:15'),
(66, 34, '34/1760428155_68ee007babe97_kit1.jpg', '2025-10-14 07:49:15'),
(71, 36, '36/1760432910_68ee130ee7875_toy1_-_Copy.jpg', '2025-10-14 09:08:30'),
(68, 35, '35/1760432703_68ee123f9ab8e_toy1.jpg', '2025-10-14 09:05:03'),
(69, 35, '35/1760432703_68ee123f9b1ce_toy4_-_Copy.jpg', '2025-10-14 09:05:03'),
(70, 35, '35/1760432703_68ee123f9c5a1_toy4.jpg', '2025-10-14 09:05:03'),
(72, 36, '36/1760432910_68ee130ee7ea9_toy5.webp', '2025-10-14 09:08:30'),
(73, 37, '37/1760440850_68ee321281e50_bag1.jpg', '2025-10-14 11:20:50'),
(74, 38, '38/1760441023_68ee32bfef944_cat_food.jpg', '2025-10-14 11:23:43'),
(75, 39, '39/1760441151_68ee333fb9897_cat_food_2.jpg', '2025-10-14 11:25:51'),
(76, 40, '40/1760441298_68ee33d2844c9_kids.jpg', '2025-10-14 11:28:18'),
(77, 41, '41/1760441381_68ee342566342_maskara.jpg', '2025-10-14 11:29:41'),
(91, 42, '42/1760503928_68ef2878c5987_head.jpg', '2025-10-15 04:52:08'),
(88, 21, '21/1760503396_68ef26646d3d4_iphone1.jpg', '2025-10-15 04:43:16'),
(89, 21, '21/1760503415_68ef2677c944f_iphone3.jpg', '2025-10-15 04:43:35'),
(90, 21, '21/1760503415_68ef2677c994b_iphone2.jpg', '2025-10-15 04:43:35'),
(92, 42, '42/1760504046_68ef28ee34de2_head2.jpg', '2025-10-15 04:54:06'),
(93, 44, '44/1760504146_68ef29522fae0_ps5.png', '2025-10-15 04:55:46'),
(94, 45, '45/1760504307_68ef29f3a858c_echo.jpg', '2025-10-15 04:58:27'),
(95, 46, '46/1760504384_68ef2a4080ecf_mouse.jpg', '2025-10-15 04:59:44'),
(96, 47, '47/1760504457_68ef2a89db468_tvstick.jpg', '2025-10-15 05:00:57'),
(97, 22, '22/1760511927_68ef47b709f96_book.jpg', '2025-10-15 07:05:27'),
(98, 23, '23/1760512030_68ef481e72739_book1.jpg', '2025-10-15 07:07:10'),
(99, 24, '24/1760512113_68ef487120082_book2.jpg', '2025-10-15 07:08:33'),
(100, 48, '48/1760512196_68ef48c45f38c_book2.jpg', '2025-10-15 07:09:56'),
(101, 49, '49/1760588210_68f071b2bf430_cup3.jpg', '2025-10-16 04:16:50'),
(102, 67, '67/1761197821_68f9befdf2126_cat_food.jpg', '2025-10-23 05:37:01'),
(103, 68, '68/1761197844_68f9bf145fd46_cup1.jpg', '2025-10-23 05:37:24'),
(104, 70, '70/1761198171_68f9c05b903f4_head.jpg', '2025-10-23 05:42:51'),
(105, 71, '71/1761201654_68f9cdf6dc765_elec2.jpg', '2025-10-23 06:40:54'),
(106, 71, '71/1761201654_68f9cdf6dcbc7_elec1.jpg', '2025-10-23 06:40:54'),
(107, 72, '72/1761202290_68f9d0725d9e0_xbox2.jpg', '2025-10-23 06:51:30'),
(108, 72, '72/1761202290_68f9d0725e203_xbox.jpg', '2025-10-23 06:51:30'),
(109, 73, '73/1761202715_68f9d21b7e5c1_xbox2.jpg', '2025-10-23 06:58:35'),
(110, 73, '73/1761202715_68f9d21b7eea1_xbox.jpg', '2025-10-23 06:58:35'),
(111, 74, '74/1761202807_68f9d277d15b1_xbox2.jpg', '2025-10-23 07:00:07'),
(112, 74, '74/1761202807_68f9d277d1bf8_xbox.jpg', '2025-10-23 07:00:07'),
(113, 75, '75/1761202922_68f9d2eac3d30_xbox2.jpg', '2025-10-23 07:02:02'),
(114, 75, '75/1761202922_68f9d2eac45f2_xbox.jpg', '2025-10-23 07:02:02'),
(115, 76, '76/1761202997_68f9d33581c6e_xbox2.jpg', '2025-10-23 07:03:17'),
(116, 76, '76/1761202997_68f9d335821a4_xbox.jpg', '2025-10-23 07:03:17'),
(117, 77, '77/1761203016_68f9d3488bc4b_xbox2.jpg', '2025-10-23 07:03:36'),
(118, 77, '77/1761203016_68f9d3488c1c5_xbox.jpg', '2025-10-23 07:03:36'),
(119, 78, '78/1761203060_68f9d374aa6c2_xbox2.jpg', '2025-10-23 07:04:20'),
(120, 78, '78/1761203060_68f9d374aab5e_xbox.jpg', '2025-10-23 07:04:20'),
(121, 79, '79/1761203125_68f9d3b540bbe_xbox2.jpg', '2025-10-23 07:05:25'),
(122, 79, '79/1761203125_68f9d3b540fd2_xbox.jpg', '2025-10-23 07:05:25'),
(123, 80, '80/1761203159_68f9d3d74744e_xbox2.jpg', '2025-10-23 07:05:59'),
(124, 80, '80/1761203159_68f9d3d74798b_xbox.jpg', '2025-10-23 07:05:59'),
(125, 81, '81/1761203290_68f9d45a4069a_xbox2.jpg', '2025-10-23 07:08:10'),
(126, 81, '81/1761203290_68f9d45a4120f_xbox.jpg', '2025-10-23 07:08:10'),
(127, 82, '82/1761204340_68f9d874b0267_applew.jpg', '2025-10-23 07:25:40'),
(128, 83, '83/1761204548_68f9d94496181_cup1.jpg', '2025-10-23 07:29:08'),
(129, 83, '83/1761204548_68f9d944966af_cup2.jpg', '2025-10-23 07:29:08'),
(130, 83, '83/1761204548_68f9d9449825d_cup3.jpg', '2025-10-23 07:29:08'),
(131, 83, '83/1761204548_68f9d9449972e_cup4.jpg', '2025-10-23 07:29:08'),
(132, 83, '83/1761204548_68f9d94499eb8_cup5.jpg', '2025-10-23 07:29:08'),
(133, 84, '84/1761204621_68f9d98d4ed76_bag1.jpg', '2025-10-23 07:30:21'),
(134, 84, '84/1761204621_68f9d98d4f0a6_bag2.jpg', '2025-10-23 07:30:21'),
(135, 84, '84/1761204621_68f9d98d4f4b5_bag3.jpg', '2025-10-23 07:30:21'),
(136, 84, '84/1761204621_68f9d98d54e7d_bag4.webp', '2025-10-23 07:30:21'),
(137, 84, '84/1761204621_68f9d98d557c6_bag5.webp', '2025-10-23 07:30:21'),
(138, 85, '85/1761204678_68f9d9c67a518_iphone1.jpg', '2025-10-23 07:31:18'),
(139, 85, '85/1761204678_68f9d9c67a9b8_iphone2.jpg', '2025-10-23 07:31:18'),
(140, 85, '85/1761204678_68f9d9c67b30e_iphone3.jpg', '2025-10-23 07:31:18'),
(141, 86, '86/1761204716_68f9d9ec98111_toy1_-_Copy.jpg', '2025-10-23 07:31:56'),
(142, 86, '86/1761204716_68f9d9ec9879e_toy1.jpg', '2025-10-23 07:31:56'),
(143, 86, '86/1761204716_68f9d9ec9b47e_toy3.jpg', '2025-10-23 07:31:56'),
(144, 86, '86/1761204716_68f9d9ec9bba8_toy4_-_Copy.jpg', '2025-10-23 07:31:56'),
(145, 87, '87/1761204772_68f9da248198f_kids.jpg', '2025-10-23 07:32:52'),
(146, 88, '88/1761213720_68f9fd186ed13_cup4.jpg', '2025-10-23 10:02:00'),
(147, 89, '89/1761280013_68fb000ddf139_kids.jpg', '2025-10-24 04:26:53'),
(148, 66, '66/1761280542_68fb021e2580f_Apple_watch.jpg', '2025-10-24 04:35:42'),
(149, 66, '66/1761280542_68fb021e25b21_apple_watch-.jpg', '2025-10-24 04:35:42'),
(150, 66, '66/1761280542_68fb021e26b6a_applew.jpg', '2025-10-24 04:35:42'),
(151, 66, '66/1761280542_68fb021e26f7e_Apple-Watch.jpg', '2025-10-24 04:35:42'),
(152, 90, '90/1761280639_68fb027f1f6d4_apple_watch-.jpg', '2025-10-24 04:37:19'),
(153, 90, '90/1761280639_68fb027f1fa4d_applew.jpg', '2025-10-24 04:37:19'),
(154, 90, '90/1761280639_68fb027f1ffa4_Apple-Watch.jpg', '2025-10-24 04:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

DROP TABLE IF EXISTS `tbl_carts`;
CREATE TABLE IF NOT EXISTS `tbl_carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `prod_qty` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(81, 0, 28, 1, '2025-10-20 07:51:22'),
(80, 0, 32, 1, '2025-10-20 07:51:14'),
(106, 0, 34, 11, '2025-10-21 04:13:43'),
(23, 0, 45, 4, '2025-10-17 10:02:23'),
(49, 69, 30, 4, '2025-10-17 11:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Furniture', 'uploads/category_images/furniture.jpg'),
(2, 'Electronics', 'uploads/category_images/electronics.jpg'),
(3, 'Clothing', 'uploads/category_images/clothing.jpg'),
(4, 'Beauty Products', 'uploads/category_images/beautyproducts.jpg'),
(5, 'Sports Items', 'uploads/category_images/sportsitems.jpg'),
(6, 'Toys', 'uploads/category_images/toys.jpg'),
(7, 'Books', 'uploads/category_images/books.jpg'),
(8, 'Groceries', 'uploads/category_images/groceries.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int NOT NULL,
  `category_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_images`
--

DROP TABLE IF EXISTS `tbl_category_images`;
CREATE TABLE IF NOT EXISTS `tbl_category_images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `product_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `category_id` (`category_id`),
  KEY `fk_product` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=299 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category_images`
--

INSERT INTO `tbl_category_images` (`image_id`, `category_id`, `product_id`, `image_path`, `uploaded_at`) VALUES
(194, 7, 45, 'uploads/category_7//Group 151.png', '2025-10-15 05:22:50'),
(195, 7, 45, 'uploads/category_7//Group 152.png', '2025-10-15 05:22:50'),
(196, 7, 45, 'uploads/category_7//fixed-width (2).png', '2025-10-15 05:22:50'),
(197, 7, 45, 'uploads/category_7//fixed-width (1).png', '2025-10-15 05:22:50'),
(198, 7, 45, 'uploads/category_7//fixed-width.png', '2025-10-15 05:22:50'),
(199, 4, 46, 'uploads/category_4//bag3.jpg', '2025-10-15 05:58:52'),
(200, 4, 46, 'uploads/category_4//bag1.jpg', '2025-10-15 05:58:52'),
(201, 4, 46, 'uploads/category_4//bag2.jpg', '2025-10-15 05:58:52'),
(202, 4, 46, 'uploads/category_4//myw3schoolsimage.jpg', '2025-10-15 05:58:52'),
(203, 4, 46, 'uploads/category_4//Group 151.png', '2025-10-15 05:58:52'),
(204, 8, 47, 'uploads/category_8//cup4.jpg', '2025-10-15 06:02:16'),
(205, 8, 47, 'uploads/category_8//cup1.jpg', '2025-10-15 06:02:16'),
(206, 8, 47, 'uploads/category_8//bag3.jpg', '2025-10-15 06:02:16'),
(207, 8, 47, 'uploads/category_8//bag1.jpg', '2025-10-15 06:02:16'),
(208, 8, 47, 'uploads/category_8//bag2.jpg', '2025-10-15 06:02:16'),
(209, 3, 48, 'uploads/category_3//cloth1.jpg', '2025-10-15 06:05:02'),
(210, 3, 48, 'uploads/category_3//cloth2.jpg', '2025-10-15 06:05:02'),
(211, 3, 48, 'uploads/category_3//cloth3.jpg', '2025-10-15 06:05:02'),
(212, 3, 48, 'uploads/category_3//cloth4.jpg', '2025-10-15 06:05:02'),
(213, 3, 48, 'uploads/category_3//cloth5.jpg', '2025-10-15 06:05:02'),
(214, 3, 48, 'uploads/category_3//download (1).jpg', '2025-10-15 06:05:28'),
(215, 3, 48, 'uploads/category_3//download (2).jpg', '2025-10-15 06:05:28'),
(216, 3, 48, 'uploads/category_3//download (3).jpg', '2025-10-15 06:05:28'),
(217, 3, 48, 'uploads/category_3//download (4).jpg', '2025-10-15 06:05:28'),
(218, 3, 48, 'uploads/category_3//download.jpg', '2025-10-15 06:05:28'),
(219, 2, 50, 'uploads/category_2//electronic1.jpg', '2025-10-15 06:07:00'),
(220, 2, 50, 'uploads/category_2//electronic2.jpg', '2025-10-15 06:07:00'),
(221, 2, 50, 'uploads/category_2//electronic3.jpg', '2025-10-15 06:07:00'),
(222, 2, 50, 'uploads/category_2//electronic4.jpg', '2025-10-15 06:07:00'),
(223, 2, 50, 'uploads/category_2//electronic5.jpg', '2025-10-15 06:07:00'),
(224, 4, 46, 'uploads/category_4//beauty1.webp', '2025-10-15 06:08:49'),
(225, 4, 46, 'uploads/category_4//beauty2.webp', '2025-10-15 06:08:49'),
(226, 4, 46, 'uploads/category_4//beauty3.webp', '2025-10-15 06:08:49'),
(227, 4, 46, 'uploads/category_4//beauty4.webp', '2025-10-15 06:08:49'),
(228, 4, 46, 'uploads/category_4//beauty5.webp', '2025-10-15 06:08:49'),
(229, 6, 52, 'uploads/category_6//toy1.webp', '2025-10-15 06:10:15'),
(230, 6, 52, 'uploads/category_6//toy2.webp', '2025-10-15 06:10:15'),
(231, 6, 52, 'uploads/category_6//toy3.webp', '2025-10-15 06:10:15'),
(232, 6, 52, 'uploads/category_6//toy4.webp', '2025-10-15 06:10:15'),
(233, 6, 52, 'uploads/category_6//toy5.webp', '2025-10-15 06:10:15'),
(234, 1, 53, 'uploads/category_1//furniture1.webp', '2025-10-15 06:47:27'),
(235, 1, 53, 'uploads/category_1//furniture2.webp', '2025-10-15 06:47:27'),
(236, 1, 53, 'uploads/category_1//furniture3.webp', '2025-10-15 06:47:27'),
(237, 1, 53, 'uploads/category_1//furniture4.webp', '2025-10-15 06:47:27'),
(238, 1, 53, 'uploads/category_1//furniture5.webp', '2025-10-15 06:47:27'),
(239, 3, 48, 'uploads/category_3//bag3.jpg', '2025-10-15 07:32:24'),
(240, 3, 48, 'uploads/category_3//bag1.jpg', '2025-10-15 07:32:24'),
(241, 3, 48, 'uploads/category_3//bag2.jpg', '2025-10-15 07:32:24'),
(242, 3, 48, 'uploads/category_3//bag4.webp', '2025-10-15 07:32:24'),
(243, 3, 48, 'uploads/category_3//bag5.webp', '2025-10-15 07:32:24'),
(244, 5, 55, 'uploads/category_5//download (1).jpg', '2025-10-15 07:32:56'),
(245, 5, 55, 'uploads/category_5//download (2).jpg', '2025-10-15 07:32:56'),
(246, 5, 55, 'uploads/category_5//download (3).jpg', '2025-10-15 07:32:56'),
(247, 5, 55, 'uploads/category_5//download (4).jpg', '2025-10-15 07:32:56'),
(248, 5, 55, 'uploads/category_5//download.jpg', '2025-10-15 07:32:56'),
(249, 1, 53, 'uploads/category_1//fur1.jpg', '2025-10-16 06:50:08'),
(250, 1, 53, 'uploads/category_1//fur2.jpg', '2025-10-16 06:50:08'),
(251, 1, 53, 'uploads/category_1//fur3.jpg', '2025-10-16 06:50:08'),
(252, 1, 53, 'uploads/category_1//fur4.jpg', '2025-10-16 06:50:08'),
(253, 1, 53, 'uploads/category_1//fur5.jpg', '2025-10-16 06:50:08'),
(254, 3, 48, 'uploads/category_3//download (1).jpg', '2025-10-16 06:53:50'),
(255, 3, 48, 'uploads/category_3//download (2).jpg', '2025-10-16 06:53:50'),
(256, 3, 48, 'uploads/category_3//download (3).jpg', '2025-10-16 06:53:50'),
(257, 3, 48, 'uploads/category_3//download (4).jpg', '2025-10-16 06:53:50'),
(258, 3, 48, 'uploads/category_3//download.jpg', '2025-10-16 06:53:50'),
(259, 7, 3, 'uploads/category_7//toy1.webp', '2025-10-17 04:09:44'),
(260, 7, 3, 'uploads/category_7//toy2.webp', '2025-10-17 04:09:44'),
(261, 7, 3, 'uploads/category_7//toy3.webp', '2025-10-17 04:09:44'),
(262, 7, 3, 'uploads/category_7//toy4.webp', '2025-10-17 04:09:44'),
(263, 7, 3, 'uploads/category_7//toy5.webp', '2025-10-17 04:09:44'),
(264, 3, 3, 'uploads/category_3//download (1).jpg', '2025-10-17 04:17:00'),
(265, 3, 3, 'uploads/category_3//download (2).jpg', '2025-10-17 04:17:00'),
(266, 3, 3, 'uploads/category_3//download (3).jpg', '2025-10-17 04:17:00'),
(267, 3, 3, 'uploads/category_3//download (4).jpg', '2025-10-17 04:17:00'),
(268, 3, 3, 'uploads/category_3//download.jpg', '2025-10-17 04:17:00'),
(269, 3, 3, 'uploads/category_3//bag3.jpg', '2025-10-17 04:27:39'),
(270, 3, 3, 'uploads/category_3//bag1.jpg', '2025-10-17 04:27:39'),
(271, 3, 3, 'uploads/category_3//bag2.jpg', '2025-10-17 04:27:39'),
(272, 3, 3, 'uploads/category_3//bag4.webp', '2025-10-17 04:27:39'),
(273, 3, 3, 'uploads/category_3//bag5.webp', '2025-10-17 04:27:39'),
(274, 4, 3, 'uploads/category_4//beauty1.webp', '2025-10-17 04:31:56'),
(275, 4, 3, 'uploads/category_4//beauty2.webp', '2025-10-17 04:31:56'),
(276, 4, 3, 'uploads/category_4//beauty3.webp', '2025-10-17 04:31:56'),
(277, 4, 3, 'uploads/category_4//beauty4.webp', '2025-10-17 04:31:56'),
(278, 4, 3, 'uploads/category_4//beauty5.webp', '2025-10-17 04:31:56'),
(279, 0, 63, 'uploads/product_63/beauty1.webp', '2025-10-17 04:46:33'),
(280, 0, 63, 'uploads/product_63/beauty2.webp', '2025-10-17 04:46:33'),
(281, 0, 63, 'uploads/product_63/beauty3.webp', '2025-10-17 04:46:33'),
(282, 0, 63, 'uploads/product_63/beauty4.webp', '2025-10-17 04:46:33'),
(283, 0, 63, 'uploads/product_63/beauty5.webp', '2025-10-17 04:46:33'),
(284, 0, 64, 'uploads/product_64/cloth1.jpg', '2025-10-17 04:53:08'),
(285, 0, 64, 'uploads/product_64/cloth2.jpg', '2025-10-17 04:53:08'),
(286, 0, 64, 'uploads/product_64/cloth3.jpg', '2025-10-17 04:53:08'),
(287, 0, 64, 'uploads/product_64/cloth4.jpg', '2025-10-17 04:53:08'),
(288, 0, 64, 'uploads/product_64/cloth5.jpg', '2025-10-17 04:53:08'),
(289, 0, 65, 'uploads/product_65/electronic1.jpg', '2025-10-17 05:17:35'),
(290, 0, 65, 'uploads/product_65/electronic2.jpg', '2025-10-17 05:17:35'),
(291, 0, 65, 'uploads/product_65/electronic3.jpg', '2025-10-17 05:17:35'),
(292, 0, 65, 'uploads/product_65/electronic4.jpg', '2025-10-17 05:17:35'),
(293, 0, 65, 'uploads/product_65/electronic5.jpg', '2025-10-17 05:17:35'),
(294, 0, 66, 'uploads/product_66/electronic1.jpg', '2025-10-17 06:05:57'),
(295, 0, 66, 'uploads/product_66/electronic2.jpg', '2025-10-17 06:05:57'),
(296, 0, 66, 'uploads/product_66/electronic3.jpg', '2025-10-17 06:05:57'),
(297, 0, 66, 'uploads/product_66/electronic4.jpg', '2025-10-17 06:05:57'),
(298, 0, 66, 'uploads/product_66/electronic5.jpg', '2025-10-17 06:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_info_id` int NOT NULL,
  `order_number` varchar(100) DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `payment_method` varchar(50) DEFAULT 'Cash on Delivery',
  `payment_status` varchar(50) DEFAULT 'Pending',
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `user_id` (`user_id`),
  KEY `user_info_id` (`user_info_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `user_info_id`, `order_number`, `order_date`, `total_amount`, `payment_method`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 36, 0, NULL, '2025-08-17 12:12:53', 149000.00, 'Cash on Delivery', 'Completed', 'Confirmed', '2025-10-17 12:12:53', '2025-10-27 11:26:18'),
(2, 36, 0, NULL, '2025-09-17 12:29:34', 40000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 12:29:34', '2025-10-27 11:26:21'),
(3, 36, 0, NULL, '2025-07-17 12:39:08', 40000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 12:39:08', '2025-10-27 11:26:24'),
(4, 36, 0, NULL, '2025-06-17 12:40:22', 40000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 12:40:22', '2025-10-27 11:26:46'),
(5, 36, 0, NULL, '2025-05-17 12:41:28', 9000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 12:41:28', '2025-10-27 11:27:03'),
(6, 36, 0, NULL, '2025-04-17 14:10:46', 6000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 14:10:46', '2025-10-27 11:27:07'),
(7, 36, 0, NULL, '2025-10-17 14:11:05', 5600.00, 'Card', 'Completed', 'Confirmed', '2025-10-17 14:11:05', '2025-10-27 11:27:10'),
(8, 36, 0, NULL, '2025-10-17 14:24:17', 21000.00, 'Card', 'Completed', 'Confirmed', '2025-10-17 14:24:17', '2025-10-27 11:27:13'),
(9, 36, 0, NULL, '2025-10-17 14:24:41', 6000.00, 'Card', 'Completed', 'Confirmed', '2025-10-17 14:24:41', '2025-10-27 11:27:19'),
(10, 36, 0, NULL, '2025-10-17 14:33:24', 3999992.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 14:33:24', '2025-10-27 11:27:22'),
(11, 36, 0, NULL, '2025-10-17 14:35:11', 12000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 14:35:11', '2025-10-27 11:27:25'),
(12, 36, 0, NULL, '2025-10-17 14:52:30', 9099.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 14:52:30', '2025-10-27 11:27:28'),
(13, 36, 0, NULL, '2025-10-17 14:57:06', 9099.00, 'Card', 'Completed', 'Confirmed', '2025-10-17 14:57:06', '2025-10-27 11:27:31'),
(14, 36, 0, NULL, '2025-10-17 15:38:58', 2499995.00, 'Card', 'Completed', 'Confirmed', '2025-10-17 15:38:58', '2025-10-27 11:27:33'),
(15, 41, 0, NULL, '2025-10-17 15:48:33', 506999.00, 'Cash on Delivery', 'Completed', 'Confirmed', '2025-10-17 15:48:33', '2025-10-27 11:27:36'),
(16, 36, 0, NULL, '2025-10-17 16:29:10', 7000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 16:29:10', '2025-10-27 11:27:41'),
(17, 36, 0, NULL, '2025-10-17 16:30:12', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 16:30:12', '2025-10-27 11:27:43'),
(18, 36, 0, NULL, '2025-10-17 16:40:24', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 16:40:24', '2025-10-27 11:27:46'),
(19, 36, 0, NULL, '2025-10-17 16:40:55', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-17 16:40:55', '2025-10-27 11:27:48'),
(20, 36, 0, NULL, '2025-10-20 09:03:08', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:03:08', '2025-10-27 11:27:54'),
(21, 36, 0, NULL, '2025-10-20 09:03:38', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:03:38', '2025-10-27 11:27:57'),
(22, 36, 0, NULL, '2025-10-20 09:04:31', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:04:31', '2025-10-27 11:28:00'),
(23, 36, 0, NULL, '2025-10-20 09:13:23', 7000.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:13:23', '2025-10-27 11:28:03'),
(24, 36, 0, NULL, '2025-10-20 09:15:45', 7000.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:15:45', '2025-10-27 11:28:05'),
(25, 36, 0, NULL, '2025-10-20 09:20:17', 143512.00, 'Card', 'Completed', 'Confirmed', '2025-10-20 09:20:17', '2025-10-27 11:28:08'),
(26, 36, 0, NULL, '2025-10-20 09:25:52', 1118187.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:25:52', '2025-10-27 11:28:13'),
(27, 36, 0, NULL, '2025-10-20 09:32:19', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:32:19', '2025-10-27 11:28:15'),
(28, 36, 0, NULL, '2025-10-20 09:40:32', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 09:40:32', '2025-10-27 11:28:18'),
(29, 36, 0, NULL, '2025-10-20 09:42:30', 499999.00, 'on', 'Completed', 'Confirmed', '2025-10-20 09:42:30', '2025-10-27 11:28:21'),
(30, 36, 0, NULL, '2025-10-20 09:57:36', 56000.00, 'Paypal', 'Completed', 'Confirmed', '2025-10-20 09:57:36', '2025-10-27 11:28:24'),
(31, 36, 0, NULL, '2025-10-20 09:58:45', 16968.00, 'Cash on Delivery', 'Pending', 'Confirmed', '2025-10-20 09:58:45', '2025-10-20 10:03:48'),
(32, 36, 0, NULL, '2025-10-20 10:08:49', 9099.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 10:08:49', '2025-10-20 10:09:03'),
(33, 36, 0, NULL, '2025-10-20 10:12:18', 499999.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 10:12:18', '2025-10-20 11:43:31'),
(34, 36, 1, NULL, '2025-10-20 12:15:46', 7000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:15:46', '2025-10-21 10:47:56'),
(35, 90, 0, NULL, '2025-10-20 12:17:29', 56000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 12:17:29', '2025-10-20 12:17:36'),
(36, 90, 0, NULL, '2025-10-20 12:22:17', 7000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 12:22:17', '2025-10-20 12:22:28'),
(37, 90, 0, NULL, '2025-10-20 12:24:26', 499999.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 12:24:26', '2025-10-20 12:24:40'),
(38, 91, 0, NULL, '2025-10-20 12:27:51', 56000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 12:27:51', '2025-10-20 12:27:57'),
(39, 91, 3, NULL, '2025-10-20 12:31:15', 56000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:31:15', '2025-10-20 12:35:16'),
(40, 91, 3, NULL, '2025-10-20 12:35:32', 7000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:35:32', '2025-10-20 12:35:38'),
(41, 91, 3, NULL, '2025-10-20 12:36:27', 56000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:36:27', '2025-10-20 12:36:32'),
(42, 91, 3, NULL, '2025-10-20 12:38:05', 90000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:38:05', '2025-10-20 12:39:12'),
(43, 92, 4, NULL, '2025-10-20 12:45:42', 72090.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:45:42', '2025-10-20 12:46:13'),
(44, 92, 4, NULL, '2025-02-20 12:51:19', 56000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:51:19', '2025-10-27 11:23:47'),
(45, 92, 4, NULL, '2025-10-20 12:57:01', 90000.00, 'COD', 'Pending', 'Completed', '2025-10-20 12:57:01', '2025-10-20 12:57:27'),
(46, 92, 4, NULL, '2025-10-20 12:58:45', 3000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 12:58:45', '2025-10-27 11:20:09'),
(47, 92, 4, NULL, '2025-10-20 14:13:19', 65090.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 14:13:19', '2025-10-27 11:20:07'),
(48, 91, 3, NULL, '2025-01-20 15:12:36', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 15:12:36', '2025-10-27 11:31:05'),
(49, 91, 3, NULL, '2025-10-20 15:13:23', 7000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 15:13:23', '2025-10-27 11:20:03'),
(50, 91, 3, NULL, '2025-10-20 15:18:22', 7000.00, 'COD', 'Pending', 'Confirmed', '2025-10-20 15:18:22', '2025-10-27 11:20:01'),
(51, 91, 3, NULL, '2025-10-20 15:23:41', 82967.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 15:23:41', '2025-10-27 11:31:02'),
(52, 91, 3, NULL, '2025-10-20 15:48:57', 8989.00, 'COD', 'Completed', 'Confirmed', '2025-10-20 15:48:57', '2025-10-27 11:31:22'),
(53, 91, 0, NULL, '2025-10-20 15:52:18', 509098.00, 'Cash on Delivery', 'Completed', 'Confirmed', '2025-10-20 15:52:18', '2025-10-27 11:30:55'),
(54, 36, 1, NULL, '2025-10-21 11:26:51', 65019.00, 'COD', 'Completed', 'Confirmed', '2025-10-21 11:26:51', '2025-10-27 11:30:52'),
(55, 93, 5, NULL, '2025-10-21 11:37:31', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-21 11:37:31', '2025-10-27 11:30:50'),
(56, 93, 5, NULL, '2025-10-21 12:10:47', 56000.00, 'COD', 'Completed', 'Confirmed', '2025-10-21 12:10:47', '2025-10-27 11:30:48'),
(57, 93, 0, NULL, '2025-10-21 12:12:16', 27297.00, 'Cash on Delivery', 'Completed', 'Completed', '2025-10-21 12:12:16', '2025-10-27 11:30:46'),
(58, 36, 0, NULL, '2025-10-21 15:41:01', 56030.00, 'Cash on Delivery', 'Completed', 'Confirmed', '2025-10-21 15:41:01', '2025-10-27 11:29:22'),
(59, 68, 0, 'ORD68F9C9DFE65B4', '2025-10-23 11:23:27', 600.00, 'PayPal', 'Completed', 'Confirmed', '2025-10-23 11:23:27', '2025-10-27 11:29:25'),
(60, 68, 0, 'ORD68F9CB4D7B3B6', '2025-10-23 11:29:33', 3.00, 'COD', 'Completed', 'Confirmed', '2025-10-23 11:29:33', '2025-10-27 11:29:19'),
(61, 68, 6, 'ORD68F9CC206A054', '2025-10-23 11:33:04', 200.00, 'COD', 'Completed', 'Confirmed', '2025-10-23 11:33:04', '2025-10-27 11:29:16'),
(62, 68, 7, 'ORD68F9D08B776E1', '2025-10-23 11:51:55', 198.00, 'COD', 'Completed', 'Confirmed', '2025-10-23 11:51:55', '2025-10-27 11:29:14'),
(63, 73, 8, 'ORD68FAFDDBDFA18', '2025-10-24 09:17:31', 40.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 09:17:31', '2025-10-27 11:29:13'),
(64, 73, 9, 'ORD68FAFE2212E8E', '2025-10-24 09:18:42', 280.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 09:18:42', '2025-10-27 11:29:11'),
(65, 73, 10, 'ORD68FB00FE63F87', '2025-10-24 09:30:54', 98.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 09:30:54', '2025-10-27 11:29:09'),
(66, 73, 11, 'ORD68FB0C28374B3', '2025-10-24 10:18:32', 12600.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:18:32', '2025-10-27 11:29:08'),
(67, 73, 12, 'ORD68FB0C5F46C3B', '2025-10-24 10:19:27', 240.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:19:27', '2025-10-27 11:29:04'),
(68, 73, 13, 'ORD68FB0C9158E43', '2025-10-24 10:20:17', 44.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:20:17', '2025-10-27 11:29:02'),
(69, 73, 14, 'ORD68FB0CB7BF6A1', '2025-10-24 10:20:55', 2100.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:20:55', '2025-10-27 11:29:00'),
(70, 73, 15, 'ORD68FB0CE2A1F9E', '2025-10-24 10:21:38', 40.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:21:38', '2025-10-27 11:28:58'),
(71, 73, 16, 'ORD68FB0D37E6497', '2025-10-24 10:23:03', 100.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:23:03', '2025-10-27 11:28:56'),
(72, 73, 17, 'ORD68FB0D5EED737', '2025-10-24 10:23:42', 120.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:23:42', '2025-10-27 11:28:54'),
(73, 73, 18, 'ORD68FB0DF6ED252', '2025-05-24 10:26:14', 2100.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:26:14', '2025-10-27 11:28:52'),
(74, 73, 19, 'ORD68FB0EC094DA8', '2025-06-24 10:29:36', 9090.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 10:29:36', '2025-10-27 11:28:51'),
(75, 68, 20, 'ORD68FB425DC7C78', '2025-07-24 14:09:49', 2180.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 14:09:49', '2025-10-27 11:28:49'),
(76, 68, 21, 'ORD68FB47B0E3939', '2025-09-24 14:32:32', 10500.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 14:32:32', '2025-10-27 11:28:47'),
(77, 68, 22, 'ORD68FB65A95470F', '2025-08-24 16:40:25', 4200.00, 'COD', 'Completed', 'Confirmed', '2025-10-24 16:40:25', '2025-10-27 11:28:46'),
(78, 68, 23, 'ORD68FF17D39ECB6', '2024-10-27 11:57:23', 21000.00, 'COD', 'Completed', 'Confirmed', '2025-10-27 11:57:23', '2025-10-27 11:58:13'),
(79, 68, 24, 'ORD68FF18341F106', '2023-10-27 11:59:00', 66450.00, 'COD', 'Completed', 'Confirmed', '2025-10-27 11:59:00', '2025-10-27 12:00:00'),
(80, 68, 25, 'ORD68FF1980C43EF', '2022-01-27 12:04:32', 499999.00, 'COD', 'Completed', 'Confirmed', '2025-10-27 12:04:32', '2025-10-27 12:06:03'),
(81, 68, 26, 'ORD6909CAAA37CB9', '2025-11-04 14:43:06', 496.00, 'COD', 'Pending', 'Pending', '2025-11-04 14:43:06', '2025-11-04 14:43:06'),
(82, 68, 27, 'ORD69243356DAC63', '2025-11-24 15:28:38', 2380.00, 'COD', 'Pending', 'Pending', '2025-11-24 15:28:38', '2025-11-24 15:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

DROP TABLE IF EXISTS `tbl_order_item`;
CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `id_item` int NOT NULL,
  `products` varchar(255) NOT NULL,
  `qty` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS ((`qty` * `unit_price`)) STORED,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`id`, `order_id`, `id_item`, `products`, `qty`, `unit_price`) VALUES
(1, 1, 28, 'cups', 3, 5.00),
(2, 2, 46, 'Wireless Mouse', 3, 20.00),
(3, 3, 46, 'Wireless Mouse', 1, 20.00),
(4, 4, 47, 'Fire TV Stick 4K', 4, 40.00),
(5, 5, 32, 'cups', 1, 6.00),
(6, 5, 25, 'Nasa 2024', 2, 100.00),
(7, 6, 34, 'kitchen', 1, 6.00),
(8, 7, 44, 'PlayStation 5', 2, 900.00),
(9, 7, 37, 'LV Bag', 1, 200.00),
(10, 8, 32, 'cups', 1, 6.00),
(11, 9, 45, 'Echo Dot', 1, 100.00),
(12, 10, 45, 'Echo Dot', 3, 100.00),
(13, 11, 30, 'Cup', 1, 5.00),
(14, 12, 30, 'Cup', 1, 5.00),
(15, 13, 46, 'Wireless Mouse', 1, 20.00),
(16, 14, 46, 'Wireless Mouse', 1, 20.00),
(17, 14, 30, 'Cup', 4, 5.00),
(18, 15, 30, 'Cup', 1, 5.00),
(19, 16, 37, 'LV Bag', 1, 200.00),
(20, 17, 25, 'Nasa 2024', 1, 100.00),
(21, 18, 30, 'Cup', 1, 5.00),
(22, 19, 47, 'Fire TV Stick 4K', 1, 40.00),
(23, 20, 32, 'cups', 1, 6.00),
(24, 21, 45, 'Echo Dot', 1, 100.00),
(25, 22, 32, 'cups', 1, 6.00),
(26, 23, 45, 'Echo Dot', 1, 100.00),
(27, 24, 45, 'Echo Dot', 1, 100.00),
(28, 25, 32, 'cups', 1, 6.00),
(29, 26, 32, 'cups', 2, 6.00),
(30, 27, 45, 'Echo Dot', 1, 100.00),
(31, 27, 32, 'cups', 1, 6.00),
(32, 28, 32, 'cups', 1, 6.00),
(33, 29, 32, 'cups', 1, 6.00),
(34, 30, 41, 'Maskara', 1, 50.00),
(35, 31, 32, 'cups', 1, 6.00),
(36, 32, 32, 'cups', 1, 6.00),
(37, 33, 45, 'Echo Dot', 1, 100.00),
(38, 34, 32, 'cups', 1, 6.00),
(39, 35, 25, 'Nasa 2024', 1, 100.00),
(40, 36, 32, 'cups', 1, 6.00),
(41, 37, 32, 'cups', 1, 6.00),
(42, 37, 32, 'cups', 1, 6.00),
(43, 37, 32, 'cups', 1, 6.00),
(44, 37, 32, 'cups', 1, 6.00),
(45, 38, 30, 'Cup', 1, 5.00),
(46, 39, 46, 'Wireless Mouse', 2, 20.00),
(47, 40, 45, 'Echo Dot', 3, 100.00),
(48, 41, 37, 'LV Bag', 1, 200.00),
(49, 41, 30, 'Cup', 1, 5.00),
(50, 41, 24, 'Almanac 2025 | National Geographic Kids', 1, 40.00),
(51, 41, 41, 'Maskara', 4, 50.00),
(52, 42, 32, 'cups', 1, 6.00),
(53, 42, 32, 'cups', 1, 6.00),
(54, 42, 32, 'cups', 1, 6.00),
(55, 42, 32, 'cups', 1, 6.00),
(56, 43, 34, 'kitchen', 1, 6.00),
(57, 43, 34, 'kitchen', 1, 6.00),
(58, 43, 34, 'kitchen', 1, 6.00),
(59, 43, 34, 'kitchen', 1, 6.00),
(60, 43, 34, 'kitchen', 1, 6.00),
(61, 44, 46, 'Wireless Mouse', 2, 20.00),
(62, 45, 30, 'Cup', 1, 5.00),
(63, 46, 46, 'Wireless Mouse', 4, 20.00),
(64, 47, 34, 'kitchen', 2, 6.00),
(65, 47, 34, 'kitchen', 2, 6.00),
(66, 47, 34, 'kitchen', 2, 6.00),
(67, 47, 34, 'kitchen', 2, 6.00),
(68, 47, 34, 'kitchen', 2, 6.00),
(69, 48, 25, 'Nasa 2024', 1, 100.00),
(70, 48, 25, 'Nasa 2024', 1, 100.00),
(71, 48, 25, 'Nasa 2024', 1, 100.00),
(72, 48, 32, 'cups', 1, 6.00),
(73, 48, 32, 'cups', 1, 6.00),
(74, 48, 32, 'cups', 1, 6.00),
(75, 48, 32, 'cups', 1, 6.00),
(76, 49, 45, 'Echo Dot', 1, 100.00),
(77, 50, 32, 'cups', 1, 6.00),
(78, 50, 32, 'cups', 1, 6.00),
(79, 50, 32, 'cups', 1, 6.00),
(80, 50, 32, 'cups', 1, 6.00),
(81, 51, 45, 'Echo Dot', 1, 100.00),
(82, 52, 27, 'cups', 1, 10.00),
(83, 52, 27, 'cups', 1, 10.00),
(84, 52, 27, 'cups', 1, 10.00),
(85, 52, 27, 'cups', 1, 10.00),
(86, 52, 27, 'cups', 1, 10.00),
(87, 53, 45, 'Echo Dot', 1, 100.00),
(88, 54, 47, 'Fire TV Stick 4K', 2, 40.00),
(89, 55, 44, 'PlayStation 5', 1, 900.00),
(90, 56, 34, 'kitchen', 1, 6.00),
(91, 56, 34, 'kitchen', 1, 6.00),
(92, 56, 34, 'kitchen', 1, 6.00),
(93, 56, 34, 'kitchen', 1, 6.00),
(94, 56, 34, 'kitchen', 1, 6.00),
(95, 57, 45, 'Echo Dot', 4, 100.00),
(96, 58, 24, 'Almanac 2025 | National Geographic Kids', 2, 40.00),
(97, 59, 45, 'Echo Dot', 2, 100.00),
(98, 60, 32, 'cups', 1, 6.00),
(99, 60, 32, 'cups', 1, 6.00),
(100, 60, 32, 'cups', 1, 6.00),
(101, 60, 32, 'cups', 1, 6.00),
(102, 61, 43, 'Apple Watch', 2, 250.00),
(103, 61, 43, 'Apple Watch', 2, 250.00),
(104, 61, 43, 'Apple Watch', 2, 250.00),
(105, 61, 43, 'Apple Watch', 2, 250.00),
(106, 62, 45, 'Echo Dot', 1, 100.00),
(107, 63, 45, 'Echo Dot', 1, 100.00),
(108, 64, 32, 'cups', 1, 6.00),
(109, 64, 32, 'cups', 1, 6.00),
(110, 64, 32, 'cups', 1, 6.00),
(111, 64, 32, 'cups', 1, 6.00),
(112, 65, 45, 'Echo Dot', 1, 100.00),
(113, 66, 45, 'Echo Dot', 1, 100.00),
(114, 67, 45, 'Echo Dot', 2, 100.00),
(115, 68, 45, 'Echo Dot', 1, 100.00),
(116, 69, 47, 'Fire TV Stick 4K', 1, 40.00),
(117, 59, 67, 'Headphones', 3, 200.00),
(118, 60, 68, 'cups', 1, 3.00),
(119, 61, 67, 'Headphones', 1, 200.00),
(120, 62, 70, 'Headphones', 1, 100.00),
(121, 62, 72, 'Xbox Wireless Gaming', 1, 49.00),
(122, 62, 72, 'Xbox Wireless Gaming', 1, 49.00),
(123, 63, 82, 'watch', 1, 40.00),
(124, 64, 82, 'watch', 7, 40.00),
(125, 65, 81, 'Xbox Wireless Gaming', 1, 49.00),
(126, 65, 81, 'Xbox Wireless Gaming', 1, 49.00),
(127, 66, 90, 'iWatch', 6, 700.00),
(128, 66, 90, 'iWatch', 6, 700.00),
(129, 66, 90, 'iWatch', 6, 700.00),
(130, 67, 82, 'watch', 6, 40.00),
(131, 68, 88, 'cups', 4, 11.00),
(132, 69, 90, 'iWatch', 1, 700.00),
(133, 69, 90, 'iWatch', 1, 700.00),
(134, 69, 90, 'iWatch', 1, 700.00),
(135, 70, 82, 'watch', 1, 40.00),
(136, 71, 89, 'Clothes', 5, 20.00),
(137, 72, 89, 'Clothes', 6, 20.00),
(138, 73, 90, 'iWatch', 1, 700.00),
(139, 73, 90, 'iWatch', 1, 700.00),
(140, 73, 90, 'iWatch', 1, 700.00),
(141, 74, 64, 'English Book', 1, 9090.00),
(142, 75, 90, 'iWatch', 1, 700.00),
(143, 75, 90, 'iWatch', 1, 700.00),
(144, 75, 90, 'iWatch', 1, 700.00),
(145, 75, 82, 'watch', 2, 40.00),
(146, 76, 90, 'iWatch', 5, 700.00),
(147, 76, 90, 'iWatch', 5, 700.00),
(148, 76, 90, 'iWatch', 5, 700.00),
(149, 77, 90, 'iWatch', 2, 700.00),
(150, 77, 90, 'iWatch', 2, 700.00),
(151, 77, 90, 'iWatch', 2, 700.00),
(152, 78, 90, 'iWatch', 10, 700.00),
(153, 78, 90, 'iWatch', 10, 700.00),
(154, 78, 90, 'iWatch', 10, 700.00),
(155, 79, 45, 'English Book', 5, 9090.00),
(156, 79, 90, 'iWatch', 10, 700.00),
(157, 79, 90, 'iWatch', 10, 700.00),
(158, 79, 90, 'iWatch', 10, 700.00),
(159, 80, 50, 'Electronic Items', 1, 499999.00),
(160, 81, 81, 'Xbox Wireless Gaming', 2, 49.00),
(161, 81, 81, 'Xbox Wireless Gaming', 2, 49.00),
(162, 81, 83, 'cups', 3, 20.00),
(163, 81, 83, 'cups', 3, 20.00),
(164, 81, 83, 'cups', 3, 20.00),
(165, 81, 83, 'cups', 3, 20.00),
(166, 81, 83, 'cups', 3, 20.00),
(167, 82, 83, 'cups', 1, 20.00),
(168, 82, 83, 'cups', 1, 20.00),
(169, 82, 83, 'cups', 1, 20.00),
(170, 82, 83, 'cups', 1, 20.00),
(171, 82, 83, 'cups', 1, 20.00),
(172, 82, 89, 'Clothes', 1, 20.00),
(173, 82, 82, 'watch', 4, 40.00),
(174, 82, 90, 'iWatch', 1, 700.00),
(175, 82, 90, 'iWatch', 1, 700.00),
(176, 82, 90, 'iWatch', 1, 700.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

DROP TABLE IF EXISTS `tbl_order_items`;
CREATE TABLE IF NOT EXISTS `tbl_order_items` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `price`)) STORED,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(3, 1, 46, 2, 40000.00, '2025-10-17 12:24:20'),
(4, 1, 47, 16, 3000.00, '2025-10-17 12:25:11'),
(5, 1, 53, 3, 7000.00, '2025-10-17 12:25:17'),
(6, 2, 46, 1, 40000.00, '2025-10-17 12:29:34'),
(7, 3, 46, 1, 40000.00, '2025-10-17 12:39:08'),
(8, 4, 46, 1, 40000.00, '2025-10-17 12:40:22'),
(9, 5, 47, 3, 3000.00, '2025-10-17 12:41:28'),
(10, 6, 48, 1, 6000.00, '2025-10-17 14:10:46'),
(11, 7, 59, 1, 5600.00, '2025-10-17 14:11:05'),
(12, 8, 47, 7, 3000.00, '2025-10-17 14:24:17'),
(13, 9, 48, 1, 6000.00, '2025-10-17 14:24:41'),
(15, 10, 50, 8, 499999.00, '2025-10-17 14:34:08'),
(16, 11, 47, 4, 3000.00, '2025-10-17 14:35:11'),
(17, 12, 66, 1, 9099.00, '2025-10-17 14:52:30'),
(19, 13, 66, 1, 9099.00, '2025-10-17 14:57:27'),
(20, 14, 50, 5, 499999.00, '2025-10-17 15:38:58'),
(21, 15, 53, 1, 7000.00, '2025-10-17 15:48:33'),
(23, 15, 50, 1, 499999.00, '2025-10-17 16:17:19'),
(24, 16, 53, 1, 7000.00, '2025-10-17 16:29:10'),
(25, 17, 52, 1, 56000.00, '2025-10-17 16:30:12'),
(26, 18, 50, 1, 499999.00, '2025-10-17 16:40:24'),
(27, 19, 50, 1, 499999.00, '2025-10-17 16:40:55'),
(28, 20, 50, 1, 499999.00, '2025-10-20 09:03:08'),
(29, 21, 50, 1, 499999.00, '2025-10-20 09:03:38'),
(30, 22, 50, 1, 499999.00, '2025-10-20 09:04:31'),
(31, 23, 53, 1, 7000.00, '2025-10-20 09:13:23'),
(32, 24, 53, 1, 7000.00, '2025-10-20 09:15:45'),
(33, 25, 65, 4, 7878.00, '2025-10-20 09:20:17'),
(34, 25, 52, 2, 56000.00, '2025-10-20 09:20:44'),
(35, 26, 50, 2, 499999.00, '2025-10-20 09:25:52'),
(36, 26, 53, 1, 7000.00, '2025-10-20 09:26:04'),
(37, 26, 66, 1, 9099.00, '2025-10-20 09:26:14'),
(38, 26, 55, 1, 90000.00, '2025-10-20 09:26:19'),
(39, 26, 45, 1, 9090.00, '2025-10-20 09:26:30'),
(40, 26, 47, 1, 3000.00, '2025-10-20 09:26:40'),
(41, 27, 52, 1, 56000.00, '2025-10-20 09:32:19'),
(42, 28, 52, 1, 56000.00, '2025-10-20 09:40:32'),
(43, 29, 50, 1, 499999.00, '2025-10-20 09:42:30'),
(44, 30, 52, 1, 56000.00, '2025-10-20 09:57:36'),
(45, 31, 65, 1, 7878.00, '2025-10-20 09:58:45'),
(46, 31, 64, 1, 9090.00, '2025-10-20 10:03:05'),
(47, 32, 66, 1, 9099.00, '2025-10-20 10:08:49'),
(48, 33, 50, 1, 499999.00, '2025-10-20 10:12:18'),
(80, 54, 47, 1, 30.00, '2025-10-21 14:33:12'),
(50, 35, 52, 1, 56000.00, '2025-10-20 12:17:29'),
(51, 36, 53, 1, 7000.00, '2025-10-20 12:22:17'),
(52, 37, 50, 1, 499999.00, '2025-10-20 12:24:26'),
(53, 38, 52, 1, 56000.00, '2025-10-20 12:27:51'),
(54, 39, 52, 1, 56000.00, '2025-10-20 12:31:15'),
(55, 40, 53, 1, 7000.00, '2025-10-20 12:35:33'),
(56, 41, 52, 1, 56000.00, '2025-10-20 12:36:27'),
(57, 42, 55, 1, 90000.00, '2025-10-20 12:38:05'),
(58, 43, 53, 1, 7000.00, '2025-10-20 12:45:42'),
(59, 43, 64, 1, 9090.00, '2025-10-20 12:45:47'),
(60, 43, 52, 1, 56000.00, '2025-10-20 12:45:53'),
(61, 44, 52, 1, 56000.00, '2025-10-20 12:51:19'),
(62, 45, 55, 1, 90000.00, '2025-10-20 12:57:01'),
(63, 46, 47, 1, 3000.00, '2025-10-20 12:58:45'),
(64, 47, 45, 1, 9090.00, '2025-10-20 14:13:19'),
(65, 47, 52, 1, 56000.00, '2025-10-20 14:33:18'),
(66, 48, 52, 1, 56000.00, '2025-10-20 15:12:36'),
(67, 49, 53, 1, 7000.00, '2025-10-20 15:13:23'),
(68, 50, 53, 1, 7000.00, '2025-10-20 15:18:22'),
(69, 51, 52, 1, 56000.00, '2025-10-20 15:23:41'),
(70, 51, 63, 3, 8989.00, '2025-10-20 15:23:51'),
(71, 52, 63, 1, 8989.00, '2025-10-20 15:48:57'),
(72, 53, 66, 1, 9099.00, '2025-10-20 15:52:18'),
(73, 53, 50, 1, 499999.00, '2025-10-20 16:03:00'),
(75, 34, 53, 1, 7000.00, '2025-10-20 16:33:49'),
(77, 55, 52, 1, 56000.00, '2025-10-21 11:37:31'),
(78, 56, 52, 1, 56000.00, '2025-10-21 12:10:47'),
(79, 57, 66, 3, 9099.00, '2025-10-21 12:12:16'),
(81, 54, 52, 1, 56000.00, '2025-10-21 15:11:17'),
(82, 54, 63, 1, 8989.00, '2025-10-21 15:20:12'),
(83, 58, 47, 1, 30.00, '2025-10-21 15:41:01'),
(84, 58, 52, 1, 56000.00, '2025-10-21 15:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_user_info`
--

DROP TABLE IF EXISTS `tbl_order_user_info`;
CREATE TABLE IF NOT EXISTS `tbl_order_user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_order_user_info`
--

INSERT INTO `tbl_order_user_info` (`id`, `order_id`, `user_id`, `full_name`, `email`, `phone`, `address`, `city`, `country`, `postal_code`, `created_at`) VALUES
(1, 12, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-17 11:53:41'),
(2, 13, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '77', '2025-10-17 11:54:05'),
(3, 14, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 03:54:56'),
(4, 15, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:01:37'),
(5, 16, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:01:58'),
(6, 17, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 04:05:05'),
(7, 18, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:27:35'),
(8, 19, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:33:30'),
(9, 20, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:35:25'),
(10, 21, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:38:14'),
(11, 22, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:38:41'),
(12, 23, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:40:58'),
(13, 24, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:48:52'),
(14, 25, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:49:12'),
(15, 26, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '88', '2025-10-20 04:49:35'),
(16, 27, 68, '', '', '', '', '', '', '', '2025-10-20 06:21:46'),
(17, 28, 68, '', '', '', '', '', '', '', '2025-10-20 06:24:40'),
(18, 29, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 06:43:29'),
(19, 30, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 06:50:29'),
(20, 31, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 06:51:56'),
(21, 32, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 06:52:27'),
(22, 33, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 07:12:44'),
(23, 34, 68, 'asma', 'aslamasma486@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 07:14:23'),
(24, 35, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 07:21:47'),
(25, 36, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 07:53:01'),
(26, 37, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 08:00:26'),
(27, 38, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 08:02:07'),
(28, 39, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 08:02:33'),
(29, 40, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 08:05:44'),
(30, 41, 68, 'yousuf', 'sohamansab@gmail.com', '03208306536', 'B-122 north Karachi', '19', 'Pakistan', '88', '2025-10-20 09:10:16'),
(31, 42, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 09:10:58'),
(32, 43, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', '19', 'Pakistan', '88', '2025-10-20 10:20:51'),
(33, 44, 68, '', '', '', '', '', '', '', '2025-10-20 10:33:11'),
(34, 45, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', 'Karachi', 'Pakistan', '7500', '2025-10-20 10:35:20'),
(35, 46, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', 'Karachi', 'Pakistan', '78000', '2025-10-20 10:43:38'),
(36, 47, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', 'Karachi', 'Pakistan', '7500', '2025-10-20 10:56:16'),
(37, 48, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'Karachi', 'Pakistan', '7500', '2025-10-20 10:58:07'),
(38, 49, 68, '', '', '', '', '', '', '', '2025-10-20 11:04:44'),
(39, 50, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '75000', '2025-10-20 11:05:43'),
(40, 51, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'Karachi', 'Pakistan', '7500', '2025-10-20 11:38:36'),
(41, 52, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulashan Karachi', 'Karachi', 'Pakistan', '75000', '2025-10-20 11:40:08'),
(42, 53, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 Karachi', 'Karachi', 'Pakistan', '7500', '2025-10-20 11:41:18'),
(43, 54, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'Karachi', 'Pakistan', '75000', '2025-10-20 11:43:32'),
(44, 55, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 04:20:38'),
(45, 56, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 04:23:10'),
(46, 57, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 04:24:29'),
(47, 58, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 04:26:07'),
(48, 59, 68, '', '', '', '', '', '', '', '2025-10-21 05:06:00'),
(49, 60, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 05:06:16'),
(50, 61, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 05:16:05'),
(51, 62, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 05:17:54'),
(52, 63, 68, '', '', '', '', '', '', '', '2025-10-21 05:23:43'),
(53, 64, 68, '', '', '', '', '', '', '', '2025-10-21 05:25:18'),
(54, 65, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 05:28:49'),
(55, 66, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 05:34:07'),
(56, 67, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 06:28:41'),
(57, 68, 71, 'Muhammad Anas', 'muhammadanas@itspk.com', '03208306536', 'XYZ Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 06:32:40'),
(58, 69, 71, 'Muhammad Anas', 'muhammadanas@itspk.com', '03208306536', 'XYZ Karachi', 'karachi', 'Pakistan', '75000', '2025-10-21 06:33:39'),
(59, 59, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-23 06:23:27'),
(60, 60, 68, 'Soha Mansab', 'sohamansab@gmail.com', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-23 06:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_description` text,
  `product_price` decimal(10,2) NOT NULL,
  `isHotSale` tinyint(1) DEFAULT '0',
  `isActive` tinyint(1) DEFAULT '1',
  `category_id` int DEFAULT NULL,
  `product_created_by` int DEFAULT NULL,
  `product_updated_by` int DEFAULT NULL,
  `product_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `product_created_by` (`product_created_by`),
  KEY `product_updated_by` (`product_updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_description`, `product_price`, `isHotSale`, `isActive`, `category_id`, `product_created_by`, `product_updated_by`, `product_created_at`, `product_updated_at`) VALUES
(45, 'English Book', 'cfgvhbjnkm,', 9090.00, 1, 1, 7, 0, NULL, '2025-10-15 05:22:50', NULL),
(47, 'cup', 'trendy cup', 30.00, 1, 1, 8, 0, NULL, '2025-10-15 06:02:16', NULL),
(50, 'Electronic Items', 'Electronic Items', 499999.00, 1, 1, 2, 0, NULL, '2025-10-15 06:07:00', NULL),
(52, 'BABY TOY', 'BABY TOY', 56000.00, 1, 1, 6, 0, NULL, '2025-10-15 06:10:15', NULL),
(53, 'Home Decor', 'Home Decor  items', 7000.00, 1, 1, 1, 0, NULL, '2025-10-15 06:47:27', NULL),
(55, 'Shoes', 'shoes', 90000.00, 1, 1, 5, 0, NULL, '2025-10-15 07:32:56', NULL),
(63, 'Slipper', 'sasgyhgjhkj', 8989.00, 1, 1, 4, 0, NULL, '2025-10-17 04:46:33', NULL),
(64, 'English Book', 'ihb', 9090.00, 1, 1, 4, 0, NULL, '2025-10-17 04:53:08', NULL),
(66, 'iWatch', 'Apple Watch', 909.00, 1, 1, 1, 36, 0, '2025-10-17 06:05:57', '2025-10-24 09:35:42'),
(68, 'cups', 'Old', 3.00, 1, 1, 3, 0, NULL, '2025-10-23 05:37:24', NULL),
(69, 'Headphones', 'Old', 7.00, 0, 1, 3, 0, NULL, '2025-10-23 05:42:30', NULL),
(70, 'Headphones', 'Latest', 100.00, 0, 1, 1, 0, NULL, '2025-10-23 05:42:51', NULL),
(71, 'Frigidaire', 'Frigidaire EFMIS179 Gaming Light Up Mini Beverage Refrigerator, Stealth', 34.00, 0, 1, 1, 0, NULL, '2025-10-23 06:40:54', NULL),
(72, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 06:51:30', NULL),
(73, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 06:58:35', NULL),
(74, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 07:00:07', NULL),
(75, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 07:02:02', NULL),
(76, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 07:03:17', NULL),
(88, 'cups', 'Old', 11.00, 0, 1, 3, 0, 0, '2025-10-23 10:02:00', '2025-10-23 15:06:09'),
(90, 'iWatch', 'Apple Watch', 700.00, 1, 1, 1, 0, NULL, '2025-10-24 04:37:19', NULL),
(79, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 07:05:25', NULL),
(81, 'Xbox Wireless Gaming', 'Xbox Wireless Gaming Controller (2025) – Carbon Black – Play on Xbox, Windows, Android, iOS, FireTV Sticks, Smart TVs, VR Headsets', 49.00, 1, 1, 1, 0, NULL, '2025-10-23 07:08:10', NULL),
(82, 'watch', 'Latest', 40.00, 1, 1, 1, 0, NULL, '2025-10-23 07:25:40', NULL),
(83, 'cups', '2025 collection', 20.00, 1, 1, 3, 0, NULL, '2025-10-23 07:29:08', NULL),
(89, 'Clothes', '2025 collection', 20.00, 1, 1, 2, 0, NULL, '2025-10-24 04:26:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile_info`
--

DROP TABLE IF EXISTS `tbl_profile_info`;
CREATE TABLE IF NOT EXISTS `tbl_profile_info` (
  `user_info_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `shipping_address` text,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_info_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_profile_info`
--

INSERT INTO `tbl_profile_info` (`user_info_id`, `user_id`, `full_name`, `contact_number`, `shipping_address`, `city`, `province`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 36, 'Asma Aslam', '03432994277', 'House no 589, street no 07', 'Orangi town, Karachi', 'karachi', '78500', '2025-10-17 16:40:30', '2025-10-21 15:20:21'),
(2, 90, 'Asma Aslam', '03432994277', 'House no 589, street no 07', 'Orangi town, Karachi', 'karachi', '78500', '2025-10-20 12:17:36', '2025-10-20 12:17:36'),
(3, 91, 'Asma Aslam', '03432994277', 'House no 589, street no 07', 'Orangi town, Karachi', 'karachi', '78500', '2025-10-20 12:27:57', '2025-10-20 15:54:37'),
(4, 92, 'Asma Aslam', '03432994277', 'House no 589, street no 07', 'Orangi town, Karachi', 'karachi', '78500', '2025-10-20 12:46:13', '2025-10-20 15:11:26'),
(5, 93, '', '', '', '', '', '', '2025-10-21 11:41:20', '2025-10-21 12:23:38'),
(6, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-23 11:33:04', '2025-10-23 11:33:04'),
(7, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-23 11:51:55', '2025-10-23 11:51:55'),
(8, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 09:17:31', '2025-10-24 09:17:31'),
(9, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 09:18:42', '2025-10-24 09:18:42'),
(10, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 09:30:54', '2025-10-24 09:30:54'),
(11, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:18:32', '2025-10-24 10:18:32'),
(12, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:19:27', '2025-10-24 10:19:27'),
(13, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:20:17', '2025-10-24 10:20:17'),
(14, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:20:55', '2025-10-24 10:20:55'),
(15, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:21:38', '2025-10-24 10:21:38'),
(16, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:23:03', '2025-10-24 10:23:03'),
(17, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:23:42', '2025-10-24 10:23:42'),
(18, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:26:14', '2025-10-24 10:26:14'),
(19, 73, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 10:29:36', '2025-10-24 10:29:36'),
(20, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 14:09:49', '2025-10-24 14:09:49'),
(21, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 14:32:32', '2025-10-24 14:32:32'),
(22, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-24 16:40:25', '2025-10-24 16:40:25'),
(23, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-27 11:57:23', '2025-10-27 11:57:23'),
(24, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-27 11:59:00', '2025-10-27 11:59:00'),
(25, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-10-27 12:04:32', '2025-10-27 12:04:32'),
(26, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-11-04 14:43:06', '2025-11-04 14:43:06'),
(27, 68, 'Soha Mansab', '03208306536', 'B-122 gulshan Karachi', 'karachi', 'Pakistan', '75000', '2025-11-24 15:28:38', '2025-11-24 15:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

DROP TABLE IF EXISTS `tbl_registration`;
CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `is_Admin` tinyint(1) DEFAULT '1',
  `cv_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`id`, `name`, `email`, `password`, `phone`, `designation`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_Admin`, `cv_path`) VALUES
(17, 'cscs', 'cs@gmail.com', 'cs1234', '03432994277', 'Manager', '2025-10-08 07:38:59', NULL, '2025-10-10 01:17:33', NULL, 1, '../Uploads/17/1760077053_2mb.pdf'),
(25, 'Raza', 'raza@gmail.com', 'raza123', '03432994277', 'Manager', '2025-10-08 10:01:31', 'Raza', '2025-10-10 01:59:50', 'Admin', 1, '../Uploads/25/1760079590_Asma Aslam_CV.pdf'),
(28, 'mom', 'mom@gmail.com', 'mom123', '03432994277', 'Manager', '2025-10-08 11:32:46', 'mom', '2025-10-12 23:16:09', 'Admin', 1, '../Uploads/28/1760328969_Arshad_CV.pdf'),
(30, 'asma', 'asma@gmail.com', '$2y$10$eybGfkOkCj/LhKfTHzis1.TxdoTYEAE3bIpYtzRdGciSJ4JaoNxte', '03432994277', 'Manager', '2025-10-08 11:39:05', 'mom', '2025-10-12 23:15:51', 'Admin', 1, '../Uploads/30/1760328951_Asma Aslam_CV (6).pdf'),
(32, 'kamran Ali', 'kamran@gmail.com', 'kamran123', '03432994277', 'Manager', '2025-10-09 04:01:25', 'roshi', '2025-10-09 00:57:46', NULL, 1, NULL),
(33, 'sir', 'sir@gmail.com', 'sir123', '03432994277', 'Manager', '2025-10-09 04:04:30', NULL, NULL, NULL, 1, NULL),
(34, 'base', 'base@gmail.com', 'base123', '03432994277', 'Developer', '2025-10-09 04:06:48', NULL, NULL, NULL, 1, NULL),
(35, 'azhar', 'azhar@gmail.com', 'azhar123', '03432994277', 'Developer', '2025-10-09 04:11:08', NULL, NULL, NULL, 1, NULL),
(36, 'Adnan Ali', 'adnan@gmail.com', '$2y$10$I7Qyb5H8kLGM.6A/hCR4CuM.TL6i8FixXYdjx.kCCuXJDPmkeCNbm', '03432994277', 'Designer', '2025-10-09 04:14:23', 'Adnan', '2025-10-08 23:15:39', 'Adnan', 1, NULL),
(37, 'Rizwan', 'rizwan@gmail.com', '$2y$10$Q2hGLGXrKTWXicaJdoSfu..TfNciq/SRekkfbphyPQW5HKBDQhFxi', '03432994277', 'Manager', '2025-10-09 04:41:06', 'Rizwan', NULL, NULL, 1, NULL),
(39, 'Asma Aslam', 'aslamasma4861@gmail.com', '$2y$10$WFTCS82i/uzgrzf5R0N84OUl8vHHZmoLFTdREa2GmYZT9P5wQi.cm', '03432994277', 'Developer', '2025-10-09 04:52:41', 'Asma Aslam', '2025-10-10 01:09:41', 'Admin', 1, '../Uploads/39/1760076581_file-example_PDF_500_kB.pdf'),
(40, 'Asma Aslam', 'aslamasma123@gmail.com', '$2y$10$ypiQ7TuJongfEFxUj9K6AuCfYviX0xEJf3XQI11ySnzQoYPXxrixm', '03432994277', 'Student ', '2025-10-09 06:54:05', NULL, NULL, NULL, 1, NULL),
(41, 'molana', 'molana@gmail.com', '$2y$10$SaFB1QafYoudrc/Vir4WbuBcezXfUei/34H.fqR7fwYnhGxG147q6', '03432994277', 'Designer', '2025-10-09 06:54:29', NULL, NULL, NULL, 1, NULL),
(42, 'Asma Aslam', 'aslamasma1234@gmail.com', '$2y$10$eGLqVAlwxvzJT3fvSsWqOuumFeKRgqoMeXju637065SMctQsfLEZ.', '03432994277', 'Student ', '2025-10-09 06:55:55', NULL, NULL, NULL, 1, NULL),
(43, 'Asma Aslam', 'aslamasma0987@gmail.com', 'asma0987', '03432994277', 'Manager', '2025-10-09 07:32:20', NULL, NULL, NULL, 1, NULL),
(44, 'Asma Aslam', 'aslamasma3456@gmail.com', 'asma3456', '03432994277', 'Student ', '2025-10-09 07:32:46', NULL, '2025-10-12 23:20:20', 'Admin', 1, NULL),
(45, 'Asma Aslam', 'aslamasma2345@gmail.com', 'asma2345', '03432994277', 'Developer', '2025-10-09 07:37:35', NULL, NULL, NULL, 1, 'resume_asma_aslam (4).pdf'),
(49, 'Asma Aslam', 'aslamasma456@gmail.com', 'asma456', '03432994277', 'Developer', '2025-10-09 07:39:07', NULL, NULL, NULL, 1, NULL),
(51, 'Asma Aslam', 'aslamasma444@gmail.com', '$2y$10$uCTkBEa2MIfCk6/LMOUvhux6FxmIY0t2gvvU3Kk2MRverMxQ4uuly', '03432994277', 'Student', '2025-10-09 09:34:15', NULL, NULL, NULL, 1, '1760002455_resume_asma_aslam__4_.pdf'),
(56, 'Asma Aslam', 'aslamasma999@gmail.com', '$2y$10$heAWbpyMfVekfr8LHUU3OuN4jAbR6SniyHhyCKL29FvvPCWp9pKZG', '03432994277', 'Student', '2025-10-09 09:39:47', NULL, NULL, NULL, 1, '1760002787_resume_asma_aslam__4_.pdf'),
(58, 'Asma Aslam', 'aslamasma888@gmail.com', '$2y$10$y9QZrv0KRIW4GQjJHabPn.b3fILWIDJEvHnLKhXJ0SselF6JKDrHW', '03432994277', 'Student', '2025-10-09 09:41:48', NULL, NULL, NULL, 1, '1760002908_resume_asma_aslam__4_.pdf'),
(62, 'Asma Aslam', 'aslam@gmail.com', '$2y$10$9.UutiF5AH1qtBk7NxJZTOEKetqKtJg9Fvx3KfKFWuSQADMFVGPpy', '03432994277', 'Student', '2025-10-09 09:46:09', NULL, NULL, NULL, 1, '1760003169_resume_asma_aslam (4).pdf'),
(63, 'Asma Aslam', 'aslamasma4886@gmail.com', '$2y$10$DG1aqkxBbeDzpizPwZkmsu1OQaN/ADlV7EttjdpG7w3xpzqMtLesa', '03432994277', 'Student', '2025-10-09 09:50:48', NULL, NULL, NULL, 1, '1760003448_'),
(64, 'Asma Aslam', '21f-cs-9@students.duet.edu.pk', '$2y$10$JyQ0KUmZCXfjC2E3CLYkuOpYhMxEH7MH3Rh20UisRQhu5veZrDhUK', '03432994277', 'Designer', '2025-10-09 09:55:20', NULL, NULL, NULL, 1, '1760003720_file-example_PDF_500_kB.pdf'),
(65, 'Asma Aslam', 'aslamasma000@gmail.com', '$2y$10$uM79I4e0mEwsiCUIQroIWuFoZDy52mTVmlbDnHjjEFcrl7i2Twq1G', '03432994277', 'Manager', '2025-10-09 10:18:57', NULL, NULL, NULL, 1, '1760005137_resume_asma_aslam (4).pdf'),
(66, 'Asma Aslam', 'aslamasma666@gmail.com', '$2y$10$x7.dSRZev/cQoZAI91G11OpB1d6unCIJ5ccdQmTBI/hd2DYZTyKO.', '03432994277', 'Developer', '2025-10-09 10:20:31', NULL, NULL, NULL, 1, '1760005231_file-example_PDF_500_kB.pdf'),
(67, 'Asma Aslam', 'aslamasma416@gmail.com', '$2y$10$qVL9/WrDrAP9kNq1HMoUZ.csL7QfQfF7w8TlAczP.j31aZd1sUMny', '03432994277', 'Student', '2025-10-09 10:34:52', 'Asma Aslam', '2025-10-09 23:44:06', 'Admin', 1, '../Uploads/67/1760071446_resume_asma_aslam (4).pdf'),
(68, 'Asma Aslam', 'aslamasma46@gmail.com', '$2y$10$otLtu0rwrctXhlMmxQD38.hTqLeP1usnyYu7prCfx2Wqp3haQE0TO', '03432994277', 'Developer', '2025-10-09 10:41:32', 'Asma Aslam', NULL, NULL, 1, '1760006492_file-example_PDF_500_kB.pdf'),
(69, 'Asma Aslam', 'aslamasma6@gmail.com', '$2y$10$a9CcB0mcaS0w1OYAKbRNr.POnePwDi7ZkTD6q9grNNbXsz3VBvQE6', '03432994277', 'Developer', '2025-10-09 10:44:20', 'Asma Aslam', '2025-10-10 00:05:13', 'Admin', 1, '../Uploads/69/1760072713_resume_asma_aslam (4).pdf'),
(70, 'Asma Aslam', '21f-cs-0@students.duet.edu.pk', '$2y$10$g5fuUf6Sx7gsMfAMhwT0dO0ZeDhKQW1eQLAbo9AbspIAdE/MeJ8H.', '03432994277', 'Manager', '2025-10-09 10:45:02', 'Asma Aslam', '2025-10-09 23:43:22', 'Admin', 1, '1760006702_resume_asma_aslam (4).pdf'),
(71, 'Saba', 'saba@gmail.com', '$2y$10$fX1xe2wDiWn28iKqsxOmPu0wDzqfgGLFVsHuxXwjZSLow2pmUaVJe', '03432994277', 'Frontend Developer', '2025-10-10 04:50:51', 'Admin', NULL, NULL, 1, ''),
(72, 'mansab', 'mansab@gmail.com', '$2y$10$LdBRBb02VckbDppxHfapguIZBf9Ib6cRA8AxXlaBCOCqw.03QhqT6', '03432994277', 'Designer', '2025-10-10 04:51:20', 'Admin', NULL, NULL, 1, ''),
(73, 'mansab', 'mansab1@gmail.com', '$2y$10$l6vJ6jGaZVWw9C0BBw4nMu4ndiwuifGKCZDKQbjnSgfRrl42m1H8m', '03432994277', 'Designer', '2025-10-10 04:52:30', 'Admin', '2025-10-09 23:57:43', 'Admin', 1, '../Uploads/73/1760072263_2mb.pdf'),
(74, 'Maha', 'maha1@gmail.com', '$2y$10$s3cLFCkr.GGzYwjCzmS9E.RoQbhNe6DXK6piKzq10LZKE77kAMDnG', '03432994277', 'Developer', '2025-10-10 04:57:25', 'Admin', NULL, NULL, 1, '1760072245_file-example_PDF_500_kB.pdf'),
(75, 'mona', 'mona@gmail.com', '$2y$10$MX6XL5P77lcIjessWJNjYeV7q03nIKK0W88g5qlpRvJnZPgVA2KxO', '03432994277', 'Manager', '2025-10-10 05:03:59', 'mona', NULL, NULL, 1, NULL),
(76, 'khursheerd', 'khursheed@gmail.com', '$2y$10$onycf2TsF2xOobfwq/qrveSVGsSCYgO5hHMnD.JAoBeuSQ6ArUSIa', '03432994277', 'Designer', '2025-10-10 05:04:30', 'khursheerd', NULL, NULL, 1, NULL),
(77, 'Ahmed', 'ahmed@gmail.com', '$2y$10$FCpAkIAs9A5w2Ouu8yP1Eud2PNjD6Gu70ldi12u8MfyDpSbeP8OM2', '03432994277', 'Student', '2025-10-10 06:04:57', 'Admin', NULL, NULL, 1, ''),
(78, 'Arshad', 'arshad@gmail.com', '$2y$10$9GYGk4yPxBlPqt6Q2EMNkuX4a71Eb265zjKxsRlqXN8nspZZKR4eC', '03432994277', 'Frontend Developer', '2025-10-10 06:08:48', 'Admin', NULL, NULL, 1, '1760076528_Asma Aslam_CV.pdf'),
(79, 'alia', 'alia@gmail.com', '$2y$10$m32oqxXLfuWb2ATk2B.WnOYWoFsKikHrvpCmLq0iDw0pQQMsgWGfW', '03432994277', 'Designer', '2025-10-10 06:52:00', 'Admin', NULL, NULL, 1, '1760079120_resume_asma_aslam (4).pdf'),
(80, 'Asma Aslam', 'aslamasma4486@gmail.com', '$2y$10$r0xx0or106emKp65yfzyxusfK6YU7hDM4z4QafDr7mTiOO1e0iBnC', '03432994277', 'Developer', '2025-10-10 10:55:34', 'Admin', NULL, NULL, 1, '1760093734_Raza_CV.pdf'),
(81, 'Asma Aslam', 'aslamasma44586@gmail.com', '$2y$10$nwzidxqygDVKoSFMboKJveFUNPLZCdb0rqSyHehE2p8QzAEZYOJPW', '03432994277', 'Designer', '2025-10-10 11:14:56', 'Admin', '2025-10-10 06:16:02', 'Admin', 1, '../Uploads/81/1760094962_Raza_CV.pdf'),
(82, 'Asma Aslam', 'aslamasma23486@gmail.com', '$2y$10$8.8aiFCOcPbufFGCMeKJsuOs.26PcjPstR6hwo0FyD36FcZ77DjO6', '03432994277', 'Frontend Developer', '2025-10-13 04:06:12', 'Admin', NULL, NULL, 1, '1760328372_Asma Aslam_CV (5).pdf'),
(83, 'Asma Aslam', 'aslamasma48634@gmail.com', '$2y$10$8FfW/xFJqYQo78o9YBOqpOjbMy0aW.K2kXB2do9QgfuPxndEqeeWC', '03432994277', 'Manager', '2025-10-13 04:15:32', 'Admin', NULL, NULL, 1, '1760328932_Arshad_CV.pdf'),
(84, 'Amiqa', 'amiqa486@gmail.com', '$2y$10$N4MkiuZY5izRtX7dmgeqeuBygfEnllXRYXnAzDPzYEPkmasF8m4mu', '03432994277', 'Manager', '2025-10-13 04:20:09', 'Amiqa', NULL, NULL, 1, NULL),
(85, 'Amna', 'amna@gmail.com', '$2y$10$YwDJ6JLQJfwGtbU3H44Cvu4OrwAlak9NILMXT1mcLld1Gu06lrrDC', '03432994277', 'Developer', '2025-10-13 04:23:19', 'Admin', '2025-10-12 23:23:54', 'Admin', 1, '../Uploads/85/1760329434_Raza_CV.pdf'),
(86, 'Asma Aslam', 'aslamasma45486@gmail.com', '$2y$10$zJwT1N9Og5c2uDVa1X6ilOCRoIdJlZB5oL3BNCrVzXa7hSpRK0uYa', '03432994277', 'Student', '2025-10-14 04:41:33', 'Admin', NULL, NULL, 1, '1760416893_Asma Aslam_CV (7).pdf'),
(87, 'Asma Aslam', 'aslamasma48fd6@gmail.com', '$2y$10$U30D877pZLSMSZ9av.8b/.dNVBlov7rkBV3QyRTxDStbVSmUupigC', '03432994277', 'Frontend Developer', '2025-10-14 04:43:14', 'Admin', NULL, NULL, 1, '1760416994_Maha_CV (1).pdf'),
(88, 'Asma Aslam', '21f-cs-029@students.duet.edu.pk', '$2y$10$tSQHBUT0BGu9yn82UJ5Ti.2wOjBAelEzz5AVJ9tAYUGlFaXWBRBcG', '03432994277', 'Designer', '2025-10-14 04:44:03', 'Admin', NULL, NULL, 1, '1760417043_Maha_CV (1).pdf'),
(89, 'Asma Aslam', '21f-cs-02er934@students.duet.edu.pk', '$2y$10$BRAcGUf14tVFXYMtH1l.YeCxXOQZTffDCYRD1qRZAoLGHB5b.GvYe', '03432994277', 'Designer', '2025-10-14 04:45:29', 'Admin', NULL, NULL, 1, '1760417129_Asma Aslam_CV (7).pdf'),
(90, 'Asma Aslam', 'sohamansab@gmail.com', '$2y$10$JXWzokThjO/fpr4P6BFBK.s6TSHH1pruPjuR4AxTY2BAZEMRq2feG', '03432994277', 'Manager', '2025-10-20 07:17:18', 'Asma Aslam', NULL, NULL, 1, NULL),
(91, 'Asma Aslam', 'aslamasma486@gmail.com', '$2y$10$cT6SrRRxdK58Utgrbxi7FuSFG/bbiWq22ADYwlS/ESQ2JVgQzenz6', '03432994277', 'Developer', '2025-10-20 07:27:36', 'Asma Aslam', NULL, NULL, 1, NULL),
(92, 'maida', 'maidasaeed311@gmail.com', '$2y$10$L3r2XV/pK0bHmgOL.H96HeL5ES5BoWu/L26uxgFsCj257BF3cocry', '03432994277', 'Manager', '2025-10-20 07:45:34', 'maida', NULL, NULL, 1, NULL),
(93, 'maida', 'maidasaeed@gmail.com', '$2y$10$JdEki27x6awXQPwmruhwV.AUB4DXp6qz15EXRgBJaiWuXa4IQ0UJK', '03432994277', 'Manager', '2025-10-21 06:37:19', 'maida', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(15) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `created_by` varchar(255),
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` int NOT NULL DEFAULT '1',
  `uploaded_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`sno`, `username`, `password`, `email`, `dt`, `phone`, `designation`, `created_by`, `updated_by`, `created_at`, `updated_at`, `admin`, `uploaded_file`) VALUES
(64, 'reham', '$2y$10$9ZTHWnr4NJ4Z8Df/R.', 'reham@gmail.com', '2025-10-10 14:56:48', '03332300066', 'Developer', 'soha', NULL, '2025-10-10 14:56:48', '2025-10-10 14:56:48', 1, '64/check_file_1760090207.pdf'),
(63, 'sarah', '$2y$10$uc9PcrISYNodv8xXgb', 'sarah@gmail.com', '2025-10-10 14:44:54', '03332300061', 'Designer', 'soha', NULL, '2025-10-10 14:44:54', '2025-10-10 14:44:54', 1, '63/favicon_1760089493.pdf'),
(62, 'umaima', '$2y$10$BiU3ndj7.eMIv6R01v', 'umaima@gmail.com', '2025-10-10 14:42:09', '03332300065', 'Teacher', 'soha', NULL, '2025-10-10 14:42:09', '2025-10-10 14:42:09', 1, '62/check_file_1760089329.pdf'),
(61, 'ebad', '$2y$10$0YVA7o9hRxoI12iV8i', 'ebad@gmail.com', '2025-10-10 14:40:13', '03332300065', 'Designer', 'soha', NULL, '2025-10-10 14:40:13', '2025-10-10 14:40:13', 1, '61/check_file_1760089213.pdf'),
(60, 'shab', '$2y$10$QIwZ1/qE4V6ObGno7j', 'shab@gmail.com', '2025-10-10 14:06:34', '03332300066', 'Developer', 'soha', NULL, '2025-10-10 14:06:34', '2025-10-10 14:06:34', 1, '60/favicon_1760087194.pdf'),
(59, 'eman', '$2y$10$YjtQOe6MEamuJjpkNI', 'eman@gmail.com', '2025-10-10 12:41:55', '03332300065', 'Developer', 'soha', NULL, '2025-10-10 12:41:55', '2025-10-10 12:41:55', 1, '59/check_file_1760082115.pdf'),
(58, 'rafay', '$2y$10$efpQ/mxi0D4cofwuce', 'rafay@gmail.com', '2025-10-10 12:40:02', '03332300065', 'Manager', 'soha', 'soha', '2025-10-10 12:40:02', '2025-10-10 16:17:40', 1, 'Resume_Bilal_Alvi__finance_.pdf'),
(57, 'nasir', '$2y$10$eaLQswqfLXf7o6STst', 'nasir@gmail.com', '2025-10-10 12:39:29', '03332300065', 'Developer', 'soha', NULL, '2025-10-10 12:39:29', '2025-10-10 12:39:29', 1, '57/favicon_1760081969.pdf'),
(55, 'nehaz', '$2y$10$i5tFExoEHvLp9m0aHi', 'nehaz@gmail.com', '2025-10-10 12:36:30', '03332300066', 'Developer', 'soha', NULL, '2025-10-10 12:36:30', '2025-10-10 12:36:30', 1, '55/check_file_1760081789.pdf'),
(56, 'sabeen', '$2y$10$GeIBIHgWUNraQdnaZF', 'sabeen@gmail.com', '2025-10-10 12:37:32', '03332300065', 'Manager', 'soha', NULL, '2025-10-10 12:37:32', '2025-10-10 12:37:32', 1, '56/check_file_1760081852.pdf'),
(42, 'arshi', '$2y$10$i1oy1CsVaZteAUqJqx', 'arshi@gmail.com', '2025-10-10 10:52:31', '03332300061', 'Student', 'soha', 'soha', '2025-10-10 10:52:31', '2025-10-10 10:52:59', 1, '42/check_file.pdf'),
(43, 'sarwar', '$2y$10$N3rrYOhPyl8eLURwRt', 'sarwar@gmail.com', '2025-10-10 10:53:45', '03332300066', 'Teacher', 'soha', NULL, '2025-10-10 10:53:45', '2025-10-10 10:53:45', 1, '43/favicon_1760075625.pdf'),
(44, 'razia', '$2y$10$oUfDDRMl5CkUotAp9T', 'razia@gmail.com', '2025-10-10 11:23:40', '03332300062', 'Student', 'soha', NULL, '2025-10-10 11:23:40', '2025-10-10 11:23:40', 1, '44/check_file_1760077420.pdf'),
(45, 'yousuf', '$2y$10$UPmbVTRcu5Z/TZF.9o', 'yousuf@gmail.com', '2025-10-10 11:39:09', '03332300066', 'Developer', 'soha', NULL, '2025-10-10 11:39:09', '2025-10-10 11:39:09', 1, '45/check_file_1760078349.pdf'),
(54, 'mansab', '$2y$10$Wqve7zC1Vserpz2SK8', 'mansab@gmail.com', '2025-10-10 12:31:44', '03332300065', 'Teacher', 'soha', NULL, '2025-10-10 12:31:44', '2025-10-10 12:31:44', 1, ''),
(47, 'tasneen', '$2y$10$hF8ySQFy1NMroxaYRS', 'tasneen@gmail.com', '2025-10-10 11:51:27', '03332300066', 'Designer', 'soha', NULL, '2025-10-10 11:51:27', '2025-10-10 11:51:27', 1, '47/check_file_1760079087.pdf'),
(48, 'zaram', '$2y$10$iSpMpVy4Swy/FPZ/Gr', 'zaram@gmail.com', '2025-10-10 11:55:42', '03332300066', 'Developer', 'soha', NULL, '2025-10-10 11:55:42', '2025-10-10 11:55:42', 1, '48/check_file_1760079341.pdf'),
(49, 'yusra', '$2y$10$0PzAABss2NB4WKUp.a', 'yusra@gmail.com', '2025-10-10 11:56:27', '03332300066', 'Manager', 'soha', NULL, '2025-10-10 11:56:27', '2025-10-10 11:56:27', 1, '49/check_file_1760079387.pdf'),
(50, 'jia', '$2y$10$p.iAlVb.Sqp3Wl1GEa', 'jia@gmail.com', '2025-10-10 11:58:09', '03332300065', 'Manager', 'soha', NULL, '2025-10-10 11:58:09', '2025-10-10 11:58:09', 1, '50/check_file_1760079489.pdf'),
(65, 'reema', '$2y$10$6PeyTuCtjwzPjHeF2Q', 'reema@gmail.com', '2025-10-10 14:57:34', '03332300065', 'Developer', 'soha', NULL, '2025-10-10 14:57:34', '2025-10-10 14:57:34', 1, '65/check_file_1760090254.pdf'),
(66, 'zian', '$2y$10$.OOMmnBpZqpDnV2bOm', 'zian@gmail.com', '2025-10-10 14:58:48', '03332300066', 'Designer', 'soha', 'soha', '2025-10-10 14:58:48', '2025-10-10 15:27:27', 1, 'check_file.pdf'),
(68, 'soha', 'soha1234', 'sohamansab@gmail.com', '2025-10-13 09:02:20', '03332300062', 'Developer', 'soha', 'soha', '2025-10-13 09:02:20', '2025-10-14 10:36:09', 1, NULL),
(67, 'minhaas', '$2y$10$Hf9g2FaIT6.y5vYSt1', 'minhaa@gmail.com', '2025-10-10 15:11:35', '03332300065', 'Developer', 'soha', 'soha', '2025-10-10 15:11:35', '2025-10-10 15:27:08', 1, 'favicon.pdf'),
(69, 'beena', 'beena1234', 'beena@gmail.com', '2025-10-17 15:47:26', '03332300062', 'Designer', 'beena', NULL, '2025-10-17 15:47:26', '2025-10-17 15:47:26', 1, NULL),
(70, 'ysf', 'yousuf12345', 'ysf@gmail.com', '2025-10-21 09:06:13', '03332300065', 'Developer', 'ysf', NULL, '2025-10-21 09:06:13', '2025-10-21 09:06:13', 1, NULL),
(71, 'Anas', 'anas12345', 'muhammadanas@itspk.com', '2025-10-21 11:30:22', '03332300065', 'Developer', 'Anas', NULL, '2025-10-21 11:30:22', '2025-10-21 11:30:22', 1, NULL),
(72, 'sohama', 'soha12345', 'sohama@gmail.com', '2025-10-23 11:37:27', '03332300061', 'Developer', 'soha', NULL, '2025-10-23 11:37:27', '2025-10-23 11:37:27', 1, NULL),
(73, 'sameen', 'sameen1234', 'sameen@gmail.com', '2025-10-24 08:49:25', '03332300062', 'Manager', 'soha', NULL, '2025-10-24 08:49:25', '2025-10-24 08:49:25', 1, NULL),
(74, 'sameen', 'sameen1234', 'sameenn@gmail.com', '2025-10-24 09:15:55', '03332300061', 'Designer', 'sameen', NULL, '2025-10-24 09:15:55', '2025-10-24 09:15:55', 1, NULL),
(75, 'suha', 'suha1234', 'suhamansab@gmail.com', '2025-10-24 14:09:27', '03332300061', 'Developer', 'soha', NULL, '2025-10-24 14:09:27', '2025-10-24 14:09:27', 1, NULL),
(76, 'sohai', 'soha12345', 'sohaimansab@gmail.com', '2025-10-27 09:04:26', '03332300061', 'Developer', 'sohai', NULL, '2025-10-27 09:04:26', '2025-10-27 09:04:26', 1, NULL),
(77, 'waniaa', 'wania12345', 'waniaa@gmail.com', '2025-10-27 12:01:02', '03332300061', 'Manager', 'soha', NULL, '2025-10-27 12:01:02', '2025-10-27 12:01:02', 1, NULL),
(78, 'soha', 'soha12345', 'soh@gmail.com', '2025-10-30 12:00:25', '03332300061', 'Manager', 'soha', NULL, '2025-10-30 12:00:25', '2025-10-30 12:00:25', 1, NULL),
(79, 'zara', 'soha1234', 'ansab@gmail.com', '2025-10-31 11:20:54', '03332300061', 'Developer', 'zara', NULL, '2025-10-31 11:20:54', '2025-10-31 11:20:54', 1, NULL),
(80, 'soha', 'soha1234', 'sohamansa@gmail.com', '2025-11-11 15:07:16', '03332300066', 'Designer', 'soha', NULL, '2025-11-11 15:07:16', '2025-11-11 15:07:16', 1, NULL),
(81, 'sohaq', 'sohaq1234', 'sohaqmansab@gmail.com', '2025-11-15 10:42:01', '1234567890', 'Teacher', 'soha', NULL, '2025-11-15 10:42:01', '2025-11-15 10:42:01', 1, NULL),
(82, 'anum', 'anum1234', 'anum@gmail.com', '2025-11-18 09:05:09', '03332300063', 'Teacher', 'anum', NULL, '2025-11-18 09:05:09', '2025-11-18 09:05:09', 1, NULL),
(83, 'soha mansab', 'soha1234', 'sohayousuf@gmail.com', '2025-11-24 11:45:23', '03332300061', 'Developer', 'soha', 'soha', '2025-11-24 11:45:23', '2025-11-24 11:45:43', 1, NULL),
(84, 'tasnem', 'tasnem1234', 'tasnem@gmail.com', '2025-11-24 15:19:53', '1234567890', 'Designer', 'soha', NULL, '2025-11-24 15:19:53', '2025-11-24 15:19:53', 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD CONSTRAINT `fk_dashboard` FOREIGN KEY (`user_id`) REFERENCES `tbl_registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

