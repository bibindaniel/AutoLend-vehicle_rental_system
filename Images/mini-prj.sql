-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 03:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini-prj`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `user_name` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `user_name`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'ram1b', 'ram@ew21'),
(3, 'math', 'Mat@1234'),
(4, 'ajul123', 'Aju@1234'),
(5, 'daniel', '!ZXzx123'),
(6, 'daniel', '!ZXzx123'),
(7, 'ajul1', 'Ajul@123'),
(8, 'dins12', 'Dins@123'),
(9, 'sarin12', 'Sar@1234'),
(10, 'yffgfg', 'Ajul@2022'),
(11, 'eric123', 'ERzx!123'),
(12, 'rahul123', 'Rahul@123'),
(14, 'rah12', 'Rohan@123'),
(15, 'rah12', 'Rohan@123'),
(16, 'rah12', 'Rohan@123'),
(17, 'ramesh12', 'Ramesh@123'),
(18, 'bid3', 'ZXzx@123'),
(19, 'aron12', 'ARon@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `user_type` int(3) NOT NULL,
  `user_status` int(3) NOT NULL DEFAULT 1,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `login_id`, `first_name`, `dob`, `location`, `email`, `mobile`, `user_type`, `user_status`, `image`) VALUES
(1, 1, 'Admin', '2000-03-14', 'idukki', 'bibi@gmail.com', '2147483647', 3, 1, 'photo.jpg'),
(2, 2, 'ram', '2001-02-07', 'ram', 'ram@gmail.com', '2147483647', 2, 1, 'photo.jpg'),
(3, 3, 'Mathew', '2001-02-07', 'idukki', 'math@gmail.co', '2147483647', 2, 1, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(4, 4, 'ajulpaul', '', 'thrissur', 'ajul@hm.com', '9567345677', 2, 0, 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg'),
(5, 5, 'ajul', '2001-01-03', 'mala', 'SDFG@asdf.vsd', '9567345677', 1, 1, 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg'),
(6, 6, 'bibin', '2001-07-02', 'rama', 'ajul@hm.mnt', '9567345677', 2, 0, 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg'),
(7, 7, 'ajul', '2000-04-02', 'malapuram', 'ajul@gami.com', '9567345679', 2, 1, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(8, 8, 'dins ', 'dins12', 'malapuram', 'dins@gmail.com', '8234234456', 2, 1, 'julian-wan-WNoLnJo7tS8-unsplash.jpg'),
(9, 9, 'sarin rajesh', '2000-05-02', 'malapuram', 'sarinkannattuthara@gmail.com', '8434532565', 2, 1, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(10, 10, 'Mathe', '2000-02-23', 'malapuram', 'mail@ajulkjose.t.ll', '6567345677', 2, 1, 'dingan_create_a_logo_for_sports_hub_red_white_a9f652fb-3180-48d8-9e8d-b9d6d312c761.png'),
(11, 11, 'erick', '2002-04-02', 'wayanad', 'eric@gmail.com', '9567345677', 1, 1, 'julian-wan-WNoLnJo7tS8-unsplash.jpg'),
(12, 12, 'rahul', '1997-02-24', 'kochi', 'rahul@gmail.com', '9567345677', 1, 0, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(13, 14, 'rohan', '1999-06-04', 'kattapana', 'rohan@gmail.com', '9567345678', 1, 1, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(14, 15, 'rohan', '1999-06-04', 'kattapana', 'rohan@gmail.com', '9567345678', 1, 1, 'ben-den-engelsen-YUu9UAcOKZ4-unsplash.jpg'),
(16, 17, 'ramesh', '1996-02-24', 'kochi', 'ramesh@gmail.com', '9567345677', 1, 0, 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg'),
(17, 18, 'bibi', '2000-02-27', 'malapuram', 'mrkuttusan@gmail.com', '7567345675', 1, 1, 'aatik-tasneem-7omHUGhhmZ0-unsplash.jpg'),
(18, 19, 'aron', '1999-02-15', 'alapuzha', 'aron12@gmal.com', '7809870987', 1, 1, 'edward-cisneros-_H6wpor9mjs-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `vehicle_id` int(3) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `year` date NOT NULL,
  `rate` int(20) NOT NULL,
  `availability` int(3) NOT NULL DEFAULT 1,
  `location` varchar(50) NOT NULL,
  `category_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_category`
--

CREATE TABLE `tbl_vehicle_category` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 1,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle_category`
--

INSERT INTO `tbl_vehicle_category` (`category_id`, `category_name`, `status`, `image`) VALUES
(4, 'SEDAN', 1, 'arteum-ro-_8WDl2zgB_0-unsplash.jpg'),
(5, 'PICKUP', 1, 'caleb-white-XGJBSkoqX_I-unsplash.jpg'),
(6, 'HATCHBACK', 1, 'gautier-salles-KCwixy8UxVY-unsplash.jpg'),
(7, 'MPV', 1, 'talia-sBPnD3jzQ7g-unsplash.jpg'),
(8, 'SUV', 1, 'tabea-schimpf-O7WzqmeYoqc-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_verify_user`
--

CREATE TABLE `tbl_verify_user` (
  `verify_id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verify_status` int(3) NOT NULL DEFAULT -1,
  `licence_no` varchar(20) NOT NULL,
  `Expiry_date` date NOT NULL,
  `licence_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_verify_user`
--

INSERT INTO `tbl_verify_user` (`verify_id`, `user_id`, `verify_status`, `licence_no`, `Expiry_date`, `licence_file`) VALUES
(4, 1, -1, '', '0000-00-00', ''),
(6, 5, -1, '', '0000-00-00', ''),
(7, 11, 1, 'KL-0720775646432', '2023-03-12', 'WhatsApp Image 2023-02-21 at 22.26.42.pdf'),
(8, 12, -1, '', '0000-00-00', ''),
(9, 13, -1, '', '0000-00-00', ''),
(10, 14, -1, '', '0000-00-00', ''),
(12, 16, -1, '', '0000-00-00', ''),
(13, 17, 0, 'HR-0920207877665', '2023-03-11', 'WhatsApp Image 2023-02-21 at 22.26.42.pdf'),
(14, 18, 0, 'MR-9920109877656', '2023-03-11', 'labqn.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `tbl_vehicle_category`
--
ALTER TABLE `tbl_vehicle_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_verify_user`
--
ALTER TABLE `tbl_verify_user`
  ADD PRIMARY KEY (`verify_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `vehicle_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicle_category`
--
ALTER TABLE `tbl_vehicle_category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_verify_user`
--
ALTER TABLE `tbl_verify_user`
  MODIFY `verify_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
