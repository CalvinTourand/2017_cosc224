-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 11:37 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VWTMaintenance`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `username` varchar(20) NOT NULL,
  `fName` varchar(20) DEFAULT NULL,
  `lName` varchar(20) DEFAULT NULL,
  `auth` tinyint(4) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`username`, `fName`, `lName`, `auth`, `pass`) VALUES
('Rbustle', 'Russell', 'Bustle', 3, '*D37C49F9CBEFBF8B6F4B165AC703AA271E079004');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `reqID` mediumint(9) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `reqTitle` varchar(40) DEFAULT NULL,
  `priority` tinyint(4) DEFAULT NULL,
  `program` varchar(20) DEFAULT NULL,
  `site` varchar(20) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `reqDate` date DEFAULT NULL,
  `approvalDate` date DEFAULT NULL,
  `completionDate` date DEFAULT NULL,
  `status` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`reqID`, `username`, `reqTitle`, `priority`, `program`, `site`, `description`, `reqDate`, `approvalDate`, `completionDate`, `status`) VALUES
(1, 'Rbustle', 'Junior\'s problems', 4, 'cosc205', 'c288', 'I don\'t know what is wrong, specifically...But something ain\'t right.', '2017-02-03', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`reqID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `reqID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
