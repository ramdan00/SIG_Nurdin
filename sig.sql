-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig`
--

-- --------------------------------------------------------

--
-- Table structure for table `kordinat_gis`
--

CREATE TABLE `kordinat_gis` (
  `nomor` int(5) NOT NULL,
  `x` decimal(8,5) NOT NULL,
  `y` decimal(8,5) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kordinat_gis`
--

INSERT INTO `kordinat_gis` (`nomor`, `x`, `y`, `nama_tempat`, `status`) VALUES
(7, -8.21961, 114.34965, 'Banyuwangi', 1),
(10, -8.72490, 115.17981, 'Pantai Kuta', 1),
(11, -8.24272, 114.48629, 'Melaya', 1),
(12, -8.64887, 115.19354, 'Denpasar', 1),
(13, -8.41121, 115.14273, 'Penebel', 1),
(14, -7.70687, 113.97817, 'Situbondo', 1),
(15, -8.43838, 115.62063, 'Karangasem', 1),
(16, -8.55247, 115.03836, 'Kerambitan', 1),
(17, -8.31202, 115.02188, 'Pupuan', 1),
(18, -8.00072, 114.40390, 'Wongsorejo', 1),
(19, -8.44109, 115.31714, 'Tampak Siring', 1),
(20, -8.73440, 115.54648, 'Nusa Penida', 1),
(21, -8.14756, 115.11389, 'Sukasada', 1),
(30, -7.34302, 108.21692, 'Plaza Asia Tasikmalaya', 0),
(34, -7.32656, 108.21993, 'MESJID AGUNG TASIK', 1),
(35, -7.33008, 108.20701, 'SMAN 4 Tasikmalaya', 1),
(36, -7.33135, 108.23366, 'STMIK DCI', 1),
(37, -7.31807, 108.20576, 'karma coffe', 0),
(38, -7.44001, 108.15650, 'Sukaraja', 1),
(39, -6.92620, 107.62051, 'Bandung', 1),
(40, -6.57652, 107.79273, 'Subang', 1),
(41, -6.60926, 106.81220, 'bogor', 1),
(42, -6.21077, 106.82319, 'jakarta', 0),
(43, -6.40187, 106.07656, 'Banten', 0),
(44, -7.31224, 108.23018, 'CAFFE Stitaco', 0),
(45, -7.31748, 108.18568, 'PERUM GRAHA JAYA', 0),
(46, -7.31148, 108.23842, 'SPBU Karang Resik', 0);

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `username`, `password`) VALUES
(1, 'jajang', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'user', '123'),
(3, 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kordinat_gis`
--
ALTER TABLE `kordinat_gis`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kordinat_gis`
--
ALTER TABLE `kordinat_gis`
  MODIFY `nomor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
