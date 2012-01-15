-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Jan 2012 um 16:52
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `awesome`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `awe_images`
--

CREATE TABLE IF NOT EXISTS `awe_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `isUpload` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `awe_images`
--

INSERT INTO `awe_images` (`id`, `name`, `isUpload`) VALUES
(1, 'bild1.jpg', 0),
(2, 'bild2.jpg', 0),
(3, 'bild3.jpg', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `awe_users`
--

CREATE TABLE IF NOT EXISTS `awe_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `image_id` int(10) NOT NULL,
  `password` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `awe_users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
