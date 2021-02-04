-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 05:52 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleprices`
--

-- --------------------------------------------------------

--
-- Table structure for table `defcon`
--

CREATE TABLE `defcon` (
  `id` int(10) UNSIGNED NOT NULL,
  `def_price` varchar(10) NOT NULL,
  `supply` int(11) NOT NULL,
  `demand` int(11) NOT NULL,
  `total` int(12) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defcon`
--

INSERT INTO `defcon` (`id`, `def_price`, `supply`, `demand`, `total`, `category`, `price`) VALUES
(1, 'gold', 100, 100, 1, 'metal', 1000),
(2, 'silver', 100, 100, 1, 'metal', 850),
(3, 'platinum', 100, 100, 1, 'metal', 1300),
(4, 'diamond', 100, 100, 1, 'gemstone', 1100),
(5, 'ruby', 100, 100, 1, 'gemstone', 900),
(6, 'emerald', 100, 100, 1, 'gemstone', 850),
(7, 'crude', 100, 100, 1, 'energy', 825),
(8, 'gas', 100, 100, 1, 'energy', 850),
(9, 'heat', 100, 100, 1, 'energy', 800);

-- --------------------------------------------------------

--
-- Table structure for table `energy`
--

CREATE TABLE `energy` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `refinement` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `gatheredOn` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `energy`
--

INSERT INTO `energy` (`id`, `name`, `type`, `refinement`, `weight`, `gatheredOn`, `total`) VALUES
(1, 'CrudeOil 30% refinement', 'Crude Oil', 30, 40, '2007-06-09', 6);

-- --------------------------------------------------------

--
-- Table structure for table `gemstone`
--

CREATE TABLE `gemstone` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `unit` int(10) NOT NULL,
  `carats` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `minedOn` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gemstone`
--

INSERT INTO `gemstone` (`id`, `name`, `type`, `unit`, `carats`, `weight`, `minedOn`, `total`) VALUES
(1, 'diamond 15 carats', 'Diamond', 30, 20, 40, '2003-06-09', 27),
(2, 'Diamond 20 carats', 'diamond', 70, 21, 51, '2019-11-29', 15),
(3, 'Ruby', 'Ruby', 30, 60, 20, '2003-06-16', 40);

-- --------------------------------------------------------

--
-- Table structure for table `metal`
--

CREATE TABLE `metal` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `unit` int(10) NOT NULL,
  `carats` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `minedOn` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metal`
--

INSERT INTO `metal` (`id`, `name`, `type`, `unit`, `carats`, `weight`, `minedOn`, `total`) VALUES
(5, 'silver 15 carats', 'silver', 20, 20, 40, '2003-06-18', 40),
(6, 'Platinum pure', 'Platinum', 1, 1, 1, '2019-11-14', 3),
(7, 'platinum 1 carats', 'platinum', 1, 1, 1, '2019-11-27', 3),
(8, 'Platinum', 'Platinum', 1, 1, 1, '2019-11-12', 3),
(9, 'Platinum two', 'platinum', 2, 2, 1, '2019-11-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `apitoken` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `apitoken`, `usertype`, `created_at`) VALUES
(1, 'Larry Dennis', 'larry@email.com', '$2y$10$DempxHKnD25Hisro9kFVVunqRZxxnVFINZsaRj3AkcG', '', '', '2019-11-24'),
(4, 'Larr TOruan', 'dennis@email.com', '$2y$10$cO.UTx/P/NOQsTO.o/UtLuFXdoDp2FvftOBAYaaKW2r', '', '', '2019-11-24'),
(5, 'Albert', 'albert@email.com', '$2y$10$O5XKyGafnBI9ZqG8UHDkg.XU8j49KmKmV0cs4sDEorv', '', '', '2019-11-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `defcon`
--
ALTER TABLE `defcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `energy`
--
ALTER TABLE `energy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gemstone`
--
ALTER TABLE `gemstone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal`
--
ALTER TABLE `metal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defcon`
--
ALTER TABLE `defcon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `energy`
--
ALTER TABLE `energy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gemstone`
--
ALTER TABLE `gemstone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
