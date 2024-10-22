CREATE DATABASE IF NOT EXISTS phpherkansing;
USE phpherkansing;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 okt 2024 om 09:33
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-adv-studenten-systeem`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `prijs` DECIMAL(10,2) NOT NULL,
  `duurtijd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `modules`
--

INSERT INTO `modules` (`id`, `naam`, `prijs`, `duurtijd`) VALUES
(1, 'Web Intro', 75, 5),
(2, 'PHP PF', 50.55, 15),
(3, 'PHP ADV', 88, 25),
(4, 'HTML-CSS', 99.99, 15),
(5, 'JavaScript', 45.17, 20),
(6, 'Scrum', 55.55, 15),
(7, 'Framework', 77.77, 20),
(8, 'Showcase', 66.66, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `studenten`
--

CREATE TABLE `studenten` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `achternaam` varchar(30) NOT NULL,
  `geboorteDatum` date NOT NULL,
  `geslacht` enum('M','V','X') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `studenten`
--

INSERT INTO `studenten` (`id`, `voornaam`, `achternaam`, `geboorteDatum`, `geslacht`) VALUES
(1, 'Jan', 'de Vries', '1985-05-12', 'M'),
(2, 'Lisa', 'van den Berg', '1993-08-23', 'V'),
(3, 'Pieter', 'Janssen', '1978-12-07', 'M'),
(4, 'Emma', 'de Groot', '2002-07-15', 'V'),
(5, 'Thomas', 'Bakker', '1990-04-13', 'M'),
(6, 'Sophie', 'van Dijk', '1988-03-02', 'V'),
(7, 'Bram', 'Visser', '1996-09-19', 'M'),
(8, 'Julia', 'Smit', '1994-11-25', 'V'),
(9, 'Koen', 'Mulder', '1974-02-11', 'M'),
(10, 'Anouk', 'Peters', '1999-10-09', 'V');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `studenten`
--
ALTER TABLE `studenten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `studenten`
--
ALTER TABLE `studenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Tabelstructuur voor tabel `punten`
--

CREATE TABLE punten (
    moduleId INT(11) NOT NULL,
    studentenId INT(11) NOT NULL,
    score DECIMAL(10,2) CHECK (score<=100),
    PRIMARY KEY (moduleId, studentenId),
    FOREIGN KEY (moduleId) REFERENCES modules(id)  ON DELETE CASCADE, 
    FOREIGN KEY (studentenId) REFERENCES studenten(id)  ON DELETE CASCADE
);
