-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 12:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccination_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_name` varchar(255) DEFAULT NULL,
  `Admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_name`, `Admin_password`) VALUES
(1, 'Admin', 'Admin@2023');

-- --------------------------------------------------------

--
-- Table structure for table `center_login_details`
--

CREATE TABLE `center_login_details` (
  `id` int(11) NOT NULL,
  `center_id` varchar(255) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_sign_up`
--

CREATE TABLE `center_sign_up` (
  `center_id` int(11) NOT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_1` varchar(255) DEFAULT NULL,
  `password_2` varchar(255) DEFAULT NULL,
  `hospital_status` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `start_time` varchar(90) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_time` varchar(90) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_1` varchar(255) NOT NULL,
  `password_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` int(255) NOT NULL,
  `Contact_Number` varchar(255) DEFAULT NULL,
  `NIC_Number` varchar(255) DEFAULT NULL,
  `Email_Address` varchar(255) DEFAULT NULL,
  `Date_of_Vaccination` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Preferred_Center` varchar(255) DEFAULT NULL,
  `Vaccination_Type` varchar(255) DEFAULT NULL,
  `Booking_Slots` varchar(255) DEFAULT NULL,
  `Dose` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `appointment` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `report` varchar(255) NOT NULL,
  `appointment_id` int(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `send_report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_reports`
--

CREATE TABLE `vaccination_reports` (
  `id` int(11) NOT NULL,
  `UserID` int(60) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `date_of_vaccination` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `dosage` varchar(10) NOT NULL,
  `vaccination_type` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `preferred_center` varchar(255) NOT NULL,
  `nic_number` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `send_report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `center_login_details`
--
ALTER TABLE `center_login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `center_sign_up`
--
ALTER TABLE `center_sign_up`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `center_login_details`
--
ALTER TABLE `center_login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `center_sign_up`
--
ALTER TABLE `center_sign_up`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sign_up`
--
ALTER TABLE `sign_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  ADD CONSTRAINT `vaccination_reports_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
