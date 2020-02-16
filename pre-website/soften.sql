-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 11:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soften`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `cname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cdetail` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cdetail`) VALUES
(0, 'Undefined', ''),
(1, 'Smartphone', ''),
(2, 'Laptop', ''),
(3, 'Drone', ''),
(4, 'Tablet', ''),
(5, 'GoPro', '');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(10) DEFAULT '0',
  `lid` int(10) DEFAULT '1',
  `equipment_type` enum('Portable','Unportable','Undefined','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Undefined',
  `equipment_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No name',
  `equipment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'สามารถยืมได้',
  `equipment_image` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no_image.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `cid`, `lid`, `equipment_type`, `equipment_name`, `equipment_status`, `equipment_image`) VALUES
('LAP1', 2, 1, 'Portable', 'HP Pavilion G4', 'สามารถยืมได้', 'LAP1.jpg'),
('PC1', 0, 1, 'Unportable', 'HP Pro Desk', 'สามารถยืมได้', 'no_image.jpeg'),
('PH1', 1, 1, 'Portable', 'Iphone 6', 'สามารถยืมได้', 'PH1.jpeg'),
('PH2', 1, 2, 'Portable', 'Iphone 6', 'ถูกยืม', 'PH2.jpeg'),
('PH3', 1, 1, 'Portable', 'Iphone 6', 'สามารถยืมได้', 'PH3.jpeg'),
('PH4', 1, 2, 'Portable', 'Iphone 6', 'ถูกยืม', 'PH4.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lid` int(10) NOT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lid`, `lname`) VALUES
(1, 'ห้องเก็บของ'),
(2, 'อยู่กับผู้ยืม');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equip_cid_fk` (`cid`),
  ADD KEY `equip_lid_fk` (`lid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equip_cid_fk` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `equip_lid_fk` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
