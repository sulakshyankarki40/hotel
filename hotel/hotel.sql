-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 07:41 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `admin_pass`) VALUES
('sulakshan', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `billinginfo`
--

CREATE TABLE `billinginfo` (
  `ROOMTYPE` varchar(50) NOT NULL,
  `PRICE` int(50) NOT NULL,
  `FULLNAME` varchar(50) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `PHONENUMBER` int(50) NOT NULL,
  `NOOFROOM` int(10) NOT NULL,
  `CHECKIN` date NOT NULL,
  `CHECKOUT` date NOT NULL,
  `TOTALPRICE` int(50) NOT NULL,
  `NO` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billinginfo`
--

INSERT INTO `billinginfo` (`ROOMTYPE`, `PRICE`, `FULLNAME`, `ADDRESS`, `PHONENUMBER`, `NOOFROOM`, `CHECKIN`, `CHECKOUT`, `TOTALPRICE`, `NO`) VALUES
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-20', '2024-09-26', 200, 1),
('Deluxe Room', 300, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-19', '2024-09-27', 300, 2),
('Deluxe Room', 300, 'sulakshyan', 'bafal', 2345677, 12, '2024-09-27', '2024-09-28', 3600, 3),
('Deluxe Room', 300, 'sulakshyan', 'bafal', 2345677, 12, '2024-09-27', '2024-09-28', 3600, 4),
('Deluxe Room', 300, 'sulakshyan', 'bafal', 2345677, 12, '2024-09-27', '2024-09-28', 3600, 5),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-12', '2024-09-17', 200, 6),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-20', '2024-09-19', 200, 7),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-20', '2024-09-19', 200, 8),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-20', '2024-09-24', 200, 9),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, -1, '2024-09-28', '2024-09-20', -200, 10),
('Simple Room', 200, 'sulakshyan', 'bafal', 2345677, 1, '2024-09-27', '2024-09-27', 200, 11);

-- --------------------------------------------------------

--
-- Table structure for table `check`
--

CREATE TABLE `check` (
  `CHECK_IN` date NOT NULL,
  `CHECK_OUT` date NOT NULL,
  `TYPE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `NO` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SUBJECT` varchar(200) NOT NULL,
  `MESSAGE` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`NO`, `NAME`, `EMAIL`, `SUBJECT`, `MESSAGE`) VALUES
(1, 'sdfe', 'zczxvzv@gmail.com', 'dvvvvvx', 'sdgsbfdbb'),
(2, 'sdfe', 'zczxvzv@gmail.com', 'dvvvvvx', 'sdgsbfdbb');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `NO` int(50) NOT NULL,
  `FULLNAME` varchar(50) NOT NULL,
  `PHONENUMBER` int(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`NO`, `FULLNAME`, `PHONENUMBER`, `EMAIL`, `PASSWORD`) VALUES
(1, 'sulakshyan', 2147483647, 'sulakshyankarki@gmail.com', '$2y$10$c0Pqz0/SziB8H8Fz/Xx1ouKL6GtzrKmymkycc/p2WDR'),
(2, 'sulakshan', 2147483647, 'sulakshyankarki1@gmail.com', '$2y$10$HwQQCYHEFayFr9.NRsM.HuH0lWyMCvEmxvAPE2jJ4rJ'),
(3, 'apurba', 2147483647, 'sulakshyankarki5@gmail.com', '$2y$10$Z39gBoP/34qDbe0zrTpsSujOdmn4r/DYPjVxCB0SFkD'),
(4, 'apu', 2147483647, 'apu123@gmail.cm', '$2y$10$H8APyiWdLy0n0eWBrBfbDOWPJwEQCUoWARtZ4gwNO4a'),
(5, 'sulakshyan', 2147483647, 'sulakshyankarki12@gmail.com', '$2y$10$l31.yeBNc89KebSihgcLaOuzCEEshokiaoYhSgo1v40'),
(6, 'sulakshyan', 2147483647, 'sulakshyankarki55@gmail.com', '$2y$10$ATI4cZOc6m6L.z/Zv5hJRemCaKdmKHpS2PP3Yn7p8Zl'),
(7, 'sulakshyan', 2147483647, 'sulakshyankarki70@gmail.com', '$2y$10$oZ7eSeCgFhODRZFgc9/QcuczPyzcOrVU2ml6ovPHPmq'),
(8, 'sulakshyan', 2147483647, 'sulakshyankarki11@gmail.com', '$2y$10$H276qXTXp7DRZYpr22pKv.uR7Bk57MTRJHZQMaQJMB1DDeMd18zCy'),
(9, 'sulakshyan', 2147483647, 'sulakshyankarki10@gmail.com', '$2y$10$FSecjpfBVIIkacgSGWQcye3WM24Eb9BzEubgdoScVpVajhU0C.tg.'),
(10, 'sulakshyan', 2147483647, 'sulakshyankarki85@gmail.com', '$2y$10$sY5tAyNv1M027GAP387C2e3S4rGEtPLDFk7sButFYcvusp9PzfSfu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billinginfo`
--
ALTER TABLE `billinginfo`
  ADD PRIMARY KEY (`NO`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`NO`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billinginfo`
--
ALTER TABLE `billinginfo`
  MODIFY `NO` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `NO` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
