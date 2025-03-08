-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 01:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maidvault`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `fname`, `lname`, `address`, `contact_number`, `created_at`, `updated_at`, `email`, `notes`, `company_name`) VALUES
(1, 'Pon', 'Thiha', '33, Jalan Mahkota 2, Kawasan 17, 41150, Klang, Selangor', '0183892798', '2025-02-24 10:11:37', '2025-02-24 10:48:41', 'p.p.thiha76@gmail.com', 'Hi test test test', 'Sunway');

-- --------------------------------------------------------

--
-- Table structure for table `maid`
--

CREATE TABLE `maid` (
  `maid_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `visa_details_id` int(11) DEFAULT NULL,
  `skills` text NOT NULL,
  `employment_status` enum('Available','Hired','Inactive') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maid`
--

INSERT INTO `maid` (`maid_id`, `fname`, `lname`, `date_of_birth`, `visa_details_id`, `skills`, `employment_status`, `created_at`, `updated_at`) VALUES
(5, 'Lim', 'Joaquin', '2025-02-20', 4, 'Coding, Java Scripting', 'Inactive', '2025-02-20 10:39:58', '2025-02-24 10:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(10) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `role`, `created_at`, `verification_code`, `is_verified`) VALUES
(1, 'test@gmail.com', '$2y$10$OnxH0rg6JwAP/V4fPqpm3eHCEtQaP0K8CoylUpPIdVD6/8W66K/q2', 'dw', 'ad', 'user', '2025-02-08 09:18:47', NULL, 0),
(2, 'test2@gmail.com', '$2y$10$ncSH/Au.Kw/xu/BH.Slf2.6A/s0AyfOeZLeSmxQJ96BmhgtGD3wUm', 'vb', 'xc', 'user', '2025-02-13 11:09:56', NULL, 0),
(3, 'admin@gmail.com', '$2y$10$yomnVmAYcs4ZZsykJRM5uuzecXBoq.iT9IHGB1kxgeYYGXa3sWfIe', 'admin', 'admin', 'admin', '2025-02-16 11:04:52', NULL, 0),
(12, 'haxtergt76@gmail.com', '$2y$10$BzmF/Uc6.FkNpIxIYseBv.aFPPWpY97Ep6d3Yo/KPNq2QFDDiqtDy', 'Phone', 'Thiha', 'user', '2025-02-26 11:45:33', NULL, 1),
(13, 'vaultmaid@gmail.com', '$2y$10$zLJAakgNvnlW0ct7EDSCQe6WuTgX2jYeZTedsggrWAuIfqOq8WP0y', 'admin', 'admin', 'admin', '2025-02-26 11:47:45', NULL, 1),
(14, 'frankiner@gmaill.com', '$2y$10$M1ATapkgrtIND4ddqA6A8esamc2nOfrG3j7sDQcfvCgyjcxGG2a.m', 'Frankie', 'Aw', 'user', '2025-02-26 11:56:44', '588974', 0),
(15, 'frankiner@gmail.com', '$2y$10$Dct5PYBQtT0zPuhc/iWt4.3JlJIYdwrJSe/SbZ1VYqa6CDiP0pruC', 'Frankie', 'Aw', 'user', '2025-02-26 11:57:24', NULL, 1),
(16, 'kyawthusoe76.kpk@gmail.com', '$2y$10$t0e91r133l5SuOzwfLyGS.FgW9OAi140Rcf3DQj7IbWyTOXLo82uO', 'dwadwa', 'dwadwa', 'user', '2025-02-27 01:59:35', '351165', 0),
(17, 'kyawthusoe75.kpk@gmail.com', '$2y$10$wbEF5yTaGbX9dgEBCrYJ3u6KRQ/3Jq1J4yTNsTS9CVDmo.JFFKuUC', 'dwadwa', 'dwadwa', 'user', '2025-02-27 02:00:07', NULL, 1),
(18, 'blank.ggs.76@gmail.com', '$2y$10$du0c1SCXXGHZGBemiw7ULub19WidW22DUdqzRObE0QHDJyTjvE3My', 'Test', 'test', 'user', '2025-02-28 06:57:28', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visa_details`
--

CREATE TABLE `visa_details` (
  `id` int(11) NOT NULL,
  `visa_type` varchar(255) DEFAULT NULL,
  `visa_number` varchar(255) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `visa_duration` varchar(255) DEFAULT NULL,
  `work_permit_status` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `issuing_country` varchar(255) DEFAULT NULL,
  `immigration_reference_number` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `maid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visa_details`
--

INSERT INTO `visa_details` (`id`, `visa_type`, `visa_number`, `date_of_issue`, `expiration_date`, `visa_duration`, `work_permit_status`, `passport_number`, `issuing_country`, `immigration_reference_number`, `entry_date`, `exit_date`, `maid_id`) VALUES
(4, 'Work', '123123123', '2025-02-20', '2025-02-20', '2 years', 'Available', 'MF293023', 'Malaysia', '123123123', '2025-02-20', '2025-02-20', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `maid`
--
ALTER TABLE `maid`
  ADD PRIMARY KEY (`maid_id`),
  ADD KEY `fk_visa_details` (`visa_details_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visa_details`
--
ALTER TABLE `visa_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maid_id` (`maid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maid`
--
ALTER TABLE `maid`
  MODIFY `maid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `visa_details`
--
ALTER TABLE `visa_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maid`
--
ALTER TABLE `maid`
  ADD CONSTRAINT `fk_visa_details` FOREIGN KEY (`visa_details_id`) REFERENCES `visa_details` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `visa_details`
--
ALTER TABLE `visa_details`
  ADD CONSTRAINT `visa_details_ibfk_1` FOREIGN KEY (`maid_id`) REFERENCES `maid` (`maid_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
