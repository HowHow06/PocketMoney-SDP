-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 03, 2021 at 04:21 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `email`) VALUES
(1, 'admin1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'howard_bb@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

DROP TABLE IF EXISTS `advisor`;
CREATE TABLE IF NOT EXISTS `advisor` (
  `advisorID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisorID`, `username`, `password`, `name`, `email`) VALUES
(1, 'advisor1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'Dacin Wong', 'advisor1@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `announcementID` int(255) NOT NULL AUTO_INCREMENT,
  `adminID` int(255) NOT NULL,
  `announcement_date` date NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`announcementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementID`, `adminID`, `announcement_date`, `title`, `content`) VALUES
(1, 1, '2020-12-31', 'Annual Report & CG Report - 2019', 'The 2019 Annual Report and Form 20-F are now available as PDF download. A printed copy of our 2019 Annual Report can be ordered free of charge.'),
(2, 1, '2021-01-14', 'Our promise to you', 'To us, security is about both protection and trust. The foundation of our offering is the commitment to sincerely do the right thing for your financial information, and that means keeping it secure and never taking advantage of it.'),
(3, 1, '2021-02-02', 'Why use PocketMoney?', 'PocketMoney innovative tech is designed to help you lead a healthy financial life. It helps you securely organize finances, monitor transactions and track money. It empowers you with data to take better financial decisions for yourself & for your family.'),
(4, 1, '2021-01-24', 'Scheduled Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. We are planning for some maintenance activities in our Data Centers on 27 January 2021 (10 a.m.  - 10 p.m.) . Once the maintenance activities are completed, all our services will resume to normal.'),
(5, 1, '2021-02-05', 'Emergency Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. An emergency maintenance would start for some maintenance activities in our Service Centers on 5 February 2021 (1 a.m.  - 3 a.m.). Apologies for inconvenience caused.');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
CREATE TABLE IF NOT EXISTS `budget` (
  `budgetID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `percentage` decimal(20,2) NOT NULL,
  PRIMARY KEY (`budgetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetID`, `cusID`, `categoryID`, `percentage`) VALUES
(36, 1, 6, '15.00'),
(37, 1, 5, '35.00'),
(38, 1, 9, '5.00'),
(39, 1, 8, '25.00'),
(40, 1, 7, '10.00'),
(41, 1, 12, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(255) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `preDefine` tinyint(1) NOT NULL,
  `cusID` int(255) DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryType`, `preDefine`, `cusID`) VALUES
(1, 'salary', 'income', 1, NULL),
(2, 'awards', 'income', 1, NULL),
(3, 'rental', 'income', 1, NULL),
(4, 'investment profit', 'income', 1, NULL),
(5, 'food', 'expenses', 1, NULL),
(6, 'home', 'expenses', 1, NULL),
(7, 'transportation', 'expenses', 1, NULL),
(8, 'entertainment', 'expenses', 1, NULL),
(9, 'beauty', 'expenses', 1, NULL),
(10, 'courses', 'expenses', 1, NULL),
(11, 'saving', 'budget', 1, NULL),
(12, 'other', 'budget', 1, NULL),
(13, 'house loan', 'liability', 1, NULL),
(14, 'car loan', 'liability', 1, NULL),
(15, 'personal loan', 'liability', 1, NULL),
(16, 'credit card', 'liability', 1, NULL),
(17, 'Stock', 'investment', 1, NULL),
(18, 'ETF', 'investment', 1, NULL),
(19, 'Fixed Deposit', 'investment', 1, NULL),
(20, 'announcement', 'notification', 1, NULL),
(21, 'feedback', 'notification', 1, NULL),
(22, 'question', 'notification', 1, NULL),
(23, 'feedback response', 'notification', 1, NULL),
(24, 'question response', 'notification', 1, NULL),
(25, 'Crypto', 'investment', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cusID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusID`, `username`, `password`, `name`, `email`) VALUES
(1, 'customer1', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Cus', 'howard_bb@hotmail.com'),
(2, 'customer2', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Two', 'jerry2@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedbackID` int(255) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminID` int(255) NOT NULL,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `contact_name`, `contact_phone`, `contact_email`, `content`, `adminID`) VALUES
(1, 'Jerry', '0123456789', 'jerry2@mail.com', 'I can\'t save my income, why?', 1),
(2, 'Tom', '0132456789', 'tommydummy@mail.com', 'The system worked so great! I will promote it to my family!', 1),
(3, 'Ali', '011123456789', 'alialia@mail.com', 'This system helped me to understand my financial more than my wallet do!', 1),
(4, 'Muthu', '01395864574', 'muthusamee@mail.com', 'This system is just like a life saviour, it helps me to stop from random spending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

DROP TABLE IF EXISTS `investment`;
CREATE TABLE IF NOT EXISTS `investment` (
  `investmentID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `investmentName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investmentType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `amountInvested` decimal(20,2) NOT NULL,
  `ratePerAnnum` decimal(20,2) NOT NULL,
  `transactionID` int(11) NOT NULL,
  PRIMARY KEY (`investmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`investmentID`, `cusID`, `investmentName`, `investmentType`, `startDate`, `amountInvested`, `ratePerAnnum`, `transactionID`) VALUES
(1, 1, 'CIMB FD', 'Fixed Deposit', '2020-05-05', '10000.00', '2.45', 25),
(2, 1, 'AMD', 'Stock', '2020-08-05', '1300.00', '11.25', 26),
(3, 1, 'SPY', 'ETF', '2020-09-05', '2000.00', '12.24', 27),
(4, 1, 'VOO', 'ETF', '2020-10-05', '1500.00', '12.24', 28),
(5, 1, 'AMD', 'Stock', '2020-12-05', '1300.00', '11.00', 29),
(6, 1, 'BTC', 'Crypto', '2021-02-03', '1250.00', '10.00', 30),
(7, 1, 'BTC', 'Crypto', '2021-02-03', '500.00', '10.00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `liability`
--

DROP TABLE IF EXISTS `liability`;
CREATE TABLE IF NOT EXISTS `liability` (
  `liabilityID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `liabilityName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liabilityType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date DEFAULT NULL,
  `totalAmountToPay` decimal(20,2) DEFAULT NULL,
  `initialPaidAmount` decimal(20,2) DEFAULT '0.00',
  `paymentDate` date DEFAULT NULL,
  `paymentFrequency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountEachPayment` decimal(20,2) DEFAULT NULL,
  `paymentReminder` tinyint(1) DEFAULT NULL,
  `autoRecord` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`liabilityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liability`
--

INSERT INTO `liability` (`liabilityID`, `cusID`, `liabilityName`, `liabilityType`, `startDate`, `totalAmountToPay`, `initialPaidAmount`, `paymentDate`, `paymentFrequency`, `amountEachPayment`, `paymentReminder`, `autoRecord`) VALUES
(1, 1, 'VKA BlockA1', 'house loan', '2020-01-23', '80000.00', '10000.00', '2020-01-05', 'M', '1500.80', 1, 1),
(2, 1, 'CIMB', 'credit card', '2020-12-20', '200.00', '1.00', '2020-01-06', 'M', '200.00', 1, 0),
(3, 1, 'Maybank', 'credit card', '2020-12-20', '5000.00', '0.00', '2021-02-20', NULL, '2000.00', 1, 0),
(4, 1, 'MYVI 1M4U', 'car loan', '2020-12-20', '50000.00', '20000.00', '2020-03-02', 'M', '1000.00', 1, 0),
(5, 1, 'Jerry', 'personal loan', '2020-10-01', '200.00', '0.00', NULL, NULL, NULL, 1, 0),
(6, 1, 'From Samuel', 'personal loan', '2020-07-01', '1000.00', '0.00', NULL, NULL, NULL, 1, 0),
(7, 1, 'Lambo', 'car loan', '2020-12-08', '5000.00', '2000.00', '2020-01-08', 'M', '200.00', 1, 0),
(8, 1, 'Toyota 555', 'car loan', '2021-01-06', '1000.00', '12.00', '2021-01-06', 'M', '21.00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `cusID`, `categoryID`, `date`, `amount`, `description`) VALUES
(1, 1, 1, '2020-12-08 10:07:23', '2500.00', 'MediaPlus Digital'),
(3, 1, 2, '2020-12-17 10:07:23', '2450.00', 'Hackathon'),
(4, 1, 5, '2020-12-06 10:07:23', '10.00', NULL),
(5, 1, 5, '2020-12-03 10:07:23', '100.00', 'NSK'),
(6, 1, 5, '2020-12-25 10:07:23', '50.00', 'Christmas Dinner'),
(7, 1, 6, '2020-12-02 10:07:23', '20.00', 'Water Bill'),
(8, 1, 6, '2020-12-02 10:07:23', '50.00', 'Electric'),
(9, 1, 6, '2020-12-05 10:07:23', '100.00', 'WiFi'),
(10, 1, 8, '2020-12-05 10:07:23', '100.00', 'Cinema'),
(11, 1, 7, '2020-12-02 10:07:23', '300.05', ''),
(12, 1, 10, '2020-12-15 10:07:23', '300.00', 'Piano Class'),
(13, 1, 8, '2020-12-23 10:07:23', '200.00', NULL),
(14, 1, 13, '2020-01-23 00:00:00', '1400.80', 'VKA BlockA1'),
(15, 1, 16, '2020-12-20 00:00:00', '2000.00', 'Maybank'),
(16, 1, 14, '2020-12-20 00:00:00', '1000.00', 'MYVI 1M4U'),
(17, 1, 15, '2020-10-20 00:00:00', '200.00', 'From Samuel'),
(18, 1, 15, '2020-11-20 00:00:00', '400.00', 'From Samuel'),
(19, 1, 15, '2020-12-20 00:00:00', '400.00', 'From Samuel'),
(20, 1, 13, '2021-01-06 00:00:00', '2000.00', 'VKA BlockA1'),
(21, 1, 14, '2021-01-02 00:00:00', '1000.00', 'MYVI 1M4U'),
(22, 1, 14, '2021-01-13 00:00:00', '200.00', 'MYVI 1M4U'),
(23, 1, 13, '2021-01-01 00:00:00', '1599.20', 'VKA BlockA1'),
(24, 1, 14, '2021-01-07 00:00:00', '97.00', 'Toyota 555'),
(25, 1, 19, '2020-05-05 00:00:00', '10000.00', 'CIMB FD'),
(26, 1, 17, '2020-08-05 00:00:00', '1300.00', 'AMD'),
(27, 1, 18, '2020-09-05 00:00:00', '2000.00', 'SPY'),
(28, 1, 18, '2020-10-05 00:00:00', '1500.00', 'VOO'),
(29, 1, 17, '2020-12-05 00:00:00', '1300.00', 'AMD'),
(30, 1, 25, '2021-02-03 00:00:00', '1250.00', 'BTC'),
(31, 1, 25, '2021-02-03 00:00:00', '500.00', 'BTC'),
(32, 1, 1, '2019-01-03 13:00:00', '1500.00', 'Miri Departmental '),
(33, 1, 1, '2019-02-03 13:18:01', '1350.00', 'Miri Departmental '),
(34, 1, 1, '2019-03-03 13:19:06', '1400.00', 'Miri Departmental '),
(35, 1, 1, '2019-04-03 13:20:32', '1550.00', 'Miri Departmental '),
(36, 1, 1, '2019-05-03 12:19:55', '1500.00', 'Miri Departmental '),
(37, 1, 1, '2019-06-03 13:20:29', '1550.00', 'Miri Departmental '),
(38, 1, 1, '2019-07-03 13:20:52', '1600.00', 'Miri Departmental '),
(39, 1, 1, '2019-08-03 17:22:45', '1750.00', 'Miri Departmental '),
(40, 1, 1, '2019-09-06 17:23:14', '1750.00', 'Miri Departmental '),
(41, 1, 1, '2019-10-06 13:23:34', '1700.00', 'Miri Departmental '),
(42, 1, 1, '2019-11-03 12:24:02', '1720.00', 'Miri Departmental '),
(43, 1, 1, '2019-12-06 17:24:26', '2000.00', 'Miri Departmental '),
(44, 1, 1, '2019-08-15 08:26:43', '750.00', 'Freelance'),
(45, 1, 1, '2019-04-11 12:27:47', '400.00', 'Freelance'),
(46, 1, 1, '2020-01-03 13:11:38', '2000.00', 'Miri Departmental '),
(47, 1, 1, '2020-02-03 17:29:08', '2000.00', 'Miri Departmental '),
(48, 1, 1, '2020-02-08 12:29:30', '350.00', 'Miri Departmental '),
(49, 1, 1, '2020-03-03 12:30:00', '2200.00', 'Miri Departmental '),
(50, 1, 1, '2020-07-08 12:30:25', '1950.00', 'MediaPlus Digital'),
(51, 1, 1, '2020-08-08 17:31:33', '2000.00', 'MediaPlus Digital'),
(52, 1, 1, '2020-09-08 12:31:52', '2150.00', 'MediaPlus Digital'),
(53, 1, 1, '2020-10-08 12:34:13', '2500.00', 'MediaPlus Digital'),
(54, 1, 1, '2020-11-08 12:32:36', '2500.00', 'MediaPlus Digital'),
(55, 1, 1, '2020-12-25 17:33:28', '500.00', 'MediaPlus Digital'),
(56, 1, 1, '2021-01-08 12:34:01', '2500.00', 'MediaPlus Digital'),
(57, 1, 1, '2021-02-05 17:34:21', '2650.00', 'MediaPlus Digital'),
(58, 1, 1, '2020-12-17 17:35:14', '350.00', 'Freelance'),
(59, 1, 1, '2021-01-15 17:35:35', '470.00', 'Freelance'),
(60, 1, 1, '2020-05-21 17:36:27', '400.00', 'Freelance'),
(61, 1, 1, '2020-06-27 17:36:49', '350.00', 'Freelance'),
(62, 1, 2, '2019-06-06 12:42:02', '3550.00', 'Hackathon'),
(63, 1, 2, '2019-08-02 17:38:41', '450.00', 'Hari Kebangsaan'),
(64, 1, 2, '2019-02-14 17:39:21', '350.00', 'Good Show'),
(65, 1, 2, '2019-09-06 12:40:03', '1000.00', 'Good Show'),
(66, 1, 2, '2020-02-12 17:41:18', '400.00', 'Good Show'),
(67, 1, 2, '2020-03-15 17:41:36', '500.00', 'Good Show'),
(68, 1, 2, '2020-10-15 17:42:02', '430.00', 'Hari Kebangsaan'),
(69, 1, 2, '2021-02-04 17:42:34', '1050.00', 'Good Show'),
(70, 1, 2, '2021-01-07 17:43:10', '120.00', ''),
(71, 1, 3, '2019-08-09 10:44:11', '450.00', 'VKA BlockA1'),
(72, 1, 3, '2019-09-07 10:44:53', '450.00', 'VKA BlockA1'),
(73, 1, 3, '2019-10-07 10:45:18', '450.00', 'VKA BlockA1'),
(74, 1, 3, '2019-11-07 10:45:40', '450.00', 'VKA BlockA1'),
(75, 1, 3, '2020-02-07 10:46:45', '400.00', 'VKA BlockA1'),
(76, 1, 3, '2020-03-06 17:47:09', '400.00', 'VKA BlockA1'),
(77, 1, 3, '2020-04-07 17:47:27', '450.00', 'VKA BlockA1'),
(78, 1, 3, '2020-05-07 17:47:49', '450.00', 'VKA BlockA1'),
(79, 1, 3, '2020-06-06 17:48:08', '450.00', 'VKA BlockA1'),
(80, 1, 3, '2020-07-06 17:48:22', '450.00', 'VKA BlockA1'),
(81, 1, 3, '2020-08-07 21:48:44', '470.00', 'VKA BlockA1'),
(82, 1, 3, '2020-09-07 17:49:10', '470.00', 'VKA BlockA1'),
(83, 1, 3, '2020-10-06 17:49:27', '450.00', 'VKA BlockA1'),
(84, 1, 3, '2020-11-08 17:49:42', '470.00', 'VKA BlockA1'),
(85, 1, 3, '2020-12-07 17:50:04', '470.00', 'VKA BlockA1'),
(86, 1, 3, '2021-01-07 17:50:37', '470.00', 'VKA BlockA1'),
(87, 1, 3, '2021-02-06 17:50:57', '480.00', 'VKA BlockA1'),
(88, 1, 4, '2019-06-28 17:52:13', '150.00', 'AMD'),
(89, 1, 4, '2019-06-09 17:52:51', '120.00', 'SPY'),
(90, 1, 4, '2019-07-09 17:53:23', '350.00', 'AMD'),
(91, 1, 4, '2019-07-28 17:53:53', '125.00', ''),
(92, 1, 4, '2019-08-09 23:54:24', '120.00', ''),
(93, 1, 4, '2019-10-10 17:54:52', '55.75', 'AMD'),
(94, 1, 4, '2019-11-08 17:55:18', '152.40', ''),
(95, 1, 4, '2019-12-21 17:55:33', '550.10', ''),
(96, 1, 4, '2019-12-10 17:55:49', '250.00', ''),
(97, 1, 4, '2020-01-07 17:56:07', '350.00', 'SPY'),
(98, 1, 4, '2020-01-16 17:56:23', '25.66', ''),
(99, 1, 4, '2020-02-08 17:56:44', '255.00', ''),
(100, 1, 4, '2020-02-28 17:56:58', '550.00', ''),
(101, 1, 4, '2020-03-05 20:00:18', '550.77', ''),
(102, 1, 4, '2020-04-07 19:57:36', '125.00', ''),
(103, 1, 4, '2020-05-23 17:57:59', '255.00', 'SPY'),
(104, 1, 4, '2020-05-23 17:57:59', '255.00', 'SPY'),
(105, 1, 4, '2020-05-15 17:58:13', '52.40', 'SPY'),
(106, 1, 4, '2020-06-15 17:58:32', '522.00', ''),
(107, 1, 4, '2020-07-10 17:58:51', '250.00', ''),
(108, 1, 4, '2020-07-24 20:59:06', '240.00', ''),
(109, 1, 4, '2020-08-05 17:59:32', '78.00', ''),
(110, 1, 4, '2020-08-20 17:59:52', '95.00', ''),
(111, 1, 4, '2020-09-18 18:00:14', '642.09', 'SPY'),
(112, 1, 4, '2020-09-10 18:00:29', '255.00', ''),
(113, 1, 4, '2020-10-22 21:00:49', '123.00', ''),
(114, 1, 4, '2020-11-02 18:01:04', '147.00', ''),
(115, 1, 4, '2020-12-18 18:01:24', '222.00', 'SPY'),
(116, 1, 4, '2020-12-10 18:01:39', '120.00', 'AMD'),
(117, 1, 4, '2020-12-30 18:01:57', '333.00', 'CIMB FD'),
(118, 1, 4, '2021-01-09 18:02:18', '550.00', 'AMD'),
(119, 1, 4, '2021-01-14 18:02:31', '100.00', 'SPY'),
(120, 1, 4, '2021-01-31 18:02:41', '75.40', 'CIMB FD'),
(121, 1, 4, '2021-02-03 18:03:24', '55.85', 'AMD'),
(122, 1, 4, '2021-02-01 18:03:41', '111.00', 'CIMB FD'),
(123, 1, 3, '2020-09-11 18:04:56', '1200.00', 'CVL 11'),
(124, 1, 3, '2020-10-11 20:07:55', '1100.00', 'CVL 11'),
(125, 1, 3, '2020-11-11 18:08:26', '1200.00', 'CVL 11'),
(126, 1, 3, '2020-12-11 18:08:44', '1200.00', 'CVL 11'),
(127, 1, 3, '2021-01-11 18:09:01', '1200.00', 'CVL 11'),
(128, 1, 5, '2019-01-06 18:12:48', '750.40', ''),
(129, 1, 5, '2019-02-06 18:13:23', '688.60', ''),
(130, 1, 5, '2019-03-06 18:13:46', '900.00', ''),
(131, 1, 5, '2019-04-06 18:14:03', '680.40', ''),
(132, 1, 5, '2019-05-06 18:14:20', '778.40', ''),
(133, 1, 5, '2019-06-15 18:14:36', '1042.50', ''),
(134, 1, 5, '2019-07-11 18:15:06', '775.50', ''),
(135, 1, 5, '2019-08-15 18:15:22', '854.33', ''),
(136, 1, 5, '2019-09-22 18:15:38', '667.80', ''),
(137, 1, 5, '2019-10-03 18:15:52', '1053.50', ''),
(138, 1, 5, '2019-11-08 18:16:08', '778.56', ''),
(139, 1, 5, '2019-12-19 18:16:25', '876.39', ''),
(140, 1, 5, '2021-01-01 09:18:32', '5.50', 'Breakfast'),
(141, 1, 5, '2021-01-01 13:19:11', '12.60', 'Lunch'),
(142, 1, 5, '2021-01-01 20:19:30', '24.10', 'Dinner'),
(143, 1, 5, '2021-01-02 09:19:49', '12.40', 'Breakfast'),
(144, 1, 5, '2021-01-02 12:20:14', '25.50', 'Lunch'),
(145, 1, 5, '2021-01-02 20:20:33', '55.60', 'Dinner'),
(146, 1, 5, '2021-01-03 09:20:48', '10.00', 'Breakfast'),
(147, 1, 5, '2021-01-03 12:21:02', '12.30', 'Lunch'),
(148, 1, 5, '2021-01-03 19:21:22', '40.20', 'Dinner'),
(149, 1, 5, '2021-01-04 09:21:38', '14.20', 'Breakfast'),
(150, 1, 5, '2021-01-04 12:21:53', '23.01', 'Lunch'),
(151, 1, 5, '2021-01-04 19:22:08', '12.40', 'Dinner'),
(152, 1, 5, '2021-01-05 18:22:24', '5.50', 'Breakfast'),
(153, 1, 5, '2021-01-05 13:22:40', '30.44', 'Lunch'),
(154, 1, 5, '2021-01-05 20:23:03', '12.00', 'Dinner'),
(155, 1, 5, '2021-01-06 09:23:34', '20.00', 'Breakfast'),
(156, 1, 5, '2021-02-01 07:23:53', '12.40', 'Breakfast'),
(157, 1, 5, '2021-01-06 18:24:19', '120.40', 'Dinner'),
(158, 1, 5, '2021-01-07 06:43:04', '15.00', 'Breakfast'),
(159, 1, 5, '2021-01-07 18:43:26', '20.00', 'Dinner'),
(160, 1, 5, '2021-01-08 09:43:40', '13.00', 'Breakfast'),
(161, 1, 5, '2021-01-08 18:44:01', '20.00', 'Dinner'),
(162, 1, 5, '2021-01-07 12:44:29', '25.00', 'Lunch'),
(163, 1, 5, '2021-01-08 13:44:41', '10.00', 'Lunch'),
(164, 1, 5, '2021-01-09 18:44:53', '11.00', 'Breakfast'),
(165, 1, 5, '2021-01-09 18:45:14', '55.00', ''),
(166, 1, 5, '2021-01-10 11:45:32', '52.00', 'Breakfast'),
(167, 1, 5, '2021-01-10 20:45:49', '32.44', 'Dinner'),
(168, 1, 5, '2021-01-11 18:46:07', '78.66', ''),
(169, 1, 5, '2021-01-12 20:46:33', '123.40', ''),
(170, 1, 5, '2021-01-13 18:46:49', '65.50', ''),
(171, 1, 5, '2021-01-14 14:47:09', '75.30', ''),
(172, 1, 5, '2021-01-14 18:47:32', '88.70', ''),
(173, 1, 5, '2021-01-15 18:47:52', '87.00', ''),
(174, 1, 5, '2021-01-16 00:52:04', '78.66', ''),
(175, 1, 5, '2021-01-17 22:34:19', '102.30', ''),
(176, 1, 5, '2021-01-18 18:48:41', '87.50', ''),
(177, 1, 5, '2021-01-19 23:52:52', '77.90', ''),
(178, 1, 5, '2021-01-20 14:53:06', '79.00', ''),
(179, 1, 5, '2021-01-21 11:29:27', '21.00', 'Breakfast'),
(180, 1, 5, '2021-01-21 13:49:45', '55.20', 'Lunch'),
(181, 1, 5, '2021-01-21 18:49:59', '35.00', 'Dinner'),
(182, 1, 5, '2021-01-22 13:31:09', '53.00', 'Lunch'),
(183, 1, 5, '2021-01-22 18:50:23', '60.00', 'Dinner'),
(184, 1, 5, '2021-01-23 03:50:43', '12.05', 'Breakfast'),
(185, 1, 5, '2021-01-23 13:51:08', '16.60', 'Lunch'),
(186, 1, 5, '2021-01-23 18:51:22', '44.00', 'Dinner'),
(187, 1, 5, '2021-01-24 12:51:48', '55.00', 'Lunch'),
(188, 1, 5, '2021-01-25 20:52:03', '96.77', ''),
(189, 1, 5, '2021-01-26 12:52:20', '20.60', 'Lunch'),
(190, 1, 5, '2021-01-26 18:52:38', '10.30', 'Dinner'),
(191, 1, 5, '2021-01-27 10:52:49', '15.00', 'Breakfast'),
(192, 1, 5, '2021-01-27 13:53:08', '30.50', 'Lunch'),
(193, 1, 5, '2021-01-27 18:53:33', '55.00', 'Christmas Dinner'),
(194, 1, 5, '2021-01-28 15:53:47', '55.00', 'Lunch'),
(195, 1, 5, '2021-01-28 20:54:02', '35.60', 'Dinner'),
(196, 1, 5, '2021-01-29 09:54:15', '12.30', 'Breakfast'),
(197, 1, 5, '2021-01-29 13:54:28', '12.55', 'Lunch'),
(198, 1, 5, '2021-01-29 18:54:41', '22.00', 'Dinner'),
(199, 1, 5, '2021-01-30 11:55:01', '11.20', ''),
(200, 1, 5, '2021-01-30 12:55:13', '63.00', 'Lunch'),
(201, 1, 5, '2021-01-31 18:55:57', '66.22', 'Dinner'),
(202, 1, 5, '2021-02-01 13:57:12', '25.00', 'Lunch'),
(203, 1, 5, '2021-02-01 20:57:26', '15.50', 'Dinner'),
(204, 1, 5, '2021-02-02 18:57:38', '15.00', 'Breakfast'),
(205, 1, 5, '2021-02-02 13:57:49', '15.30', 'Lunch'),
(206, 1, 5, '2021-02-02 20:58:01', '5.30', 'Dinner'),
(207, 1, 5, '2021-02-03 09:58:15', '9.00', 'Breakfast'),
(208, 1, 5, '2021-02-03 12:58:29', '33.00', 'Lunch'),
(209, 1, 5, '2021-02-03 20:58:46', '12.30', 'Dinner'),
(210, 1, 5, '2021-02-04 12:58:58', '25.30', ''),
(211, 1, 5, '2021-02-04 20:59:09', '10.00', 'Dinner'),
(212, 1, 5, '2021-02-05 09:59:19', '8.00', 'Breakfast'),
(213, 1, 5, '2021-02-05 18:59:53', '12.60', 'Dinner'),
(214, 1, 5, '2021-02-06 05:00:04', '10.00', 'Breakfast'),
(215, 1, 5, '2021-02-06 13:00:22', '12.00', 'Lunch'),
(216, 1, 5, '2021-02-06 19:00:34', '25.30', 'Dinner'),
(217, 1, 5, '2020-01-06 19:01:35', '350.00', ''),
(218, 1, 5, '2020-02-06 22:01:51', '455.63', ''),
(219, 1, 5, '2020-03-06 19:02:04', '350.00', ''),
(220, 1, 5, '2020-04-06 19:02:15', '663.25', ''),
(221, 1, 5, '2020-05-06 19:02:28', '355.66', ''),
(222, 1, 5, '2020-06-19 19:02:44', '993.20', ''),
(223, 1, 5, '2020-07-06 19:02:58', '420.00', ''),
(224, 1, 5, '2020-08-06 19:03:11', '366.10', ''),
(225, 1, 5, '2020-09-06 19:03:24', '369.00', ''),
(226, 1, 5, '2020-10-06 19:03:36', '557.00', ''),
(227, 1, 5, '2020-11-06 19:03:47', '360.00', ''),
(228, 1, 5, '2020-12-06 19:04:01', '450.36', ''),
(229, 1, 7, '2019-01-06 19:05:23', '300.55', ''),
(230, 1, 7, '2019-02-06 19:05:39', '255.78', ''),
(231, 1, 7, '2019-03-06 19:05:54', '402.36', ''),
(232, 1, 7, '2019-04-06 19:06:13', '367.44', ''),
(233, 1, 7, '2019-05-06 19:06:27', '388.00', ''),
(234, 1, 7, '2019-06-12 19:06:38', '253.12', ''),
(235, 1, 7, '2019-07-06 19:06:56', '258.00', ''),
(236, 1, 7, '2019-08-06 19:07:13', '412.55', ''),
(237, 1, 7, '2019-09-06 19:07:26', '355.00', ''),
(238, 1, 7, '2019-10-06 19:07:36', '489.55', ''),
(239, 1, 7, '2019-11-17 19:07:55', '530.20', ''),
(240, 1, 7, '2019-12-04 19:08:15', '357.22', ''),
(241, 1, 7, '2020-05-15 19:09:22', '288.99', ''),
(242, 1, 7, '2020-02-04 19:09:37', '351.22', ''),
(243, 1, 7, '2020-01-06 19:09:49', '311.01', ''),
(244, 1, 7, '2020-03-06 19:10:18', '336.22', ''),
(245, 1, 7, '2020-04-16 19:10:32', '344.20', ''),
(246, 1, 7, '2020-06-18 19:10:47', '555.55', ''),
(247, 1, 7, '2020-06-11 19:11:02', '553.44', ''),
(248, 1, 7, '2020-08-06 19:11:17', '369.22', ''),
(249, 1, 7, '2020-11-06 19:11:31', '319.69', ''),
(250, 1, 7, '2020-10-06 19:11:46', '323.44', ''),
(251, 1, 7, '2021-01-05 19:12:24', '120.00', 'Rapid KL'),
(252, 1, 7, '2021-01-01 19:12:48', '13.66', 'Grab'),
(253, 1, 7, '2021-01-02 19:13:05', '12.40', 'Grab'),
(254, 1, 7, '2021-01-10 19:13:19', '30.50', 'Rapid KL'),
(255, 1, 7, '2021-01-09 19:13:41', '12.40', 'Grab'),
(256, 1, 7, '2021-01-17 19:14:05', '32.00', 'Grab'),
(257, 1, 7, '2021-01-14 19:14:38', '75.00', 'Grab'),
(258, 1, 7, '2021-01-09 19:14:54', '120.00', 'Petrol'),
(259, 1, 7, '2021-01-23 19:15:16', '120.00', 'Petrol'),
(260, 1, 7, '2021-01-27 19:15:32', '50.00', 'Rapid KL'),
(261, 1, 7, '2021-02-05 19:16:46', '120.00', 'Rapid KL'),
(262, 1, 7, '2021-02-02 19:17:01', '120.00', 'Petrol'),
(263, 1, 7, '2021-02-03 19:17:16', '10.00', 'Grab'),
(265, 1, 6, '2019-01-06 19:24:57', '520.00', ''),
(266, 1, 6, '2019-02-06 19:25:14', '500.00', ''),
(267, 1, 6, '2019-03-06 19:25:28', '425.00', ''),
(268, 1, 6, '2019-04-06 19:25:49', '444.00', ''),
(269, 1, 6, '2019-05-06 19:26:04', '500.00', ''),
(270, 1, 6, '2019-06-06 19:26:17', '500.00', ''),
(271, 1, 6, '2019-07-06 19:26:49', '550.00', ''),
(272, 1, 6, '2019-08-06 19:27:04', '550.00', ''),
(273, 1, 6, '2019-09-06 19:27:18', '550.00', ''),
(274, 1, 6, '2019-10-06 19:27:30', '550.00', ''),
(275, 1, 6, '2019-11-06 19:27:42', '550.00', ''),
(276, 1, 6, '2019-12-06 19:27:56', '550.00', ''),
(277, 1, 6, '2020-01-06 19:28:35', '550.00', ''),
(278, 1, 6, '2020-02-06 19:28:47', '550.00', ''),
(279, 1, 6, '2019-03-06 19:28:59', '550.00', ''),
(280, 1, 6, '2020-04-06 19:29:11', '550.00', ''),
(281, 1, 6, '2020-06-06 19:29:21', '500.00', ''),
(282, 1, 6, '2020-03-06 19:29:46', '520.00', ''),
(283, 1, 6, '2020-05-06 19:30:10', '500.00', ''),
(284, 1, 6, '2020-07-06 19:30:22', '500.00', ''),
(285, 1, 6, '2020-08-06 19:30:47', '500.00', ''),
(286, 1, 6, '2020-09-06 19:31:03', '500.00', ''),
(287, 1, 6, '2020-10-06 19:31:13', '500.00', ''),
(288, 1, 6, '2020-11-06 19:31:22', '500.00', ''),
(289, 1, 6, '2020-12-06 19:31:38', '320.00', 'For Family'),
(290, 1, 6, '2021-01-06 19:33:10', '150.00', 'Water Bill'),
(291, 1, 6, '2021-01-08 19:33:25', '120.00', 'WiFi'),
(292, 1, 6, '2021-01-01 19:33:38', '320.00', 'For Family'),
(293, 1, 6, '2021-02-01 19:33:54', '320.00', 'For Family'),
(294, 1, 6, '2021-02-03 19:34:11', '120.00', 'WiFi'),
(295, 1, 10, '2019-03-06 19:35:37', '5400.00', 'APU'),
(296, 1, 10, '2019-07-06 19:35:59', '5250.00', 'APU'),
(297, 1, 10, '2019-11-06 19:36:18', '5200.00', 'APU'),
(298, 1, 10, '2020-03-06 19:36:52', '5150.00', 'APU'),
(299, 1, 10, '2020-07-06 19:37:13', '4700.00', 'APU'),
(300, 1, 10, '2021-02-04 19:37:29', '4000.00', 'APU'),
(301, 1, 9, '2019-01-06 21:30:37', '120.00', ''),
(302, 1, 9, '2019-02-06 21:31:03', '220.00', ''),
(303, 1, 9, '2019-03-06 21:31:15', '105.00', ''),
(304, 1, 9, '2019-04-06 21:31:25', '100.00', ''),
(305, 1, 9, '2019-05-06 21:31:39', '150.00', ''),
(306, 1, 9, '2019-06-06 21:31:49', '220.00', ''),
(307, 1, 9, '2019-07-06 21:31:59', '100.00', ''),
(308, 1, 9, '2019-08-06 21:32:07', '120.00', ''),
(309, 1, 9, '2019-09-06 21:32:16', '100.00', ''),
(310, 1, 9, '2019-10-06 21:32:24', '230.00', ''),
(311, 1, 9, '2019-11-06 21:32:35', '120.00', ''),
(312, 1, 9, '2019-12-06 21:32:46', '100.00', ''),
(313, 1, 9, '2020-01-06 21:33:17', '120.55', ''),
(314, 1, 9, '2020-02-06 21:33:28', '255.80', ''),
(315, 1, 9, '2020-03-06 21:33:39', '120.00', ''),
(316, 1, 9, '2020-04-06 21:33:48', '62.76', ''),
(317, 1, 9, '2020-05-06 21:34:00', '150.00', ''),
(318, 1, 9, '2020-06-06 21:34:24', '100.00', ''),
(319, 1, 9, '2020-07-06 21:34:33', '200.00', ''),
(320, 1, 9, '2020-08-06 21:34:42', '120.00', ''),
(321, 1, 9, '2020-10-06 21:34:53', '100.00', ''),
(322, 1, 9, '2020-12-06 21:35:01', '123.00', ''),
(323, 1, 9, '2021-01-09 15:35:31', '45.70', 'Hair Cut'),
(324, 1, 9, '2021-01-15 21:35:51', '120.00', ''),
(325, 1, 9, '2021-02-02 21:36:14', '37.90', 'Hair Cut'),
(326, 1, 8, '2021-02-03 21:38:01', '200.00', 'Mobile Legend'),
(327, 1, 8, '2021-02-01 21:38:36', '23.66', 'Movie'),
(328, 1, 8, '2021-01-02 21:38:57', '14.90', 'Movie'),
(329, 1, 8, '2021-01-23 21:39:33', '42.77', 'Shopping'),
(330, 1, 2, '2020-02-06 22:17:22', '100.00', 'Miri Departmental '),
(331, 1, 1, '2020-03-06 22:17:22', '2500.00', 'Basic Salary'),
(332, 1, 1, '2020-04-06 22:17:22', '2500.00', 'Basic Salary'),
(333, 1, 1, '2020-05-06 22:17:22', '2500.00', 'Basic Salary'),
(334, 1, 1, '2020-06-06 22:17:22', '2500.00', 'Basic Salary'),
(335, 1, 1, '2020-07-06 22:17:22', '2500.00', 'Basic Salary'),
(336, 1, 1, '2020-08-06 22:17:22', '2500.00', 'Basic Salary'),
(337, 1, 1, '2020-09-06 22:17:22', '2500.00', 'Basic Salary'),
(338, 1, 1, '2020-10-06 22:17:22', '2500.00', 'Basic Salary'),
(339, 1, 1, '2020-11-06 22:17:22', '2500.00', 'Basic Salary'),
(340, 1, 1, '2020-12-06 22:17:22', '2500.00', 'Basic Salary'),
(341, 1, 1, '2021-01-06 22:17:22', '2500.00', 'Basic Salary'),
(342, 1, 1, '2021-02-06 22:17:22', '2500.00', 'Basic Salary');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
