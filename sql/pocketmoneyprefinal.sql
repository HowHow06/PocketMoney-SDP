-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 06, 2021 at 03:08 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pocketmoneyprefinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `email`) VALUES
(1, 'admin1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'howard_bb@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `announcementID` int(255) NOT NULL AUTO_INCREMENT,
  `adminID` int(255) NOT NULL,
  `announcement_date` datetime(6) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`announcementID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementID`, `adminID`, `announcement_date`, `title`, `content`) VALUES
(1, 1, '2020-12-31 00:00:00.000000', 'Annual Report & CG Report - 2019', 'The 2019 Annual Report and Form 20-F are now available as PDF download. A printed copy of our 2019 Annual Report can be ordered free of charge.'),
(2, 1, '2021-01-14 00:00:00.000000', 'Our promise to you', 'To us, security is about both protection and trust. The foundation of our offering is the commitment to sincerely do the right thing for your financial information, and that means keeping it secure and never taking advantage of it.'),
(3, 1, '2021-02-02 00:00:00.000000', 'Why use PocketMoney?', 'PocketMoney innovative tech is designed to help you lead a healthy financial life. It helps you securely organize finances, monitor transactions and track money. It empowers you with data to take better financial decisions for yourself & for your family.'),
(4, 1, '2021-01-24 00:00:00.000000', 'Scheduled Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. We are planning for some maintenance activities in our Data Centers on 27 January 2021 (10 a.m.  - 10 p.m.) . Once the maintenance activities are completed, all our services will resume to normal.'),
(5, 1, '2021-02-05 00:00:00.000000', 'Emergency Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. An emergency maintenance would start for some maintenance activities in our Service Centers on 5 February 2021 (1 a.m.  - 3 a.m.). Apologies for inconvenience caused.');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetID`, `cusID`, `categoryID`, `percentage`) VALUES
(1, 1, 6, '10.00'),
(2, 1, 5, '20.00'),
(3, 1, 9, '10.00'),
(4, 1, 12, '10.00'),
(5, 1, 11, '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(255) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preDefine` tinyint(1) NOT NULL,
  `cusID` int(255) DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cusID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminID` int(255) NOT NULL,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `investmentName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investmentType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `amountInvested` decimal(20,2) NOT NULL,
  `ratePerAnnum` decimal(20,2) NOT NULL,
  `transactionID` int(11) NOT NULL,
  PRIMARY KEY (`investmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `liabilityName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liabilityType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date DEFAULT NULL,
  `totalAmountToPay` decimal(20,2) DEFAULT NULL,
  `initialPaidAmount` decimal(20,2) DEFAULT '0.00',
  `paymentDate` date DEFAULT NULL,
  `paymentFrequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountEachPayment` decimal(20,2) DEFAULT NULL,
  `paymentReminder` tinyint(1) DEFAULT NULL,
  `autoRecord` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`liabilityID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liability`
--

INSERT INTO `liability` (`liabilityID`, `cusID`, `liabilityName`, `liabilityType`, `startDate`, `totalAmountToPay`, `initialPaidAmount`, `paymentDate`, `paymentFrequency`, `amountEachPayment`, `paymentReminder`, `autoRecord`) VALUES
(1, 1, 'VKA BlockA1', 'house loan', '2020-01-23', '80000.00', '10000.00', '2020-01-05', 'M', '1500.80', 1, 1),
(2, 1, 'CIMB', 'credit card', '2020-12-20', '200.00', '1.00', '2020-01-06', 'M', '200.00', 1, 0),
(3, 1, 'Maybank', 'credit card', '2020-12-20', '5000.00', '0.00', '2020-02-20', NULL, '2000.00', 1, 0),
(4, 1, 'MYVI 1M4U', 'car loan', '2020-12-20', '50000.00', '20000.00', '2020-03-02', 'M', '1000.00', 1, 0),
(5, 1, 'Jerry', 'personal loan', '2020-10-01', '200.00', '0.00', NULL, NULL, NULL, 1, 0),
(6, 1, 'From Samuel', 'personal loan', '2020-07-01', '1000.00', '0.00', NULL, NULL, NULL, 1, 0),
(7, 1, 'Lambo', 'car loan', '2020-12-08', '10000.00', '2000.00', '2020-01-08', 'M', '200.00', 1, 0),
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
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `cusID`, `categoryID`, `date`, `amount`, `description`) VALUES
(1, 1, 1, '2020-12-01 10:07:23', '10000.00', NULL),
(2, 1, 3, '2020-12-04 10:07:23', '5000.00', NULL),
(3, 1, 2, '2020-12-05 10:07:23', '5000.00', 'Hackathon'),
(4, 1, 5, '2020-12-06 10:07:23', '10.00', NULL),
(5, 1, 5, '2020-12-03 10:07:23', '100.00', 'NSK'),
(6, 1, 5, '2020-12-25 10:07:23', '50.00', 'Christmas Dinner'),
(7, 1, 6, '2020-12-02 10:07:23', '20.00', 'Water Bill'),
(8, 1, 6, '2020-12-02 10:07:23', '50.00', 'Electric'),
(9, 1, 6, '2020-12-05 10:07:23', '100.00', 'WiFi'),
(10, 1, 8, '2020-12-05 10:07:23', '100.00', 'Cinema'),
(11, 1, 7, '2020-12-02 10:07:23', '30.00', NULL),
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
(31, 1, 25, '2021-02-03 00:00:00', '500.00', 'BTC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
