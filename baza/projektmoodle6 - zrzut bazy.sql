-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 03 Lis 2015, 13:17
-- Wersja serwera: 5.5.32
-- Wersja PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `projektmoodle`
--
CREATE DATABASE IF NOT EXISTS `projektmoodle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projektmoodle`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursy`
--

CREATE TABLE IF NOT EXISTS `kursy` (
  `id_kursu` int(11) NOT NULL AUTO_INCREMENT,
  `id_zalozyciela` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `klucz_dostepu` text COLLATE utf8_polish_ci NOT NULL,
  `stan` text COLLATE utf8_polish_ci NOT NULL COMMENT 'Przechowuje informację, czy kurs jest zablokowany(blocked) czy nie (dobry)',
  PRIMARY KEY (`id_kursu`),
  KEY `id_kursu` (`id_kursu`),
  KEY `id_zalozyciela` (`id_zalozyciela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `kursy`
--

INSERT INTO `kursy` (`id_kursu`, `id_zalozyciela`, `nazwa`, `klucz_dostepu`, `stan`) VALUES
(1, 2, '4it Programowanie Extremalneasd das', 'java-ssie', 'dobry'),
(2, 1, 'Siedzenie i nic nie robienie', 'idz_sie_lecz', 'dobry'),
(3, 2, 'Kurs test', 'asd546s', 'dobry');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje`
--

CREATE TABLE IF NOT EXISTS `lekcje` (
  `id_lekcji` int(11) NOT NULL AUTO_INCREMENT,
  `id_kursu` int(11) NOT NULL,
  `temat` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `plik_nauczyciela` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalną ścieżkę do pliku, który udostępnił nauczyciel',
  `oryginalna_nazwa` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `data_dodania` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `typ_odpowiedzi` text NOT NULL COMMENT 'p - plik; t - tekst; q -quiz;',
  PRIMARY KEY (`id_lekcji`),
  KEY `id_kursu` (`id_kursu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Zrzut danych tabeli `lekcje`
--

INSERT INTO `lekcje` (`id_lekcji`, `id_kursu`, `temat`, `tresc`, `plik_nauczyciela`, `oryginalna_nazwa`, `data_dodania`, `typ_odpowiedzi`) VALUES
(1, 1, 'Dlaczego ludzie programujo ?', 'Ludzie programujo, bo mogo. Dzienkuje, dobranoc.', 'brak', 'safe_image - Kopia (22).jpg', '2015-11-03', 't'),
(2, 1, 'Programowanie a kopiowanie', 'Jest to dosyć ciekawe zagadnienie. Bardzo dużo ludzi kopiuje treść programów by programować szybciej i lepiej.<br> Można zrobić test HTML <b>To pogrubione</b>, <a>natomiast jest to link</a>.', 'brak', NULL, NULL, 'p'),
(3, 1, 'Test jpgów i innych badziewów', 'W tej lekcji można przetestować obrazki przez img src. Hosting na jpg.aq.pl<br>\n<center>\n<img src="http://www.jpg.aq.pl/s/3331.jpg" width="500px">\n</center>', NULL, NULL, NULL, ''),
(7, 2, ' nic nie robienie', ' nic nie robienie  nic nie robienie  nic nie robienie  nic nie robienie', NULL, NULL, NULL, ''),
(25, 3, 'jkhjkhjkhkhjk', 'kugjkhjkhjkhjkhjkhjk', NULL, NULL, NULL, 't'),
(26, 3, '33333333 3 3  3 33 ccc', '33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 ', NULL, NULL, NULL, ''),
(28, 3, 'fff f f  f123 22222222', 'fff f f  ffff f f  fffasdasdassd', 'brak', 'awatar StarCrafts s4 ep2 broodwar.jpg', '2015-11-01', ''),
(29, 2, 'Temat lekcjiTemat lekcjiffffff', 'asdasdasd', '29.txt', 'zadania piatek.txt', '2015-11-02', 'q');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odp_ucznia`
--

CREATE TABLE IF NOT EXISTS `odp_ucznia` (
  `id_pliku` int(11) NOT NULL AUTO_INCREMENT,
  `id_lekcji` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `plik_ucznia` text COLLATE utf8_polish_ci NOT NULL,
  `oryginalna_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` text COLLATE utf8_polish_ci NOT NULL,
  `wynik_testu` text COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_pisemna` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_pliku`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `odp_ucznia`
--

INSERT INTO `odp_ucznia` (`id_pliku`, `id_lekcji`, `id_uzytkownika`, `plik_ucznia`, `oryginalna_nazwa`, `data_dodania`, `wynik_testu`, `odpowiedz_pisemna`) VALUES
(1, 1, 4, '1_4test.txt', 'ble.txt', '2015-11-02', '', 'odpowiedz pisemna a das dsd af   sdg s gsdg '),
(2, 3, 2, 'asd', 'asd', 'asd', 'asd', 'asd'),
(9, 1, 3, '', '', '2015-11-03', '', 'dfgdfg'),
(10, 1, 3, '', '', '2015-11-03', '', 'dfgdfg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `typ`, `email`, `reset_hasla`) VALUES
(1, 'test', 'test', 'Testownik', 'Testowy', 'a', '', ''),
(2, 'test2', 'test2', 'Jan', 'KowalskiEEEE', 'n', 'test2@wp.pl', ''),
(3, 'test3', 'test3', 'Paweł', 'Kowalski', 'u', 'test3@wp.pl', ''),
(4, 'adasdasd', 'asd', 'Ble ble', 'adadasdafasf', 'n', '', ''),
(5, 'aaaa', 'aaa', 'aaa', 'aasfasf', 'u', '', ''),
(6, 'test4', 'test', 'Testyk', 'Terere', 'n', 'test@test.pl', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapisy`
--

CREATE TABLE IF NOT EXISTS `zapisy` (
  `id_zapisu` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `data_zapisu` text NOT NULL,
  `plik_uzytkownika` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalny plik, który użytkownik przesłał do lekcji',
  PRIMARY KEY (`id_zapisu`),
  KEY `id_uzytkownika` (`id_uzytkownika`),
  KEY `id_kursu` (`id_kursu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `zapisy`
--

INSERT INTO `zapisy` (`id_zapisu`, `id_uzytkownika`, `id_kursu`, `data_zapisu`, `plik_uzytkownika`) VALUES
(1, 3, 1, '2015-10-23', NULL),
(10, 4, 2, '2015-10-24', NULL),
(11, 3, 2, '2015-10-24', NULL),
(15, 3, 3, '2015-10-25', NULL),
(16, 4, 3, '2015-10-26', NULL);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kursy`
--
ALTER TABLE `kursy`
  ADD CONSTRAINT `uzytkownik-kurs` FOREIGN KEY (`id_zalozyciela`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `lekcje`
--
ALTER TABLE `lekcje`
  ADD CONSTRAINT `kursy-lekcja` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zapisy`
--
ALTER TABLE `zapisy`
  ADD CONSTRAINT `kurs-zapis` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzytkownik-zapis` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
