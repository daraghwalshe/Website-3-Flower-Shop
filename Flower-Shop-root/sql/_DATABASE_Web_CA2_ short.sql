-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 05:06 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectX`
--
CREATE DATABASE IF NOT EXISTS `projectX` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projectX`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `session_id` varchar(32) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `quantity` int(8) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`session_id`, `product_id`, `price`, `quantity`) VALUES
('38gopq49omct4e814tm28re5c2', 'b002', '5.00', 1),
('38gopq49omct4e814tm28re5c2', 'b006', '2.25', 2),
('38gopq49omct4e814tm28re5c2', 'b008', '1.85', 2),
('38gopq49omct4e814tm28re5c2', 'b009', '4.60', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` varchar(17) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `delivery` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `address`, `delivery`) VALUES
('ORD_535eabb6de5e8', 'mr', 'yy', '12 rose lane', 'none'),
('ORD_535eb57c47643', 'mr', 'blue', '11 Willow av. Dub13', '11 The Mews Sandymou');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `colour` varchar(30) DEFAULT NULL,
  `blooming` varchar(30) DEFAULT NULL,
  `height` int(8) DEFAULT NULL,
  `soil` varchar(30) DEFAULT NULL,
  `hardiness` varchar(30) DEFAULT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `colour`, `blooming`, `height`, `soil`, `hardiness`, `price`, `image`) VALUES
('b001', 'Dahalia Rosamunde', 'Pink', 'Mid. Feb', 90, 'Light clay', 'Half hardy', '8.75', 'dahalia_rosamunde.jpg'),
('b002', 'Begonia Crispa', 'Red, White', 'Feb to April', 30, 'Fertile well drained', 'Tender', '5.00', 'begonia_crispa.jpg'),
('b003', 'Bessera Elegans', 'Red', 'August to Sept.', 60, 'Humus rich', 'Half hardy', '3.50', 'bessera_elegans.jpg'),
('b004', 'Cyclamen Coum', 'Pink', 'March to April', 8, 'Moderately fertile', 'Hardy', '6.50', 'cyclamen_coum.jpg'),
('b005', 'Dahlia Swanlake', 'Cream-White', 'July to Oct.', 90, 'Humus rich', 'Tender', '4.45', 'dahlia_swanlake.jpg'),
('b006', 'Eranthis Hyemalis', 'Yellow', 'Feb to March', 10, 'Alkaline', 'Delicate', '2.25', 'eranthis_hyemalis.jpg'),
('b007', 'Crocosmia Lucifer', 'Red', 'July to Sept', 60, 'Fertile humus rich', 'very hardy', '3.25', 'crocosmia_lucifer.jpg'),
('b008', 'Freesia mixture', 'Varied', 'July to august', 20, 'Any soil type', 'Not hardy', '1.85', 'freesia_mixture.jpg'),
('b009', 'Babiana Purple Star', 'Purple', 'May to July', 20, 'Neutral', 'Tender-indoor', '4.60', 'babiana_purple_star.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_ordered`
--

CREATE TABLE IF NOT EXISTS `products_ordered` (
  `order_no` int(12) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(17) DEFAULT NULL,
  `session_id` varchar(32) NOT NULL,
  `prod_id` varchar(20) DEFAULT NULL,
  `item_price` decimal(9,2) DEFAULT NULL,
  `quantity` int(8) DEFAULT NULL,
  PRIMARY KEY (`order_no`),
  UNIQUE KEY `order_no` (`order_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `products_ordered`
--

INSERT INTO `products_ordered` (`order_no`, `order_id`, `session_id`, `prod_id`, `item_price`, `quantity`) VALUES
(1, 'ORD_535eabb6de5e8', '38gopq49omct4e814tm28re5c2', 'b002', '5.00', 2),
(2, 'ORD_535eabb6de5e8', '38gopq49omct4e814tm28re5c2', 'b004', '6.50', 1),
(3, 'ORD_535eabb6de5e8', '38gopq49omct4e814tm28re5c2', 'b005', '4.45', 1),
(4, 'ORD_535eabb6de5e8', '38gopq49omct4e814tm28re5c2', 'b008', '1.85', 1),
(5, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b002', '5.00', 26),
(6, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b004', '6.50', 28),
(7, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b005', '4.45', 23),
(8, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b006', '2.25', 31),
(9, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b007', '3.25', 29),
(10, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b008', '1.85', 24),
(11, 'ORD_535eb57c47643', '38gopq49omct4e814tm28re5c2', 'b009', '4.60', 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('aaaa', '8f60c8102d29fcd525162d02eed4566b'),
('daragh', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
('flakey', '9815281f9d1287b5ee54325388b4cb82'),
('mike', 'dde2c7ad63ad86d6a18de781205d194f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
