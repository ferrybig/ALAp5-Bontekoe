-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2015 at 10:29 AM
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
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password_hash` varchar(128) NOT NULL,
  `features` set('banned','email_validated','administrator') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `fullname`, `email`, `password_hash`, `features`, `created`) VALUES
(41, 'test', 'test', '', '$2y$10$vcrhWFHGOhL9xscg13a4iu2pAmGq7PYE2qKrr2jqhrDQ5CAbkz3KO', 'email_validated,administrator', '2015-10-01 08:21:59');

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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `table` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `date`, `table`) VALUES
(1, 'Fernando van Loenhout', 'test@test.nl', '2015-09-24', 1),
(2, 'henk', 'jeoffrey.o98@hotmail.com', '2015-09-25', 1),
(3, 'henk', 'jeoffrey.o98@hotmail.com', '2015-09-25', 2),
(4, '1', 'jeoffrey.o98@hotmail.com', '2015-09-26', 1),
(5, 'henk', 'jeoffrey.o98@hotmail.com', '2015-09-27', 1),
(6, 'pieter', 'jeoffrey.o98@hotmail.com', '2015-09-28', 1),
(7, 'jeoffrey', 'jeoffrey.o98@hotmail.com', '2015-09-27', 2),
(8, 'test', 'jeoffrey.o98@hotmail.com', '2015-09-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(50) NOT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `features` set('onetime','verifyemail','require_password','') NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
`id` int(11) NOT NULL,
  `nummer` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `nummer`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10');

-- --------------------------------------------------------

--
-- Table structure for table `uitgaan`
--

CREATE TABLE IF NOT EXISTS `uitgaan` (
`id` int(2) NOT NULL,
  `page` varchar(20) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uitgaan`
--

INSERT INTO `uitgaan` (`id`, `page`, `text`) VALUES
(1, 'home', '<h1>Uitgaan in de Bontekoe?</h1>\r\n\r\nDat kan!\r\nElke vrijdag, zaterdag en zondag is het uitgaanscentrum van de Bontekoe voor jou geopend! <br />\r\n\r\nJe kan de hele avond wisselen tussen de area´s.\r\n'),
(2, '80s-90s', '<h1>80´s en 90´s area</h1>\r\nGenieten en lekker swingen op de oude discohits? <br />\r\nDan is deze area zeker iets voor jou. <br />\r\nElke hit komt natuurlijk voorbij.'),
(3, 'urban', '<h1>Urban</h1>\r\nBij deze area treden er talenten uit de buurt  op. <br />\r\nAllemaal om jou te entertainen. <br />\r\nDus waar wacht je nog op Urban is alleen toegankelijk met de gekozen outfit style die vooraf wordt bepaald.'),
(4, 'schuurfeest', '<h1>Schuurfeest</h1>\r\nLaad jezelf op een gooi al je zorgen en energie eruit bij onze schuurfeesten. <br />\r\nGezelligheid staat centraal en er is drank in overvloedt! <br /> \r\n<small>(Legitimatie verplicht)</small>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_nummer`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `date` (`date`,`table`), ADD KEY `table` (`table`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`id`), ADD KEY `userid` (`userid`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uitgaan`
--
ALTER TABLE `uitgaan`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_nummer` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `uitgaan`
--
ALTER TABLE `uitgaan`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
