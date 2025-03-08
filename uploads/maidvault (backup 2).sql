-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 04:35 PM
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
(7, 'Ahmad', 'Bin Ali', 'No. 1, Jalan Ampang, 50450 Kuala Lumpur, Wilayah Persekutuan', '0123456789', '2025-01-05 01:15:00', '2025-01-05 01:15:00', 'ahmad.ali@example.com', 'First client', 4, 2, 0, 'None', 'Malaysian', 'Malay', 'Full-time', ''),
(8, 'Siti', 'Binti Ahmad', 'No. 2, Jalan Tun Razak, 50400 Kuala Lumpur, Wilayah Persekutuan', '0123456788', '2025-01-06 02:20:00', '2025-01-06 02:20:00', 'siti.ahmad@example.com', '', 3, 1, 1, 'Cats', 'Malaysian', 'Malay', 'Part-time', 'Requires cleaning on weekends'),
(9, 'Lim', 'Chong', 'No. 10, Jalan Bukit Bintang, 55100 Kuala Lumpur, Wilayah Persekutuan', '0123456777', '2025-01-07 03:30:00', '2025-01-07 03:30:00', 'lim.chong@example.com', 'Frequent client', 5, 0, 0, 'Dogs', 'Malaysian', 'English', 'Full-time', ''),
(10, 'Tan', 'Ah Kow', 'No. 25, Jalan Ipoh, 30000 Ipoh, Perak', '0123456766', '2025-01-08 04:45:00', '2025-01-08 04:45:00', 'tan.ahkow@example.com', '', 4, 2, 0, 'None', 'Malaysian', 'English', 'Part-time', ''),
(11, 'Raj', 'Singh', 'No. 50, Jalan Penang, 10300 George Town, Pulau Pinang', '0123456755', '2025-01-09 00:30:00', '2025-01-09 00:30:00', 'raj.singh@example.com', 'Loyal customer', 6, 3, 1, 'Other', 'Malaysian', 'English', 'Full-time', 'Prefers eco-friendly products'),
(12, 'Nor', 'Hafizah', 'No. 7, Jalan Melaka, 75000 Melaka, Melaka', '0123456744', '2025-01-10 06:00:00', '2025-01-10 06:00:00', 'nor.hafizah@example.com', '', 3, 1, 0, 'None', 'Malaysian', 'Malay', 'Part-time', ''),
(13, 'Ahmad', 'Rashid', 'No. 100, Jalan Merdeka, 50000 Kuala Lumpur, Wilayah Persekutuan', '0123456733', '2025-02-01 01:00:00', '2025-02-01 01:00:00', 'ahmad.rashid@example.com', 'New client', 5, 2, 0, 'Dogs', 'Malaysian', 'Malay', 'Full-time', ''),
(14, 'Siti', 'Nur', 'No. 20, Jalan Petaling, 50050 Kuala Lumpur, Wilayah Persekutuan', '0123456722', '2025-02-02 02:10:00', '2025-02-02 02:10:00', 'siti.nur@example.com', 'Regular cleaning', 4, 1, 1, 'Cats', 'Malaysian', 'Malay', 'Part-time', ''),
(15, 'Lee', 'Wei', 'No. 5, Jalan Kuching, 93000 Kuching, Sarawak', '0123456711', '2025-02-03 03:15:00', '2025-02-03 03:15:00', 'lee.wei@example.com', '', 3, 0, 0, 'None', 'Malaysian', 'English', 'Full-time', ''),
(16, 'Wong', 'Kim', 'No. 8, Jalan Kuching, 93000 Kuching, Sarawak', '0123456700', '2025-02-04 04:20:00', '2025-02-04 04:20:00', 'wong.kim@example.com', 'Weekend client', 4, 2, 0, 'None', 'Malaysian', 'Chinese', 'Part-time', ''),
(17, 'Rahman', 'Ismail', 'No. 15, Jalan Bukit Bintang, 55100 Kuala Lumpur, Wilayah Persekutuan', '0123456699', '2025-02-05 05:25:00', '2025-02-05 05:25:00', 'rahman.ismail@example.com', '', 5, 3, 1, 'Other', 'Malaysian', 'Malay', 'Full-time', ''),
(18, 'Aminah', 'Binti Kassim', 'No. 12, Jalan Ipoh, 30000 Ipoh, Perak', '0123456688', '2025-02-06 06:30:00', '2025-02-06 06:30:00', 'aminah.kassim@example.com', 'Needs weekly deep cleaning', 4, 2, 0, 'None', 'Malaysian', 'Malay', 'Part-time', ''),
(19, 'Hassan', 'Abdullah', 'No. 30, Jalan Tun Razak, 50400 Kuala Lumpur, Wilayah Persekutuan', '0123456677', '2025-02-07 07:35:00', '2025-02-07 07:35:00', 'hassan.abdullah@example.com', '', 3, 1, 1, 'Dogs', 'Malaysian', 'Malay', 'Full-time', ''),
(20, 'Farah', 'Amin', 'No. 3, Jalan Merdeka, 50000 Kuala Lumpur, Wilayah Persekutuan', '0123456666', '2025-02-08 08:40:00', '2025-02-08 08:40:00', 'farah.amin@example.com', '', 5, 3, 0, 'None', 'Malaysian', 'English', 'Part-time', ''),
(21, 'Zainal', 'Iskandar', 'No. 6, Jalan Melaka, 75000 Melaka, Melaka', '0123456655', '2025-02-09 09:45:00', '2025-02-09 09:45:00', 'zainal.iskandar@example.com', 'Prefers evening service', 4, 2, 1, 'Cats', 'Malaysian', 'Malay', 'Full-time', ''),
(22, 'Ismail', 'Rahim', 'No. 9, Jalan Penang, 10300 George Town, Pulau Pinang', '0123456644', '2025-02-10 00:50:00', '2025-02-10 00:50:00', 'ismail.rahim@example.com', '', 3, 1, 0, 'None', 'Malaysian', 'English', 'Full-time', ''),
(23, 'Azman', 'Yusof', 'No. 11, Jalan Petaling, 50050 Kuala Lumpur, Wilayah Persekutuan', '0123456633', '2025-02-11 01:55:00', '2025-02-11 01:55:00', 'azman.yusof@example.com', '', 4, 2, 0, 'Other', 'Malaysian', 'Malay', 'Part-time', ''),
(24, 'Rashid', 'Hussein', 'No. 14, Jalan Bukit Bintang, 55100 Kuala Lumpur, Wilayah Persekutuan', '0123456622', '2025-02-12 02:00:00', '2025-02-12 02:00:00', 'rashid.hussein@example.com', 'Frequent service', 5, 3, 1, 'None', 'Malaysian', 'Malay', 'Full-time', ''),
(25, 'Sharifah', 'Kamal', 'No. 16, Jalan Kuching, 93000 Kuching, Sarawak', '0123456611', '2025-02-13 03:05:00', '2025-02-13 03:05:00', 'sharifah.kamal@example.com', '', 3, 1, 0, 'Cats', 'Malaysian', 'Malay', 'Part-time', '');

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
