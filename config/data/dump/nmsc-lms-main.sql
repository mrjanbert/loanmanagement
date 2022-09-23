-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2022 at 03:27 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrowers`
--

INSERT INTO `tbl_borrowers` (`user_id`, `accountNumber`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `username`, `password`, `membership`) VALUES
(22, '2018-0560', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-11', '09042022085849_sampe_profile.jpg', '09300344555', '2022-09-03 10:23:15', 'janbert.gabica@nmsc.edu.ph', 'janbert', '$2y$10$WNa11EN8udXLV2B28VE2AOVoDrfv8a.5WsQyvePOxJCNBv7eC3puS', '1'),
(23, '2018-450', 'Serge', 'Secret', 'Estanero', 'Mahayag, Zamboanga Del Sur', 23, '1999-08-12', '', '09122522870', '2022-09-03 11:29:01', 'serge.estanero@nmsc.edu.ph', 'serge', '$2y$10$Xczr4BkPpiyZfSZFvsaRFOWPDGxF4TND0snbAUkj5uihq7z0cyG5G', '0'),
(24, '2018-0144', 'Geque', 'Lapar', 'Aguaviva', 'Maquilao, Tangub City', 22, '1999-12-25', '', '09461979424', '2022-09-03 13:16:47', 'geque.aguaviva@nmsc.edu.ph', 'geque', '$2y$10$/23U9ID92ltiDpwrmaMVre/szr//ESzSqjMyVo9tDc3AiiF6f5hG.', '0'),
(25, '0001', 'Test', 'Test', 'Test', 'Test', 22, '1999-10-11', '', '09120001234', '2022-09-03 15:20:37', 'test@nmsc.edu.ph', 'test', '$2y$10$ID2TYFG0KX5cQX2bL08NCu8Lsq5s1mfSlZSaJlrqlVBImQt9cLJOW', '0'),
(26, '2018-6540', 'Charleston Clyde', '', 'Villaruz', 'Bagumbang, Tangub City', 22, '1999-10-11', '', '09123445561', '2022-09-04 04:48:20', 'charlestonclyde.villaruz@nmsc.edu.ph', 'clyde', '$2y$10$9MXf.4oYB/ctgrJYnUzPPOSye7TgJ/fqLZd0y6yXW7APMqI4Rqtcq', '1'),
(27, '0001123', 'Dhenmarc', '', 'Ginos', 'Lanao', 22, '1999-10-11', '', '09364464516', '2022-09-04 06:09:04', 'dhenmarc.ginos@nmsc.edu.ph', 'dhenmarc', '$2y$10$Zhx8nQeJN/WC05fvChyVqe6kEJonQz4GVTE/s/3Fb/LhF0MUKZ846', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comakers`
--

INSERT INTO `tbl_comakers` (`comaker_id`, `user_id`, `firstName`, `lastName`) VALUES
(11, 26, 'Charleston Clyde', 'Villaruz'),
(10, 22, 'Janbert', 'Gabica');

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
) ENGINE=MyISAM AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_monthlynotif`
--

INSERT INTO `tbl_monthlynotif` (`id`, `loan_ref`, `month_date`) VALUES
(239, 1663222530, '2022-11-14'),
(237, 1663222416, '2023-02-12'),
(236, 1663222416, '2023-01-13'),
(235, 1663222416, '2022-12-14'),
(234, 1663222416, '2022-11-14'),
(233, 1663222416, '2022-10-15'),
(238, 1663222530, '2022-10-15'),
(242, 1663222882, '2022-10-15'),
(243, 1663222882, '2022-11-14'),
(241, 1663222530, '2023-01-13'),
(240, 1663222530, '2022-12-14');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `ref_no`, `receipt_no`, `payee`, `penalty`, `payment_amount`, `payment_balance`, `payment_date`) VALUES
(16, 1663222080, '000001', 'Janbert Gabica', 0, 3030, 0, '2022-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smslogs`
--

