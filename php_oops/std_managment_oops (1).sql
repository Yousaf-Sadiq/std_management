-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 08:26 AM
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
-- Database: `std_managment_oops`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_outline` longtext NOT NULL,
  `course_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `course_name`, `course_outline`, `course_status`) VALUES
(1, 'PHP OOP', '<h2>123231jklsd</h2>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `p_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ptoken` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`p_id`, `f_name`, `l_name`, `email`, `password`, `ptoken`, `contact`, `p_status`) VALUES
(1, 'test', 'Martinez2321', 'popezuge@mailinator.com', '$2y$10$bF91w7qI.AdOWfpvpvOvwOQasbdAuFR3DEK8l4fqsq.vyzcTQvWIO', 'MTIzNDU2', '123456789', 1),
(2, 'David', 'Martinez', 'popdsaezuge@mailinator.com', '$2y$10$xptLKspomNQ9giSwQUYVUexjusZbU7g6aVnTlF3GbgFMtODk9QoRW', 'MTIzNDU2', '981', 1),
(3, 'james', 'Martinez', 'parent@mailinator.com', '$2y$10$czeGR8kkdDwo04Dafe03IOhCk9L1yqXAL6eDXpmdsypAoQf4sDkE2', 'MTIzNDU2', '981321321321321321321', 1);

-- --------------------------------------------------------

--
-- Table structure for table `std`
--

CREATE TABLE `std` (
  `std_id` int(11) NOT NULL,
  `profile` longtext DEFAULT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `DOB` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ptoken` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `std_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `std`
--

INSERT INTO `std` (`std_id`, `profile`, `f_name`, `l_name`, `DOB`, `email`, `password`, `ptoken`, `contact`, `address`, `std_status`) VALUES
(2, '{\"relUrl\":\"C:/xampp/htdocs/php_oops/std_management//assets/admin/upload/26__976d1f4a-3f0a-4647-a618-b1e22a99bbb9.jpeg\",\"absUrl\":\"http://localhost/php_oops/std_management//assets/admin/upload/26__976d1f4a-3f0a-4647-a618-b1e22a99bbb9.jpeg\"}', 'XYZ32131', 'Wally', '2003-05-09', 'std1@gmail.com', '$2y$10$s.e3rEBqH.29RuP0TT4.weU8s9Ltx6thxz8s85oi2Bq8jPHfUjA.W', 'MTIzNDU2', '1234567890', 'xyz', 1),
(3, '{\"relUrl\":\"C:/xampp/htdocs/php_oops/std_management//assets/admin/upload/56_leisure-dilapidation-contractors1 (1).jpg\",\"absUrl\":\"http://localhost/php_oops/std_management//assets/admin/upload/56_leisure-dilapidation-contractors1 (1).jpg\"}', 'jamesdsa', 'wally', '2017-05-03', 'std4@gmail.com', '$2y$10$1qi3dwwkeM4K1W2JZe4TuOnxAcTNGkzmCZA33M7kInF1OAxFfpelG', 'MTIzNDU2', '123456789', 'dsadsa', 1),
(4, '{\"relUrl\":\"C:/xampp/htdocs/php_oops/std_management//assets/admin/upload/22_pexels-pixabay-159844.jpg\",\"absUrl\":\"http://localhost/php_oops/std_management//assets/admin/upload/22_pexels-pixabay-159844.jpg\"}', 'qwer', 'wally', '2017-05-03', 'std6@gmail.com', '$2y$10$hc3o6IkeUHFIaxVvZpNBc.jZyRjTbfF3/TbOSp6uwJzRE00rZ.z52', 'MTIzNDU2', '123432654', 'dasdsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_parent`
--

CREATE TABLE `std_parent` (
  `std_parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `std_parent`
--

INSERT INTO `std_parent` (`std_parent_id`, `student_id`, `parent_id`) VALUES
(1, 2, 3),
(2, 3, 1),
(3, 4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `course_name_index` (`course_name`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `std`
--
ALTER TABLE `std`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `std_parent`
--
ALTER TABLE `std_parent`
  ADD PRIMARY KEY (`std_parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `std`
--
ALTER TABLE `std`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `std_parent`
--
ALTER TABLE `std_parent`
  MODIFY `std_parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
