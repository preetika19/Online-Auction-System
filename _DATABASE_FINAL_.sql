-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 04, 2021 at 02:39 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`member_ID`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `aggregate_bids`
-- (See below for the actual view)
--
CREATE TABLE `aggregate_bids` (
`seller_ID` int(11)
,`buyer_ID` int(11)
,`COUNT(item_ID)` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `aggregate_items`
-- (See below for the actual view)
--
CREATE TABLE `aggregate_items` (
`seller_ID` int(11)
,`COUNT(item_ID)` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `buyer_ID` int(11) NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `bidPlacedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bidStatus` tinyint(1) NOT NULL,
  `bidPrice` float NOT NULL,
  `bidIncrement` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`buyer_ID`, `seller_ID`, `item_ID`, `bidPlacedTime`, `bidStatus`, `bidPrice`, `bidIncrement`) VALUES
(5, 4, 1, '2021-12-01 02:23:57', 1, 11, 0),
(5, 7, 2, '2021-10-27 16:06:39', 0, 2, 0),
(5, 9, 3, '2021-10-27 16:06:39', 0, 15, 2),
(6, 4, 1, '2021-10-27 16:06:39', 0, 10, 0),
(6, 7, 2, '2021-10-27 16:06:39', 1, 30, 2),
(8, 10, 4, '2021-10-27 16:06:39', 1, 5, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `member_ID` int(11) NOT NULL,
  `shippingAddress` varchar(60) NOT NULL,
  `creditCardNum` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`member_ID`, `shippingAddress`, `creditCardNum`) VALUES
(5, '8247 Harvey Street Dalton, GA 30721', '4024007168857752'),
(6, '537 Fairground Court Lanham, MD 20706', '5340452481493006'),
(8, '13 Berkshire Lane Gwynn Oak, MD 21207', '6011621658094971');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `reviewer_ID` int(11) NOT NULL,
  `reviewee_ID` int(11) NOT NULL,
  `Item` int(11) NOT NULL,
  `rating` float NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`reviewer_ID`, `reviewee_ID`, `Item`, `rating`, `message`) VALUES
