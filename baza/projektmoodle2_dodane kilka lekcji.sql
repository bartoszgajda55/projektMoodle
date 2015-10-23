-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Paź 2015, 20:40
-- Wersja serwera: 5.6.24
-- Wersja PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `projektmoodle`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursy`
--

CREATE TABLE IF NOT EXISTS `kursy` (
  `id_kursu` int(11) NOT NULL,
  `id_zalozyciela` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `klucz_dostepu` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kursy`
--

INSERT INTO `kursy` (`id_kursu`, `id_zalozyciela`, `nazwa`, `klucz_dostepu`) VALUES
(1, 2, '4it Programowanie Extremalne', 'java-ssie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje`
--

CREATE TABLE IF NOT EXISTS `lekcje` (
  `id_lekcji` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `temat` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `lekcje`
--

INSERT INTO `lekcje` (`id_lekcji`, `id_kursu`, `temat`, `tresc`) VALUES
(1, 1, 'Dlaczego ludzie programujo ?', 'Ludzie programujo, bo mogo. Dzienkuje, dobranoc.'),
(2, 1, 'Programowanie a kopiowanie', 'Jest to dosyć ciekawe zagadnienie. Bardzo dużo ludzi kopiuje treść programów by programować szybciej i lepiej.<br> Można zrobić test HTML <b>To pogrubione</b>, <a>natomiast jest to link</a>.'),
(3, 1, 'Test jpgów i innych badziewów', 'W tej lekcji można przetestować obrazki przez img src. Hosting na jpg.aq.pl<br>\n<center>\n<img src="http://www.jpg.aq.pl/s/3331.jpg" width="500px">\n</center>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `typ` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `reset_hasla` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `typ`, `email`, `reset_hasla`) VALUES
(1, 'test', 'test', 'Testownik', 'Testowy', 'a', '', ''),
(2, 'test2', 'test2', 'Jan', 'KowalskiEEEE', 'n', 'test2@wp.pl', ''),
(3, 'test3', 'test3', 'Paweł', 'Kowalski', 'u', 'test3@wp.pl', ''),
(4, 'adasdasd', 'asd', 'Ble ble', 'adadasdafasf', 'u', '', ''),
(5, 'aaaa', 'aaa', 'aaa', 'aasfasf', 'u', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapisy`
--

CREATE TABLE IF NOT EXISTS `zapisy` (
  `id_zapisu` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `data_zapisu` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zapisy`
--

INSERT INTO `zapisy` (`id_zapisu`, `id_uzytkownika`, `id_kursu`, `data_zapisu`) VALUES
(1, 3, 1, '2015-10-23');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `kursy`
--
ALTER TABLE `kursy`
  ADD PRIMARY KEY (`id_kursu`), ADD KEY `id_kursu` (`id_kursu`), ADD KEY `id_zalozyciela` (`id_zalozyciela`);

--
-- Indexes for table `lekcje`
--
ALTER TABLE `lekcje`
  ADD PRIMARY KEY (`id_lekcji`), ADD KEY `id_kursu` (`id_kursu`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `zapisy`
--
ALTER TABLE `zapisy`
  ADD PRIMARY KEY (`id_zapisu`), ADD KEY `id_uzytkownika` (`id_uzytkownika`), ADD KEY `id_kursu` (`id_kursu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kursy`
--
ALTER TABLE `kursy`
  MODIFY `id_kursu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `lekcje`
--
ALTER TABLE `lekcje`
  MODIFY `id_lekcji` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `zapisy`
--
ALTER TABLE `zapisy`
  MODIFY `id_zapisu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
