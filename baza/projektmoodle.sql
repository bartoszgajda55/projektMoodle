-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2015 at 10:52 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projektmoodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `kursy`
--

CREATE TABLE IF NOT EXISTS `kursy` (
  `id_kursu` int(11) NOT NULL AUTO_INCREMENT,
  `id_zalozyciela` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `klucz_dostepu` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_kursu`),
  KEY `id_kursu` (`id_kursu`),
  KEY `id_zalozyciela` (`id_zalozyciela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kursy`
--

INSERT INTO `kursy` (`id_kursu`, `id_zalozyciela`, `nazwa`, `klucz_dostepu`) VALUES
(1, 2, '4it Programowanie Extremalne', 'java-ssie');

-- --------------------------------------------------------

--
-- Table structure for table `lekcje`
--

CREATE TABLE IF NOT EXISTS `lekcje` (
  `id_lekcji` int(11) NOT NULL AUTO_INCREMENT,
  `id_kursu` int(11) NOT NULL,
  `temat` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_lekcji`),
  KEY `id_kursu` (`id_kursu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lekcje`
--

INSERT INTO `lekcje` (`id_lekcji`, `id_kursu`, `temat`, `tresc`) VALUES
(1, 1, 'Dlaczego ludzie programujo ?', 'Ludzie programujo, bo mogo. Dzienkuje, dobranoc.');

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `typ` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `reset_hasla` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `typ`, `email`, `reset_hasla`) VALUES
(1, 'test', 'test', 'Testownik', 'Testowy', 'a', '', ''),
(2, 'test2', 'test2', 'Jan', 'Kowalski', 'n', 'test2@wp.pl', ''),
(3, 'test3', 'test3', 'Paweł', 'Kowalski', 'u', 'test3@wp.pl', '');

-- --------------------------------------------------------

--
-- Table structure for table `zapisy`
--

CREATE TABLE IF NOT EXISTS `zapisy` (
  `id_zapisu` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `data_zapisu` date NOT NULL,
  PRIMARY KEY (`id_zapisu`),
  KEY `id_uzytkownika` (`id_uzytkownika`),
  KEY `id_kursu` (`id_kursu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `zapisy`
--

INSERT INTO `zapisy` (`id_zapisu`, `id_uzytkownika`, `id_kursu`, `data_zapisu`) VALUES
(1, 3, 1, '2015-10-23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kursy`
--
ALTER TABLE `kursy`
  ADD CONSTRAINT `uzytkownik-kurs` FOREIGN KEY (`id_zalozyciela`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lekcje`
--
ALTER TABLE `lekcje`
  ADD CONSTRAINT `kursy-lekcja` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zapisy`
--
ALTER TABLE `zapisy`
  ADD CONSTRAINT `kurs-zapis` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzytkownik-zapis` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
