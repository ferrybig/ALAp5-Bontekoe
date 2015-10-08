-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 okt 2015 om 11:22
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
-- Tabelstructuur voor tabel `uitgaan`
--

CREATE TABLE IF NOT EXISTS `uitgaan` (
  `id` int(2) NOT NULL,
  `page` varchar(20) NOT NULL,
  `text` text NOT NULL,
  `picture` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `uitgaan`
--

INSERT INTO `uitgaan` (`id`, `page`, `text`, `picture`) VALUES
(1, 'home', '<h1>Uitgaan in de Bontekoe?</h1>\r\n\r\nDat kan!\r\nElke vrijdag, zaterdag en zondag is het uitgaanscentrum van de Bontekoe voor jou geopend!\r\n\r\nJe kan de hele avond wisselen tussen de area´s. <br /> \r\n\r\nDe openingstijden zijn elke dag van 23.00 uur tot 09.00 uur.\r\n', '../img/foto01.jpg'),
(2, '80s-90s', '<h1>80´s en 90´s area</h1>\r\nGenieten en lekker swingen op de oude discohits? <br />\r\nDan is deze area zeker iets voor jou. <br />\r\nElke hit komt natuurlijk voorbij. <br /> <br />', '../img/foto02.jpg'),
(3, 'urban', '<h1>Urban</h1>\r\nBij deze area treden er talenten uit de buurt  op. <br />\r\nAllemaal om jou te entertainen. <br />\r\nDus waar wacht je nog op Urban is alleen toegankelijk met de gekozen outfit die vooraf wordt bepaald. <br /> <br />', '../img/foto04.jpg'),
(4, 'schuurfeest', '<h1>Schuurfeest</h1>\r\nLaad jezelf op een gooi al je zorgen en energie eruit bij onze schuurfeesten. <br />\r\nGezelligheid staat centraal en er is drank in overvloedt! <br /> \r\n<small>(Legitimatie verplicht)</small> <br /> <br />', '../img/foto03.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `uitgaan`
--
ALTER TABLE `uitgaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page` (`page`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `uitgaan`
--
ALTER TABLE `uitgaan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
