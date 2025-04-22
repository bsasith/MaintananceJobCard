-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 08:15 AM
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
-- Table structure for table `acfmachines`
--

CREATE TABLE `acfmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acfmachines`
--

INSERT INTO `acfmachines` (`id`, `MachineName`) VALUES
(6, 'JOHN ROYLE EXTRUDER'),
(7, 'GENERAL ENGINEERING EXTRUDER'),
(8, 'HIGH SPEED BOW STRANDER'),
(9, 'MAJI LAYING UP MACHINE'),
(10, 'ALIND STRANDER I'),
(11, 'ALIND STRANDER II'),
(12, 'SKIP STRANDER'),
(13, 'BABCOCK W/D MACHINE I'),
(14, 'BABCOCK W/D MACHINE II'),
(15, 'AGEING FURNACE'),
(16, 'CURING CHAMBER'),
(17, 'REVOMAX STEAM BOILER'),
(18, 'SM STRANDER II'),
(19, 'HOSN 1600 BUNCHER'),
(20, 'HOLD W/D MACHINE'),
(21, 'AEI STRANDER'),
(22, 'SCREW COMPRESSOR - 1   [ELANG]'),
(23, 'PISTON TYPE COMPRESSOR - ATLAS COPCO'),
(24, 'PISTON TYPE COMPRESSOR '),
(25, 'SCREW COMPRESSOR - LANG'),
(26, 'SCREW COMPRESSOR - CICCATO');

-- --------------------------------------------------------

--
-- Table structure for table `aluminiumrodmillmachines`
--

CREATE TABLE `aluminiumrodmillmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluminiumrodmillmachines`
--

INSERT INTO `aluminiumrodmillmachines` (`id`, `MachineName`) VALUES
(1, 'MELTING FURNACE'),
(2, 'HOLDING FURNACE'),
(3, 'CASTING MACHINE'),
(4, 'INDUCTION HEATER'),
(5, 'ROD ROLLING MACHINE'),
(6, 'TAKEUP 1 & 2'),
(7, 'GANTRY CRANE 2T'),
(8, 'GANTRY CRANE 3T'),
(9, 'SCREW COMPRESSOR - LANG');

-- --------------------------------------------------------

--
-- Table structure for table `bailmachines`
--

CREATE TABLE `bailmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bailmachines`
--

INSERT INTO `bailmachines` (`id`, `MachineName`) VALUES
(1, 'FIREFOX MACHINE'),
(2, 'PULAVERISER MACHINE'),
(3, 'COMPACT MACHINE'),
(4, 'STRIP MACHINE I , II , III'),
(5, 'BAIL MACHINE I , II , III'),
(6, 'HYDRAULIC CUTTER');

-- --------------------------------------------------------

--
-- Table structure for table `carpentrymachines`
--

CREATE TABLE `carpentrymachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carpentrymachines`
--

INSERT INTO `carpentrymachines` (`id`, `MachineName`) VALUES
(1, 'WOOD PLANER MACHINE - 1 [LIDA]'),
(2, 'WOOD PLANER MACHINE - 2'),
(3, 'HOLE SAW MACHINE - 1'),
(4, 'HOLE SAW MACHINE - 2'),
(5, 'CIRCULAR SAW MACHINE - 1'),
(6, 'CIRCULAR SAW MACHINE - 2'),
(7, 'BAND SAW MACHINE - 1'),
(8, 'BAND SAW MACHINE - 2'),
(9, 'CUTOFF MACHINE'),
(10, 'LATHE MACHINE - 1   '),
(11, 'LATHE MACHINE - 2'),
(12, 'BUT WELDER'),
(13, 'BENCH GRINDER');

-- --------------------------------------------------------

--
-- Table structure for table `ccfmachines`
--

CREATE TABLE `ccfmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccfmachines`
--