DROP TABLE IF EXISTS `tbl_smslogs`;
CREATE TABLE IF NOT EXISTS `tbl_smslogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactNumber` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_smslogs`
--

INSERT INTO `tbl_smslogs` (`id`, `contactNumber`, `name`, `message`, `date`) VALUES
(31, '', '', '', '2022-09-15 14:21:39'),
(32, '09300344555', 'Janbert Gabica', 'Forda bayad nimu today 3,030.00 pesos with OR Number 000001. Current balance: 0.00.', '2022-09-15 21:16:41'),
(28, '', '', '', '2022-09-15 14:15:45'),
(29, '', '', '', '2022-09-15 14:16:50'),
(30, '09300344555', 'Janbert Gabica', 'FROM NMSCST LMS: \r\nSerge Estanero has new loan application and added you (Janbert Gabica) as a Co-Maker.\r\nPlease check your account now. (computer msg)', '2022-09-15 14:21:23'),
(27, '09123445561', 'Charleston Clyde Villaruz', 'FROM NMSCST LMS: \r\nSerge Estanero has new loan application and added you (Charleston Clyde Villaruz) as a Co-Maker.\r\nPlease check your account now. (computer msg)', '2022-09-15 14:15:32');

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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `ref_no`, `processor_id`, `status_comaker`, `comaker_dateprocess`, `status_processor`, `processor_dateprocess`, `status_manager`, `manager_dateprocess`, `status_cashier`, `cashier_dateprocess`) VALUES
(45, 1663222882, 18, 1, '2022-09-15', 1, '2022-09-15', 1, '2022-09-15', 2, '2022-09-15'),
(44, 1663222530, 18, 1, '2022-09-15', 1, '2022-09-15', 1, '2022-09-15', 2, '2022-09-15'),
(43, 1663222416, 18, 1, '2022-09-15', 1, '2022-09-15', 1, '2022-09-15', 2, '2022-09-15'),
(42, 1663222080, 18, 1, '2022-09-15', 1, '2022-09-15', 1, '2022-09-15', 2, '2022-09-15');

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
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_totalshares`
--

DROP TABLE IF EXISTS `tbl_totalshares`;
CREATE TABLE IF NOT EXISTS `tbl_totalshares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(5) DEFAULT NULL,
  `share_capital` float DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_totalshares`
--

INSERT INTO `tbl_totalshares` (`id`, `borrower_id`, `share_capital`, `date_modified`) VALUES
(7, 23, 0, '2022-09-15 14:22:41'),
(6, 22, 130, '2022-09-15 14:52:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `ref_no`, `borrower_id`, `comaker_id`, `status_ref`, `amount`, `loan_term`, `interest`, `total_interest`, `monthly`, `principal`, `balance`, `loan_type`, `purpose`, `loan_date`) VALUES
(42, 1663222080, 22, 22, 1663222080, 3000, 1, 30, 30, 3030, 3000, 3030, 'Salary Loan', 'test', '2022-09-15 14:08:00'),
(43, 1663222416, 22, 22, 1663222416, 10000, 5, 100, 500, 2100, 2000, 10500, 'Salary Loan', 'test', '2022-09-15 14:13:36'),
(44, 1663222530, 23, 26, 1663222530, 5000, 4, 50, 200, 1300, 1250, 5200, 'Emergency Loan', 'test', '2022-09-15 14:15:30'),
(45, 1663222882, 23, 22, 1663222882, 2000, 2, 20, 40, 1020, 1000, 2040, 'Salary Loan', 'test', '2022-09-15 14:21:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `accountNumber`, `username`, `firstName`, `middleName`, `lastName`, `address`, `age`, `birthDate`, `profilePhoto`, `contactNumber`, `userCreated`, `email`, `password`, `role_name`) VALUES
(17, '2018-0560', 'adminjanbert', 'Janbert', 'Recimulo', 'Gabica', 'Capalaran, Tangub City', 22, '1999-10-11', '09032022103407_janbert.JPG', '09300344555', '2022-09-02 18:26:23', 'janbert.gabica@nmsc.edu.ph', '$2y$10$RLamr5qtcJ1JwVpIM0l7NuBgqJKFNXd2adcKoJDFZ6XLFnQAyaDxi', 'Admin'),
(18, '2000-0001', 'processor', 'Lovely Pearl', 'Dompales', 'Estrosas', 'Labuyo, Tangub City', 22, '1999-10-11', '', '09123456789', '2022-09-03 15:19:01', 'lovelypearl.estrosas@nmsc.edu.ph', '$2y$10$BxzoY7.VgtfnEifuVm2GguR78sGi27xi0MTF9i6ODCTfeYZx1QaDa', 'Processor'),
(19, '2000-0002', 'manager', 'Ruth', '', 'Juanillo', 'Labuyo, Tangub City', 22, '1999-10-11', '', '09123001221', '2022-09-03 15:28:03', 'ruth.juanillo@nmsc.edu.ph', '$2y$10$nHdAnkRWPaTEk9A16KT7neHu053IIt5313nGvDxTOTLEELtvwfcwy', 'Manager'),
(20, '2000-0003', 'cashier', 'Marissa', '', 'Legaspi', 'Labuyo, Tangub City', 22, '1999-10-11', '', '09123210123', '2022-09-03 15:30:56', 'marissa.legaspi@nmsc.edu.ph', '$2y$10$pDB2Chscz4wuJrNGtZLHkuZ3kFM8f5iClJQobmqlLR0fhwo.e9/vy', 'Cashier'),
(21, '2000-0000', 'testing', 'Test', 'Test', 'Test', 'Test', 22, '1999-10-11', '', '09123654987', '2022-09-03 17:35:45', 'test@nmsc.edu.ph', '$2y$10$1/ECnnKpM1VzI1n2K19U1uNZZqCz4VtB1LYM9eBMYY2fvdy6By53e', 'Unknown User');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
