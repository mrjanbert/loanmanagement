-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2022 at 01:26 PM
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
  `accountNumber` int(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `profilePhoto` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `membership` tinyint(1) NOT NULL COMMENT '0 = non-member, 1 = member',
  `userCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrowers`
--

INSERT INTO `tbl_borrowers` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `profilePhoto`, `birthDate`, `contactNumber`, `membership`, `userCreated`, `email`, `password`) VALUES
(1, 123303458, 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, 'profile.png', '1999-10-11', '+639300344555', 1, '2022-06-19 08:20:15', 'janbert.gabica@nmsc.edu.ph', 'MjAxOC0wNTYw'),
(3, 125240192, 'Test', 'test', 'Testing', 'Test', 22, 'profile-janbert.jpg', '1999-10-11', '+63123456789', 0, '2022-06-24 16:53:03', 'test@email.com', 'dGVzdA==');

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
  `user_id` varchar(255) NOT NULL,
  `ref_no` int(100) NOT NULL,
  PRIMARY KEY (`comaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `balance` float NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `ref_no`, `receipt_no`, `payee`, `penalty`, `payment_amount`, `balance`, `payment_date`) VALUES
(1, 145932163, 1696268281, 'Borrower', 0, 1000, 10200, '2022-07-08 14:48:45'),
(2, 145932163, 1673602460, 'Co-maker', 0, 1200, 10000, '2022-07-08 14:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_no` int(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `loan_term` int(10) NOT NULL,
  `interest` float NOT NULL,
  `total_interest` float NOT NULL,
  `monthly` float NOT NULL,
  `principal` float NOT NULL,
  `balance` float NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `comaker_id` int(5) NOT NULL DEFAULT 0,
  `membership` tinyint(1) NOT NULL COMMENT '0 = non-member, 1 = member',
  `loan_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status_manager` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 3 = denied',
  `status_processor` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 3 = denied',
  `status_cashier` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved, 2 = released, 3 = denied',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `ref_no`, `user_id`, `amount`, `loan_term`, `interest`, `total_interest`, `monthly`, `principal`, `balance`, `loan_type`, `purpose`, `comaker_id`, `membership`, `loan_date`, `status_manager`, `status_processor`, `status_cashier`) VALUES
(15, 145932163, 3, 10000, 12, 100, 1200, 933.333, 833.333, 11200, 'Loan', 'Testing', 0, 1, '2022-07-08 14:42:48', 1, 1, 2),
(16, 145294028, 1, 10000, 12, 100, 1200, 933.333, 833.333, 11200, 'Personal Loan', 'Testing', 0, 1, '2022-07-08 15:21:09', 0, 0, 0),
(17, 148213655, 1, 12000, 10, 120, 1200, 1320, 1200, 13200, 'Loan', 'Testing', 0, 1, '2022-07-08 15:23:27', 0, 0, 0),
(18, 147013336, 1, 20000, 12, 200, 2400, 1866.67, 1666.67, 22400, 'Loan', 'Testing', 0, 1, '2022-07-08 20:09:12', 0, 0, 0),
(19, 142306201, 1, 22000, 12, 220, 2640, 2053.33, 1833.33, 24640, 'Testing loan', 'Test', 0, 1, '2022-07-08 20:15:43', 0, 0, 0),
(20, 141735214, 3, 10003, 11, 100.03, 1100.33, 1009.39, 909.364, 11103.3, 'Loans', 'Insurance', 0, 0, '2022-07-08 20:16:40', 0, 0, 0),
(21, 147369339, 3, 15000, 10, 150, 1500, 1650, 1500, 16500, 'Loan', 'Pay Bills', 1, 0, '2022-07-08 20:18:10', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

DROP TABLE IF EXISTS `tbl_transactions`;
CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_no` int(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `loantype_id` int(10) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `transact_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `ref_no`, `user_id`, `plan_id`, `loantype_id`, `purpose`, `amount`, `transact_date`, `status`) VALUES
(1, 15895376, 0, 0, 0, '', 0, '2022-06-26 00:16:12', ''),
(2, 15885469, 0, 0, 0, '', 0, '2022-06-26 00:30:41', ''),
(3, 15697471, 3, 2, 7, 'Test', 313112000, '2022-06-26 00:34:18', 'Pending'),
(4, 15924724, 3, 1, 7, 'Testing', 100000, '2022-06-26 00:34:56', 'Pending'),
(5, 15712627, 3, 2, 7, 'utang', 20000, '2022-06-26 03:16:07', 'Pending');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `password`, `role_name`) VALUES
(6, '135327383', 'Test', 'Test', 'Test', 'Test', 22, '1999-10-11', 'th.jpg', '+639300344555', '2022-06-24 15:37:51', 'test@email.com', 'dGVzdA==', 'Account Testing'),
(7, '134218201', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-11', 'sampe_profile.jpg', '+639300344555', '2022-06-25 11:58:49', 'janbert.gabica@nmsc.edu.ph', 'MjAxOC0wNTYw', 'Admin'),
(8, '2018-0001', 'Nico', 'Fuentes', 'Sambiog', 'Banadero, Ozamis City', 22, '2000-06-15', 'Sambiog Fuentes Nico.jpg', '+639987654321', '2022-07-03 16:59:36', 'manager@email.com', 'bWFuYWdlcg==', 'Manager'),
(9, '2018-0002', 'Gann Deryl', 'Canino', 'Balili', 'Molicay, Ozamis City', 23, '2000-05-15', '3088IMG_0699.JPG', '+631235464848', '2022-07-03 17:55:47', 'cashier@email.com', 'Y2FzaGllcg==', 'Cashier'),
(10, '2018-0003', 'Geque', 'Lapar', 'Aguaviva', 'Maquilao, Tangub City', 22, '1999-12-25', '7135jeke lingi janbert.png', '+631254978985', '2022-07-03 18:07:36', 'processor@email.com', 'cHJvY2Vzc29y', 'Processor');

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
