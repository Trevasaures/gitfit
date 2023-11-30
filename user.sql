-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 03:50 AM
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
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `current_weight` decimal(10,0) NOT NULL,
  `target_weight` decimal(10,0) NOT NULL,
  `height_inches` decimal(10,0) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`name`, `age`, `gender`, `email`, `password`, `current_weight`, `target_weight`, `height_inches`, `id`, `username`, `created_at`) VALUES
('cameron perez', 27, 'male', 'perecame8700@gmail.com', '$2y$10$lv4EbAlYzIp8huPkO/wU0uVrfLNTXFL8gpFi2O2YdeGN51As4jNoK', 180, 190, 72, 1, 'camperez', '2023-11-17 18:15:38'),
('cameron perez', 27, 'male', 'cameron.perez@my.utsa.edu', '$2y$10$siCDRFWWJ91q.sNnLupO0eFU1A5tOO4Xx730E8zT1DENJsD5Lyf4C', 187, 190, 72, 2, 'life', '2023-11-17 19:32:26'),
('timmy tim', 27, 'male', 'tim@gmail.com', '$2y$10$MODK1R/gofi9sbUU9MD6.eZvzAlA8U701rezFZiNmGXQPJoGqiz3y', 180, 190, 72, 3, 'tim', '2023-11-18 02:09:18'),
('Trevor', 27, 'male', 'trevorcolen1@gmail.com', '$2y$10$UrZWbKP9T7Dj3wJjWKdrMexTldk87QhW8l3zpf8OQOnCLtUpe9zBG', 168, 160, 67, 4, 'Trevasaures', '2023-11-28 20:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_notes`
--

CREATE TABLE `user_notes` (
  `note_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `note_title` varchar(255) DEFAULT NULL,
  `note_content` text DEFAULT NULL,
  `note_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notes`
--

INSERT INTO `user_notes` (`note_id`, `id`, `note_title`, `note_content`, `note_date`) VALUES
(11, 4, NULL, 'new notes', '2023-11-28 17:19:26'),
(12, 4, NULL, 'new notes', '2023-11-28 17:19:29'),
(13, 4, NULL, 'notes', '2023-11-28 17:24:20'),
(14, 4, NULL, 'notes', '2023-11-28 17:24:23'),
(15, 4, NULL, 'hi', '2023-11-29 20:46:10'),
(16, 4, NULL, 'hi', '2023-11-29 20:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `weight_records`
--

CREATE TABLE `weight_records` (
  `weight_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `weight_date` date DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight_records`
--

INSERT INTO `weight_records` (`weight_id`, `id`, `weight_date`, `weight`) VALUES
(1, 2, '2023-11-17', 189.00),
(3, 3, '2023-11-17', 191.00),
(9, 4, '2023-11-28', 168.00);

-- --------------------------------------------------------

--
-- Table structure for table `workout_data`
--

CREATE TABLE `workout_data` (
  `workout_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exercise` varchar(255) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_data`
--

INSERT INTO `workout_data` (`workout_id`, `id`, `date`, `exercise`, `sets`, `reps`) VALUES
(2, 2, '2023-11-17', 'Bench Press', 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`email`),
  ADD UNIQUE KEY `UNIQUE_USERNAM` (`username`);

--
-- Indexes for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `weight_records`
--
ALTER TABLE `weight_records`
  ADD PRIMARY KEY (`weight_id`),
  ADD UNIQUE KEY `id` (`id`,`weight_date`);

--
-- Indexes for table `workout_data`
--
ALTER TABLE `workout_data`
  ADD PRIMARY KEY (`workout_id`),
  ADD UNIQUE KEY `id` (`id`,`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_notes`
--
ALTER TABLE `user_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `weight_records`
--
ALTER TABLE `weight_records`
  MODIFY `weight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `workout_data`
--
ALTER TABLE `workout_data`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD CONSTRAINT `user_notes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `weight_records`
--
ALTER TABLE `weight_records`
  ADD CONSTRAINT `weight_records_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `workout_data`
--
ALTER TABLE `workout_data`
  ADD CONSTRAINT `workout_data_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
