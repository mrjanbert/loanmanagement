-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2022 at 11:48 AM
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
-- Table structure for table `comakers`
--

DROP TABLE IF EXISTS `comakers`;
CREATE TABLE IF NOT EXISTS `comakers` (
  `comaker_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  PRIMARY KEY (`comaker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comakers`
--

INSERT INTO `comakers` (`comaker_id`, `firstName`, `lastName`) VALUES
(1, 'Erlinda', 'Pantallao'),
(2, 'Joel', 'Dagot'),
(3, 'Fe', 'Maaba'),
(4, 'Edison', 'Clamonte'),
(5, 'Jennelyn', 'Abdulsamad'),
(6, 'Dionalyn', 'Gumacial'),
(7, 'Vinus', 'Mansueto'),
(8, 'Genevive', 'Dagot'),
(9, 'Vhenlea Jay', 'Jumamil'),
(10, 'Milben', 'Jumamil'),
(11, 'Richly', 'Tagbacaula'),
(12, 'Fe Sharon', 'Tubal'),
(13, 'Wilson', 'Nabua'),
(14, 'Florante', 'Requina'),
(15, 'Marilou', 'Abatayo'),
(16, 'Jonny Mark', 'Bolante'),
(17, 'Bien', 'Saludo'),
(18, 'Charlie', 'Miparanum'),
(19, 'Lito', 'Nueva'),
(20, 'Jorge', 'Basilisco'),
(21, 'Ruth', 'Juanillo');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plans`
--

DROP TABLE IF EXISTS `loan_plans`;
CREATE TABLE IF NOT EXISTS `loan_plans` (
  `plan_id` int(10) NOT NULL AUTO_INCREMENT,
  `plan_term` int(10) NOT NULL,
  `interest_percentage` int(10) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL COMMENT 'Monthly or 15th/30th',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_plans`
--

INSERT INTO `loan_plans` (`plan_id`, `plan_term`, `interest_percentage`, `mode_of_payment`) VALUES
(1, 6, 0, 'Monthly'),
(2, 3, 0, '15th/30th'),
(3, 0, 0, 'Monthly'),
(4, 0, 0, '15th/30th');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

DROP TABLE IF EXISTS `loan_types`;
CREATE TABLE IF NOT EXISTS `loan_types` (
  `loantype_id` int(11) NOT NULL AUTO_INCREMENT,
  `typeofLoan` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`loantype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`loantype_id`, `typeofLoan`, `description`) VALUES
(1, 'Small business', 'starting business'),
(2, 'Insurance', 'Insurance Loan'),
(7, 'Loan Test', 'testing add loan type');

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

DROP TABLE IF EXISTS `module_permission`;
CREATE TABLE IF NOT EXISTS `module_permission` (
  `mod_id` int(2) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `mod_name` varchar(255) NOT NULL,
  `mod_create` tinyint(1) NOT NULL,
  `mod_read` tinyint(1) NOT NULL,
  `mod_update` tinyint(1) NOT NULL,
  `mod_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4;

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
  `password` varchar(255) NOT NULL,
  `membership` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrowers`
--

INSERT INTO `tbl_borrowers` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `password`, `membership`) VALUES
(8, '2018-0001', 'Fe Sharon', ' ', 'Tubal', 'Tangub City', 30, '2022-07-01', '8870avatar2.png', '+639123456789', '2022-07-10 21:38:18', 'fesharon@email.com', 'dGVzdA==', '1'),
(9, '2018-0002', 'Wilson', 'C', 'Nabua', 'Capalaran, Tangub City', 30, '2022-07-02', '6299avatar4.png', '+639123456987', '2022-07-10 21:39:56', 'wilson@email.com', 'dGVzdA==', '1'),
(10, '2018-0003', 'Florante', '', 'Requina', 'Tangub City', 30, '2022-07-03', '3693avatar.png', '+639123456789', '2022-07-10 21:41:07', 'florante@email.com', 'dGVzdA==', '1'),
(11, '2018-0004', 'Marilou', 'M', 'Abatayo', 'Tangub City', 30, '2022-07-04', '2206avatar3.png', '+639123456789', '2022-07-10 21:42:25', 'marilou@email.com', 'dGVzdA==', '1'),
(12, '2018-0005', 'Johnny Mark', '', 'Bolante', 'Tangub Cityy', 30, '2022-07-05', '5888profile.png', '+639123456789', '2022-07-13 12:14:07', 'johnnymark@email.com', 'dGVzdA==', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_charges`
--

DROP TABLE IF EXISTS `tbl_charges`;
CREATE TABLE IF NOT EXISTS `tbl_charges` (
  `charges_id` int(10) NOT NULL AUTO_INCREMENT,
  `charges_type` varchar(255) NOT NULL,
  `charge_percentage` float NOT NULL,
  PRIMARY KEY (`charges_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_charges`
--

INSERT INTO `tbl_charges` (`charges_id`, `charges_type`, `charge_percentage`) VALUES
(1, 'Service Charge', 1),
(2, 'Other Charges', 1),
(11, 'Notarial Fees', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comakers`
--

INSERT INTO `tbl_comakers` (`comaker_id`, `user_id`, `firstName`, `lastName`) VALUES
(1, 9, 'Wilson', 'Nabua'),
(2, 8, 'Fe Sharon', 'Tubal'),
(3, 11, 'Marilou', 'Abatayo'),
(4, 10, 'Florante', 'Requina');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

DROP TABLE IF EXISTS `tbl_payments`;
CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` int(100) NOT NULL,
  `receipt_no` int(100) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `penalty` float NOT NULL DEFAULT 0,
  `payment_amount` float NOT NULL,
  `payment_balance` float NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `ref_no`, `receipt_no`, `payee`, `penalty`, `payment_amount`, `payment_balance`, `payment_date`) VALUES
(3, 143625211, 1658370141, 'Fe Sharon Tubal', 0, 300, 2230, '2022-07-21 22:22:21'),
(4, 147229787, 13123141, 'Fe Sharon Tubal', 0, 360, 3000, '2022-07-23 11:45:35'),
(5, 147229787, 2312323, 'Fe Sharon Tubal', 0, 300, 3060, '2022-07-23 11:45:47'),
(6, 143625211, 21312323, 'Fe Sharon Tubal', 0, 200, 2330, '2022-07-23 11:58:02'),
(22, 148239874, 123, 'Fe Sharon Tubal', 0, 570, 3000, '2022-07-24 00:37:28'),
(23, 148239874, 12344, 'Fe Sharon Tubal', 0, 1000, 2000, '2022-07-24 00:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_no` int(50) NOT NULL,
  `processor_id` int(50) NOT NULL DEFAULT 0,
  `manager_id` int(50) NOT NULL DEFAULT 0,
  `cashier_id` int(50) NOT NULL DEFAULT 0,
  `status_comaker` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 2 = denied',
  `status_processor` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 3 = denied',
  `status_manager` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 3 = denied',
  `status_cashier` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 2 = released, 3 = denied',
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `ref_no`, `processor_id`, `manager_id`, `cashier_id`, `status_comaker`, `status_processor`, `status_manager`, `status_cashier`) VALUES
(35, 145074231, 0, 0, 0, 2, 0, 0, 0),
(34, 146993126, 0, 0, 0, 0, 0, 0, 0),
(33, 146592935, 0, 0, 0, 1, 1, 1, 0),
(32, 142251438, 0, 0, 0, 0, 0, 0, 0),
(31, 144158979, 0, 0, 0, 0, 0, 0, 0),
(30, 148200369, 0, 0, 0, 0, 0, 0, 0),
(29, 143625211, 0, 0, 0, 1, 1, 1, 2),
(28, 147229787, 0, 0, 0, 1, 1, 1, 2),
(36, 147708791, 0, 0, 0, 0, 0, 0, 0),
(37, 145400459, 0, 0, 0, 1, 1, 1, 1),
(38, 146469664, 0, 0, 0, 2, 0, 0, 0),
(39, 148239874, 0, 0, 0, 1, 1, 1, 1),
(40, 1658333152, 0, 0, 0, 1, 1, 1, 0),
(41, 1658333168, 0, 0, 0, 1, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `ref_no`, `borrower_id`, `comaker_id`, `status_ref`, `amount`, `loan_term`, `interest`, `total_interest`, `monthly`, `principal`, `balance`, `loan_type`, `purpose`, `loan_date`) VALUES
(81, 147229787, 8, 8, 147229787, 3000, 12, 30, 360, 280, 250, 3360, 'Personal Loan', 'Testing', '2022-07-16 00:07:55'),
(82, 143625211, 8, 8, 143625211, 2300, 10, 23, 230, 253, 230, 2530, 'Personal Loan', 'Allowance', '2022-07-16 18:58:12'),
(86, 146592935, 9, 8, 146592935, 5000, 12, 50, 600, 466.667, 416.667, 5600, 'Personal Loan', 'Insurance', '2022-07-16 19:30:01'),
(87, 146993126, 9, 9, 146993126, 12000, 10, 120, 1200, 1320, 1200, 13200, 'Loan', 'Testing', '2022-07-16 19:31:19'),
(88, 145074231, 12, 8, 145074231, 10000, 9, 100, 900, 1211.11, 1111.11, 10900, 'Personal Loan', 'Testing', '2022-07-16 19:38:33'),
(90, 145400459, 12, 11, 145400459, 23000, 12, 230, 2760, 2146.67, 1916.67, 25760, 'Personal Loan', 'Testing', '2022-07-18 22:19:47'),
(91, 146469664, 12, 11, 146469664, 230000, 12, 2300, 27600, 21466.7, 19166.7, 257600, 'Testing loan', 'Testing', '2022-07-18 22:20:19'),
(93, 148239874, 12, 9, 148239874, 3500, 2, 35, 70, 1785, 1750, 3570, 'Personal Loan', 'Insurance', '2022-07-19 01:00:57'),
(94, 1658333152, 10, 10, 1658333152, 2000, 3, 20, 60, 686.667, 666.667, 2060, 'Loan', 'Testing', '2022-07-21 00:05:52'),
(95, 1658333168, 10, 9, 1658333168, 12121, 424, 121.21, 51393, 149.797, 28.5873, 63514, 'Loan', 'Testing', '2022-07-21 00:06:08');

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
(6, '2018-0123', 'Test', 'Test', 'Test', 'Test', 22, '1999-10-11', 'th.jpg', '+639300344555', '2022-06-24 15:37:51', 'test@email.com', 'dGVzdA==', 'Account Testing'),
(7, '2018-0560', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-11', 'sampe_profile.jpg', '+639300344555', '2022-06-25 11:58:49', 'janbert.gabica@nmsc.edu.ph', 'MjAxOC0wNTYw', 'Admin'),
(8, '2018-0450', 'Nico', 'Fuentes', 'Sambiog', 'Banadero, Ozamis City', 22, '2000-06-15', 'Sambiog Fuentes Nico.jpg', '+639987654321', '2022-07-03 16:59:36', 'manager@email.com', 'bWFuYWdlcg==', 'Manager'),
(9, '2018-0352', 'Gann Deryl', 'Canino', 'Balili', 'Molicay, Ozamis City', 23, '2000-05-15', '3088IMG_0699.JPG', '+631235464848', '2022-07-03 17:55:47', 'cashier@email.com', 'Y2FzaGllcg==', 'Cashier'),
(10, '2018-0143', 'Geque', 'Lapar', 'Aguaviva', 'Maquilao, Tangub City', 22, '1999-12-25', '7135jeke lingi janbert.png', '+631254978985', '2022-07-03 18:07:36', 'processor@email.com', 'cHJvY2Vzc29y', 'Processor'),
(13, '2018-0123', 'Popol', 'And', 'Kupa', 'Addr, Mis. Occc', 12, '1999-11-10', '2253user7-128x128.jpg', '+639456161988', '2022-07-18 20:28:47', 'processor2@email.com', 'cHJvY2Vzc29y', 'Processor');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
