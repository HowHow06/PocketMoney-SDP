
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `Customer`;
CREATE TABLE IF NOT EXISTS `Customer` (
  `cusID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`cusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Customer` (`username`, `password`, `name`, `email`) VALUES
('customer1', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO','Jerry Cus', 'howard_bb@hotmail.com'),
('customer2', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO','Jerry Two', 'jerry2@mail.com');

-- --------------------------------------------------------

-- `total` decimal(20,2) NOT NULL,
--
-- Table structure for table `FinancialGoal`
--

DROP TABLE IF EXISTS `FinancialGoal`;
CREATE TABLE IF NOT EXISTS `FinancialGoal` (
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
-- Table structure for table `cart_detail`
--

DROP TABLE IF EXISTS `Budget`;
CREATE TABLE IF NOT EXISTS `Budget` (
  `budgetID` int(255) NOT NULL AUTO_INCREMENT,
  `cudID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `percentage` decimal(20,2) NOT NULL,
  PRIMARY KEY (`budgetID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Budget` (`cudID`,`categoryID`,`percentage`) VALUES 
(1, 6, 10), 
(1, 5, 20), 
(1, 9, 10),
(1, 12, 10),
(1, 11, 50); 

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `Transaction`;
CREATE TABLE IF NOT EXISTS `Transaction` (
  `transactionID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Transaction` (`cusID`,`categoryID`,`date`,`amount`,`description`) VALUES 
(1,1,'2020-12-01 10:07:23',10000,NULL),
(1,3,'2020-12-04 10:07:23',5000,NULL), 
(1,2,'2020-12-05 10:07:23',5000,'Hackathon'), 
(1,5,'2020-12-06 10:07:23',10,NULL), 
(1,5,'2020-12-03 10:07:23',100,'NSK'), 
(1,5,'2020-12-25 10:07:23',50,'Christmas Dinner'), 
(1,6,'2020-12-02 10:07:23',20,'Water Bill'),
(1,6,'2020-12-02 10:07:23',50,'Electric'), 
(1,6,'2020-12-05 10:07:23',100,'WiFi'), 
(1,10,'2020-12-05 10:07:23',100,'VKA BlockA1'), 
(1,7,'2020-12-02 10:07:23',30,NULL), 
(1,9,'2020-12-15 10:07:23',3000,NULL),
(1,8,'2020-12-23 10:07:23',200,NULL);


-- --------------------------------------------------------

--
-- Table structure for table `deliverable_postcode`
--

DROP TABLE IF EXISTS `Category`;
CREATE TABLE IF NOT EXISTS `Category` (
  `categoryID` int(255) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryType` varchar(255) NOT NULL,
  `preDefine` tinyint(1) NOT NULL,
  `cusID` int(255),
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverable_postcode`
--
INSERT INTO `Category` (`categoryName`,`categoryType`,`preDefine`,`cusID`) VALUES 
('salary','income',1, NULL),
('awards','income',1, NULL),
('rental','income',1, NULL),
('investment profit','income',1, NULL),
('food','expenses',1, NULL),
('home','expenses',1, NULL),
('transportation','expenses',1, NULL),
('entertainment','expenses',1, NULL),
('investment','expenses',1, NULL),
('courses','expenses',1, NULL),
('saving','budget',1, NULL),
('other','budget',1, NULL),
('house loan','liability',1, NULL),
('car loan','liability',1, NULL),
('personal loan','liability',1, NULL),
('credit card','liability',1, NULL),
('Stock','investment',1, NULL),
('ETF','investment',1, NULL),
('Fixed Deposit','investment',1, NULL),
('announcement','notification',1, NULL),
('feedback','notification',1, NULL),
('question','notification',1, NULL),
('feedback response','notification',1, NULL),
('question response','notification',1, NULL);
-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

DROP TABLE IF EXISTS `AutomatedTransaction`;
CREATE TABLE IF NOT EXISTS `AutomatedTransaction` (
  `aTransactionID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `categoryID` int(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `recordTime` varchar(255) NOT NULL,
  `autoRecord` TINYINT(1) NOT NULL,
  `paymentReminder` TINYINT(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aTransactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `AutomatedTransaction` (`cusID`,`categoryID`,`amount`,`recordTime`,`autoRecord`,`paymentReminder`,`description`) VALUES 
(1,7,30,'{"frequency": "M", "period": "2"}',1,0,NULL), 
(1,6,100,'{"frequency": "M", "period": "5"}',1,1,'WiFi'),
(1,6,50,'{"frequency": "M", "period": "2"}',0,1,'Electric'), 
(1,3,5000,'{"frequency": "M", "period": "4"}',1,1,NULL);



-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `Liability`;
CREATE TABLE IF NOT EXISTS `Liability` (
  `liabilityID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `liabilityName` varchar(255) DEFAULT NULL,
  `liabilityType` varchar(255) NOT NULL,
  `startDate` date,
  `totalAmountToPay` decimal(20,2),
  `totalMonths` int(255) DEFAULT NULL,
  `paymentTime` varchar(255) DEFAULT NULL,
  `amountEachPayment` decimal(20,2) DEFAULT NULL,
  `paymentReminder` TINYINT(1) DEFAULT NULL,
  `autoRecord` TINYINT(1)DEFAULT NULL,
  PRIMARY KEY (`liabilityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `Liability` (`cusID`,`liabilityName`,`liabilityType`,`startDate`,`totalAmountToPay`,`totalMonths`,`paymentTime`,`amountEachPayment`,`paymentReminder`,`autoRecord`) VALUES 
(1, 'VKA BlockA1', 'house loan', '2020-01-23', 550000, 240, '{"frequency": "M", "period": "5"}',1388.89,1,1),
(1, 'CIMB', 'credit card', '2020-12-20', 200, 1, '{"frequency": "M", "period": "6"}',200,1,0),
(1, 'Maybank', 'credit card', '2020-12-20', 5000, NULL,NULL,NULL,1,0),
(1, 'MYVI 1M4U', 'car loan', '2020-12-20', 80000, 60, '{"frequency": "M", "period": "2"}',1000,1,0),
(1, 'Jerry', 'personal loan', '2020-10-01', 1000, NULL, NULL,NULL,1,0),
(1, 'From Samuel', 'personal loan', '2020-07-01', 1000, NULL, NULL,NULL,1,0);

DROP TABLE IF EXISTS `DebtPayment`;
CREATE TABLE IF NOT EXISTS `DebtPayment` (
  `paymentID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `liabilityID` int(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `paymentdate` date NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `DebtPayment` (`cusID`,`liabilityID`,`amount`,`paymentDate`) VALUES 
(1, 1, 5000,'2020-01-23'),
(1, 3, 2000,'2020-12-20'),
(1, 4, 20000,'2020-12-20'),
(1, 6, 200,'2020-10-20'),
(1, 6, 300,'2020-11-20'),
(1, 6, 500,'2020-12-20');



-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

DROP TABLE IF EXISTS `Investment`;
CREATE TABLE IF NOT EXISTS `Investment` (
  `investmentID` int(255) NOT NULL AUTO_INCREMENT,
  `cusID` int(255) NOT NULL,
  `investmentName` varchar(255) DEFAULT NULL,
  `investmentType` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `amountInvested` decimal(20,2) NOT NULL,
  `ratePerAnnum` decimal(20,2) NOT NULL,
  PRIMARY KEY (`investmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Investment` (`cusID`,`investmentName`,`investmentType`,`startDate`,`amountInvested`,`ratePerAnnum`) VALUES 
(1, 'Microsoft','Stock', '2020-09-05', 1000, 20.0),
(1, 'Microsoft','Stock', '2020-10-05', 500, 20.0),
(1, 'Microsoft','Stock', '2020-11-05', 800, 20.0),
(1, 'AMD','Stock', '2020-10-05', 900, 30.0),
(1, 'AMD','Stock', '2020-12-05', 1000, 30.0),
(1, 'SPY','ETF', '2020-09-05', 2000, 15.0),
(1, 'VOO','ETF', '2020-08-05', 1500, 13.0),
(1, 'CIMB FD','Fixed Deposit', '2020-05-05', 10000, 2.4);


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `Notification`;
CREATE TABLE IF NOT EXISTS `Notification` (
  `notificationID` int(255) NOT NULL AUTO_INCREMENT,
  `senderID` int(255),
  `receiver` decimal(10,2),
  `date` datetime NOT NULL,
  `content` varchar(255),
  `notificationType` varchar(255),
  `receiverCusID` int(255),
  PRIMARY KEY (`notificationID`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--
-- --------------------------------------------------------

--
-- Table structure for table `order_cancel_request`
--

DROP TABLE IF EXISTS `Admin`;
CREATE TABLE IF NOT EXISTS `Admin` (
  `adminID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Admin` (`username`,`password`,`email`) VALUES 
('admin1','$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.','howard_bb@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `Advisor`;
CREATE TABLE IF NOT EXISTS `Advisor` (
  `advisorID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Advisor`(`username`,`password`,`name`,`email`) VALUES
('advisor1','$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.','Dacin Wong','advisor1@mail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
