-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 09:44 PM
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
-- Database: `awis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `esp`
--

CREATE TABLE `esp` (
  `espID` int(11) NOT NULL,
  `Main_moist_sensingID` int(11) NOT NULL,
  `sensorID` int(11) NOT NULL,
  `relayID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_moist_sensing`
--

CREATE TABLE `main_moist_sensing` (
  `Main_moist_sensingID` int(11) NOT NULL,
  `relayID` int(11) NOT NULL,
  `sensorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay`
--

CREATE TABLE `relay` (
  `relayID` int(11) NOT NULL,
  `relay_status` int(11) NOT NULL,
  `espID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ricefield`
--

CREATE TABLE `ricefield` (
  `ricefieldID` int(11) NOT NULL,
  `ricefield_Name` varchar(50) NOT NULL,
  `rice_variant` varchar(50) NOT NULL,
  `square_meter` decimal(10,2) NOT NULL,
  `date_started_planting` datetime NOT NULL,
  `stageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `stageID` int(11) NOT NULL,
  `stage_name` varchar(50) NOT NULL,
  `current_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `substageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_stage`
--

CREATE TABLE `sub_stage` (
  `substageID` int(11) NOT NULL,
  `substage_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `espID` int(11) NOT NULL,
  `ricefieldID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `espID`, `ricefieldID`) VALUES
(1, 'aram@gmail.com', 'Arambuuu', '$2y$10$mFgItTsm7eGuoU2lwaEBSeJwVcxjQkXNDVLeTsTft1duOvpqsuF6K', 0, 0),
(2, 'sample@gmail.com', 'aram', '$2y$10$WNAOmpatywsbJF7ATk8DDekZEDjgG17IgdRqrRsX0IX3NkjOXrPJa', 0, 0),
(3, 'user@gmail.com', 'user', '$2y$10$xrE0IjIlSgKXqesVBLvbUOvNharn6.YAJMzswlnRIkfyw2/Cq5R/u', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `water_levels`
--

CREATE TABLE `water_levels` (
  `sensorID` int(11) NOT NULL,
  `water_level` int(11) NOT NULL,
  `current_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_levels`
--

INSERT INTO `water_levels` (`sensorID`, `water_level`, `current_time`) VALUES
(1, 123, '2024-08-31 13:58:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esp`
--
ALTER TABLE `esp`
  ADD PRIMARY KEY (`espID`),
  ADD KEY `fk_Main_moist_sensingID` (`Main_moist_sensingID`),
  ADD KEY `fk_sensor` (`sensorID`),
  ADD KEY `fk_relayID` (`relayID`);

--
-- Indexes for table `main_moist_sensing`
--
ALTER TABLE `main_moist_sensing`
  ADD PRIMARY KEY (`Main_moist_sensingID`),
  ADD KEY `fk_relay` (`relayID`),
  ADD KEY `fk_water_level` (`sensorID`);

--
-- Indexes for table `relay`
--
ALTER TABLE `relay`
  ADD PRIMARY KEY (`relayID`);

--
-- Indexes for table `ricefield`
--
ALTER TABLE `ricefield`
  ADD PRIMARY KEY (`ricefieldID`),
  ADD KEY `fk_stageID` (`stageID`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`stageID`),
  ADD KEY `fk_stage` (`substageID`);

--
-- Indexes for table `sub_stage`
--
ALTER TABLE `sub_stage`
  ADD PRIMARY KEY (`substageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_levels`
--
ALTER TABLE `water_levels`
  ADD PRIMARY KEY (`sensorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esp`
--
ALTER TABLE `esp`
  MODIFY `espID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_moist_sensing`
--
ALTER TABLE `main_moist_sensing`
  MODIFY `Main_moist_sensingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay`
--
ALTER TABLE `relay`
  MODIFY `relayID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ricefield`
--
ALTER TABLE `ricefield`
  MODIFY `ricefieldID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `stageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_stage`
--
ALTER TABLE `sub_stage`
  MODIFY `substageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `water_levels`
--
ALTER TABLE `water_levels`
  MODIFY `sensorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `esp`
--
ALTER TABLE `esp`
  ADD CONSTRAINT `fk_Main_moist_sensingID` FOREIGN KEY (`Main_moist_sensingID`) REFERENCES `main_moist_sensing` (`Main_moist_sensingID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_relayID` FOREIGN KEY (`relayID`) REFERENCES `relay` (`relayID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sensor` FOREIGN KEY (`sensorID`) REFERENCES `water_levels` (`sensorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `main_moist_sensing`
--
ALTER TABLE `main_moist_sensing`
  ADD CONSTRAINT `fk_relay` FOREIGN KEY (`relayID`) REFERENCES `relay` (`relayID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_water_level` FOREIGN KEY (`sensorID`) REFERENCES `water_levels` (`sensorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ricefield`
--
ALTER TABLE `ricefield`
  ADD CONSTRAINT `fk_stageID` FOREIGN KEY (`stageID`) REFERENCES `stage` (`stageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `fk_stage` FOREIGN KEY (`substageID`) REFERENCES `sub_stage` (`substageID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
