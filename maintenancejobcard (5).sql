-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 07:37 AM
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
  `Approval` enum('Not Approved','Approved','','') NOT NULL,
  `FinishedCommentE` varchar(255) DEFAULT NULL,
  `FinishedCommentM` varchar(500) DEFAULT NULL,
  `TransferCommentE` varchar(500) DEFAULT NULL,
  `TransferCommentM` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobdatasheet`
--

INSERT INTO `jobdatasheet` (`id`, `JobCodeNo`, `JobPostingDateTime`, `JobPostingDev`, `MachineName`, `Priority`, `ReportTo`, `BDescription`, `Username`, `JobStatusE`, `JobStatusM`, `Approval`, `FinishedCommentE`, `FinishedCommentM`, `TransferCommentE`, `TransferCommentM`) VALUES
(172, 'JO151265', '2024-06-26 14:25:18', 'ACF', 'A20', 'Low', 'Both', 'Jonto Rohdes', 'ranga', 'Finished', 'Finished', 'Approved', 'dfsfsfsf', '', '', ''),
(173, 'JO557555', '2024-06-26 14:31:27', 'ACF', 'A20', 'Low', 'Mechanical', 'dddddddddddddddddddddddddddd', 'ranga', 'NA', 'Started', 'Not Approved', '', '', '', ''),
(174, 'JO133325', '2024-06-26 14:46:09', 'ACF', 'A20', 'Low', 'Electrical', 'girraf', 'ranga', 'Finished', 'NA', 'Not Approved', 'sdfsfds', '', 'fdsfsdfsfs', 'dfdfsfssf'),
(175, 'JO795615', '2024-06-26 14:54:27', 'ACF', 'A20', 'Low', 'Electrical', 'Wikis are enabled by wiki software, otherwise known as wiki engines. A wiki engine, being a form of a content management system, differs from other web-based systems such as blog software or static site generators, in that the content is created without any defined owner or leader, and wikis have little inherent structure, allowing structure to emerge according to the needs of the users.[1] Wiki engines usually allow content to be written using a simplified markup language and sometimes edited w', 'ranga', 'Finished', 'NA', 'Approved', '', '', '', '');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
