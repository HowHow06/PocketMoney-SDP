INSERT INTO `Customer` (`username`, `password`, `name`, `email`) VALUES
('customer1', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO','Jerry Cus', 'howard_bb@hotmail.com'),
('customer2', '$2y$10$NQ3t1EhKqJuL0g11iX6N.OnrVMKU1cJW7emwy3uYqMADE8J4ggelO','Jerry Two', 'jerry2@mail.com');


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
('credit card','liability',1, NULL),
('Stock','investment',1, NULL),
('ETF','investment',1, NULL),
('Fixed Deposit','investment',1, NULL),
('announcement','notification',1, NULL),
('feedback','notification',1, NULL),
('question','notification',1, NULL),
('feedback response','notification',1, NULL),
('question response','notification',1, NULL);
-- 1-> Salary, income
-- 2	Awards, income
-- 3	Rental, income
-- 4	Investment Profit, income
-- 5	food, expenses
-- 6	home, expenses
-- 7	transportation, expenses
-- 8	entertainment, expenses
-- 9	investment, expenses (for budget also)
-- 10	liability, expenses
-- 11	saving, budget 
-- 12	other, budget <-for budget, not a must in plan, but might display for budget status, is basically general expenses
-- 13	house loan, liability
-- 14	car loan, liability 
-- 15	credit card, liability 
-- 16	stock, investment
-- 17	ETF, investment 
-- 18	Fixed Deposit,investment
-- 19	announcement, notification 
-- 20	feedback, notification 
-- 21	question, notifcation 
-- 22	feedback response, notification 
-- 23	question response, notification


INSERT INTO `Budget` (`cudID`,`categoryID`,`percentage`) VALUES 
(1, 6, 10), --home
(1, 5, 20), -- food
(1, 9, 10), -- investment
(1, 12, 10), --other budget
(1, 11, 50); --saving budget


INSERT INTO `Transaction` (`cusID`,`categoryID`,`date`,`amount`,`description`) VALUES 
(1,1,'2020-12-01 10:07:23',10000,NULL),--salary income +RM10000
(1,3,'2020-12-04 10:07:23',5000,NULL), --rental +RM5000
(1,2,'2020-12-05 10:07:23',5000,'Hackathon'), --awardS +RM5000
(1,5,'2020-12-06 10:07:23',10,NULL), --food -RM10
(1,5,'2020-12-03 10:07:23',100,'NSK'), --food -RM100
(1,5,'2020-12-25 10:07:23',50,'Christmas Dinner'), --food -RM50
(1,6,'2020-12-02 10:07:23',20,'Water Bill'), --home -RM20
(1,6,'2020-12-02 10:07:23',50,'Electric'), --home -RM50
(1,6,'2020-12-05 10:07:23',100,'WiFi'), --home RM100
(1,10,'2020-12-05 10:07:23',100,'VKA BlockA1'), --liability RM100
(1,7,'2020-12-02 10:07:23',30,NULL), --transportation -RM30
(1,9,'2020-12-15 10:07:23',3000,NULL), --investment -RM3000
(1,8,'2020-12-23 10:07:23',200,NULL);  --entertainment -RM200


INSERT INTO `AutomatedTransaction` (`cusID`,`categoryID`,`amount`,`recordTime`,`autoRecord`,`paymentReminder`,`description`) VALUES 
(1,7,30,'{"frequency": "M", "period": "2"}',1,0,NULL), --transportation, autorecord, no remind
(1,6,100,'{"frequency": "M", "period": "5"}',1,1,'WiFi'), --Wifi ,autorecord, remind
(1,6,50,'{"frequency": "M", "period": "2"}',0,1,'Electric'), --Electric, no autorecord, remind
(1,3,5000,'{"frequency": "M", "period": "4"}',1,1,NULL); --Rental, autorecord,remind

INSERT INTO `Liability` (`cusID`,`liabilityName`,`liabilityType`,`startDate`,`totalAmountToPay`,`totalMonths`,`paymentTime`,`amountEachPayment`,`amountPaid`,`paymentReminder`,`autoRecord`) VALUES 
(1, 'VKA BlockA1', 'house loan', '2020-01-23', 550000, 240, '{"frequency": "M", "period": "5"}',1388.89,5000,1,1), --house loan , auto record and reminder
(1, NULL, 'credit card', '2020-12-20', 200, 1, '{"frequency": "M", "period": "6"}',200,0,1,0);  --credit card pay at next month 6, no autorecord, reminder


INSERT INTO `Investment` (`cusID`,`investmentName`,`investmentType`,`startDate`,`amountInvested`,`ratePerAnnum`) VALUES 
(1, 'Microsoft','Stock', '2020-09-05', 1000, 20.0),
(1, 'Microsoft','Stock', '2020-10-05', 500, 20.0),
(1, 'Microsoft','Stock', '2020-11-05', 800, 20.0),
(1, 'AMD','Stock', '2020-10-05', 900, 30.0),
(1, 'AMD','Stock', '2020-12-05', 1000, 30.0),
(1, 'SPY','ETF', '2020-09-05', 2000, 15.0),
(1, 'VOO','ETF', '2020-08-05', 1500, 13.0),
(1, 'CIMB FD','Fixed Deposit', '2020-05-05', 10000, 2.4);


INSERT INTO `Admin` (`username`,`password`,`email`) VALUES 
('admin1','$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.','howard_bb@hotmail.com');


INSERT INTO `Advisor`(`username`,`password`,`name`,`email`) VALUES --password is admin
('advisor1','$2y$10$sk3.6iF6nXtMEzV/ClwA4uYMJ7iTwe93H/zJ9qONEnNsyGtWcHYh.','Dacin Wong','advisor1@mail.com');


-- INSERT INTO `FinancialGoal`(`cusID`,`currentSaving`,`incomePerAnnum`,`expensePerAnnum`,`goalAmount`,`totalAsset`,`totalLiability`,`netWorth`,`yearNeeded`) VALUES
-- ();

-- INSERT INTO `Notification` (`senderID`,`receiver`,`date`,`content`,`notificationType`,`receiverCusID`) VALUES 
-- ();




