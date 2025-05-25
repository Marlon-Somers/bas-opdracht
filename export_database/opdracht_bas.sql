-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 07:15 PM
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
-- Database: `bbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikelen`
--

CREATE TABLE `artikelen` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(50) NOT NULL,
  `artInkoop` decimal(5,2) DEFAULT NULL,
  `artVerkoop` decimal(5,2) DEFAULT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikelen`
--

INSERT INTO `artikelen` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 'mango\'s', 1.20, 2.50, 50, 10, 100, 12);

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(50) NOT NULL,
  `klantEmail` varchar(50) NOT NULL,
  `klantAdres` varchar(100) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Marlon Somers', 'mar@mail.com', 'straat 1', '1234AB', 'Rotterdam');

-- --------------------------------------------------------

--
-- Table structure for table `verkooporders`
--

CREATE TABLE `verkooporders` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) DEFAULT NULL,
  `artId` int(11) DEFAULT NULL,
  `verkOrdDatum` date DEFAULT NULL,
  `verkOrdBestAantal` int(11) DEFAULT NULL,
  `verkOrdStatus` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verkooporders`
--

INSERT INTO `verkooporders` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(1, 1, 1, '2025-05-20', 2, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artId`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexes for table `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD KEY `klantId` (`klantId`),
  ADD KEY `artId` (`artId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verkooporders`
--
ALTER TABLE `verkooporders`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD CONSTRAINT `verkooporders_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`),
  ADD CONSTRAINT `verkooporders_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
