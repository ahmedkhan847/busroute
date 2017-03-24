-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2015 at 07:42 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fashirx7_busdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bus`
--

CREATE TABLE IF NOT EXISTS `tb_bus` (
`buses_id` int(11) NOT NULL,
  `bus_name` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_bus`
--

INSERT INTO `tb_bus` (`buses_id`, `bus_name`) VALUES
(1, 'w11'),
(2, '4l'),
(3, '2d');

-- --------------------------------------------------------

--
-- Table structure for table `tb_location`
--

CREATE TABLE IF NOT EXISTS `tb_location` (
`locs_id` int(11) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `longe` double NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_location`
--

INSERT INTO `tb_location` (`locs_id`, `loc_name`, `lat`, `longe`) VALUES
(1, 'sohrab goth', 24.943555, 67.08438),
(2, 'water pump', 24.937011, 67.07591),
(3, 'ayesha manzil', 24.927544, 67.064205),
(4, 'gulberg chowrangi bus stop', 24.942219, 67.070961),
(5, 'shafique mor', 24.957104, 67.076162),
(6, 'soccer stadium block 19 f.b. area', 24.950879, 67.079401);

-- --------------------------------------------------------

--
-- Table structure for table `tb_route`
--

CREATE TABLE IF NOT EXISTS `tb_route` (
  `loc_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_route`
--

INSERT INTO `tb_route` (`loc_id`, `bus_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 1),
(3, 1),
(3, 2),
(6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bus`
--
ALTER TABLE `tb_bus`
 ADD PRIMARY KEY (`buses_id`), ADD UNIQUE KEY `Name` (`bus_name`);

--
-- Indexes for table `tb_location`
--
ALTER TABLE `tb_location`
 ADD PRIMARY KEY (`locs_id`), ADD UNIQUE KEY `lat` (`lat`,`longe`);

--
-- Indexes for table `tb_route`
--
ALTER TABLE `tb_route`
 ADD KEY `loc_id` (`loc_id`), ADD KEY `bus_id` (`bus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bus`
--
ALTER TABLE `tb_bus`
MODIFY `buses_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_location`
--
ALTER TABLE `tb_location`
MODIFY `locs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
