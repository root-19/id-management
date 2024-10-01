-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 02:21 PM
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
-- Database: `camarines`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `activity_description` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `activity_time` time NOT NULL,
  `activity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birth_registration`
--

CREATE TABLE `birth_registration` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(50) NOT NULL,
  `name_last` varchar(50) NOT NULL,
  `name_first` varchar(50) NOT NULL,
  `name_middle` varchar(50) DEFAULT NULL,
  `place_birth_city` varchar(50) DEFAULT NULL,
  `place_birth_province` varchar(50) DEFAULT NULL,
  `place_birth_street` varchar(50) DEFAULT NULL,
  `place_birth_barangay` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `father_last` varchar(50) DEFAULT NULL,
  `father_first` varchar(50) DEFAULT NULL,
  `father_middle` varchar(50) DEFAULT NULL,
  `mother_last` varchar(50) DEFAULT NULL,
  `mother_first` varchar(50) DEFAULT NULL,
  `mother_middle` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_registration`
--

INSERT INTO `birth_registration` (`id`, `registry_no`, `name_last`, `name_first`, `name_middle`, `place_birth_city`, `place_birth_province`, `place_birth_street`, `place_birth_barangay`, `date_of_birth`, `gender`, `father_last`, `father_first`, `father_middle`, `mother_last`, `mother_first`, `mother_middle`, `contact_no`, `date_added`) VALUES
(20, 'addadd', 'dadad', 'ada', 'dada', 'adad', 'ada', 'dad', 'adad', '2024-09-29', 'Female', 'ada', 'aaa', 'aa', 'aa', 'aaa', 'aa', 'adada', '2024-09-30 05:32:30'),
(21, 'aDAdA', 'DADAD', 'DAD', 'ADAD', 'DADAD', 'DAD', 'DAD', 'ADA', '2024-09-30', 'Female', 'ADAD', 'AD', 'DA', 'ADAD', 'ADAD', 'DAD', 'DADA', '2024-09-30 05:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `death_info`
--

CREATE TABLE `death_info` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(255) NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `founder_last_name` varchar(255) NOT NULL,
  `founder_first_name` varchar(255) NOT NULL,
  `founder_middle_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `founder_street` varchar(255) DEFAULT NULL,
  `founder_barangay` varchar(255) DEFAULT NULL,
  `founder_province` varchar(255) DEFAULT NULL,
  `founder_zipcode` varchar(10) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `cause_of_death` text DEFAULT NULL,
  ` date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death_info`
--

INSERT INTO `death_info` (`id`, `registry_no`, `date_of_death`, `founder_last_name`, `founder_first_name`, `founder_middle_name`, `gender`, `founder_street`, `founder_barangay`, `founder_province`, `founder_zipcode`, `occupation`, `civil_status`, `cause_of_death`, ` date_added`) VALUES
(6, 'adad', '0000-00-00', 'adad', 'adada', 'da', 'Female', 'adad', NULL, 'adad', NULL, 'dada', '', '', '2024-09-23 13:14:30'),
(7, 'rens', '0000-00-00', 'aDAd', 'adaD', 'DADA', 'Male', 'DADA', NULL, 'DADA', NULL, 'ADAD', '', '', '2024-09-28 14:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `live_births`
--

CREATE TABLE `live_births` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `date_time` datetime NOT NULL,
  `founder_last_name` varchar(50) NOT NULL,
  `founder_first_name` varchar(50) NOT NULL,
  `founder_middle_name` varchar(50) DEFAULT NULL,
  `founder_occupation` varchar(100) DEFAULT NULL,
  `founder_street` varchar(100) DEFAULT NULL,
  `founder_province` varchar(100) DEFAULT NULL,
  `founder_barangay` varchar(100) DEFAULT NULL,
  `founder_zipcode` varchar(10) DEFAULT NULL,
  `informant_last_name` varchar(50) NOT NULL,
  `informant_first_name` varchar(50) NOT NULL,
  `informant_middle_name` varchar(50) DEFAULT NULL,
  `informant_occupation` varchar(100) DEFAULT NULL,
  `relationship_to_founder` varchar(100) DEFAULT NULL,
  `informant_address` varchar(100) DEFAULT NULL,
  `informant_contact` varchar(15) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_births`
--

INSERT INTO `live_births` (`id`, `registry_no`, `contact_no`, `date_time`, `founder_last_name`, `founder_first_name`, `founder_middle_name`, `founder_occupation`, `founder_street`, `founder_province`, `founder_barangay`, `founder_zipcode`, `informant_last_name`, `informant_first_name`, `informant_middle_name`, `informant_occupation`, `relationship_to_founder`, `informant_address`, `informant_contact`, `date_added`) VALUES
(4, 'dadada', 'adad', '2024-09-23 14:32:22', 'adad', 'dada', 'dada', 'adad', 'adada', 'dad', 'adad', 'dad', 'adad', 'ada', 'adad', 'dad', 'adad', 'dad', 'daada', '2024-09-24 13:39:21'),
(5, 'ss', 'adada', '2024-09-30 06:45:53', 'adad', 'ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-09-30 04:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('successful','failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `login_time`, `ip_address`, `status`) VALUES
(3, 1, '2024-09-30 05:31:52', NULL, 'successful'),
(4, 1, '2024-09-30 05:33:52', NULL, 'successful');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_registrations`
--

CREATE TABLE `marriage_registrations` (
  `id` int(11) NOT NULL,
  `registry_no` varchar(255) NOT NULL,
  `date_of_marriage` date NOT NULL,
  `place_of_marriage` varchar(255) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `husband_birth_ref_no` varchar(100) NOT NULL,
  `husband_tin` varchar(100) NOT NULL,
  `wife_birth_ref_no` varchar(100) NOT NULL,
  `wife_tin` varchar(100) NOT NULL,
  `founder_last_name` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'users', 'user', '2024-09-14 16:44:19', '2024-09-30 04:22:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `birth_registration`
--
ALTER TABLE `birth_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_info`
--
ALTER TABLE `death_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_births`
--
ALTER TABLE `live_births`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `marriage_registrations`
--
ALTER TABLE `marriage_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `birth_registration`
--
ALTER TABLE `birth_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `death_info`
--
ALTER TABLE `death_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `live_births`
--
ALTER TABLE `live_births`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marriage_registrations`
--
ALTER TABLE `marriage_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
