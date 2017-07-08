-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2017 at 09:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cfgteam5`
--

-- --------------------------------------------------------

--
-- Table structure for table `child_info`
--

CREATE TABLE `child_info` (
  `DOB` varchar(9) NOT NULL,
  `date_of_join` varchar(10) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roll_no` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donar_name` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `gender` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `count` varchar(50) NOT NULL,
  `item_id` int(100) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`gender`, `name`, `count`, `item_id`, `category`) VALUES
('m', 'pens', '20', 1, 'st'),
('f', 'veggies', '5', 2, 'kt'),
('m', 'toys', '20', 3, 'ut'),
('f', 'meds', '3', 4, 'md'),
('m', 'books', '40', 5, 'st'),
('f', 'vessels', '5', 6, 'kt');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `perm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `first_name`, `last_name`, `email`, `contact`, `perm`) VALUES
('ashwin', 'ashwin', 'Ashwin', 'Pujari', 'ashwingg@gmail.com', '9912345678', 'va'),
('deepa', 'deepa', 'Deepika', 'K', 'deepa174@gmail.com', '9933445567', 'va'),
('admin', 'admin', 'John', 'Smith', 'johnamith@gmail.com', '8050663636', 'ad'),
('karan', 'karan', 'Karan', 'R', 'karan123@gmail.com', '9998765432', 'ac'),
('rajath', 'rajath', 'Rajath', 'S', 'rajathmba@gmail.com', '8866552234', 'va'),
('raju', 'raju', 'Rajesh', 'Kumar', 'rajukumar@gmail.com', '9977665523', 'wa'),
('santosh', 'santosh', 'Santosh', 'Patil', 'santupatil@gmail.com', '9911223344', 'wa');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `reqid` int(2) NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child_info`
--
ALTER TABLE `child_info`
  ADD PRIMARY KEY (`roll_no`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donar_name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`reqid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