INSERT INTO `ccfmachines` (`id`, `MachineName`) VALUES
(1, 'SICTRA W/D MACHINE'),
(2, 'RIGID STRANDER'),
(3, 'GOLDEN EXTRUDER 120+45/60+45mm'),
(4, 'YOSHIDA DRUM TWISTER'),
(5, 'MAPRE EXTRUDER'),
(6, 'GENERAL ENGINEERING EXTRUDER'),
(7, 'BEKEART W/D MACHINE'),
(8, 'DRUM TWISTER'),
(9, 'ARMOURING MACHINE '),
(10, 'REELING WINDER '),
(11, 'MAJI ARMOURING MACHINE'),
(12, 'SETIC BUNCHER  1250mm'),
(13, 'TINNING PLANT'),
(14, 'CUTTING WINDER I & II'),
(15, 'PIONEER MEDIUM W/D MACHINE  [DB 17]'),
(16, '1250 PIONEER DOUBLE TWIST BUNCHER '),
(17, 'SCREW COMPRESSOR - 1   [LANG]'),
(18, 'SCREW COMPRESSOR - 2   [LANG]'),
(19, 'PISTON TYPE COMPRESSOR - 1   [ATLAS]'),
(20, 'PISTON TYPE COMPRESSOR - 2   [ATLAS]'),
(21, 'PISTON TYPE COMPRESSOR - 3   [KIRLOSCAR]'),
(22, 'PISTON TYPE COMPRESSOR - 4   [KIRLOSCAR]'),
(23, 'PISTON TYPE COMPRESSOR - 5   [KIRLOSCAR]');

-- --------------------------------------------------------

--
-- Table structure for table `ceyloncoppermachines`
--

CREATE TABLE `ceyloncoppermachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ceyloncoppermachines`
--

INSERT INTO `ceyloncoppermachines` (`id`, `MachineName`) VALUES
(1, 'CONTINUOUS CASTING MACHINE 8-17mm '),
(2, 'BUSBAR MACHINE'),
(3, 'PIONEER FURNACE'),
(4, 'PISTON TYPE COMPRESSOR - ATLAS COPCO');

-- --------------------------------------------------------

--
-- Table structure for table `drmachines`
--

CREATE TABLE `drmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drmachines`
--

INSERT INTO `drmachines` (`id`, `MachineName`) VALUES
(1, 'MICA TAPING MACHINE I'),
(2, 'MICA TAPING MACHINE II'),
(3, 'KU KA MA BUNCHER'),
(4, 'FRANCIS SHAW MACHINE '),
(5, 'GOLDEN TEC. 80+45/90+45 EXTRUDER'),
(6, 'NMC TANDEM EXTRUDER LINE'),
(7, 'PIONEER EXTRUDER'),
(8, 'REEL O TECH CUTTING WINDER'),
(9, 'CUTTING WINDER'),
(10, 'NORTHEMPTON EXTRUDER'),
(11, 'PIONEER TANDEM EXTRUDER 70+60mm'),
(12, 'SCREW COMPRESSOR - LANG');

-- --------------------------------------------------------

--
-- Table structure for table `drumyardmachines`
--

CREATE TABLE `drumyardmachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drumyardmachines`
--

INSERT INTO `drumyardmachines` (`id`, `MachineName`) VALUES
(1, 'GANTRY CRANE 20T'),
(2, 'CUTTING WINDER I , II , III'),
(3, 'SCREW COMPRESSOR - CICCATO ');

-- --------------------------------------------------------

--
-- Table structure for table `flexiblemachines`
--

