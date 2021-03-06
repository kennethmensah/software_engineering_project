-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2015 at 04:55 PM
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
-- Table structure for table `se_users`
--

CREATE TABLE IF NOT EXISTS `se_users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` enum('admin','nurse','supervisor') NOT NULL,
`user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `se_users`
--

INSERT INTO `se_users` (`username`, `password`, `user_type`, `user_id`) VALUES
('admin', '6e8204c0862ec8abecb49762f0899554', 'admin', 2),
('kwasi_ansah', 'demo', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `se_users`
--
ALTER TABLE `se_users`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `se_users`
--
ALTER TABLE `se_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
