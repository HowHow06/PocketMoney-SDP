-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 03, 2021 at 06:29 AM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `email`) VALUES
('admin1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'howard_bb@hotmail.com');

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`username`, `password`, `name`, `email`) VALUES
('advisor1', '$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.', 'Dacin Wong', 'advisor1@mail.com');

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`cudID`, `categoryID`, `percentage`) VALUES
(1, 6, '10.00'),
(1, 5, '20.00'),
(1, 9, '10.00'),
(1, 12, '10.00'),
(1, 11, '50.00');

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryName`, `categoryType`, `preDefine`, `cusID`) VALUES
('salary', 'income', 1, NULL),
('awards', 'income', 1, NULL),
('rental', 'income', 1, NULL),
('investment profit', 'income', 1, NULL),
('food', 'expenses', 1, NULL),
('home', 'expenses', 1, NULL),
('transportation', 'expenses', 1, NULL),
('entertainment', 'expenses', 1, NULL),
('beauty', 'expenses', 1, NULL),
( 'courses', 'expenses', 1, NULL),
( 'saving', 'budget', 1, NULL),
( 'other', 'budget', 1, NULL),
( 'house loan', 'liability', 1, NULL),
( 'car loan', 'liability', 1, NULL),
( 'personal loan', 'liability', 1, NULL),
( 'credit card', 'liability', 1, NULL),
( 'Stock', 'investment', 1, NULL),
( 'ETF', 'investment', 1, NULL),
( 'Fixed Deposit', 'investment', 1, NULL),
( 'announcement', 'notification', 1, NULL),
( 'feedback', 'notification', 1, NULL),
( 'question', 'notification', 1, NULL),
( 'feedback response', 'notification', 1, NULL),
( 'question response', 'notification', 1, NULL),
( 'Crypto', 'investment', 0, 1);

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `name`, `email`) VALUES
('customer1', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Cus', 'howard_bb@hotmail.com'),
('customer2', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO', 'Jerry Two', 'jerry2@mail.com');

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`cusID`, `investmentName`, `investmentType`, `startDate`, `amountInvested`, `ratePerAnnum`, `transactionID`) VALUES
(1, 'CIMB FD', 'Fixed Deposit', '2020-05-05', '10000.00', '2.45', 25),
(1, 'AMD', 'Stock', '2020-08-05', '1300.00', '11.25', 26),
(1, 'SPY', 'ETF', '2020-09-05', '2000.00', '12.24', 27),
(1, 'VOO', 'ETF', '2020-10-05', '1500.00', '12.24', 28),
(1, 'AMD', 'Stock', '2020-12-05', '1300.00', '11.00', 29),
(1, 'BTC', 'Crypto', '2021-02-03', '1250.00', '10.00', 30),
(1, 'BTC', 'Crypto', '2021-02-03', '500.00', '10.00', 31);

--
-- Dumping data for table `liability`
--

INSERT INTO `liability` (`cusID`, `liabilityName`, `liabilityType`, `startDate`, `totalAmountToPay`, `initialPaidAmount`, `paymentDate`, `paymentFrequency`, `amountEachPayment`, `paymentReminder`, `autoRecord`) VALUES
(1, 'VKA BlockA1', 'house loan', '2020-01-23', '550000.00', '10000.00', '2020-01-05', 'M', '1500.80', 1, 1),
(1, 'CIMB', 'credit card', '2020-12-20', '200.00', '1.00', '2020-01-06', 'M', '200.00', 1, 0),
(1, 'Maybank', 'credit card', '2020-12-20', '5000.00', '0.00', '2020-02-20', NULL, '2000.00', 1, 0),
(1, 'MYVI 1M4U', 'car loan', '2020-12-20', '80000.00', '20000.00', '2020-03-02', 'M', '1000.00', 1, 0),
(1, 'Jerry', 'personal loan', '2020-10-01', '1000.00', '0.00', NULL, NULL, NULL, 1, 0),
(1, 'From Samuel', 'personal loan', '2020-07-01', '1000.00', '0.00', NULL, NULL, NULL, 1, 0),
(1, 'Lambo', 'car loan', '2020-12-08', '10000.00', '2000.00', '2020-01-08', 'M', '200.00', 1, 0),
( 1, 'Toyota 555', 'car loan', '2021-01-06', '1000.00', '12.00', '2021-01-06', 'M', '21.00', 1, NULL);

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` ( `cusID`, `categoryID`, `date`, `amount`, `description`) VALUES
(1, 1, '2020-12-01 10:07:23', '10000.00', NULL),
(1, 3, '2020-12-04 10:07:23', '5000.00', NULL),
(1, 2, '2020-12-05 10:07:23', '5000.00', 'Hackathon'),
(1, 5, '2020-12-06 10:07:23', '10.00', NULL),
(1, 5, '2020-12-03 10:07:23', '100.00', 'NSK'),
(1, 5, '2020-12-25 10:07:23', '50.00', 'Christmas Dinner'),
(1, 6, '2020-12-02 10:07:23', '20.00', 'Water Bill'),
(1, 6, '2020-12-02 10:07:23', '50.00', 'Electric'),
(1, 6, '2020-12-05 10:07:23', '100.00', 'WiFi'),
( 1, 8, '2020-12-05 10:07:23', '100.00', 'Cinema'),
( 1, 7, '2020-12-02 10:07:23', '30.00', NULL),
( 1, 10, '2020-12-15 10:07:23', '300.00', 'Piano Class'),
( 1, 8, '2020-12-23 10:07:23', '200.00', NULL),
( 1, 13, '2020-01-23 00:00:00', '1400.80', 'VKA BlockA1'),
( 1, 16, '2020-12-20 00:00:00', '2000.00', 'Maybank'),
( 1, 14, '2020-12-20 00:00:00', '1000.00', 'MYVI 1M4U'),
( 1, 15, '2020-10-20 00:00:00', '200.00', 'From Samuel'),
( 1, 15, '2020-11-20 00:00:00', '400.00', 'From Samuel'),
( 1, 15, '2020-12-20 00:00:00', '400.00', 'From Samuel'),
( 1, 13, '2021-01-06 00:00:00', '2000.00', 'VKA BlockA1'),
( 1, 14, '2021-01-02 00:00:00', '1000.00', 'MYVI 1M4U'),
( 1, 14, '2021-01-13 00:00:00', '200.00', 'MYVI 1M4U'),
( 1, 13, '2021-01-01 00:00:00', '1599.20', 'VKA BlockA1'),
( 1, 14, '2021-01-07 00:00:00', '97.00', 'Toyota 555'),
( 1, 19, '2020-05-05 00:00:00', '10000.00', 'CIMB FD'),
( 1, 17, '2020-08-05 00:00:00', '1300.00', 'AMD'),
( 1, 18, '2020-09-05 00:00:00', '2000.00', 'SPY'),
( 1, 18, '2020-10-05 00:00:00', '1500.00', 'VOO'),
( 1, 17, '2020-12-05 00:00:00', '1300.00', 'AMD'),
( 1, 25, '2021-02-03 00:00:00', '1250.00', 'BTC'),
( 1, 25, '2021-02-03 00:00:00', '500.00', 'BTC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
