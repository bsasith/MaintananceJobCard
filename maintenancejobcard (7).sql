-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 01:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maintenancejobcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobdatasheet`
--

CREATE TABLE `jobdatasheet` (
  `id` int(10) NOT NULL,
  `JobCodeNo` varchar(100) NOT NULL,
  `JobPostingDateTime` varchar(50) NOT NULL,
  `JobPostingDev` enum('ACF','CCF','DR','Flexible','Aluminium Rodmill','Ceylon Copper') NOT NULL,
  `MachineName` varchar(255) NOT NULL,
  `Priority` enum('High','Low','Critical','') NOT NULL,
  `ReportTo` enum('Electrical','Mechanical','Both','') NOT NULL,
  `BDescription` varchar(500) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `JobStatusE` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `JobStatusM` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `Approval` enum('Pending Approval','Not Approved','Approved','') NOT NULL,
  `FinishedCommentE` varchar(255) DEFAULT NULL,
  `FinishedCommentM` varchar(500) DEFAULT NULL,
  `TransferCommentE` varchar(500) DEFAULT NULL,
  `TransferCommentM` varchar(500) DEFAULT NULL,
  `ApproveComment` varchar(1000) DEFAULT NULL,
  `DisapproveComment` varchar(1000) DEFAULT NULL,
  `DownTime` varchar(500) DEFAULT NULL,
  `TryCount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobdatasheet`
--

INSERT INTO `jobdatasheet` (`id`, `JobCodeNo`, `JobPostingDateTime`, `JobPostingDev`, `MachineName`, `Priority`, `ReportTo`, `BDescription`, `Username`, `JobStatusE`, `JobStatusM`, `Approval`, `FinishedCommentE`, `FinishedCommentM`, `TransferCommentE`, `TransferCommentM`, `ApproveComment`, `DisapproveComment`, `DownTime`, `TryCount`) VALUES
(213, 'JO561794', '2024-07-17 10:13:52', 'CCF', 'B20', 'Low', 'Both', 'Job 1 Dispp both', 'lanka', 'Finished', 'Finished', 'Approved', 'ghfhfh', 'gdfgdgdf', NULL, NULL, NULL, NULL, NULL, 1),
(214, 'JO723162', '2024-07-17 10:18:58', 'CCF', 'B20', 'Low', 'Electrical', 'thytrftfhfh', 'lanka', 'Finished', 'Finished', 'Pending Approval', 'hkhkhk', NULL, 'uhhhh', 'uihuihio', NULL, 'gfnvjgjghjg', NULL, 3),
(215, 'JO292773', '2024-07-17 10:29:08', 'CCF', 'B20', 'Low', 'Electrical', 'ddfsfsfsd', 'lanka', 'Pending', 'NA', 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(216, 'JO712447', '2024-07-17 14:43:52', 'CCF', 'B20', 'Low', 'Mechanical', 'sdfsfsdfd', 'lanka', 'NA', 'Finished', 'Pending Approval', NULL, 'fdffg', NULL, NULL, NULL, NULL, '00-00-00 00:47:41', 1),
(217, 'JO615431', '2024-07-17 15:33:16', 'CCF', 'B20', 'Low', 'Mechanical', 'dfsdfssdf', 'lanka', 'NA', 'Finished', 'Pending Approval', NULL, 'bvhjgjgjjg', NULL, NULL, NULL, NULL, '00-00-00 00:01:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `workplace` enum('ACF','CCF','DR','Flexible','Aluminium Rodmill','Ceylon Copper','Electrical','Mechanical') NOT NULL,
  `type` enum('admin','euser','puser','muser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `workplace`, `type`) VALUES
(1, 'prakash', '123', 'Electrical', 'euser'),
(2, 'lahiru', '123', 'Mechanical', 'muser'),
(3, 'admin', '123', '', 'admin'),
(4, 'ranga', '123', 'ACF', 'puser'),
(5, 'rasika', '123', 'DR', 'puser'),
(7, 'nadeesha', '123', 'Flexible', 'puser'),
(8, 'lanka', '123', 'CCF', 'puser'),
(9, 'dilan', '123', 'Aluminium Rodmill', 'puser'),
(10, 'lanka', '123', 'CCF', 'puser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobdatasheet`
--
ALTER TABLE `jobdatasheet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `JobCodeNo` (`JobCodeNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobdatasheet`
--
ALTER TABLE `jobdatasheet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
