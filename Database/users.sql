-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2023 at 11:16 AM
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
-- Database: `socmed`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `create_date`) VALUES
(12, 'eqweq', 'asdsad', '$2y$10$40uVS/yVjSLVtLdWr8U9sukh7ViCJITq/LEv6h5FAH2QZV1nQ8QmG', '2023-10-05 14:00:07'),
(13, 'eqweq', 'xjaylandero@gmail123', '$2y$10$5kY3KWj.gOy1KAKhDhQ3I.rPWcQlEbwD4Cx3wYRcVRRsRmZDu.08C', '2023-10-06 09:25:39'),
(14, 'cjay', 'cjay@gmail', '$2y$10$6kM/FpOwnalO89k97v9ZOeLhUHcLFGDGS1QDgOff64nZlCWH0nLpy', '2023-10-06 10:56:17'),
(15, 'cjay', 'xjaylandero@gmail', '$2y$10$u6xb3wB/AcHYFPgHQmzeDOerJnyTsuPQBfnJVjqErjcVU21rM0.im', '2023-10-06 11:46:44'),
(16, 'cjay', 'cjay123@gmail', '$2y$10$s6LUnJ1Fvyjt3.CV..eIa.7meLx5cSzNo1wyML3DjLcPUwXk7vKLq', '2023-10-07 08:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
