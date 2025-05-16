
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 07:12 AM
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
  `JobPostingDev` enum('ACF','CCF','DR','Flexible','Aluminium Rodmill','Ceylon Copper','Drum Yard','Carpentry','Bail Room') NOT NULL,
  `MachineName` varchar(255) NOT NULL,
  `Priority` enum('High','Low','Critical','') NOT NULL,
  `ReportTo` enum('Electrical','Mechanical','Both','') NOT NULL,
  `BDescription` varchar(500) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `JobStatusE` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `JobStatusM` enum('Pending','Started','Finished','Approved','NA') NOT NULL,
  `ManPowerInvolved` varchar(1000) DEFAULT NULL,
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

INSERT INTO `jobdatasheet` (`id`, `JobCodeNo`, `JobPostingDateTime`, `JobPostingDev`, `MachineName`, `Priority`, `ReportTo`, `BDescription`, `Username`, `JobStatusE`, `JobStatusM`, `ManPowerInvolved`, `Approval`, `FinishedCommentE`, `FinishedCommentM`, `TransferCommentE`, `TransferCommentM`, `ApproveComment`, `DisapproveComment`, `DownTime`, `TryCount`) VALUES
(383, 'WO1', '2024-09-05 15:28:56', 'CCF', 'SICTRA W/D MACHINE ', 'Low', 'Both', 'u', 'lanka', 'Pending', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(386, 'JO383', '2024-09-02 14:02:12', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'll', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(388, 'JO387', '2024-09-02 14:03:55', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'i', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(389, 'JO389', '2024-09-02 14:04:01', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgdg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(390, 'JO390', '2024-09-02 14:04:34', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'gergdg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(392, 'JO391', '2024-09-02 14:05:40', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'fghfghfgh', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(393, 'JO393', '2024-09-02 14:05:57', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'erete', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(394, 'JO394', '2024-09-02 14:06:09', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'ryrty', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(395, 'JO395', '2024-09-02 14:06:50', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgdg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(396, 'JO396', '2024-09-02 14:06:54', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgfdg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(397, 'JO397', '2024-09-02 14:06:58', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgfd', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(398, 'JO398', '2024-09-02 14:08:52', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'tfghfg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(399, 'JO399', '2024-09-02 14:09:51', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'sdfsf', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(400, 'JO400', '2024-09-02 14:09:56', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', 'tryrt', 'ranga', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(401, 'JO401', '2024-09-02 14:11:15', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', '401 JOB', 'ranga', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(402, 'JO402', '2024-09-02 14:11:55', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', '402 J royle', 'ranga', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(403, 'JO403', '2024-09-02 14:12:03', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', '402 sictra', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(404, 'JO404', '2024-09-02 14:14:02', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'dfgdgdg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(405, 'JO405', '2024-09-02 14:14:12', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', 'r', 'ranga', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(406, 'JO406', '2024-09-02 14:14:18', 'Carpentry', 'WOOD PLANER MACHINE - 1 [LIDA]', 'Low', 'Electrical', 'ff', 'sarath', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(407, 'JO407', '2024-09-05 16:15:05', 'CCF', 'PISTON TYPE COMPRESSOR - 3   [KIRLOSCAR] ', 'Critical', 'Both', 'fg', 'lanka', 'Pending', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(408, 'JO408', '2024-09-02 14:16:21', 'Carpentry', 'WOOD PLANER MACHINE - 1 [LIDA]', 'Low', 'Electrical', 'fdg', 'sarath', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(409, ' WO409', '2024-09-03 10:09:47', 'CCF', 'SICTRA W/D MACHINE ', 'Low', 'Electrical', 'aaa', 'lanka', 'Finished', 'NA', 'efwfw', 'Approved', 'sdfsfs', NULL, NULL, NULL, NULL, NULL, '00-00-09 05:50:01', 1),
(410, 'JO410', '2024-09-02 14:18:15', 'Carpentry', 'WOOD PLANER MACHINE - 1 [LIDA]', 'Low', 'Electrical', 'aaaa', 'sarath', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(411, ' WO411', '2024-09-03 10:08:53', 'CCF', 'SICTRA W/D MACHINE ', 'Low', 'Electrical', 'gfj', 'lanka', 'Started', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(412, 'JO412', '2024-09-02 14:46:14', 'ACF', 'JOHN ROYLE EXTRUDER', 'Low', 'Electrical', 'aaa', 'ranga', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(414, ' WO414', '2024-09-03 10:04:08', 'CCF', 'PIONEER MEDIUM W/D MACHINE  [DB 17] ', 'High', 'Both', 'dfgdg', 'lanka', 'Started', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(415, ' WO415', '2024-09-02 15:25:50', 'CCF', 'SICTRA W/D MACHINE ', 'Low', 'Electrical', 'sdfsfsf', 'lanka', 'Started', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(417, ' JO417', '2024-09-03 10:13:50', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'rthrh', 'lanka', 'Started', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(418, ' JO418', '2024-09-03 10:28:46', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'asdasf', 'lanka', 'Started', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(419, 'WO419', '2024-09-05 15:29:13', 'CCF', 'SICTRA W/D MACHINE ', 'Low', 'Electrical', 'gff', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(422, ' JOO422', '2024-09-04 16:03:59', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'dfgfdgd', 'lanka', 'Started', 'Started', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(423, ' JO423', '2024-09-04 16:18:11', 'CCF', 'SICTRA W/D MACHINE', 'High', 'Both', 'jiol;jkol;', 'lanka', 'Pending', 'Started', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(424, 'WOO424', '2024-09-05 15:28:41', 'CCF', 'SICTRA W/D MACHINE ', 'High', 'Both', 'efsdf', 'lanka', 'Pending', 'Pending', 'jfgjghj', 'Pending Approval', NULL, 'ghjhgj', NULL, NULL, NULL, NULL, '00-00-00 00:23:16', 1),
(425, ' JO425', '2024-09-05 11:57:57', 'CCF', 'CUTTING WINDER I & II', 'High', 'Both', ',l.,', 'lanka', 'Pending', 'Started', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(426, 'WO426', '2024-09-05 16:15:17', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Electrical', 'tgijo', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(427, ' ', '2024-09-05 16:15:43', 'CCF', 'SICTRA W/D MACHINE', 'Low', 'Both', 'iop[io[iop[po[', 'lanka', 'Started', 'Pending', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(428, 'JO428', '2024-09-12 15:58:44', 'CCF', 'TINNING PLANT ', 'Low', 'Electrical', 'xcfgdfgdfg', 'lanka', 'Pending', 'NA', NULL, 'Pending Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

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
(42, 'JO428', 'used');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
