-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 04:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-wallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `amount` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`amount`, `datetime`, `user_id`) VALUES
(10, '2021-04-10 22:44:23', 100007),
(100, '2021-04-10 22:46:20', 100007);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(6) NOT NULL,
  `datetime` datetime DEFAULT current_timestamp(),
  `amount` int(15) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `receiver_id` bigint(100) NOT NULL,
  `rem_balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `datetime`, `amount`, `sender_id`, `receiver_id`, `rem_balance`) VALUES
(17, '2021-04-06 22:07:29', 5, 100007, 100002, 70),
(18, '2021-04-06 22:30:35', 10, 100007, 100001, 50),
(19, '2021-04-06 22:40:40', 10, 100008, 100007, 60),
(20, '2021-04-06 23:44:51', 5, 100007, 100001, 55),
(21, '2021-04-07 00:16:48', 12, 100007, 100001, 80),
(22, '2021-04-10 22:30:48', 100, 100007, 100002, 112);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `balance`, `created_at`) VALUES
(100001, '', '', 'sajib', '$2y$10$pgiLfA089mN0ka.64tgmBODi8ygB1d.EITAopPoJhFF1qwEyUANaW', 56, '2021-04-06 01:26:55'),
(100002, '', '', 'ajmol', '$2y$10$QRKqufZeHcp9r94l8HpMCuGHrvZd39bmbydMzld6WIL18O/qMUN7y', 105, '2021-04-06 18:01:48'),
(100007, 'akram', 'hossain', 'akram', '$2y$10$sNKdHEfN5NKQoM7ylFjM7.RSpDZrVUCof1G7tBfhVT6P8Gk0fy9Uy', 222, '2021-04-06 18:37:38'),
(100008, 'mohammad', 'asri', 'asri', '$2y$10$vplSM71306hvKiZjDmmz2ubDCod.44hIl9a4Y3PsFccpy0sOzLI1C', 90, '2021-04-06 22:40:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100009;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
