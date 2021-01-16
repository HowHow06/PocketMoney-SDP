-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 16, 2021 at 06:28 AM
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

--
-- Database: `pocketmoney`
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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisorID`, `username`, `password`, `name`, `email`) VALUES
(1, 'advisor1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'Dacin Wong', 'advisor1@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `automatedtransaction`
--

DROP TABLE IF EXISTS `automatedtransaction`;
CREATE TABLE IF NOT EXISTS `automatedtransaction` (
  `aTransactionID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `recordTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoRecord` tinyint(1) NOT NULL,
  `paymentReminder` tinyint(1) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`aTransactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `automatedtransaction`
--

INSERT INTO `automatedtransaction` (`aTransactionID`, `cusID`, `categoryID`, `amount`, `recordTime`, `autoRecord`, `paymentReminder`, `description`) VALUES
(1, 1, 7, '30.00', '{\"frequency\": \"M\", \"period\": \"2\"}', 1, 0, NULL),
(2, 1, 6, '100.00', '{\"frequency\": \"M\", \"period\": \"5\"}', 1, 1, 'WiFi'),
(3, 1, 6, '50.00', '{\"frequency\": \"M\", \"period\": \"2\"}', 0, 1, 'Electric'),
(4, 1, 3, '5000.00', '{\"frequency\": \"M\", \"period\": \"4\"}', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
CREATE TABLE IF NOT EXISTS `budget` (
  `budgetID` int(255) NOT NULL AUTO_INCREMENT,
  `cudID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `percentage` decimal(20,2) NOT NULL,
  PRIMARY KEY (`budgetID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetID`, `cudID`, `categoryID`, `percentage`) VALUES
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
(9, 'investment', 'expenses', 1, NULL),
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
(24, 'question response', 'notification', 1, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusID`, `username`, `password`, `name`, `email`) VALUES
(1, 'customer1', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Cus', 'howard_bb@hotmail.com'),
(2, 'customer2', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Two', 'jerry2@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `financialgoal`
--

DROP TABLE IF EXISTS `financialgoal`;
CREATE TABLE IF NOT EXISTS `financialgoal` (
  `goalID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `currentSaving` decimal(20,2) NOT NULL,
  `incomePerAnnum` decimal(20,2) NOT NULL,
  `expensePerAnnum` decimal(20,2) NOT NULL,
  `goalAmount` decimal(20,2) NOT NULL,
  `totalAsset` decimal(20,2) NOT NULL,
  `totalLiability` decimal(20,2) NOT NULL,
  `netWorth` decimal(20,2) NOT NULL,
  `yearNeeded` int(255) NOT NULL,
  PRIMARY KEY (`goalID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  PRIMARY KEY (`investmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`investmentID`, `cusID`, `investmentName`, `investmentType`, `startDate`, `amountInvested`, `ratePerAnnum`) VALUES
(1, 1, 'Microsoft', 'Stock', '2020-09-05', '1000.00', '20.00'),
(2, 1, 'Microsoft', 'Stock', '2020-10-05', '500.00', '20.00'),
(3, 1, 'Microsoft', 'Stock', '2020-11-05', '800.00', '20.00'),
(4, 1, 'AMD', 'Stock', '2020-10-05', '900.00', '30.00'),
(5, 1, 'AMD', 'Stock', '2020-12-05', '1000.00', '30.00'),
(6, 1, 'SPY', 'ETF', '2020-09-05', '2000.00', '15.00'),
(7, 1, 'VOO', 'ETF', '2020-08-05', '1500.00', '13.00'),
(8, 1, 'CIMB FD', 'Fixed Deposit', '2020-05-05', '10000.00', '2.40');

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
  `paymentTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountEachPayment` decimal(20,2) DEFAULT NULL,
  `paymentReminder` tinyint(1) DEFAULT NULL,
  `autoRecord` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`liabilityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liability`
--

INSERT INTO `liability` (`liabilityID`, `cusID`, `liabilityName`, `liabilityType`, `startDate`, `totalAmountToPay`, `paymentTime`, `amountEachPayment`, `paymentReminder`, `autoRecord`) VALUES
(1, 1, 'VKA BlockA1', 'house loan', '2020-01-23', '550000.00', '{\"frequency\": \"M\", \"period\": \"5\"}', '1388.89', 1, 1),
(2, 1, 'CIMB', 'credit card', '2020-12-20', '200.00', '{\"frequency\": \"M\", \"period\": \"6\"}', '200.00', 1, 0),
(3, 1, 'Maybank', 'credit card', '2020-12-20', '5000.00', NULL, NULL, 1, 0),
(4, 1, 'MYVI 1M4U', 'car loan', '2020-12-20', '80000.00', '{\"frequency\": \"M\", \"period\": \"2\"}', '1000.00', 1, 0),
(5, 1, 'Jerry', 'personal loan', '2020-10-01', '1000.00', NULL, NULL, 1, 0),
(6, 1, 'From Samuel', 'personal loan', '2020-07-01', '1000.00', NULL, NULL, 1, 0),
(7, 1, 'Lambo', 'car loan', '2020-12-08', '10000.00', '{\"frequency\":\"M\",\"period\":\"8\"}', '200.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notificationID` int(255) NOT NULL AUTO_INCREMENT,
  `senderID` int(255) DEFAULT NULL,
  `receiver` decimal(10,2) DEFAULT NULL,
  `date` datetime NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notificationType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiverCusID` int(255) DEFAULT NULL,
  PRIMARY KEY (`notificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, 1, 10, '2020-12-05 10:07:23', '100.00', 'VKA BlockA1'),
(11, 1, 7, '2020-12-02 10:07:23', '30.00', NULL),
(12, 1, 9, '2020-12-15 10:07:23', '3000.00', NULL),
(13, 1, 8, '2020-12-23 10:07:23', '200.00', NULL),
(14, 1, 13, '2020-01-23 00:00:00', '5000.00', 'VKA BlockA1'),
(15, 1, 16, '2020-12-20 00:00:00', '2000.00', 'Maybank'),
(16, 1, 14, '2020-12-20 00:00:00', '20000.00', 'MYVI 1M4U'),
(17, 1, 15, '2020-10-20 00:00:00', '200.00', 'From Samuel'),
(18, 1, 15, '2020-11-20 00:00:00', '300.00', 'From Samuel'),
(19, 1, 15, '2020-12-20 00:00:00', '500.00', 'From Samuel');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
