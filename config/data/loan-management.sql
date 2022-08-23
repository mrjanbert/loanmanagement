-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2022 at 04:12 PM
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
  `profilePhoto` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `userCreated` datetime DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `membership` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrowers`
--

INSERT INTO `tbl_borrowers` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `username`, `password`, `membership`) VALUES
(13, '2018-0001', 'Fe Sharon', '', 'Tubal', 'Capalaran, Tangub City', 33, '1989-07-12', '08122022052823_avatar88.png', '09123456777', '2022-07-24 23:45:59', 'feharon.tubal@nmsc.edu.ph', 'fesharon', '098f6bcd4621d373cade4e832627b4f6', '1'),
(16, '2018-0002', 'Wilson', 'C', 'Nabua', 'Labuyo, Tangub City', 36, '1985-10-20', '08102022104145_avatar4.png', '09123456711', '2022-07-25 01:02:38', 'wilson@email.com', 'wilson', '098f6bcd4621d373cade4e832627b4f6', '1'),
(17, '2018-0003', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-24', '08102022104118_user2-160x160.jpg', '09321654987', '2022-07-29 15:26:37', 'janbert.gabica@nmsc.edu.ph', 'janbert', '098f6bcd4621d373cade4e832627b4f6', '0'),
(27, '2018-0005', 'Marilou', 'M', 'Abatayo', 'Addr, Mis. Occ', 19, '2002-12-25', '08142022092214_user5-128x128.jpg', '09300344552', '2022-08-07 14:47:26', 'marilou@email.com', 'marilou', '098f6bcd4621d373cade4e832627b4f6', '1'),
(28, '2018-0006', 'Johnny Mark', '', 'Bolante', 'Addr, Mis. Occ', 24, '1998-02-01', NULL, '09300344111', '2022-08-07 14:50:44', 'johnnymark@gmail.com', 'johnny', '098f6bcd4621d373cade4e832627b4f6', '1'),
(30, '2018-0007', 'Bien', '', 'Saludo', 'Addr, Mis. Occ', 21, '2000-10-18', NULL, '09300344555', '2022-08-07 19:57:30', 'bien@email.com', 'bien', '098f6bcd4621d373cade4e832627b4f6', '1'),
(36, '2018-0128', 'Gann', 'Deryl', 'Balili', 'Molicay, Ozamis City', 22, '2000-05-15', NULL, '09322123456', '2022-08-18 14:20:59', 'gann@nmsc.edu.ph', 'gann', '098f6bcd4621d373cade4e832627b4f6', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comakers`
--

INSERT INTO `tbl_comakers` (`comaker_id`, `user_id`, `firstName`, `lastName`) VALUES
(10, 18, 'Florante', 'Requina'),
(9, 16, 'Wilson', 'Nabua'),
(22, 13, 'Fe Sharon', 'Tubal'),
(21, 30, 'Bien', 'Saludo'),
(15, 27, 'Marilou', 'Abatayo'),
(16, 28, 'Johnny Mark', 'Bolante');

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
-- Table structure for table `tbl_notifications`
--

DROP TABLE IF EXISTS `tbl_notifications`;
CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `ref_no` int(50) NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_posted` datetime NOT NULL,
  PRIMARY KEY (`sms_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`sms_id`, `user_id`, `ref_no`, `contactNumber`, `message`, `date_posted`) VALUES
