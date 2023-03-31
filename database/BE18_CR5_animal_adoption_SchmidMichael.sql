-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 31. Mrz 2023 um 19:42
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `BE18_CR5_animal_adoption_SchmidMichael`
--
CREATE DATABASE IF NOT EXISTS `BE18_CR5_animal_adoption_SchmidMichael` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `BE18_CR5_animal_adoption_SchmidMichael`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `vaccinated` varchar(50) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `picture`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `name`) VALUES
(15, 'labrador.png', 'Berlin', 'smart and loyal', 'large', 8, 'yes', 'Labrador', 'available', 'Maxi'),
(16, 'husky.png', 'Munich', 'activ and loyal', 'large', 9, 'yes', 'Husky', 'available', 'Moritz'),
(17, 'dalmatiner.png', 'Vienna', 'little bit shy', 'large', 10, 'yes', 'Dalmatiner', 'available', 'Fluffy'),
(18, 'dackel.png', 'Seoul', 'playful', 'small', 4, 'no', 'Dackel', 'available', 'Wauwau'),
(19, 'turtle.png', 'Paris', 'smart and slowly', 'large', 55, 'yes', 'Turtle', 'available', 'Gary'),
(20, 'cat.png', 'Lyon', 'wild', 'small', 3, 'yes', 'Cat', 'available', 'Miau'),
(21, 'goldfish.png', 'Zurich', 'calm and quiet', 'small', 1, 'yes', 'Goldfish', 'available', 'Patrick'),
(22, 'doberman.png', 'Berlin', 'smart and activ', 'large', 10, 'yes', 'Doberman', 'available', 'Bully'),
(23, 'akita.png', 'Bukarest', 'playful and loyal', 'large', 12, 'yes', 'Akita', 'available', 'Robert'),
(24, 'horse.png', 'Milano', 'smart and calm', 'large', 8, 'yes', 'Horse', 'available', 'Peter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('user','adm') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`) VALUES
(9, 'Admin', 'Mustermann', 'admin@email.com', 1522222222, 'Berlin', 'avatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'adm'),
(10, 'User', 'Mustermann', 'user@email.com', 1725555555, 'Vienna', 'avatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