(5, 4, 1, 1, 'ad,fjkans,df'),
(6, 7, 2, 3, 'Not very happy with the item, it arrived poorly packed'),
(8, 9, 3, 5, 'Excellent! Very happy with my purchase');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `startingBidPrice` int(11) NOT NULL,
  `description` text NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(30) NOT NULL,
  `itemTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `seller_ID`, `startingBidPrice`, `description`, `startDate`, `endDate`, `category`, `itemTitle`) VALUES
(1, 4, 2, '2Pcs Vinyl Pokemon Stickers', '2021-12-15 06:00:00', '2021-12-30 06:00:00', 'Stationary', 'Stickers'),
(2, 7, 400, 'NEW:Unused, unopened, and undamaged Animal Crossing Edition Nintendo Switch console', '2020-01-10 18:40:30', '2021-12-22 06:00:00', 'Electronics', 'Nintendo Switch Console'),
(3, 9, 61, 'OPTICAL DL GLASS', '2019-10-10 13:21:36', '2022-11-12 06:00:00', 'Photography&Video', 'WIDE ANGLE + MACRO LENS'),
(4, 10, 230, '2\" elevated white pet food and water bowls.', '2019-09-19 15:41:36', '2019-10-19 05:00:00', 'Pets', '2pcs Elevated Cat Bowls');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_ID` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `homeAddress` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_ID`, `password`, `email`, `name`, `phoneNumber`, `homeAddress`) VALUES
(1, 'aaron_parker', 'aaron_parker23@gmail.com', 'Aaron Parker', '4076147198', '822 Oak Ave.\r\nYakima, WA 98908'),
(2, 'shannon_marsh', 'shannon_marsh54@yahoo.com', 'Shannon Marsh', '9788685889', '7 Greystone Avenue\r\nWaterbury, CT 06705'),
(3, 'patsy_beck', 'patsy_beck67@gmail.com', 'Patsy Beck', '7139037400', '16 Greenview Rd.\r\nVincentown, NJ 08088'),
(4, 'ricardo_kelly', 'ricardo_kelly12@gmail.com', 'Ricardo Kelly', '6312091617', '706 E. Oak Rd.\r\nErlanger, KY 41018'),
(5, 'jaime_castillo', 'jaime_castillo32@gmail.com', 'Jaime Castillo', '2673504056', '8247 Harvey Street\r\nDalton, GA 30721'),
(6, 'heidi_ellis', 'heidi_ellis99@hotmail.com', 'Heidi Ellis', '8054712064', '537 Fairground Court\r\nLanham, MD 20706'),
(7, 'lamar_sims', 'lamar_sims10@yahoo.com', 'Lamar Sims', '8285812939', '9943 Saxton St.\r\nSouth Windsor, CT 06074'),
(8, 'mabel_alvarez', 'mabel_alvarez88@hotmail.com', 'Mabel Alvarez', '2676713814', '13 Berkshire Lane\r\nGwynn Oak, MD 21207'),
(9, 'blanche_long', 'blanche_long44@yahoo.com', 'Blanche Long', '7813301387', '90 Third Rd.\r\nTullahoma, TN 37388'),
(10, 'meghan_reed', 'meghan_reed39@gmail.com', 'Meghan Reed', '4254428163', '26 Pilgrim Street\r\nSouthington, CT 06489');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `member_ID` int(11) NOT NULL,
  `bankAccountNum` varchar(12) NOT NULL,
  `routingNum` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`member_ID`, `bankAccountNum`, `routingNum`) VALUES
(4, '87718369', '733691427'),
(7, '70150035', '488352888'),
(9, '65765762', '918991638'),
(10, '38787253', '058019205');

-- --------------------------------------------------------

--
-- Structure for view `aggregate_bids`
--
DROP TABLE IF EXISTS `aggregate_bids`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aggregate_bids`  AS SELECT `bids`.`seller_ID` AS `seller_ID`, `bids`.`buyer_ID` AS `buyer_ID`, count(`bids`.`item_ID`) AS `COUNT(item_ID)` FROM `bids` GROUP BY `bids`.`seller_ID`, `bids`.`buyer_ID` ;

-- --------------------------------------------------------

--
-- Structure for view `aggregate_items`
--
DROP TABLE IF EXISTS `aggregate_items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aggregate_items`  AS SELECT `items`.`seller_ID` AS `seller_ID`, count(`items`.`item_ID`) AS `COUNT(item_ID)` FROM `items` GROUP BY `items`.`seller_ID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`member_ID`),
  ADD KEY `FK_admin` (`member_ID`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`buyer_ID`,`seller_ID`,`item_ID`,`bidPlacedTime`),
  ADD KEY `FK_bids-seller` (`seller_ID`),
  ADD KEY `FK_bids-item` (`item_ID`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`member_ID`),
  ADD KEY `FK_Buyer` (`member_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`reviewer_ID`,`reviewee_ID`),
  ADD KEY `FK_feedback-reviewee` (`reviewee_ID`),
  ADD KEY `Item` (`Item`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `FK_item` (`seller_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_ID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`member_ID`),
  ADD KEY `FK_seller` (`member_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`member_ID`) REFERENCES `member` (`member_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `FK_bids-buyer` FOREIGN KEY (`buyer_ID`) REFERENCES `buyer` (`member_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bids-item` FOREIGN KEY (`item_ID`) REFERENCES `items` (`item_ID`),
  ADD CONSTRAINT `FK_bids-seller` FOREIGN KEY (`seller_ID`) REFERENCES `seller` (`member_ID`);

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `FK_Buyer` FOREIGN KEY (`member_ID`) REFERENCES `member` (`member_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_feedback-Item` FOREIGN KEY (`Item`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_feedback-reviewee` FOREIGN KEY (`reviewee_ID`) REFERENCES `seller` (`member_ID`),
  ADD CONSTRAINT `FK_feedback-reviewer` FOREIGN KEY (`reviewer_ID`) REFERENCES `buyer` (`member_ID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_item` FOREIGN KEY (`seller_ID`) REFERENCES `member` (`member_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `FK_seller` FOREIGN KEY (`member_ID`) REFERENCES `member` (`member_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
