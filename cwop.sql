-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 12:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwop`
--

-- --------------------------------------------------------

--
-- Table structure for table `counselor_records`
--

CREATE TABLE `counselor_records` (
  `counsel_id` int(11) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `counselor_name` varchar(255) DEFAULT NULL,
  `salvation_status` text DEFAULT NULL,
  `baptism_status` text DEFAULT NULL,
  `prayer_status` text DEFAULT NULL,
  `assurance_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counselor_records`
--

INSERT INTO `counselor_records` (`counsel_id`, `patient_id`, `counselor_name`, `salvation_status`, `baptism_status`, `prayer_status`, `assurance_status`) VALUES
(1, 1, 'Test', 'on', 'on', 'on', 'on'),
(2, 1, '23', 'on', 'on', 'on', 'on'),
(3, 1, '23', 'on', 'on', 'on', 'on'),
(4, 1, 'RJ', 'on', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `partners` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `ID` int(255) NOT NULL,
  `orgName` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `services` varchar(255) DEFAULT NULL,
  `fbaccount` varchar(255) DEFAULT NULL,
  `address` varchar(78) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID`, `lastName`, `firstName`, `age`, `gender`, `services`, `fbaccount`, `address`, `area`, `email`, `number`, `datetime`, `status`) VALUES
(1, 'Escala', 'Bien', '24', 'Male', 'Medical Adult', 'Bien', 'B7 L4 Flamingo Street Don Mariano Subdivision Cainta, Rizal', 'Cainta, Rizal', 'escalabien@gmail.com', '09691977018', '2025-01-31 10:55:21', 'Done'),
(2, 'Morilla', 'Roel Joseph', '28', 'Male', 'Medical Pedia', 'escalabien', 'B7 L4 Flamingo Street Don Mariano Subdivision Cainta, Rizal', 'Cainta, Rizal', 'escalabien@gmail.com', '23123123213', '2025-01-31 10:57:32', 'Pre-Registered');

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnostics_record`
--

CREATE TABLE `patient_diagnostics_record` (
  `diagnostic_id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `cbc` text NOT NULL,
  `blood_typing` text NOT NULL,
  `urinalysis` text NOT NULL,
  `diagnosis` text NOT NULL,
  `recommendations` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_diagnostics_record`
--

INSERT INTO `patient_diagnostics_record` (`diagnostic_id`, `patient_id`, `cbc`, `blood_typing`, `urinalysis`, `diagnosis`, `recommendations`) VALUES
(1, 1, 'on', 'on', 'on', 'Test', 'Test'),
(2, 1, 'on', 'on', 'on', '23', '23'),
(3, 1, 'on', 'on', 'on', '23', '23'),
(4, 1, 'on', 'on', 'on', '23', '23');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vitals_record`
--

CREATE TABLE `patient_vitals_record` (
  `vitals_id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `bp` int(255) NOT NULL,
  `pr` int(255) NOT NULL,
  `rr` int(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_vitals_record`
--

INSERT INTO `patient_vitals_record` (`vitals_id`, `patient_id`, `bp`, `pr`, `rr`, `temp`, `weight`, `height`) VALUES
(1, 1, 23, 0, 23, '23', '23', '23'),
(2, 1, 23, 0, 23, '23', '23', '23'),
(3, 1, 23, 0, 23, '23', '23', '23'),
(4, 1, 24, 0, 23, '23', '23', '23');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `membership_status` enum('Member','Non-Member') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counselor_records`
--
ALTER TABLE `counselor_records`
  ADD PRIMARY KEY (`counsel_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient_diagnostics_record`
--
ALTER TABLE `patient_diagnostics_record`
  ADD PRIMARY KEY (`diagnostic_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patient_vitals_record`
--
ALTER TABLE `patient_vitals_record`
  ADD PRIMARY KEY (`vitals_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counselor_records`
--
ALTER TABLE `counselor_records`
  MODIFY `counsel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_diagnostics_record`
--
ALTER TABLE `patient_diagnostics_record`
  MODIFY `diagnostic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_vitals_record`
--
ALTER TABLE `patient_vitals_record`
  MODIFY `vitals_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_diagnostics_record`
--
ALTER TABLE `patient_diagnostics_record`
  ADD CONSTRAINT `patient_diagnostics_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `patient_vitals_record`
--
ALTER TABLE `patient_vitals_record`
  ADD CONSTRAINT `FK` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
