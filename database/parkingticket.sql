-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2015 at 12:38 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parkingticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `alertpreferances`
--

CREATE TABLE IF NOT EXISTS `alertpreferances` (
  `AlertpreferancesID` int(11) NOT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `updatetime` datetime DEFAULT '0000-00-00 00:00:00',
  `sendalert` tinyint(1) DEFAULT NULL,
  `user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`AlertpreferancesID`,`user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `AlertsID` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`AlertsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alertshistory`
--

CREATE TABLE IF NOT EXISTS `alertshistory` (
  `AlertsHistoryID` int(11) NOT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `alerts_alertsID` int(11) NOT NULL,
  `alertpreferances_alertpreferancesID` int(11) NOT NULL,
  `alertpreferances_user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`AlertsHistoryID`,`alerts_alertsID`,`alertpreferances_alertpreferancesID`,`alertpreferances_user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contestletter`
--

CREATE TABLE IF NOT EXISTS `contestletter` (
  `ContestLetterID` int(11) NOT NULL,
  `contestLettercopy` varchar(45) DEFAULT NULL,
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `sentdate` date DEFAULT NULL,
  `evidance_evidanceID` int(11) NOT NULL,
  `evidance_user_UserID` bigint(15) NOT NULL,
  `defense_DefenseID` int(11) NOT NULL,
  PRIMARY KEY (`ContestLetterID`,`evidance_evidanceID`,`evidance_user_UserID`,`defense_DefenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `defense`
--

CREATE TABLE IF NOT EXISTS `defense` (
  `DefenseID` int(11) NOT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `description` varchar(45) DEFAULT NULL,
  `details` varchar(45) DEFAULT NULL,
  `copyversion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`DefenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evidance`
--

CREATE TABLE IF NOT EXISTS `evidance` (
  `EvidanceID` int(11) NOT NULL,
  `evidancetype` varchar(45) DEFAULT NULL,
  `user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`EvidanceID`,`user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learningtable`
--

CREATE TABLE IF NOT EXISTS `learningtable` (
  `LearningtableID` int(11) NOT NULL,
  `letter` varchar(15) DEFAULT NULL,
  `sample` blob,
  `photo_photoid` int(11) NOT NULL,
  `photo_evidance_evidanceID` int(11) NOT NULL,
  `tickets_officerID` varchar(45) NOT NULL,
  PRIMARY KEY (`LearningtableID`,`photo_photoid`,`photo_evidance_evidanceID`,`tickets_officerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentplan`
--

CREATE TABLE IF NOT EXISTS `paymentplan` (
  `PlanID` int(11) NOT NULL,
  `creationtime` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `transActions_transationID` int(11) NOT NULL,
  `paymentmade` tinyint(1) DEFAULT NULL,
  `totalpaymentplan` varchar(45) DEFAULT NULL,
  `paymentenddate` varchar(45) DEFAULT NULL,
  `user_UserID` bigint(15) NOT NULL,
  `tickets_ticket_id` int(11) NOT NULL,
  `tickets_plates_plateNumber` varchar(45) NOT NULL,
  PRIMARY KEY (`PlanID`,`user_UserID`,`tickets_ticket_id`,`tickets_plates_plateNumber`,`transActions_transationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentplan_has_transactions`
--

CREATE TABLE IF NOT EXISTS `paymentplan_has_transactions` (
  `paymentplan_planID` int(11) NOT NULL,
  `transActions_transationID` int(11) NOT NULL,
  `transActions_paymentAccounts_user_UserID` bigint(15) NOT NULL,
  `transActions_paymentAccounts_paymentAccountID` bigint(15) NOT NULL,
  PRIMARY KEY (`paymentplan_planID`,`transActions_transationID`,`transActions_paymentAccounts_user_UserID`,`transActions_paymentAccounts_paymentAccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_accounts`
--

CREATE TABLE IF NOT EXISTS `payment_accounts` (
  `PaymentaccountID` bigint(15) NOT NULL,
  `user_UserID` bigint(15) NOT NULL,
  `nickName` varchar(45) DEFAULT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `updatetime` datetime DEFAULT '0000-00-00 00:00:00',
  `accounttype` varchar(45) DEFAULT NULL,
  `accountnumber` varchar(45) DEFAULT NULL,
  `routingnumber` varchar(45) DEFAULT NULL,
  `experationdate` datetime NOT NULL,
  PRIMARY KEY (`user_UserID`,`PaymentaccountID`,`experationdate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `PermissionID` int(11) NOT NULL AUTO_INCREMENT,
  `PermissionGroup` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`PermissionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES
(1, 1, 'View', 'View all the roles'),
(2, 1, 'Add', 'Add new role'),
(3, 1, 'Edit', 'Edit Role'),
(4, 1, 'Delete', 'Delete Role'),
(5, 2, 'View', 'View all users'),
(6, 2, 'Add', 'Add new user'),
(7, 2, 'Edit', 'Edit existing user'),
(8, 2, 'Delete', 'Delete existing user(s)');

-- --------------------------------------------------------

--
-- Table structure for table `permission_group`
--

CREATE TABLE IF NOT EXISTS `permission_group` (
  `PermissionGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(250) NOT NULL,
  PRIMARY KEY (`PermissionGroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `permission_group`
--

INSERT INTO `permission_group` (`PermissionGroupID`, `GroupName`) VALUES
(1, 'Role'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `Photoid` int(11) NOT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `title` varchar(45) DEFAULT NULL,
  `desctiption` varchar(45) DEFAULT NULL,
  `data` tinyblob,
  `evidance_evidanceID` int(11) NOT NULL,
  `Xcoordinate` decimal(10,0) DEFAULT NULL,
  `Ycoordinate` decimal(10,0) DEFAULT NULL,
  `Vehicles_VehicleID` int(11) NOT NULL,
  `Vehicles_user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`Photoid`,`evidance_evidanceID`,`Vehicles_VehicleID`,`Vehicles_user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plates`
--

CREATE TABLE IF NOT EXISTS `plates` (
  `PlateID` bigint(15) NOT NULL,
  `platenumber` varchar(25) NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` varchar(45) DEFAULT NULL,
  `plateTypes_plateTypesID` int(11) NOT NULL,
  `plateexperation` datetime DEFAULT '0000-00-00 00:00:00',
  `registeredname` varchar(45) DEFAULT NULL,
  `hasSticker` tinyint(1) DEFAULT NULL,
  `stickerExperation` datetime DEFAULT '0000-00-00 00:00:00',
  `Vehicles_vehicleID` int(11) NOT NULL,
  `Vehicles_user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`PlateID`,`platenumber`,`plateTypes_plateTypesID`,`Vehicles_vehicleID`,`Vehicles_user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `platetypes`
--

CREATE TABLE IF NOT EXISTS `platetypes` (
  `PlatetypesID` int(11) NOT NULL,
  `platetype` varchar(45) DEFAULT NULL,
  `platetypesdesc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`PlatetypesID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `RoleStatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `name`, `description`, `RoleStatus`) VALUES
(14, 'Admin', 'zsdfsdfasd', 0),
(15, 'Admin', 'afadsfasdfa', 0),
(16, 'Admin', 'Dafasdfasdfasd', 0),
(17, 'Super Admin', 'Super Admin', 0),
(18, 'Admin', 'attr ', 0),
(19, '', '', 1),
(20, 'Samoj', 'This is samoj', 0),
(21, 'Admin', 'Test', 1),
(22, 'Administrator', 'asdfasdfasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permission`
--

CREATE TABLE IF NOT EXISTS `role_has_permission` (
  `Role_roleID` int(11) NOT NULL,
  `permission_permissionID` int(11) NOT NULL,
  PRIMARY KEY (`Role_roleID`,`permission_permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_has_permission`
--

INSERT INTO `role_has_permission` (`Role_roleID`, `permission_permissionID`) VALUES
(16, 4),
(16, 8),
(17, 1),
(17, 3),
(17, 6),
(17, 8),
(18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `role_member`
--

CREATE TABLE IF NOT EXISTS `role_member` (
  `Role_roleID` int(11) NOT NULL,
  `user_UserID` bigint(15) NOT NULL,
  PRIMARY KEY (`Role_roleID`,`user_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `TicketID` int(11) NOT NULL,
  `Ticketnumber` int(11) NOT NULL,
  `issueddatetime` datetime DEFAULT '0000-00-00 00:00:00',
  `platetype` varchar(45) DEFAULT NULL,
  `violationcode` varchar(45) DEFAULT NULL,
  `officerID` varchar(45) NOT NULL,
  `amount` float DEFAULT NULL,
  `initialduedate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'initial due date should be a trigger 21 days > issued date',
  `currentduedate` datetime DEFAULT '0000-00-00 00:00:00',
  `status` varchar(15) DEFAULT NULL,
  `plates_Vehicles_user_UserID` bigint(15) NOT NULL,
  `plates_platenumber` varchar(45) NOT NULL,
  `hearingdate` datetime DEFAULT '0000-00-00 00:00:00',
  `violationCodes_violationCode` varchar(45) NOT NULL,
  `Xcoordinates` float DEFAULT NULL,
  `Ycoordinates` float DEFAULT NULL,
  PRIMARY KEY (`TicketID`,`Ticketnumber`,`officerID`,`plates_Vehicles_user_UserID`,`plates_platenumber`,`violationCodes_violationCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticketsgeolayer`
--

CREATE TABLE IF NOT EXISTS `ticketsgeolayer` (
  `TicketsgeolayerID` int(11) NOT NULL,
  `ward` int(11) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `6blockradius` decimal(10,0) DEFAULT NULL,
  `fineamount` float DEFAULT NULL,
  `tickets_ticketNumber` int(11) NOT NULL,
  `Xcoordrinates` float DEFAULT NULL,
  `Ycoordrinates` float DEFAULT NULL,
  PRIMARY KEY (`TicketsgeolayerID`,`tickets_ticketNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_has_evidance`
--

CREATE TABLE IF NOT EXISTS `tickets_has_evidance` (
  `tickets_ticket_id` int(11) NOT NULL,
  `tickets_plates_Vehicles_user_UserID` bigint(15) NOT NULL,
  `tickets_plates_plateNumber` varchar(45) NOT NULL,
  `evidance_evidanceID` int(11) NOT NULL,
  PRIMARY KEY (`tickets_ticket_id`,`tickets_plates_Vehicles_user_UserID`,`tickets_plates_plateNumber`,`evidance_evidanceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `TransationID` int(11) NOT NULL,
  `transactiontype` varchar(45) DEFAULT NULL,
  `creationtime` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `amount` float DEFAULT NULL,
  `paymentAccounts_user_UserID` bigint(15) NOT NULL,
  `paymentAccounts_paymentAccountID` bigint(15) NOT NULL,
  PRIMARY KEY (`TransationID`,`paymentAccounts_user_UserID`,`paymentAccounts_paymentAccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` bigint(15) NOT NULL AUTO_INCREMENT,
  `creationtime` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `firstname` varchar(35) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `signatureimage` blob,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `creationtime`, `firstname`, `lastname`, `username`, `email`, `password`, `signatureimage`) VALUES
(2, '2015-04-07 18:15:00', 'John', 'Doe', 'johndoe', 'johndoe@gmail.com', 'johndoe', NULL),
(3, '2015-04-07 18:15:00', 'Samoj', 'Bhattarai', 'samojbhattarai', 'samojbhattarai@gmail.com', 'samoj123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehiclelocation`
--

CREATE TABLE IF NOT EXISTS `vehiclelocation` (
  `Vehiclelocationid` int(11) NOT NULL,
  `creationtime` datetime DEFAULT '0000-00-00 00:00:00',
  `Xcoordinates` decimal(10,0) DEFAULT NULL,
  `ycoordinates` decimal(10,0) DEFAULT NULL,
  `evidance_evidanceID` int(11) NOT NULL,
  PRIMARY KEY (`Vehiclelocationid`,`evidance_evidanceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemake`
--

CREATE TABLE IF NOT EXISTS `vehiclemake` (
  `VehiclemakeID` int(11) NOT NULL,
  `vehiclemake` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`VehiclemakeID`,`vehiclemake`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `VehicleID` int(11) NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nickName` varchar(45) DEFAULT NULL,
  `VIN` varchar(20) DEFAULT NULL,
  `user_UserID` bigint(15) NOT NULL,
  `vehicleMake_vehicleMake` varchar(45) NOT NULL,
  PRIMARY KEY (`VehicleID`,`user_UserID`,`vehicleMake_vehicleMake`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `violationcodes`
--

CREATE TABLE IF NOT EXISTS `violationcodes` (
  `ViolationCodesID` int(11) NOT NULL,
  `creationime` datetime DEFAULT '0000-00-00 00:00:00',
  `violationCode` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `fine` float DEFAULT NULL,
  `expandedviolationcode` varchar(45) DEFAULT NULL,
  `details` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ViolationCodesID`,`violationCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `violationcodes_has_defense`
--

CREATE TABLE IF NOT EXISTS `violationcodes_has_defense` (
  `violationCodes_violationCodesID` int(11) NOT NULL,
  `violationCodes_violationCode` varchar(45) NOT NULL,
  `Defense_DefenseID` int(11) NOT NULL,
  PRIMARY KEY (`violationCodes_violationCodesID`,`violationCodes_violationCode`,`Defense_DefenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
