-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2022 at 06:09 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nmsc-lms-main`
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
  `userCreated` datetime DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `membership` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monthlynotif`
--

DROP TABLE IF EXISTS `tbl_monthlynotif`;
CREATE TABLE IF NOT EXISTS `tbl_monthlynotif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_ref` int(11) NOT NULL,
  `month_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

DROP TABLE IF EXISTS `tbl_payments`;
CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` int(100) NOT NULL,
  `receipt_no` varchar(100) DEFAULT NULL,
  `payee` varchar(255) DEFAULT NULL,
  `penalty` float NOT NULL DEFAULT 0,
  `payment_amount` float DEFAULT NULL,
  `payment_balance` float NOT NULL,
  `payment_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smslogs`
--

DROP TABLE IF EXISTS `tbl_smslogs`;
CREATE TABLE IF NOT EXISTS `tbl_smslogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tmp_registration`
--

DROP TABLE IF EXISTS `tbl_tmp_registration`;
CREATE TABLE IF NOT EXISTS `tbl_tmp_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) DEFAULT NULL,
  `borrower_id` int(10) DEFAULT NULL,
  `accountNumber` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `contactNumber` varchar(50) DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `profilePhoto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `data_inserted` varchar(255) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `accountNumber` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
