-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2022 at 10:04 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrowers`
--

DROP TABLE IF EXISTS `tbl_borrowers`;
CREATE TABLE IF NOT EXISTS `tbl_borrowers` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `accountNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(10) NOT NULL,
  `birthDate` date NOT NULL,
  `profilePhoto` varchar(255) NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `userCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `membership` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrowers`
--

INSERT INTO `tbl_borrowers` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `username`, `password`, `membership`) VALUES
(13, '2018-0001', 'Fe Sharon', 'Test', 'Tubal', 'Capalaran, Tangub City', 33, '1989-07-12', '8870avatar2.png', '+639123456789', '2022-07-24 23:45:59', 'fesharon@email.com', 'fesharon', '098f6bcd4621d373cade4e832627b4f6', '1'),
(16, '2018-0002', 'Wilson', 'C', 'Nabua', 'Addr, Mis. Occ', 38, '1983-10-20', '16586302803828sampe_profile.jpg', '+639123456789', '2022-07-25 01:02:38', 'wilson@email.com', 'wilson', '098f6bcd4621d373cade4e832627b4f6', '1'),
(17, '2018-0003', 'Janbert', 'Recimulo', 'Gabica', 'Addr, Mis. Occc', 0, '2022-07-28', '4081profile-janbert.jpg', '+639300344555', '2022-07-29 15:26:37', 'janbert.gabica@nmsc.edu.ph', 'janbert', '098f6bcd4621d373cade4e832627b4f6', '1'),
(18, '2018-0004', 'Florante', 'R', 'Requina', 'Addr, Mis. Occ', 41, '1980-12-15', '1659357360IMG_0349.JPG', '+639987654321', '2022-08-01 14:12:36', 'florante@email.com', 'florante', '098f6bcd4621d373cade4e832627b4f6', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comakers`
--

DROP TABLE IF EXISTS `tbl_comakers`;
CREATE TABLE IF NOT EXISTS `tbl_comakers` (
  `comaker_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  PRIMARY KEY (`comaker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comakers`
--

INSERT INTO `tbl_comakers` (`comaker_id`, `user_id`, `firstName`, `lastName`) VALUES
(9, 16, 'Wilson', 'Nabua'),
(8, 13, 'Fe Sharon', 'Tubal'),
(7, 17, 'Janbert', 'Gabica');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monthlypayment`
--

DROP TABLE IF EXISTS `tbl_monthlypayment`;
CREATE TABLE IF NOT EXISTS `tbl_monthlypayment` (
  `monthly_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(100) NOT NULL,
  `monthly_date` date NOT NULL,
  `monthly_amount` int(50) NOT NULL,
  PRIMARY KEY (`monthly_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

DROP TABLE IF EXISTS `tbl_payments`;
CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` int(100) NOT NULL,
  `receipt_no` int(100) DEFAULT NULL,
  `payee` varchar(255) DEFAULT NULL,
  `penalty` float NOT NULL DEFAULT 0,
  `payment_amount` float DEFAULT NULL,
  `payment_balance` float NOT NULL,
  `payment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `ref_no`, `receipt_no`, `payee`, `penalty`, `payment_amount`, `payment_balance`, `payment_date`) VALUES
(48, 1659276478, 123456, 'Fe Sharon Tubal', 0, 3000, 8200, '2022-07-31 14:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_no` int(50) NOT NULL,
  `processor_id` int(50) NOT NULL DEFAULT 0,
  `status_comaker` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 2 = denied',
  `comaker_dateprocess` date DEFAULT NULL,
  `status_processor` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved',
  `processor_dateprocess` date DEFAULT NULL,
  `status_manager` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 3 = denied',
  `manager_dateprocess` date DEFAULT NULL,
  `status_cashier` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 2 = released, 3 = denied',
  `cashier_dateprocess` date DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `ref_no`, `processor_id`, `status_comaker`, `comaker_dateprocess`, `status_processor`, `processor_dateprocess`, `status_manager`, `manager_dateprocess`, `status_cashier`, `cashier_dateprocess`) VALUES
(53, 1659276478, 10, 1, '2022-07-31', 1, '2022-07-31', 1, '2022-07-31', 2, '2022-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_no` int(50) NOT NULL,
  `borrower_id` int(10) NOT NULL,
  `comaker_id` int(5) DEFAULT NULL,
  `status_ref` int(50) NOT NULL,
  `amount` float NOT NULL,
  `loan_term` int(10) NOT NULL,
  `interest` float NOT NULL,
  `total_interest` float NOT NULL,
  `monthly` float NOT NULL,
  `principal` float NOT NULL,
  `balance` float NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `loan_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `ref_no`, `borrower_id`, `comaker_id`, `status_ref`, `amount`, `loan_term`, `interest`, `total_interest`, `monthly`, `principal`, `balance`, `loan_type`, `purpose`, `loan_date`) VALUES
(107, 1659276478, 13, 13, 1659276478, 10000, 12, 100, 1200, 933.333, 833.333, 11200, 'Loan', 'Insurance', '2022-07-31 22:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `accountNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(10) NOT NULL,
  `birthDate` date NOT NULL,
  `profilePhoto` varchar(255) NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `userCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `password`, `role_name`) VALUES
(6, '2018-0123', 'Test', 'Test', 'Test', 'Test', 22, '1999-10-11', 'th.jpg', '+639300344555', '2022-06-24 15:37:51', 'test@email.com', '098f6bcd4621d373cade4e832627b4f6', 'Account Testing'),
(7, '2018-0560', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-11', 'sampe_profile.jpg', '+639300344555', '2022-06-25 11:58:49', 'janbert.gabica@nmsc.edu.ph', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(8, '2018-0450', 'Nico', 'Fuentes', 'Sambiog', 'Banadero, Ozamis City', 22, '2000-06-15', 'Sambiog Fuentes Nico.jpg', '+639987654321', '2022-07-03 16:59:36', 'manager@email.com', '1d0258c2440a8d19e716292b231e3190', 'Manager'),
(9, '2018-0352', 'Gann Deryl', 'Canino', 'Balili', 'Molicay, Ozamis City', 23, '2000-05-15', '3088IMG_0699.JPG', '+631235464848', '2022-07-03 17:55:47', 'cashier@email.com', '6ac2470ed8ccf204fd5ff89b32a355cf', 'Cashier'),
(10, '2018-0143', 'Geque', 'Lapar', 'Aguaviva', 'Maquilao, Tangub City', 22, '1999-12-25', '7135jeke lingi janbert.png', '+631254978985', '2022-07-03 18:07:36', 'processor@email.com', '649ce0650379a0aaff63c1ce257350de', 'Processor'),
(13, '2018-0123', 'Popol', 'And', 'Kupa', 'Addr, Mis. Occc', 12, '1999-11-10', '2253user7-128x128.jpg', '+639456161988', '2022-07-18 20:28:47', 'processor2@email.com', '649ce0650379a0aaff63c1ce257350de', 'Processor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
