-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2015 at 07:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nurse_task_managerV2`
--

-- --------------------------------------------------------

--
-- Table structure for table `se_admin`
--

CREATE TABLE IF NOT EXISTS `se_admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `district` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_admin`
--

INSERT INTO `se_admin` (`admin_id`, `fname`, `sname`, `district`, `phone`, `gender`) VALUES
(1, 'Kwakye', 'Davidson', 3, '+233200393945', 'M'),
(4, 'Mensah', 'Kenneth Mintah', 2, ' 233200393945', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `se_clinics`
--

CREATE TABLE IF NOT EXISTS `se_clinics` (
`clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(100) NOT NULL,
  `clinic_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `se_clinic_tasks`
--

CREATE TABLE IF NOT EXISTS `se_clinic_tasks` (
`task_id` int(11) NOT NULL,
  `task_title` varchar(50) NOT NULL,
  `task_desc` varchar(300) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `date_completed` date NOT NULL,
  `due_date` date NOT NULL,
  `due_time` time NOT NULL,
  `confirmed` enum('confirmed','not') NOT NULL,
  `clinic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `se_district_tasks`
--

CREATE TABLE IF NOT EXISTS `se_district_tasks` (
`task_id` int(11) NOT NULL,
  `task_title` varchar(50) NOT NULL,
  `task_desc` varchar(300) NOT NULL,
  `clinics` varchar(200) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `se_nurses`
--

CREATE TABLE IF NOT EXISTS `se_nurses` (
  `nurse_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `district_zone` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_nurses`
--

INSERT INTO `se_nurses` (`nurse_id`, `fname`, `sname`, `district_zone`, `phone`, `gender`) VALUES
(1, 'Araba', 'Maison', 2, '+233244393945', 'M'),
(6, 'Baddoo', 'Edwina', 2147483647, '1', 'F'),
(7, 'Baddoo', 'Edwina', 1, ' 233200393945', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `se_supervisors`
--

CREATE TABLE IF NOT EXISTS `se_supervisors` (
  `supervisor_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `district_zone` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_supervisors`
--

INSERT INTO `se_supervisors` (`supervisor_id`, `fname`, `sname`, `district_zone`, `phone`, `gender`) VALUES
(1, 'Aelaf', 'Dafla', 2, '+233200393945', 'M'),
(8, 'Edwina', 'Baddoo', 1, ' 233200393945', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `se_users`
--

CREATE TABLE IF NOT EXISTS `se_users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` enum('admin','nurse','supervisor') NOT NULL,
`user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_users`
--

INSERT INTO `se_users` (`username`, `password`, `user_type`, `user_id`, `email`) VALUES
('admin', '6e8204c0862ec8abecb49762f0899554', 'admin', 2, '0'),
('amakye.dede', 'amakye.dede', 'nurse', 9, 'aben.woha'),
('edwina.baddoo', '3752ae0c5aef2c5de20eafc721567a9b', 'nurse', 6, 'edwina.baddoo@gmail.com'),
('edwina1.baddoo', '3752ae0c5aef2c5de20eafc721567a9b', 'nurse', 7, 'edwina.baddoo@gmail.com'),
('edwina2.baddoo', '3752ae0c5aef2c5de20eafc721567a9b', 'supervisor', 8, 'edwina.baddoo@gmail.com'),
('kenneth.mensah', '6e8204c0862ec8abecb49762f0899554', 'admin', 4, 'kenneth.mensah@gmail.com'),
('KwameAnim', 'Ajaie', 'admin', 10, 'k.a@sth.com'),
('kwasi_ansah', 'demo', 'admin', 1, '0'),
('kwasi_bansah', 'demo', 'admin', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `se_admin`
--
ALTER TABLE `se_admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `se_clinics`
--
ALTER TABLE `se_clinics`
 ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `se_clinic_tasks`
--
ALTER TABLE `se_clinic_tasks`
 ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `se_district_tasks`
--
ALTER TABLE `se_district_tasks`
 ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `se_nurses`
--
ALTER TABLE `se_nurses`
 ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `se_supervisors`
--
ALTER TABLE `se_supervisors`
 ADD PRIMARY KEY (`supervisor_id`);

--
-- Indexes for table `se_users`
--
ALTER TABLE `se_users`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `se_clinics`
--
ALTER TABLE `se_clinics`
MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `se_clinic_tasks`
--
ALTER TABLE `se_clinic_tasks`
MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `se_district_tasks`
--
ALTER TABLE `se_district_tasks`
MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `se_users`
--
ALTER TABLE `se_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
