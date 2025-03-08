-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 03:52 PM
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
  `household_size` int(11) DEFAULT NULL,
  `number_of_children` int(11) DEFAULT NULL,
  `number_of_elders` int(11) DEFAULT NULL,
  `pets` enum('None','Dogs','Cats','Other') DEFAULT 'None',
  `preferred_nationality` varchar(255) DEFAULT NULL,
  `preferred_language` varchar(255) DEFAULT NULL,
  `work_type` enum('Full-time','Part-time') NOT NULL,
  `special_requirements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `fname`, `lname`, `address`, `contact_number`, `created_at`, `updated_at`, `email`, `notes`, `household_size`, `number_of_children`, `number_of_elders`, `pets`, `preferred_nationality`, `preferred_language`, `work_type`, `special_requirements`) VALUES
(1, 'Pon', 'Thiha', '33, Jalan Mahkota 2, Kawasan 17, 41150, Klang, Selangor', '0183892798', '2025-02-24 10:11:37', '2025-02-24 10:48:41', 'p.p.thiha76@gmail.com', 'Hi test test test', NULL, NULL, NULL, 'None', NULL, NULL, 'Full-time', NULL),
(6, 'john', 'doe', 'da', '0183892798', '2025-03-08 11:12:30', '2025-03-08 11:13:03', 'admin@gmail.com', 'hi', 5, 1, 1, 'Other', 'malay', 'english', 'Full-time', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_type` enum('global','local') NOT NULL DEFAULT 'local',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `title`, `description`, `event_type`, `user_id`, `created_at`, `updated_at`) VALUES
(18, '2025-03-07', 'hi', 'hi', 'local', 12, '2025-03-07 06:36:54', '2025-03-07 06:36:54');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nationality` varchar(100) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maid`
--

INSERT INTO `maid` (`maid_id`, `fname`, `lname`, `date_of_birth`, `visa_details_id`, `skills`, `employment_status`, `created_at`, `updated_at`, `nationality`, `language`) VALUES
(10, 'Lim', 'Joaquin', '2005-02-17', 9, 'Cleaning', 'Available', '2025-03-08 10:08:04', '2025-03-08 11:21:19', 'Indonesian', 'English');

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
  `is_verified` tinyint(1) DEFAULT 0,
  `reset_code` varchar(10) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `role`, `created_at`, `verification_code`, `is_verified`, `reset_code`, `reset_expires`) VALUES
(12, 'haxtergt76@gmail.com', '$2y$10$Zq7qjvfEBw/B9jvvz6rIiO5t5Zl6QagUSM4eiF3pZrIB6DsWVtXNC', 'Phone', 'Thiha', 'user', '2025-02-26 11:45:33', NULL, 1, NULL, NULL),
(13, 'vaultmaid@gmail.com', '$2y$10$zLJAakgNvnlW0ct7EDSCQe6WuTgX2jYeZTedsggrWAuIfqOq8WP0y', 'admin', 'admin', 'admin', '2025-02-26 11:47:45', NULL, 1, NULL, NULL);

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
  `maid_id` int(11) NOT NULL,
  `visa_image` varchar(255) DEFAULT NULL,
  `passport_image` varchar(255) DEFAULT NULL,
  `work_permit_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visa_details`
--

INSERT INTO `visa_details` (`id`, `visa_type`, `visa_number`, `date_of_issue`, `expiration_date`, `visa_duration`, `work_permit_status`, `passport_number`, `issuing_country`, `immigration_reference_number`, `entry_date`, `exit_date`, `maid_id`, `visa_image`, `passport_image`, `work_permit_image`) VALUES
(9, 'Single Entry', '123123123', '2025-03-02', '2025-03-31', '2 years', 'Available', 'MF293023', 'Malaysia', '34123123123', '2025-03-08', '2025-03-08', 10, 'uploads/visa_images/1741429826_2-1.jpg', 'uploads/passport_images/1741429986_Indonesian_passport_data_page.jpg', 'uploads/work_permit_images/1741429986_employment-pass-659x450.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `maid`
--
ALTER TABLE `maid`
  MODIFY `maid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `visa_details`
--
ALTER TABLE `visa_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
