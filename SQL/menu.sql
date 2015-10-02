-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2015 at 08:59 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alap5`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_nummer` int(3) NOT NULL,
  `product_nummer` int(3) NOT NULL,
  `product_naam` varchar(30) NOT NULL,
  `product_prijs` float NOT NULL,
  `product_beschrijving` varchar(100) NOT NULL,
  `product_type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_nummer`, `product_nummer`, `product_naam`, `product_prijs`, `product_beschrijving`, `product_type`) VALUES
(1, 101, 'xxl hamburger', 14.95, 'rundvlees, tomaat, ui, kaas, spek, volkoren brood', 'hoofdgerecht'),
(2, 102, 'medium cheese burger', 11.95, 'kaas, tomaat, ui, volkoren brood', 'hoofdgerecht'),
(3, 103, 'entrecote', 13.95, 'rundvlees, gemengde groentes', 'hoofdgerecht'),
(4, 1, 'gambas', 6.95, 'gepelde gambas, gebakken met knoflook en spaanse pepers', 'voorgerecht'),
(5, 2, 'carpaccio', 7.49, 'carpaccio met truffeldressing en parmezaanse kaas', 'voorgerecht'),
(6, 3, 'tomatensoep', 4.95, 'tomatensoep met verse gebakken stokbrood', 'voorgerecht'),
(7, 201, 'creme brulee', 9.95, 'geparfumeerd met citroengras, vanille-ijs en een amandelkrul', 'nagerecht'),
(8, 202, 'dame blanche', 8.95, 'vanille-ijs met chocolade en slagroomsaus', 'nagerecht'),
(9, 203, 'tiramisu(18+)', 4.95, 'tiramisu met rum, cacao, mascarpone, koffie en ei', 'nagerecht'),
(10, 301, 'coca cola', 2.49, 'coca cola met of zonder ijsklontjes', 'dranken'),
(11, 302, '7-up', 2.49, '7-up met of zonder ijsklontjes', 'dranken'),
(12, 303, 'hertog jan(18+)', 2.99, 'versgebrouwen hertog jan bier vers van de tap', 'dranken');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_nummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_nummer` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
