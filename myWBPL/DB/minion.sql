-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2014 at 01:45 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minion`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaction`
--

CREATE TABLE IF NOT EXISTS `detailtransaction` (
  `transactionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`transactionID`,`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailtransaction`
--

INSERT INTO `detailtransaction` (`transactionID`, `productID`, `qty`) VALUES
(1, 4, 4),
(1, 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `headertransaction`
--

CREATE TABLE IF NOT EXISTS `headertransaction` (
  `transactionID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headertransaction`
--

INSERT INTO `headertransaction` (`transactionID`, `username`, `date`, `status`) VALUES
(1, 'asd', '0000-00-00 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `msproduct`
--

CREATE TABLE IF NOT EXISTS `msproduct` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productType` varchar(20) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productStock` int(11) NOT NULL,
  `productDesc` varchar(160) NOT NULL,
  `productImage` varchar(50) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `msproduct`
--

INSERT INTO `msproduct` (`productID`, `productType`, `productName`, `productPrice`, `productStock`, `productDesc`, `productImage`) VALUES
(1, 'Besi', 'zaii', 150000, 0, 'Barbel terbuat dari besi', 'logowbpl.png'),
(3, 'Besi', 'Barbel', 150000, 150, 'Barbel terbuat dari besi', 'logowbpl.png'),
(4, 'Plastik', 'Barbel', 150000, 150, 'Barbel terbuat dari besi', 'logowbpl.png'),
(5, 'Besi', 'Barbel', 150000, 150, 'Barbel terbuat dari besi', 'logowbpl.png'),
(6, 'Besi', 'Barbel', 150000, 150, 'Barbel terbuat dari besi', 'logowbpl.png'),
(7, 'Besi', 'Barbel', 150000, 150, 'Barbel terbuat dari besi', 'logowbpl.png'),
(8, 'Besi', 'Barbel murah', 50000, 50, 'barbel 5 kg', 'Barbel Murah.jpg'),
(9, 'Plastik', 'Minion Barbel', 100000, 500, 'Terbuat dari minion 10kg', 'Minion Barbel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mstestimoni`
--

CREATE TABLE IF NOT EXISTS `mstestimoni` (
  `testimoniID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `message` varchar(160) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`testimoniID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mstestimoni`
--

INSERT INTO `mstestimoni` (`testimoniID`, `username`, `message`, `date`) VALUES
(2, 'admin', 'Please write your testimonial here.', '2014-04-01 03:10:16'),
(3, 'asd', 'Wah mantap', '2014-06-01 15:08:18'),
(4, 'akuasd', 'wahhh, mantapp', '2014-06-01 15:08:18'),
(5, 'asd', 'asdasdasd', '2014-06-01 15:43:54'),
(7, 'asd', 'Bagus sekali', '2014-06-01 15:44:29'),
(8, 'asd', 'coba lagi', '2014-06-01 15:44:57'),
(9, 'denyst77', 'Mantep nih', '2014-06-01 20:41:23'),
(10, 'akuasd', 'abcdefghijkl', '2014-06-01 22:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE IF NOT EXISTS `msuser` (
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`first_name`, `last_name`, `username`, `password`, `gender`, `address`, `phone`, `email`, `image`, `role`) VALUES
('Shina', 'Mashiro', 'akuasd', 'asd', 'Female', 'Chiba Street', 11155852, 'gemini@minionfitnes.com', 'akuasd.gif', 'admin'),
('Deny', 'Seti', 'denyst77', '123456', 'Male', 'cilincing raya Street ', 2147483647, 'deny@yahoo.com', 'denyst77.jpg', 'member'),
('limaribu', 'rupiah', 'limaribu', 'e10adc3949ba59abbe56', 'Male', 'jalan dprd Street ', 123456789, 'limaribu@dpr.com', 'limaribu.jpg', 'member'),
('Minnie', 'Mouse', 'minnieajah', 'minniemouse', 'Female', 'dysney castle Street ', 654321, 'minnie@yahoo.com', 'minnieajah.jpg', 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
