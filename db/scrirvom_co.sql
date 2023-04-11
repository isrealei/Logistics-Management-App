-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2020 at 03:45 PM
-- Server version: 10.3.23-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrirvom_co`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@digitalwebplus.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `shipdate` varchar(100) NOT NULL,
  `saddress` varchar(200) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `raddress` varchar(200) NOT NULL,
  `rname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `pdate` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `edd` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `servicetype` varchar(100) NOT NULL,
  `pdesc` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `pname`, `shipdate`, `saddress`, `sname`, `raddress`, `rname`, `email`, `status`, `location`, `pdate`, `pid`, `edd`, `weight`, `servicetype`, `pdesc`, `qty`, `image`, `remark`) VALUES
(45, 'samsung phone', '2020-06-14', 'abuja', 'Paul smith', 'Lagos Nigeria', 'Daniel Amos', 'ducanharry@gmail.com', 'In the warehouse', 'Ikeja warehouse', '2020-06-16', '8SHHHGGD63', '2020-06-30', '24kg', 'Persel', 'In good condotion', '2', 'Make Money fast Online.jpg', 'healthy delivery'),
(46, 'samsung phone', '', 'abuja', 'Paul smith', '', 'Daniel Amos', 'ducanharry@gmail.com', 'Custom check', 'Lagos', '2020-06-19', '8SHHHGGD63', '', '', '', '', '', '', 'Perfect condition'),
(47, 'samsung phone', '', 'abuja', 'Paul smith', '', 'Daniel Amos', 'ducanharry@gmail.com', 'On Hold', 'Delta state police', '2020-06-25', '8SHHHGGD63', '', '', '', '', '', '', 'Awaiting clearance  '),
(48, 'samsung phone', '', 'abuja', 'Paul smith', '', 'Daniel Amos', 'ducanharry@gmail.com', 'reuy5u', 'w4y53', '2020-07-25', '8SHHHGGD63', '', '', '', '', '', '', '5yu5u');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(200) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `apipr` varchar(200) NOT NULL,
  `apipu` varchar(200) NOT NULL,
  `currency` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `bname` varchar(200) NOT NULL,
  `baddress` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sname`, `apipr`, `apipu`, `currency`, `branch`, `bname`, `baddress`, `email`, `phone`, `title`, `logo`) VALUES
(2, '', '', '', '$', '', 'Fright Cargo', '', 'support@scriptsdemo.website', '', 'Welcome to Fright Cargo', '');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `shipdate` varchar(100) NOT NULL,
  `saddress` varchar(200) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `raddress` varchar(200) NOT NULL,
  `rname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `pdate` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `edd` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `servicetype` varchar(100) NOT NULL,
  `pdesc` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `pname`, `shipdate`, `saddress`, `sname`, `raddress`, `rname`, `email`, `status`, `location`, `pdate`, `pid`, `edd`, `weight`, `servicetype`, `pdesc`, `qty`, `image`, `remark`) VALUES
(28, 'samsung phone', '2020-06-14', 'abuja', 'Paul smith', 'Lagos Nigeria', 'Daniel Amos', 'ducanharry@gmail.com', 'deliver', 'Ikeja warehouse', '', '8SHHHGGD63', '2020-06-30', '24kg', 'Persel', 'In good condotion', '2', 'Computer Science.jpg', 'healthy delivery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
