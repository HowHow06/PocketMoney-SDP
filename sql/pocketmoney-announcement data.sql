-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 05, 2021 at 12:26 PM
-- Server version: 8.0.18
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
-- Database: `pocketmoney`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `announcementID` int(255) NOT NULL AUTO_INCREMENT,
  `adminID` int(255) NOT NULL,
  `announcement_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`announcementID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementID`, `adminID`, `announcement_date`, `title`, `content`) VALUES
(1, 1, '2020-12-31', 'Annual Report & CG Report - 2019', 'The 2019 Annual Report and Form 20-F are now available as PDF download. A printed copy of our 2019 Annual Report can be ordered free of charge.'),
(2, 1, '2021-01-14', 'Our promise to you', 'To us, security is about both protection and trust. The foundation of our offering is the commitment to sincerely do the right thing for your financial information, and that means keeping it secure and never taking advantage of it.'),
(3, 1, '2021-02-02', 'Why use PocketMoney?', 'PocketMoney innovative tech is designed to help you lead a healthy financial life. It helps you securely organize finances, monitor transactions and track money. It empowers you with data to take better financial decisions for yourself & for your family.'),
(4, 1, '2021-01-24', 'Scheduled Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. We are planning for some maintenance activities in our Data Centers on 27 January 2021 (10 a.m.  - 10 p.m.) . Once the maintenance activities are completed, all our services will resume to normal.'),
(5, 1, '2021-02-05', 'Emergency Maintenance Announcement - PocketMoney', 'Thank you all for your continuous support to PocketMoney. An emergency maintenance would start for some maintenance activities in our Service Centers on 5 February 2021 (1 a.m.  - 3 a.m.). Apologies for inconvenience caused.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
