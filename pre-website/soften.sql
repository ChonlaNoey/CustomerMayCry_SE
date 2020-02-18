-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2020 at 11:09 AM
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
  `prefix` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `cname_tha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cname_eng` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cdetail_tha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cdetail_eng` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `prefix`, `cname_tha`, `cname_eng`, `cdetail_tha`, `cdetail_eng`) VALUES
(0, 'UND', 'ไม่ได้ระบุ', 'Undefined', '', ''),
(1, 'SPH', 'สมาร์ทโฟน', 'Smartphone', '', ''),
(2, 'LAP', 'แล็ปท็อป', 'Laptop', '', ''),
(3, 'DR', 'โดรน', 'Drone', '', ''),
(4, 'TAB', 'แท็บเล็ต', 'Tablet', '', ''),
(5, 'GP', 'กล้องโกโปร', 'GoPro', '', ''),
(6, 'PC', 'คอมพิวเตอร์', 'PC', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `eid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(10) DEFAULT '0',
  `lid` int(10) DEFAULT '1',
  `sid` int(10) DEFAULT '1',
  `equipment_type` enum('Portable','Unportable','Undefined','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Undefined',
  `ename_eng` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No name',
  `ename_tha` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ไม่มีชื่อ',
  `equipment_image` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no_image.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lid` int(10) NOT NULL,
  `lname_tha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lname_eng` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lid`, `lname_tha`, `lname_eng`) VALUES
(1, 'ห้องเก็บของ', ''),
(2, 'อยู่กับผู้ยืม', ''),
(3, 'ส่งซ่อม', ''),
(4, 'SC8104', '');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sid` int(10) NOT NULL,
  `status_tha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_eng` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sid`, `status_tha`, `status_eng`) VALUES
(1, 'ว่าง', 'Available'),
(2, 'ถูกยืม', ''),
(3, 'กำลังซ่อม', 'Fixing');

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
  ADD PRIMARY KEY (`eid`),
  ADD KEY `equip_cid_fk` (`cid`),
  ADD KEY `equip_lid_fk` (`lid`),
  ADD KEY `equip_sid_fk` (`sid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equip_cid_fk` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `equip_lid_fk` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `equip_sid_fk` FOREIGN KEY (`sid`) REFERENCES `status` (`sid`) ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
