-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2022 at 02:30 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paycol`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

DROP TABLE IF EXISTS `banner_images`;
CREATE TABLE IF NOT EXISTS `banner_images` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `merchant` int(250) NOT NULL,
  `heading` varchar(250) NOT NULL,
  `caption` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

DROP TABLE IF EXISTS `business_category`;
CREATE TABLE IF NOT EXISTS `business_category` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_reference` varchar(200) DEFAULT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `product_size` varchar(20) DEFAULT NULL,
  `order_id` varchar(10) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `sales_method` varchar(200) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `merchant` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `business_category` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_order`
--

DROP TABLE IF EXISTS `client_order`;
CREATE TABLE IF NOT EXISTS `client_order` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `reference_id` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `sales_method` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

DROP TABLE IF EXISTS `commission`;
CREATE TABLE IF NOT EXISTS `commission` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `commision_account` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

DROP TABLE IF EXISTS `completed`;
CREATE TABLE IF NOT EXISTS `completed` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `ip` varchar(1100) DEFAULT NULL,
  `order_id` varchar(1100) DEFAULT NULL,
  `firstname` varchar(1100) DEFAULT NULL,
  `lastname` varchar(1100) DEFAULT NULL,
  `email` varchar(1100) DEFAULT NULL,
  `phone` varchar(1100) DEFAULT NULL,
  `address` varchar(1100) DEFAULT NULL,
  `city` varchar(1100) DEFAULT NULL,
  `state` varchar(1100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `amount` varchar(1100) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `merchant` varchar(100) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `shipping_fee` varchar(250) DEFAULT NULL,
  `commission` int(250) DEFAULT NULL,
  `txref` varchar(100) DEFAULT NULL,
  `balance_confirmed` varchar(50) DEFAULT NULL,
  `actual_amount` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE IF NOT EXISTS `counter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) NOT NULL,
  `days` varchar(100) NOT NULL,
  `fee` int(100) NOT NULL,
  `merchant` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
CREATE TABLE IF NOT EXISTS `fees` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `percentage` varchar(100) NOT NULL,
  `additional` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flutter_bank_list`
--

DROP TABLE IF EXISTS `flutter_bank_list`;
CREATE TABLE IF NOT EXISTS `flutter_bank_list` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `bank_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `free_transactions`
--

DROP TABLE IF EXISTS `free_transactions`;
CREATE TABLE IF NOT EXISTS `free_transactions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `local_govt`
--

DROP TABLE IF EXISTS `local_govt`;
CREATE TABLE IF NOT EXISTS `local_govt` (
  `local_govt` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
CREATE TABLE IF NOT EXISTS `merchant` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verified` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `address` blob,
  `phone` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `balance` int(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_code` int(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `referral` varchar(50) DEFAULT NULL,
  `refer_by` varchar(50) DEFAULT NULL,
  `log_count` int(250) DEFAULT NULL,
  `business_category` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(500) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

DROP TABLE IF EXISTS `payouts`;
CREATE TABLE IF NOT EXISTS `payouts` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `merchant` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  `reference` varchar(250) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `amount` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `category` int(59) NOT NULL,
  `price` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `merchant` int(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `image_no` int(50) DEFAULT NULL,
  `size_needed` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `order_date` varchar(50) DEFAULT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `item_bought` varchar(200) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `order_id` varchar(200) DEFAULT NULL,
  `product_id` int(250) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved_colors`
--

DROP TABLE IF EXISTS `saved_colors`;
CREATE TABLE IF NOT EXISTS `saved_colors` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `merchant` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved_sizes`
--

DROP TABLE IF EXISTS `saved_sizes`;
CREATE TABLE IF NOT EXISTS `saved_sizes` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `merchant` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `size_tab`
--

DROP TABLE IF EXISTS `size_tab`;
CREATE TABLE IF NOT EXISTS `size_tab` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(20) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
