-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 01:48 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `api_key` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `api_key`, `controller`, `date_created`, `date_modified`) VALUES
(1, '123456', 'user_api', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `api_limit`
--

CREATE TABLE `api_limit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uri` varchar(200) NOT NULL,
  `class` varchar(200) NOT NULL,
  `method` varchar(200) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_limit`
--

INSERT INTO `api_limit` (`id`, `user_id`, `uri`, `class`, `method`, `ip_address`, `time`) VALUES
(1, NULL, 'api/v1/limit', 'user_api', 'api_limit', '::1', '1542219747');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_on` varchar(100) NOT NULL,
  `updated_on` varchar(100) NOT NULL,
  `read_on` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `read_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `title`, `details`, `priority`, `department`, `province`, `status`, `created_on`, `updated_on`, `read_on`, `created_by`, `read_by`) VALUES
(1, 'Test Complaint', 'Test Complaint Details', 'Test Priority', 'Test Dep', 'Test Province', 'Test Status', 'Test Created_on', 'Test Updated_on', 'Test read_on', 'Test Created_by', 'Test read_by'),
(2, 'Test 2 title', 'Test 2 details', 'Test Priority 2', 'Test  department 2', 'Test  province 2', 'Test  status 2', 'Test  created_on 2', 'Test  updated_on 2', 'Test  read_on 2', 'keria', 'Test  read_by 2');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_setting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `department`, `designation`, `user_role`, `location`, `user_setting`) VALUES
(13, 'Grey', 'keriagrey@yahoo.am', 'd41d8cd98f00b204e9800998ecf8427e', 'Keria23', 'Grey', 'Test Dep', 'Test Desg', 'Test User', 'Us', ''),
(14, 'admin', 'abdullah@yahoo.com', '202cb962ac59075b964b07152d234b70', 'Abdullah', 'Tariq', 'Test Dep 2', 'Test Desg 2', 'admin', 'Uk', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_limit`
--
ALTER TABLE `api_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_limit`
--
ALTER TABLE `api_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
