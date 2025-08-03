-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2025 at 06:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `addition_info`
--

CREATE TABLE `addition_info` (
  `id` varchar(20) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phno` int(11) NOT NULL,
  `dob` date NOT NULL,
  `cur_weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `goal_weight` int(11) NOT NULL,
  `profile_path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addition_info`
--

INSERT INTO `addition_info` (`id`, `firstname`, `lastname`, `phno`, `dob`, `cur_weight`, `height`, `goal_weight`, `profile_path`) VALUES
('', 'Harish', 'harish', 2147483647, '2005-08-03', 63, 5, 58, './images/profile.jpeg'),
('23191a0502', 'saiteja', 'singam', 2147483647, '2005-01-09', 65, 5, 60, '../images/deault.png'),
('23191a0522', 'amrutha', 'avvari', 2147483647, '2005-01-12', 50, 5, 49, '../images/deault.png'),
('23191A0538', 'Harish', 'harish', 2147483647, '2023-07-07', 63, 5, 58, '../images/deault.png'),
('24195A0502', 'Harish', 'harish', 2147483647, '2005-08-03', 65, 5, 60, './images/profile.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Username` varchar(30) NOT NULL,
  `faculty_id` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Username`, `faculty_id`, `email`, `password`) VALUES
('Harish', '123456', 'harishgb3805@gmail.com', '$2y$10$6vcTPB51uI4MtI5RrybByugAHgTSEQxYYI4.lEv.OEbQoULESi9aC');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `weight` int(11) NOT NULL,
  `WorkoutDetails` varchar(100) NOT NULL,
  `CaloriesBurned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `Date`, `weight`, `WorkoutDetails`, `CaloriesBurned`) VALUES
('', '2025-03-19', 65, 'Abs, Triceps', 33),
('', '2025-03-20', 63, 'Abs, Triceps', 33),
('', '2025-03-20', 65, 'Abs, Triceps', 33),
('', '2025-03-20', 63, 'Abs, Triceps', 33),
('', '2025-03-20', 63, 'Abs, Triceps', 33),
('24195A0502', '2025-03-20', 63, 'Abs, Triceps, Leg', 57),
('24195A0502', '2025-03-20', 0, 'Abs, Leg', 23),
('24195A0502', '2025-03-21', 65, 'Abs, Triceps', 15);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(30) NOT NULL,
  `roll_no` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `roll_no`, `email`, `password`) VALUES
('amrutha', '23191a0522', 'amruthavvari@gmail.com', '$2y$10$rGjOraNmQNsisbSo8RRn7.kztySVSC80jWdzhi1HTL6SBjCVjh1xC'),
('Harish', '24195A0502', 'harishgb3805@gmail.com', '$2y$10$shZGqKMWf8qkqPqEJkRRL.pBu95okSe5mpHgpgP6EswNPkra6PCEe'),
('naveen', '23191A0538', 'naveen@gmail.com', '$2y$10$ME0QX1XLhViM5S82rtMGwO7y.BJWpfezsOyjesHwvz1qWqlWrl7w2'),
('saiteja', '23191a0502', 'singamsaitejareddy76@gmail.com', '$2y$10$PYANu8itq2LRDK/UhYl.KO/hacBx7HHfM24L62EpUH6QD0cPmPm3.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addition_info`
--
ALTER TABLE `addition_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
