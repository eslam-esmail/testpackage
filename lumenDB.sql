-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2018 at 09:38 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumenDB`
--
CREATE DATABASE IF NOT EXISTS `lumenDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lumenDB`;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `non_approved_info_title` text CHARACTER SET utf8 COLLATE utf8_bin,
  `approved_info_title` text CHARACTER SET utf8 COLLATE utf8_bin,
  `is_approved` tinyint(4) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `approved_on_utc` datetime DEFAULT NULL,
  `approved_by` binary(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `merchant_slug` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `non_approved_info_title`, `approved_info_title`, `is_approved`, `is_published`, `approved_on_utc`, `approved_by`, `created_at`, `created_by`, `updated_at`, `updated_by`, `merchant_slug`) VALUES
(0, 'Test froeeee API2', NULL, 0, 0, NULL, NULL, '2018-01-24 15:00:07', 22541125, '2018-01-24 15:18:30', 75584, NULL),
(1, 'My Merchant', NULL, 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:06', 0, 'my-merchant'),
(2, 'Mall', NULL, 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:06', 0, 'mall'),
(3, '3ala2', '3ala2', 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, '3ala2'),
(4, 'OlaHub', 'OlaHub', 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'olahub'),
(5, 'New Vision-Jordan', 'New Vision-Jordan', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'new-vision-jordan'),
(6, 'Time Center', 'Time Center', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'time-center'),
(7, 'My Merchant', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'my-merchant'),
(8, 'My Merchant', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'my-merchant'),
(9, 'Wild Jordan', 'Wild Jordan', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'wild-jordan'),
(10, 'Nothing Like IT', 'Nothing Like IT', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'nothing-like-it'),
(11, 'OlaHub Test', 'OlaHub Test', 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL),
(12, 'Colorfull Printing Solutions', 'Colorfull Printing Solutions', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'colorfull-printing-solutions'),
(13, 'Abu Shakra', 'Abu Shakra', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'abu-shakra'),
(14, 'BCI', 'BCI', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'bci'),
(15, 'LEO Jewelry', 'LEO Jewelry', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'leo-jewelry'),
(16, 'Rosenthal', 'Rosenthal', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'rosenthal'),
(17, 'Albakhait Telecom', 'Albakhait Telecom', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'albakhait-telecom'),
(18, 'Mazaya Gallery', 'Mazaya Gallery', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'mazaya-gallery'),
(19, 'Kenzi Online', 'Kenzi Online', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'kenzi-online'),
(20, 'jedo yousef toys', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'jedo-yousef-toys'),
(21, 'SIA', 'SIA', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'sia'),
(22, 'Burj Al Nahar For Electronics Trading', 'Burj Al Nahar For Electronics Trading', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'burj-al-nahar-for-electronics-trading'),
(23, 'Your Depot', 'Your Depot', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'your-depot'),
(24, 'Jobedu', 'Jobedu', 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'jobedu'),
(25, 'BalloonZmania', 'BalloonZmania', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'balloonzmania'),
(26, 'Orchids Flowers', 'Orchids Flowers', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'orchids-flowers'),
(27, 'Ghadir', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(28, 'test', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(29, 'Gheed', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'gheed'),
(30, 'Experience Days', 'Experience Days', 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'experience-days'),
(31, 'testing', 'testing', 0, 0, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'testing'),
(32, 'testing', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(33, 'TXON', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'txon'),
(34, 'Al-Afghani', 'Al-Afghani', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'al-afghani'),
(35, 'Luxury Home', 'Luxury Home', 1, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'luxury-home'),
(36, 'Al-Fursan', 'Al-Fursan', 1, 1, '2017-05-17 13:23:19', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'al-fursan'),
(37, 'blafel', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'blafel'),
(38, 'Mecal', 'Mecal', 1, 1, '2017-06-02 11:42:21', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'mecal'),
(40, 'test', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(41, 'AminoGenesis', 'AminoGenesis', 1, 1, '2017-06-07 06:55:01', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'aminogenesis'),
(42, 'Samiz', 'Samiz', 1, 1, '2017-06-07 07:52:47', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'samiz'),
(43, 'Jolie Femme', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(44, 'Ala', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'ala'),
(45, 'Jolie Femme', 'Jolie Femme', 1, 1, '2017-07-05 12:24:16', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'jolie-femme'),
(46, 'Lavyola', 'Lavyola', 1, 1, '2017-07-17 13:59:34', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'lavyola'),
(47, 'EvaFlor Paris', 'EvaFlor Paris', 1, 1, '2017-07-31 17:42:17', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'evaflor-paris'),
(48, 'Dara Shop', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'dara-shop'),
(49, 'Al-Shaffaf', 'Al-Shaffaf', 1, 1, '2017-08-12 07:05:32', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'al-shaffaf'),
(50, 'Futna', 'Futna', 1, 1, '2017-08-13 13:40:40', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'futna'),
(51, 'Ghadir', NULL, 0, 1, NULL, NULL, NULL, 0, NULL, 0, NULL),
(52, 'Freddy', 'Freddy', 1, 1, '2017-08-17 11:16:52', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'freddy'),
(53, 'Richmond', 'Richmond', 1, 1, '2017-08-22 13:48:49', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'richmond'),
(54, 'Decore', 'Decore', 1, 1, '2017-10-01 09:26:03', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'decore'),
(55, 'Orient', 'Orient', 1, 1, '2017-10-05 11:35:06', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'orient'),
(57, 'UFESA', 'UFESA', 1, 1, '2017-10-16 17:06:09', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'ufesa'),
(58, 'Test Store', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'test-store'),
(59, 'Store 1', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'store-1'),
(60, 'Store 1', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'store-1'),
(61, 'Amira Store', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'amira-store'),
(62, 'Beso', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'beso'),
(63, '3ateeq', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, '3ateeq'),
(64, 'Olahub Shop', 'Olahub Shop', 0, 1, '2017-10-14 13:06:28', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'olahub-shop'),
(65, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(66, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(67, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(68, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(69, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(70, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(71, NULL, NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, ''),
(72, 'As', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'as'),
(73, 'Areeq', 'Areeq', 1, 1, '2017-10-19 03:52:27', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'areeq'),
(74, 'KazaShee', 'KazaShee', 1, 1, '2017-10-24 10:04:21', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'kazashee'),
(75, 'Joude designs', 'Joude designs', 1, 1, '2017-10-26 18:20:23', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'joude-designs'),
(76, 'SignatAmman', 'SignatAmman', 1, 1, '2017-11-06 13:11:22', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'signatamman'),
(77, 'kollshe', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'kollshe'),
(78, 'DecorationOne', 'DecorationOne', 1, 1, '2017-11-11 10:31:26', NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'decorationone'),
(79, 'Petite Patisserie & more', NULL, 0, 1, NULL, NULL, NULL, 0, '2018-01-22 04:55:07', 0, 'petite-patisserie-more'),
(80, 'Ghedo', NULL, 0, 0, NULL, NULL, '2017-12-04 17:07:55', 0, '2018-01-22 04:55:07', 0, 'ghedo'),
(81, 'Store10 test', 'Store10 test', 0, 0, '2017-12-05 21:21:22', NULL, '2017-12-05 21:12:06', 0, '2018-01-22 04:55:07', 0, 'store10-test'),
(82, 'test', NULL, 0, 0, NULL, NULL, '2017-12-09 10:03:33', 0, '2017-12-09 10:03:33', 0, NULL),
(84, 'Ward Express', 'Ward Express', 1, 0, '2017-12-11 15:35:13', NULL, '2017-12-11 15:08:53', 0, '2018-01-22 04:55:07', 0, 'ward-express'),
(85, 'Occasions', 'Occasions', 1, 0, '2017-12-12 11:48:25', NULL, '2017-12-12 11:30:51', 0, '2018-01-22 04:55:07', 0, 'occasions'),
(86, 'testtoday', NULL, 0, 0, NULL, NULL, '2017-12-14 15:35:17', 0, '2017-12-14 15:35:17', 0, NULL),
(87, 'Concorde', 'Concorde', 1, 0, '2017-12-18 13:45:17', NULL, '2017-12-18 11:34:32', 0, '2018-01-22 04:55:07', 0, 'concorde'),
(88, 'Barakat', 'Barakat', 1, 0, '2017-12-24 20:44:59', NULL, '2017-12-24 19:29:58', 0, '2018-01-22 04:55:07', 0, 'barakat'),
(89, 'mohannadGroup', NULL, 0, 0, NULL, NULL, '2017-12-31 14:16:01', 0, '2018-01-22 04:55:07', 0, 'mohannadgroup'),
(90, 'testtest', NULL, 0, 0, NULL, NULL, '2018-01-09 13:26:52', 0, '2018-01-22 04:55:07', 0, 'testtest'),
(91, 'shrouqtest', NULL, 0, 0, NULL, NULL, '2018-01-09 14:17:35', 0, '2018-01-22 04:55:07', 0, 'shrouqtest'),
(92, 'Beso Store', NULL, 0, 0, NULL, NULL, '2018-01-09 14:28:49', 0, '2018-01-22 04:55:07', 0, 'beso-store'),
(93, 'New Storeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', NULL, 0, 0, NULL, NULL, '2018-01-11 14:49:43', 0, '2018-01-22 04:55:07', 0, 'new-storeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee'),
(94, 'rasas', 'rasas', 1, 0, '2018-01-21 08:33:23', NULL, '2018-01-20 12:57:12', 0, '2018-01-22 04:55:07', 0, 'rasas'),
(98, 'Test from new API', NULL, 0, 0, NULL, NULL, '2018-01-24 12:45:31', 0, '2018-01-24 12:45:31', 0, NULL),
(100, 'Test froeeee Assssswwwww', NULL, 0, 0, NULL, NULL, '2018-01-24 15:00:30', 22541125, '2018-01-25 05:06:25', 75584, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
