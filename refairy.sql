-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 05:13 PM
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
-- Database: `refairy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `remember_token`, `token_expiry`) VALUES
(10, 'admin2', '0192023a7bbd73250516f069df18b500', 'f8e0aca40d11124bf94de7468a5bd1baca80d9cbd5e0b4725227d60ab91c66db', '2025-06-16 10:14:26'),
(11, 'admin3', '0192023a7bbd73250516f069df18b500', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `repair_service` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `name`, `date`, `repair_service`, `description`, `created_at`) VALUES
(14, 'oli', '2025-02-01', 'saasf', 'safsaf', '2025-05-27 20:19:52'),
(15, 'a', NULL, 'df', 'sdf', '2025-05-27 20:21:13'),
(16, 'b', '4555-06-07', 'fdsdsf', 'sdfsdf', '2025-05-27 20:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `code`, `brand`, `location`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'oli', '123', 'shell', 'rak 1', 1, '1748333393_download.jpg', '2025-05-27 08:09:53', '2025-05-27 08:09:53'),
(3, 'Ban', '123', 'pirelli', 'Rak 2', 25, '1748441282_bf0d72debcfdd831974449e71e4133c0.jpg', '2025-05-28 14:08:02', '2025-05-28 14:08:02'),
(4, 'Aki', '456', 'Merek terkenal', 'rak 8', 0, '1748441500_ezgif.com-resize-3.jpg', '2025-05-28 14:11:40', '2025-05-28 14:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text DEFAULT NULL,
  `date_last_visit` date DEFAULT NULL,
  `repair_service` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `progress` enum('in-progress','complete') DEFAULT 'in-progress',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `name`, `contact`, `address`, `date_last_visit`, `repair_service`, `description`, `progress`, `created_at`, `updated_at`) VALUES
(14, 'oli', '123', 'qwee', '2025-02-01', 'saasf', 'safsaf', 'complete', '2025-05-27 20:04:36', '2025-05-27 20:19:52'),
(15, 'a', '12', 'sdklljfda', NULL, 'df', 'sdf', 'complete', '2025-05-27 20:20:18', '2025-05-27 20:21:13'),
(16, 'b', '800795', 'jfsdlkjfsak', '4555-06-07', 'fdsdsf', 'sdfsdf', 'complete', '2025-05-27 20:20:52', '2025-05-27 20:21:18');

--
-- Triggers `management`
--
DELIMITER $$
CREATE TRIGGER `insert_into_history_after_update` AFTER UPDATE ON `management` FOR EACH ROW BEGIN
  IF NEW.progress = 'complete' AND OLD.progress != 'complete' THEN
    INSERT INTO history (id, name, date, repair_service, description)
    VALUES (NEW.id, NEW.name, NEW.date_last_visit, NEW.repair_service, NEW.description);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `employment` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `admin_id`, `username`, `email`, `employment`, `photo`) VALUES
(1, 10, 'admin', 'steve@mail', 'Mekanik', '../uploads/profile_photos/1748431238_54f4b55a59ff9ddf2a2655c7f35e4356.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