(1, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 22:51:22'),
(2, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 22:51:23'),
(3, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 22:51:24'),
(4, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 22:52:03'),
(5, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 22:56:51'),
(6, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 23:05:30'),
(7, 12, 123456, '09300344555', 'Test Notification', '2022-08-08 23:05:48'),
(8, 13, 12213456, '09300344555', 'Test Notification', '2022-08-08 23:22:51'),
(9, 13, 12213456, '09300344555', 'Test Notification', '2022-08-08 23:25:06'),
(10, 13, 12213456, '09300344555', 'Test Notification', '2022-08-08 23:27:00'),
(11, 12, 123456, '09123456789', '', '2022-08-17 02:29:37'),
(12, 12, 123456, '09123456789', '', '2022-08-17 02:29:37'),
(13, 12, 123456, '09123456789', '', '2022-08-17 02:29:37'),
(14, 12, 123456, '09123456789', '', '2022-08-17 02:29:37'),
(15, 12, 123456, '09123456789', '', '2022-08-17 02:29:37'),
(16, 12, 123456, '09123456789', 'bruh', '2022-08-17 02:30:10'),
(17, 12, 123456, '09123456789', 'bruh', '2022-08-17 02:30:10'),
(18, 12, 123456, '09123456789', 'bruh', '2022-08-17 02:30:10'),
(19, 12, 123456, '09123456789', 'bruh', '2022-08-17 02:30:10'),
(20, 12, 123456, '09123456789', 'bruh', '2022-08-17 02:30:10'),
(21, 12, 123456, '09123456789', 'data inserted', '2022-08-17 02:36:18'),
(22, 12, 123456, '09123456789', 'data inserted', '2022-08-17 02:36:18'),
(23, 13, 1660468652, '09123456789', 'data inserted', '2022-08-17 02:40:17'),
(24, 13, 1660468652, '09123456789', 'data inserted', '2022-08-17 02:40:17');

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
  `payment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `ref_no`, `receipt_no`, `payee`, `penalty`, `payment_amount`, `payment_balance`, `payment_date`) VALUES
(59, 1660468652, '000001', 'Fe Sharon Tubal', 0, 1716, 3434, '2022-08-14 09:43:29'),
(60, 1660468652, NULL, NULL, 30, NULL, 3464, '2022-08-04 00:00:00'),
(61, 1660468652, '000002', 'Fe Sharon Tubal', 0, 1716, 1748, '2022-08-16 18:36:18'),
(62, 1660468652, '000003', 'Fe Sharon Tubal', 0, 300, 1448, '2022-08-16 18:40:16'),
(63, 1660468592, '000007', 'Fe Sharon Tubal', 0, 1000, 2150, '2022-08-17 12:51:24');

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
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `ref_no`, `processor_id`, `status_comaker`, `comaker_dateprocess`, `status_processor`, `processor_dateprocess`, `status_manager`, `manager_dateprocess`, `status_cashier`, `cashier_dateprocess`) VALUES
(66, 1660834420, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(65, 1660468843, 10, 1, '2022-08-14', 1, '2022-08-14', 1, '2022-08-14', 0, NULL),
(64, 1660468742, 10, 1, '2022-08-14', 1, '2022-08-14', 1, '2022-08-14', 0, NULL),
(63, 1660468652, 10, 1, '2022-08-14', 1, '2022-08-14', 1, '2022-08-14', 2, '2022-08-14'),
(62, 1660468592, 10, 1, '2022-08-14', 1, '2022-08-14', 1, '2022-08-14', 2, '2022-08-17');

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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `ref_no`, `borrower_id`, `comaker_id`, `status_ref`, `amount`, `loan_term`, `interest`, `total_interest`, `monthly`, `principal`, `balance`, `loan_type`, `purpose`, `loan_date`) VALUES
(116, 1660468592, 13, 13, 1660468592, 3000, 5, 30, 150, 630, 600, 3150, 'Perssonal Loan', 'Allowance', '2022-08-14 17:16:32'),
(117, 1660468652, 16, 28, 1660468652, 5000, 3, 50, 150, 1716.67, 1666.67, 5150, 'Mortgage', 'Mortgages', '2022-08-14 17:17:32'),
(118, 1660468742, 28, 28, 1660468742, 4000, 2, 40, 80, 2040, 2000, 4080, 'Personal Loan', 'Emergencies', '2022-08-14 17:19:02'),
(119, 1660468843, 27, 16, 1660468843, 12000, 10, 120, 1200, 1320, 1200, 13200, 'Personal Loan', 'Allowance', '2022-08-14 17:20:43'),
(120, 1660834420, 17, 13, 1660834420, 15000, 12, 150, 1800, 1400, 1250, 16800, 'Personal Loan', 'Secret', '2022-08-18 22:53:40');

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
  `profilePhoto` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `userCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `accountNumber`, `username`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `password`, `role_name`) VALUES
(6, '2018-0123', 'test', 'Test', 'Test', 'Test', 'Tangub City', 22, '1999-10-11', NULL, '+639300344555', '2022-06-24 15:37:51', 'test@email.com', '098f6bcd4621d373cade4e832627b4f6', ''),
(7, '2018-0560', 'admin', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub Cityy', 22, '1999-10-11', '08112022042119_profile-janbert.jpg', '09300344555', '2022-06-25 11:58:49', 'janbert.gabica@nmsc.edu.ph', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(8, '2018-0450', 'manager', 'Nico', 'Fuentes', 'Sambiog', 'Banadero, Ozamis City', 22, '2000-06-11', '08102022102343_IMG_0349.JPG', '09987654321', '2022-07-03 16:59:36', 'manager@email.com', '1d0258c2440a8d19e716292b231e3190', 'Manager'),
(9, '2018-0352', 'cashier', 'Gann Deryl', 'Canino', 'Balili', 'Molicay, Ozamis City', 22, '2000-05-15', '08102022103517_avatar3.png', '09123546484', '2022-07-03 17:55:47', 'cashier@nmsc.edu.ph', '6ac2470ed8ccf204fd5ff89b32a355cf', 'Cashier'),
(10, '2018-0143', 'processor', 'Geque', 'Lapar', 'Aguaviva', 'Maquilao, Tangub City', 22, '1999-12-25', '08102022103318_IMG_3076.JPG', '09125497898', '2022-07-03 18:07:36', 'processor@email.com', '649ce0650379a0aaff63c1ce257350de', 'Processor'),
(13, '2018-0153', 'processor2', 'Lovely Pearl', 'Dompales', 'Estrosas', 'Labuyo, Tangub City', 22, '1999-11-10', '08102022013552_user7-128x128.jpg', '09456161988', '2022-07-18 20:28:47', 'processor2@email.com', '649ce0650379a0aaff63c1ce257350de', 'Processor'),
(14, '2018-0789', 'billsamar', 'Bill Lawrence', 'S', 'Samar', 'Addr, Mis. Occ', 32, '1989-12-25', '08102022011136_user1-128x128.jpg', '09876543210', '2022-08-02 09:47:32', 'processor3@email.com', '649ce0650379a0aaff63c1ce257350de', 'Processor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
