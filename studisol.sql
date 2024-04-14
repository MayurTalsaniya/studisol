-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 07:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studisol`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `student_user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `enrollment` varchar(20) NOT NULL,
  `college` varchar(40) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `sem` varchar(2) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `id_img` varchar(250) NOT NULL,
  `isVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`student_user_id`, `fullname`, `city`, `enrollment`, `college`, `course`, `branch`, `sem`, `mobile_no`, `email`, `pass`, `created_at`, `id_img`, `isVerified`) VALUES
(2, 'Mayur Talsaniya ', 'Rajkot', '220043131003', 'B. H. Gardi', 'B.E.', 'CSE', '6', '9408124385', 'mayurtalsaniya@hotmail.com', '$2y$10$A518Xnl6Zwh3BvjH3iAAsuOegTsi4az1pr8WEYHlRDCuaQ7ZctQ2K', '2024-04-11 23:16:11', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_user`
--
ALTER TABLE `student_user`
  ADD PRIMARY KEY (`student_user_id`),
  ADD UNIQUE KEY `enrollment` (`enrollment`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_user`
--
ALTER TABLE `student_user`
  MODIFY `student_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
