-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Lis 2015, 17:07
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
  `klucz_dostepu` text COLLATE utf8_polish_ci NOT NULL,
  `stan` text COLLATE utf8_polish_ci NOT NULL COMMENT 'Przechowuje informację, czy kurs jest zablokowany(blocked) czy nie (dobry)'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kursy`
--

INSERT INTO `kursy` (`id_kursu`, `id_zalozyciela`, `nazwa`, `klucz_dostepu`, `stan`) VALUES
(1, 2, '4it Programowanie Extremalne', 'java-ssie', 'dobry'),
(2, 1, 'Siedzenie i nic nie robienie', 'idz_sie_lecz', 'dobry'),
(3, 2, 'Kurs test', 'asd546s', 'dobry'),
(4, 2, 'Kurs numier 3, co by się nie przemęczać', 'blebleble', 'dobry'),
(5, 6, 'a 3 3 3 3 a 3  3 3 ', 'fffffff', 'dobry'),
(6, 2, 'testtt', 'testttt', 'dobry'),
(7, 2, 'asf', 'asf', 'dobry');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje`
--

CREATE TABLE IF NOT EXISTS `lekcje` (
  `id_lekcji` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `temat` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `plik_nauczyciela` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalną ścieżkę do pliku, który udostępnił nauczyciel',
  `oryginalna_nazwa` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `data_dodania` text CHARACTER SET utf8 COLLATE utf8_polish_ci
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `lekcje`
--

INSERT INTO `lekcje` (`id_lekcji`, `id_kursu`, `temat`, `tresc`, `plik_nauczyciela`, `oryginalna_nazwa`, `data_dodania`) VALUES
(1, 1, 'Dlaczego ludzie programujo ?', 'Ludzie programujo, bo mogo. Dzienkuje, dobranoc.', NULL, NULL, NULL),
(2, 1, 'Programowanie a kopiowanie', 'Jest to dosyć ciekawe zagadnienie. Bardzo dużo ludzi kopiuje treść programów by programować szybciej i lepiej.<br> Można zrobić test HTML <b>To pogrubione</b>, <a>natomiast jest to link</a>.', NULL, NULL, NULL),
(3, 1, 'Test jpgów i innych badziewów', 'W tej lekcji można przetestować obrazki przez img src. Hosting na jpg.aq.pl<br>\n<center>\n<img src="http://www.jpg.aq.pl/s/3331.jpg" width="500px">\n</center>', NULL, NULL, NULL),
(4, 3, 'lekcja id 4, ide kursu 3 ', 'fgh fghfghfg hfg hfgh fg hf gh 123 123 12 3<br><hr><h2>asdasd</h2>555', '', NULL, NULL),
(5, 3, '555 333 ble ble', ' 2345 345t g3gg23g ', NULL, NULL, NULL),
(6, 1, 'Test test', 'sdadafasfasf as fas <br>sdasd<b>adad</b>ąśłżźółę', NULL, NULL, NULL),
(7, 2, ' nic nie robienie', ' nic nie robienie  nic nie robienie  nic nie robienie  nic nie robienie', NULL, NULL, NULL),
(8, 1, 'programowanie asd ', 'programowanie asd programowanie asd programowanie asd programowanie asd ', '', '', ''),
(9, 1, 'fffafafaf', 'asdasd', '', '', ''),
(10, 1, 'hghgfh', 'fghfghgfh', '', '', ''),
(11, 1, '13123 1312313123 13123', '13123 1312313123 13123', NULL, NULL, NULL),
(12, 1, 'bleeeee eeeeeeee', 'bleeeee eeeeeeeebleeeee eeeeeeeebleeeee eeeeeeeebleeeee eeeeeeeebleeeee eeeeeeeebleeeee eeeeeeeebleeeee eeeeeeee', '12', 'zadanie10-30v2.zip', '2015-11-01'),
(13, 2, 'nowa lekcja tralalala', 'nowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalalanowa lekcja tralalala', NULL, NULL, NULL),
(14, 2, 'fffff f f f', 'fffff f f ffffff f f ffffff f f ffffff f f ffffff f f ffffff f f ffffff f f ffffff f f ffffff f f ffffff f f f', NULL, NULL, NULL),
(15, 2, 'f f f ', 'f f f f f f f f f ', NULL, NULL, NULL),
(16, 2, 'f f f ', 'f f f f f f f f f ', NULL, NULL, NULL),
(17, 3, 'g3g3g3g', 'g3g3g3g', NULL, NULL, NULL),
(18, 3, 'g3g3g3g', 'g3g3g3g', NULL, NULL, NULL),
(19, 3, 'g3g3g3g', 'g3g3g3g', NULL, NULL, NULL),
(20, 3, '234', '234', '20.zip', 'zadanie10-30v2.zip', '2015-11-01'),
(21, 3, '234', '234', '21.zip', 'zadanie10-30v2.zip', '2015-11-01'),
(22, 3, 'hjkhjkhjk', 'yukuk', NULL, NULL, NULL),
(23, 3, 'kjhkh', 'khkhkhk', NULL, NULL, NULL),
(24, 1, 'ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ', 'ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ccc c  ', '', '', ''),
(25, 3, 'jkhjkhjkhkhjk', 'kugjkhjkhjkhjkhjkhjk', NULL, NULL, NULL),
(26, 3, '33333333 3 3  3 33 ccc', '33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 33333333 3 3  3 33 ', NULL, NULL, NULL),
(27, 3, '444444 4 ccc', '444444 4 ccc444444 4 ccc444444 4 ccc444444 4 ccc', NULL, NULL, NULL),
(28, 3, 'fff f f  f123 22222222', 'fff f f  ffff f f  fffasdasdassd', 'brak', 'awatar StarCrafts s4 ep2 broodwar.jpg', '2015-11-01');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `typ`, `email`, `reset_hasla`) VALUES
(1, 'test', 'test', 'Testownik', 'Testowy', 'a', '', ''),
(2, 'test2', 'test2', 'Jan', 'KowalskiEEEE', 'n', 'test2@wp.pl', ''),
(3, 'test3', 'test3', 'Paweł', 'Kowalski', 'u', 'test3@wp.pl', ''),
(4, 'adasdasd', 'asd', 'Ble ble', 'adadasdafasf', 'u', '', ''),
(5, 'aaaa', 'aaa', 'aaa', 'aasfasf', 'n', '', ''),
(6, 'test4', 'test', 'Testyk', 'Terere', 'n', 'test@test.pl', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapisy`
--

CREATE TABLE IF NOT EXISTS `zapisy` (
  `id_zapisu` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `data_zapisu` text NOT NULL,
  `plik_uzytkownika` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalny plik, który użytkownik przesłał do lekcji'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zapisy`
--

INSERT INTO `zapisy` (`id_zapisu`, `id_uzytkownika`, `id_kursu`, `data_zapisu`, `plik_uzytkownika`) VALUES
(1, 3, 1, '2015-10-23', NULL),
(10, 4, 2, '2015-10-24', NULL),
(11, 3, 2, '2015-10-24', NULL),
(15, 3, 3, '2015-10-25', NULL),
(16, 4, 3, '2015-10-26', NULL),
(17, 6, 1, '2015-10-28', NULL),
(18, 6, 4, '2015-10-29', NULL),
(19, 3, 4, '2015-10-29', NULL);

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
  MODIFY `id_kursu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `lekcje`
--
ALTER TABLE `lekcje`
  MODIFY `id_lekcji` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `zapisy`
--
ALTER TABLE `zapisy`
  MODIFY `id_zapisu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
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
