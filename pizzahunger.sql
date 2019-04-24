-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 12:13 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzahunger`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'asif', 'info@info.com', 'aa', '2019-04-24 06:46:37', '2019-04-24 06:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Italian Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia\r\n', 2.9, '1556096133bbfac7e23e852c0eef17f393237ee4de.jpg', '2019-04-24 08:55:33', '2019-04-24 08:55:33'),
(3, 'Greek Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 2.9, '15560962501fb22a089c2fa64c9780eee6be030b30.jpg', '2019-04-24 08:57:30', '2019-04-24 08:57:30'),
(4, 'Caucasian Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 2.9, '155609630114f19cb5de539bccc934c0679c53b854.jpg', '2019-04-24 08:58:21', '2019-04-24 08:58:21'),
(5, 'American Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 2.9, '15560964162c3c9afbc4029d7f47f3da66efcd62b1.jpg', '2019-04-24 09:00:16', '2019-04-24 09:00:16'),
(6, 'Tomatoe Pie', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 3.1, '1556096490ffa5e94a993fb53fc9f030df1ce32619.jpg', '2019-04-24 09:01:30', '2019-04-24 09:01:30'),
(7, 'Margherita', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 5.2, '1556096541b203d41bbcbb9b9e7925e86c69534dcd.jpg', '2019-04-24 09:02:21', '2019-04-24 09:02:21'),
(9, 'Bacon Pizza', 'A small river named Duden flows by their place and supplies', 25, '155609671272cff57163b5578dccfe6567f73b07da.jpg', '2019-04-24 09:05:12', '2019-04-24 09:05:12'),
(10, 'Ham & Pineapple', 'A small river named Duden flows by their place and supplies', 20, '155609840610cffda1f2b992160175c7464a6748d5.jpg', '2019-04-24 09:33:26', '2019-04-24 09:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short-heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `name`, `short-heading`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Italian Pizza', 'Crunchy', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.\r\n', '15561007551061608f5c370376287184f2a5dc7cc5.png', '2019-04-24 10:12:35', '2019-04-24 10:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'info@info.com', 'aa', '2019-04-23 09:00:56', '2019-04-23 09:00:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
