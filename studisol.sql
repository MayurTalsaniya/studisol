-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 06:54 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` tinyint(5) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_email` varchar(50) NOT NULL,
  `admin_passwd` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `post_pic` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `content`, `post_pic`, `created_at`) VALUES
(1, 'Hello, this is the first post on studisol. :)', 'uploads/667a6a661fe2a.jpg', '2024-06-25 06:57:42'),
(11, 'The 2nd post!!!!', '', '2024-06-25 11:13:05'),
(12, 'Once More with image :)', 'uploads/667aa66427c96.jpg', '2024-06-25 11:13:40'),
(22, 'Address:\r\nGardi Vidyapith Campus\r\nOpp. Aarya Club, Kalawad Highway, Village: Anandpar, Rajkot - 361 162, Gujarat,India.', 'uploads/667ab35f20daa.png', '2024-06-25 12:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `enrollment` varchar(20) NOT NULL,
  `college` varchar(40) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `sem` varchar(2) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `id_img` varchar(250) NOT NULL,
  `isVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`id`, `fullname`, `city`, `enrollment`, `college`, `course`, `branch`, `sem`, `mobile_no`, `email`, `passwd`, `created_at`, `id_img`, `isVerified`) VALUES
(1, 'Mayur', 'Rajkot', '220043131003', 'B H Gardi', 'BE', 'CSE', '6', '9408124385', 'mayurtalsaniya@hotmail.com', '$2y$10$qqKStKSZP8g5qvmz5qkyJe7OX27O1cpAuzLnseXFjp1f/JeIr/5o2', '2024-04-17 21:39:36', 'C:xampp	mpphp35A1.tmp', 0),
(13, 'AB', 'Rajkot', '6789134566', 'ABXC', 'MCA', 'None', '5', '1234567890', 'ab@h', '$2y$10$s9uAVllSLzCdbOHko0HwG.0CqwVuVjdVzs8bY.BpW/0HKf/8GakPe', '2024-06-21 10:41:02', 'C:xampp	mpphp2B5B.tmp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` mediumint(9) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `mobileno` decimal(10,0) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(350) NOT NULL,
  `profile_pic` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `mobileno`, `email`, `passwd`, `profile_pic`, `created_at`) VALUES
(9, 'mayur', 'gajar', '4125874333', 'ah@d', '$2y$10$6a3ZqDJ6jN.ZofLiHCNr9uhSxExchLq7Wqu2v0Af.2n8A4R8hW.Hi', '', '2024-04-17 16:03:53'),
(12, 'dhara', 'vasiyar', '12346455', 'dv@h', '$2y$10$eA4rxvFf8Wz/bbCykPfFsuXOlgmqrqe/xrC9jp3/SGvQeTV5g0mtC', '', '2024-06-21 05:23:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `student_user`
--
ALTER TABLE `student_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollment` (`enrollment`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` tinyint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_user`
--
ALTER TABLE `student_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
