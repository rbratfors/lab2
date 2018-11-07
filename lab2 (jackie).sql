-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2018 at 05:33 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Lab 2`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `name` varchar(50) NOT NULL,
  `actor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `directing`
--

CREATE TABLE `directing` (
  `director_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directing`
--

INSERT INTO `directing` (`director_id`, `m_id`) VALUES
(1, 4),
(1, 6),
(2, 1),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `name` varchar(50) NOT NULL,
  `director_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`name`, `director_id`) VALUES
('Steven Spielberg', 1),
('George Lucas', 2),
('Gary Halvorson', 3);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `title` varchar(50) NOT NULL,
  `m_id` int(11) UNSIGNED NOT NULL,
  `year` int(11) UNSIGNED NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `episodes` int(11) UNSIGNED NOT NULL,
  `language` varchar(30) NOT NULL DEFAULT 'English',
  `MPAA_rating` varchar(30) NOT NULL,
  `rating` float UNSIGNED DEFAULT NULL,
  `votes` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`title`, `m_id`, `year`, `genre`, `category`, `episodes`, `language`, `MPAA_rating`, `rating`, `votes`) VALUES
('Star Wars', 1, 1977, 'Sci-Fi', 'Movie', 0, 'English', '', NULL, 0),
('Indiana Jones', 4, 1981, 'Adventure', 'Movie', 0, 'English', '', NULL, 0),
('Friends', 5, 1994, 'Comedy', 'TV-series', 24, 'English', '', NULL, 0),
('Jaws', 6, 1975, 'Thriller', 'Movie', 0, 'English', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `actor_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `user_id`, `payment_status`, `join_date`, `expiry_date`, `date_of_birth`) VALUES
('Lars Larsson', 1, 'Visa', '2017-02-19', '2017-06-19', '1990-02-06'),
('Gunnar Gunnarsson', 2, 'MasterCard', '2018-01-04', '2019-01-04', '1997-06-11'),
('Anna Andersson', 3, 'PayPal', '2017-07-19', '2018-04-19', '1973-02-01'),
('Anders Andersson', 4, 'Mom\'s credit card', '2018-11-01', '2019-01-01', '2009-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `m_id` int(10) UNSIGNED NOT NULL,
  `watch_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`user_id`, `m_id`, `watch_date`) VALUES
(3, 1, '2018-10-10'),
(3, 4, '2018-11-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `directing`
--
ALTER TABLE `directing`
  ADD PRIMARY KEY (`director_id`,`m_id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`actor_id`,`m_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`user_id`,`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `m_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