CREATE TABLE `flexiblemachines` (
  `id` int(11) NOT NULL,
  `MachineName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flexiblemachines`
--

INSERT INTO `flexiblemachines` (`id`, `MachineName`) VALUES
(1, 'SETIC BUNCHER 630'),
(2, 'ANDOURT EXTRUDER'),
(3, 'CORTINOVIS BUNCHER'),
(4, 'MULTI W/D MACHINE'),
(5, 'CUTTING WINDER WITH PIONEER AUTO COILER'),
(6, 'CUTTING WINDER WITH AUTO COILER'),
(7, 'CUTTING WINDER I'),
(8, 'CUTTING WINDER II'),
(9, 'BOW TWINER');

-- --------------------------------------------------------

--
-- Table structure for table `jobdatasheet`
--

CREATE TABLE `jobdatasheet` (
  `id` int(10) NOT NULL,
  `JobCodeNo` varchar(100) NOT NULL,
  `JobPostingDateTime` varchar(50) NOT NULL,
  `JobFinishingDateTime` varchar(50) DEFAULT NULL,
  `JobPostingDev` enum('ACF','CCF','DR','Flexible','Aluminium Rodmill','Ceylon Copper','Drum Yard','Carpentry','Bail Room') NOT NULL,
  `MachineName` varchar(255) NOT NULL,
  `Priority` enum('High','Low','Critical','') NOT NULL,
  `ReportTo` enum('Electrical','Mechanical','Both','') NOT NULL,
  `BDescription` varchar(500) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `JobStatusE` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `JobStatusM` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `ManPowerInvolved` varchar(1000) DEFAULT NULL,
  `Certification` enum('Pending Certification','Not Certified','Certified','') NOT NULL,
  `FinishedCommentE` varchar(255) DEFAULT NULL,
  `FinishedCommentM` varchar(500) DEFAULT NULL,
  `TransferCommentE` varchar(500) DEFAULT NULL,
  `TransferCommentM` varchar(500) DEFAULT NULL,
  `ApproveComment` varchar(1000) DEFAULT NULL,
  `DisapproveComment` varchar(1000) DEFAULT NULL,
  `DownTimeE` varchar(500) DEFAULT NULL,
  `DownTimeM` varchar(50) DEFAULT NULL,
  `TryCount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobdatasheet`
--

INSERT INTO `jobdatasheet` (`id`, `JobCodeNo`, `JobPostingDateTime`, `JobFinishingDateTime`, `JobPostingDev`, `MachineName`, `Priority`, `ReportTo`, `BDescription`, `Username`, `JobStatusE`, `JobStatusM`, `ManPowerInvolved`, `Certification`, `FinishedCommentE`, `FinishedCommentM`, `TransferCommentE`, `TransferCommentM`, `ApproveComment`, `DisapproveComment`, `DownTimeE`, `DownTimeM`, `TryCount`) VALUES
(461, 'JO1', '2024-10-21 11:01:51', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'df', 'lanka', 'Started', 'NA', NULL, 'Certified', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '95', 1),
(462, 'JO462', '2024-10-21 11:01:56', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfdf', 'lanka', 'Started', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(463, 'JO463', '2024-10-21 11:02:04', '2024-11-12 09:46:10', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Mechanical', 'dffgd', 'lanka', 'NA', 'Finished', 'fgsdrf', 'Pending Certification', NULL, 'sdf', NULL, NULL, NULL, NULL, NULL, '526.735', 1),
(464, 'WO464', '2024-10-21 11:02:15', '', 'CCF', 'SETIC BUNCHER  1250mm', 'Low', 'Electrical', 'asdaa', 'lanka', 'Started', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(465, 'JO465', '2024-10-21 11:03:21', '2024-11-12 09:45:08', 'CCF', 'TINNING PLANT', 'Low', 'Electrical', 'tfghfg ', 'lanka', 'Finished', 'NA', 'dfgddfg', 'Pending Certification', 'dfgdg', NULL, NULL, NULL, NULL, NULL, '526.69638888889', NULL, 1),
(466, 'JO466', '2024-10-21 11:03:30', '', 'CCF', 'PISTON TYPE COMPRESSOR - 4   [KIRLOSCAR]', 'Low', 'Both', 'dfg', 'lanka', 'Finished', 'Finished', 'hgj', 'Pending Certification', 'ghjgh', 'ghj', NULL, NULL, NULL, NULL, '335.44138888889', '335.46138888889', 1),
(467, 'JO467', '2024-10-21 11:03:51', '', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', 'hfgh', 'ranga', 'Started', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(468, 'JO468', '2024-10-21 11:04:08', '', 'ACF', 'SCREW COMPRESSOR - LANG', 'High', 'Mechanical', 'ghjgj', 'ranga', 'NA', 'Finished', 'f', 'Certified', NULL, 'dfgfg', NULL, NULL, NULL, NULL, '1.3913888888889', NULL, 1),
(469, 'JO469', '2024-10-21 11:04:18', '2024-11-12 09:44:38', 'ACF', 'SM STRANDER II', 'Low', 'Electrical', 'fghfhf', 'ranga', 'Finished', 'NA', 'dfg', 'Certified', 'dfg', NULL, NULL, NULL, NULL, NULL, '526.67222222222', NULL, 1),
(470, 'JO470', '2024-10-21 11:04:44', '', 'Flexible', 'MULTI W/D MACHINE', 'Low', 'Electrical', 'fgthfh', 'nadeesha', 'Finished', 'NA', 'ggf', 'Pending Certification', 'dfg', NULL, NULL, NULL, NULL, NULL, '1.5352777777778', NULL, 1),
(471, 'JO471', '2024-10-21 11:05:19', '', 'DR', 'PIONEER EXTRUDER', 'Low', 'Mechanical', 'gyjghj', 'rasika', 'NA', 'Finished', 'sdd', 'Pending Certification', NULL, 'sd', NULL, NULL, NULL, NULL, '105.236', NULL, 1),
(472, 'WO472', '2024-10-30 10:46:17', '', 'CCF', 'SICTRA W/D MACHINE', 'High', 'Both', 'ghjghj', 'lanka', 'Finished', 'Finished', 'jhkhk', 'Certified', 'hjkjh', 'hjkjhk', NULL, NULL, NULL, NULL, '0.056666666666667', NULL, 1),
(473, 'JO473', '2024-10-30 10:52:20', '', 'CCF', 'TINNING PLANT', 'High', 'Mechanical', 'bvhgvhv', 'lanka', 'NA', 'Finished', 'gdfg', 'Certified', NULL, 'dgdfg', 'ghjgjg', NULL, NULL, NULL, '48.185', NULL, 2),
(475, 'WO475', '2024-10-31 13:01:02', '2025-04-07 17:08:39', 'ACF', 'HOSN 1600 BUNCHER', 'Low', 'Electrical', 'dfgdgd', 'ranga', 'Finished', 'NA', 'jiopoi', 'Pending Certification', 'sdsaasdadad', NULL, NULL, NULL, NULL, NULL, '3796.1269444444', NULL, 1),
(476, 'JO476', '2024-10-31 13:01:36', '', 'ACF', 'SM STRANDER II', 'Low', 'Electrical', 'err', 'ranga', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(477, 'JO477', '2024-10-31 13:02:12', '', 'CCF', 'SCREW COMPRESSOR - 1   [LANG]', 'Low', 'Electrical', 'sdfsfsfs', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(478, 'JO478', '2024-10-31 14:25:13', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgb', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(479, 'JO479', '2024-11-01 11:04:55', '', 'CCF', 'CUTTING WINDER I & II', 'High', 'Electrical', 'X1', 'lanka', 'Finished', 'NA', 'fgh', 'Certified', 'fghfgh', NULL, NULL, NULL, NULL, NULL, '0.010555555555556', NULL, 1),
(481, 'JO480', '2024-11-01 11:12:32', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Mechanical', 'X3', 'lanka', 'NA', 'Finished', 'dfgdg', 'Certified', NULL, 'dfgdg', 'dsfsf', NULL, NULL, NULL, '0.017777777777778', NULL, 2),
(482, 'JO482', '2024-11-01 11:14:47', '', 'CCF', 'TINNING PLANT', 'Low', 'Both', 'X4', 'lanka', 'Finished', 'Finished', 'fghf', 'Certified', 'fghf', 'jhkhk', 'awdawasdf', 'awdawasdf', NULL, NULL, '0.047222222222222', NULL, 2),
(483, 'JO483', '2024-11-01 11:43:21', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'X4', 'lanka', 'Finished', 'Started', 'dfsd', 'Pending Certification', 'sdf', NULL, 'cvxv', 'cvxv', NULL, NULL, '0.01', NULL, 2),
(484, 'JO484', '2024-11-01 11:48:34', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Mechanical', 'X5', 'lanka', 'Finished', 'Finished', 'ghj', 'Certified', NULL, 'ghj', 'ghjgjg', NULL, NULL, NULL, '0.026666666666667', NULL, 2),
(485, 'JO485', '2024-11-01 11:53:18', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'X6', 'lanka', 'Finished', 'Finished', 'uyhfghg', 'Certified', 'dfg', 'fh', 'dfgdgdg', 'dfgdgdg', NULL, NULL, '3.3577777777778', NULL, 2),
(486, 'JO486', '2024-11-01 12:14:26', '', 'CCF', 'SETIC BUNCHER  1250mm', 'High', 'Mechanical', 'X7', 'lanka', 'Finished', 'Finished', 'vbhv', 'Certified', NULL, 'fg', 'fghfgh', NULL, NULL, NULL, '0.12638888888889', NULL, 2),
(487, 'JO487', '2024-11-01 12:23:20', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'X8', 'lanka', 'Finished', 'Finished', 'h', 'Certified', 'fghf', 'g', NULL, NULL, NULL, NULL, '2.605', NULL, 1),
(488, 'JO488', '2024-11-01 15:51:35', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'fgfghfdgd', 'lanka', 'Finished', 'NA', 'koljk', 'Pending Certification', 'kljkl', NULL, NULL, NULL, NULL, NULL, '0.0325', NULL, 1),
(489, 'JO489', '2024-11-04 9:20:42', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'lukjk', 'lanka', 'Finished', 'NA', 'ghjhg', 'Pending Certification', 'ghjg', NULL, NULL, NULL, NULL, NULL, '0.0080555555555556', NULL, 1),
(490, 'JO490', '2024-11-04 9:24:05', '', 'CCF', 'SETIC BUNCHER  1250mm', 'High', 'Mechanical', 'sfsfsdf', 'lanka', 'NA', 'Finished', 'ghj', 'Pending Certification', NULL, 'hj', NULL, NULL, NULL, NULL, NULL, '0.078888888888889', 1),
(491, 'JO491', '2024-11-04 9:46:52', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'yyrty', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(492, 'JO492', '2024-11-04 9:47:32', '2024-11-04 11:32:55', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'fghfgh', 'lanka', 'Finished', 'Finished', 'fgh', 'Certified', 'fgh', 'y', NULL, NULL, NULL, NULL, '1.7563888888889', '0.03', 1),
(493, 'JO493', '2024-11-04 9:50:35', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'uiouiopu', 'lanka', 'Finished', 'Finished', 'ghg', 'Pending Certification', 'jh', 'ghgh', NULL, NULL, NULL, NULL, '0.0061111111111111', '0.017222222222222', 1),
(494, 'JO494', '2024-11-04 9:53:29', '2025-01-01 16:13:22', 'CCF', 'SICTRA W/D MACHINE', 'High', 'Both', 'X9', 'lanka', 'Finished', 'Finished', 'ghj', 'Pending Certification', 'ghjgjh', 'fghfh', NULL, NULL, NULL, NULL, '1398.3313888889', '0.072222222222222', 1),
(495, 'JO495', '2024-11-04 9:56:30', '', 'CCF', 'SICTRA W/D MACHINE', 'High', 'Both', 'aasasa', 'lanka', 'Pending', 'Pending', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(496, 'JO496', '2024-11-04 9:56:55', '', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'X10', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(497, 'JO497', '2024-11-04 12:02:01', NULL, 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'ghj', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(498, 'JO498', '2024-11-04 12:02:25', NULL, 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Mechanical', 'ghjgj', 'lanka', 'NA', 'Pending', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(499, 'JO499', '2024-11-25 11:27:17', NULL, 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'hj', 'lanka', 'Pending', 'NA', NULL, 'Pending Certification', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(500, 'JO500', '2025-01-01 16:10:39', '2025-01-01 16:15:56', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfdfgh', 'lanka', 'Finished', 'NA', 'ghfh', 'Pending Certification', 'fghgf', NULL, NULL, NULL, NULL, NULL, '0.088055555555556', NULL, 1),
(501, 'JO501', '2025-01-01 16:14:38', '2025-01-01 16:25:08', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'ghmkgnm', 'lanka', 'Finished', 'Pending', 'ggf', 'Pending Certification', 'fgh', NULL, NULL, NULL, NULL, NULL, '0.175', NULL, 1),
(502, 'JO502', '2025-01-01 16:23:35', '2025-04-07 16:43:55', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'kll,', 'lanka', 'Finished', 'Pending', 'xcvxvx', 'Pending Certification', 'ghjhgj', NULL, NULL, NULL, NULL, NULL, '2304.3388888889', NULL, 1),
(503, 'JO503', '2025-01-01 16:25:20', '2025-04-08 14:30:10', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'vbnvn', 'lanka', 'Finished', 'Finished', 'fgbfdg', 'Pending Certification', 'fhgfhgfhgfh', 'fhgfhgfhgfh', NULL, NULL, NULL, NULL, '2299.1313888889', '2326.0805555556', 1),
(504, 'JO504', '2025-01-01 16:31:39', '2025-04-07 10:55:49', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'ghjghj', 'lanka', 'Finished', 'Finished', 'xcvxvx', 'Pending Certification', 'sdfsfdsfsfsf', 'vbnvn', NULL, NULL, NULL, NULL, '2298.4027777778', '0.6025', 1),
(505, 'JO505', '2025-04-04 10:08:20', '2025-04-07 11:39:40', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', 'asas', 'ranga', 'Finished', 'NA', 'df', 'Pending Certification', 'dfg', NULL, NULL, NULL, NULL, NULL, '73.522222222222', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `serial_numbers`
--

CREATE TABLE `serial_numbers` (
  `id` int(11) NOT NULL,
  `serial_no` varchar(11) NOT NULL,
  `status` enum('available','used','canceled') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serial_numbers`
--

INSERT INTO `serial_numbers` (`id`, `serial_no`, `status`) VALUES
(6, 'JO390', 'used'),
(7, 'JO395', 'used'),
(8, 'JO396', 'used'),
(9, 'JO397', 'used'),
(10, 'JO398', 'used'),
(11, 'JO399', 'used'),
(12, 'JO400', 'used'),
(13, 'JO401', 'used'),
(14, 'JO402', 'used'),
(15, 'JO403', 'used'),
(16, 'JO404', 'used'),
(17, 'JO405', 'used'),
(18, 'JO406', 'used'),
(19, 'JO407', 'used'),
(20, 'JO408', 'used'),
(21, 'JO409', 'used'),
(22, 'JO410', 'used'),
(23, 'JO411', 'used'),
(26, 'JO412', 'used'),
(27, 'JO413', 'used'),
(28, 'JO414', 'used'),
(29, 'WO415', 'used'),
(30, 'JO416', 'used'),
(31, 'JO417', 'used'),
(32, 'JO418', 'used'),
(33, 'JO419', 'used'),
(34, 'JO420', 'used'),
(35, 'JO421', 'used'),
(36, 'JO422', 'used'),
(37, 'JO423', 'used'),
(38, 'JO424', 'used'),
(39, 'WO425', 'used'),
(40, 'WO426', 'used'),
(41, 'WO427', 'used'),
(42, 'JO428', 'used'),
(43, 'WO429', 'used'),
(44, 'JO430', 'used'),
(45, 'JO431', 'used'),
(46, 'JO432', 'used'),
(47, 'JO433', 'used'),
(48, 'JO1', 'used'),
(49, 'JO435', 'used'),
(50, 'JO436', 'used'),
(51, 'JO437', 'used'),
(52, 'JO438', 'used'),
(53, 'JO439', 'used'),
(54, 'JO440', 'used'),
(55, 'JO441', 'used'),
(56, 'JO442', 'used'),
(57, 'JO443', 'used'),
(58, 'JO444', 'used'),
(59, 'JO445', 'used'),
(60, 'JO446', 'used'),
(61, 'JO447', 'used'),
(62, 'JO448', 'used'),
(63, 'JO449', 'used'),
(64, 'JO450', 'used'),
(65, 'JO451', 'used'),
(66, 'JO452', 'used'),
(67, 'JO453', 'used'),
(68, 'JO454', 'used'),
(69, 'JO455', 'used'),
(70, 'JO456', 'used'),
(71, 'JO457', 'used'),
(72, 'JO458', 'used'),
(73, 'WO459', 'used'),
(74, 'JO460', 'used'),
(76, 'JO462', 'used'),
(77, 'JO463', 'used'),
(78, 'WO464', 'used'),
(79, 'JO465', 'used'),
(80, 'JO466', 'used'),
(81, 'JO467', 'used'),
(82, 'JO468', 'used'),
(83, 'JO469', 'used'),
(84, 'JO470', 'used'),
(85, 'JO471', 'used'),
(86, 'JO472', 'used'),
(87, 'JO473', 'used'),
(88, 'WO474', 'used'),
(89, 'JO475', 'used'),
(90, 'JO476', 'used'),
(91, 'JO477', 'used'),
(92, 'JO478', 'used'),
(93, 'JO479', 'used'),
(94, 'JO480', 'used'),
(96, 'JO482', 'used'),
(97, 'JO483', 'used'),
(98, 'JO484', 'used'),
(99, 'JO485', 'used'),
(100, 'JO486', 'used'),
(101, 'JO487', 'used'),
(102, 'JO488', 'used'),
(103, 'JO489', 'used'),
(104, 'JO490', 'used'),
(105, 'JO491', 'used'),
(106, 'JO492', 'used'),
(107, 'JO493', 'used'),
(108, 'JO494', 'used'),
(109, 'JO495', 'used'),
(110, 'JO496', 'used'),
(111, 'JO497', 'used'),
(112, 'JO498', 'used'),
(113, 'JO499', 'used'),
(114, 'JO500', 'used'),
(115, 'JO501', 'used'),
(116, 'JO502', 'used'),
(117, 'JO503', 'used'),
(118, 'JO504', 'used'),
(119, 'JO505', 'used');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `workplace` enum('ACF','CCF','DR','Flexible','Aluminium Rodmill','Ceylon Copper','Electrical','Mechanical','Drum Yard','Bail Room','Carpentry') NOT NULL,
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
(11, 'minesh', '123', 'Ceylon Copper', 'puser'),
(12, 'sarath', '123', 'Carpentry', 'puser'),
(13, 'dilshan', '123', 'Drum Yard', 'puser'),
(14, 'sujeewa', '123', 'Bail Room', 'puser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acfmachines`
--
ALTER TABLE `acfmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aluminiumrodmillmachines`
--
ALTER TABLE `aluminiumrodmillmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bailmachines`
--
ALTER TABLE `bailmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carpentrymachines`
--
ALTER TABLE `carpentrymachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ccfmachines`
--
ALTER TABLE `ccfmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ceyloncoppermachines`
--
ALTER TABLE `ceyloncoppermachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drmachines`
--
ALTER TABLE `drmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drumyardmachines`
--
ALTER TABLE `drumyardmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flexiblemachines`
--
ALTER TABLE `flexiblemachines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobdatasheet`
--
ALTER TABLE `jobdatasheet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `JobCodeNo` (`JobCodeNo`);

--
-- Indexes for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_no` (`serial_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acfmachines`
--
ALTER TABLE `acfmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `aluminiumrodmillmachines`
--
ALTER TABLE `aluminiumrodmillmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bailmachines`
--
ALTER TABLE `bailmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carpentrymachines`
--
ALTER TABLE `carpentrymachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ccfmachines`
--
ALTER TABLE `ccfmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ceyloncoppermachines`
--
ALTER TABLE `ceyloncoppermachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drmachines`
--
ALTER TABLE `drmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `drumyardmachines`
--
ALTER TABLE `drumyardmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flexiblemachines`
--
ALTER TABLE `flexiblemachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobdatasheet`
--
ALTER TABLE `jobdatasheet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
