-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 okt 2015 om 13:45
-- Serverversie: 5.6.26
-- PHP-versie: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alap5`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu`
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
-- Gegevens worden geëxporteerd voor tabel `menu`
--

INSERT INTO `menu` (`id_nummer`, `product_nummer`, `product_naam`, `product_prijs`, `product_beschrijving`, `product_type`) VALUES
(1, 101, 'XXL Hamburger', 14.95, 'Rundvlees, tomaat, ui, kaas, spek, volkoren brood', 'hoofdgerecht'),
(2, 102, 'Medium cheese burger', 11.95, 'Kaas, tomaat, ui, volkoren brood', 'hoofdgerecht'),
(3, 103, 'Entrecote', 13.95, 'Rundvlees, gemengde groentes', 'hoofdgerecht'),
(4, 1, 'Gambas', 6.95, 'Gepelde gambas, gebakken met knoflook en spaanse pepers', 'voorgerecht'),
(5, 2, 'Carpaccio', 7.95, 'Carpaccio met truffeldressing, parmezaanse kaas en rucola', 'voorgerecht'),
(6, 3, 'Tomatensoep', 4.95, 'Tomatensoep met verse gebakken stokbrood', 'voorgerecht'),
(7, 201, 'Creme brulee', 9.95, 'Geparfumeerd met citroengras, vanille-ijs en een amandelkrul', 'nagerecht'),
(8, 202, 'Dame blanche', 8.95, 'Vanille-ijs met chocolade en slagroomsaus', 'nagerecht'),
(9, 203, 'Tiramisu(18+)', 4.95, 'Tiramisu met rum, cacao, mascarpone, koffie en ei', 'nagerecht'),
(10, 301, 'Coca cola', 2.49, 'Coca cola met of zonder ijsklontjes', 'dranken'),
(11, 302, '7-up', 2.49, '7-up met of zonder ijsklontjes', 'dranken'),
(12, 303, 'Hertog jan(18+)', 2.99, 'Versgebrouwen hertog jan bier vers van de tap', 'dranken');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_nummer`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_nummer` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
