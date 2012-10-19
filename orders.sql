-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2012 at 09:37 AM
-- Server version: 5.0.92
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `kPO` int(5) NOT NULL,
  `itemCount` varchar(25) NOT NULL,
  `itemNumber` varchar(25) NOT NULL,
  `itemDescription` text NOT NULL,
  `itemPrice` varchar(25) NOT NULL,
  `itemCategory` varchar(50) default NULL,
  `itemTotal` int(11) NOT NULL,
  `kOrder` int(11) default NULL,
  `kItem` int(5) NOT NULL auto_increment,
  PRIMARY KEY  (`kItem`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=370 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `kPO` int(5) NOT NULL,
  `poDate` date NOT NULL,
  `poOrderMethod` varchar(20) NOT NULL,
  `poPaymentType` varchar(20) NOT NULL,
  `poOrderedBy` varchar(25) default NULL,
  `poBillingContact` varchar(255) default NULL,
  `poCategory` varchar(40) default NULL,
  `poConfirmation` varchar(55) default NULL,
  `poTotal` double default NULL,
  `poShipping` varchar(25) default NULL,
  `poReceived` varchar(10) default NULL COMMENT 'date the order was received',
  `poQuote` varchar(30) default NULL,
  `kOrder` int(11) NOT NULL auto_increment,
  `kVendor` varchar(75) NOT NULL,
  PRIMARY KEY  (`kOrder`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

-- --------------------------------------------------------

--
-- Table structure for table `variable`
--

CREATE TABLE IF NOT EXISTS `variable` (
  `kVariable` int(11) NOT NULL auto_increment,
  `var_category` varchar(55) NOT NULL,
  `var_name` varchar(55) NOT NULL,
  `var_value` varchar(55) NOT NULL,
  PRIMARY KEY  (`kVariable`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `vendorName` varchar(75) NOT NULL,
  `vendorContact` varchar(75) NOT NULL,
  `vendorAddress` text NOT NULL,
  `vendorCityStateZip` varchar(75) NOT NULL,
  `vendorURL` varchar(50) default NULL,
  `vendorPhone` varchar(35) default NULL,
  `vendorFax` varchar(35) default NULL,
  `vendorEmail` varchar(80) default NULL,
  `vendorCustomerID` varchar(65) default NULL COMMENT 'Customer number if required',
  `kVendor` int(5) NOT NULL auto_increment,
  PRIMARY KEY  (`kVendor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
