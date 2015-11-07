CREATE TABLE IF NOT EXISTS `kursy` (
  `id_kursu` int(11) NOT NULL,
  `id_zalozyciela` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `klucz_dostepu` text COLLATE utf8_polish_ci NOT NULL,
  `stan` text COLLATE utf8_polish_ci NOT NULL COMMENT 'Przechowuje informację, czy kurs jest zablokowany(blocked) czy nie (dobry)'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


INSERT INTO `kursy` (`id_kursu`, `id_zalozyciela`, `nazwa`, `klucz_dostepu`, `stan`) VALUES
(1, 2, '4it Programowanie Extremalne', 'java-ssie', 'dobry'),
(2, 1, 'Krojenie desek, aż drzazgi lecą', 'deska', 'dobry'),
(3, 2, 'Kurs test', 'drzazga', 'dobry'),
(8, 7, 'Jak żydy są wspaniałe', 'o-ja-prd', 'blocked');

CREATE TABLE IF NOT EXISTS `lekcje` (
  `id_lekcji` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `temat` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `plik_nauczyciela` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalną ścieżkę do pliku, który udostępnił nauczyciel',
  `oryginalna_nazwa` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `data_dodania` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `typ_odpowiedzi` text NOT NULL COMMENT 'p - plik; t - tekst; q -quiz;'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

INSERT INTO `lekcje` (`id_lekcji`, `id_kursu`, `temat`, `tresc`, `plik_nauczyciela`, `oryginalna_nazwa`, `data_dodania`, `typ_odpowiedzi`) VALUES
(1, 1, 'Dlaczego ludzie programujo ?', 'Ludzie programujo, bo mogo. Dzienkuje, dobranoc.', '1.jpg', 'safe_image - Kopia (22).jpg', '2015-11-03', 't'),
(2, 1, 'Programowanie a kopiowanie', 'Jest to dosyć ciekawe zagadnienie. Bardzo dużo ludzi kopiuje treść programów by programować szybciej i lepiej.<br> Można zrobić test HTML <b>To pogrubione</b>, <a>natomiast jest to link</a>.', 'brak', NULL, NULL, 'p'),
(3, 1, 'Test jpgów i innych badziewów', 'W tej lekcji można przetestować obrazki przez img src. Hosting na jpg.aq.pl<br>\n<center>\n<img src="http://www.jpg.aq.pl/s/3331.jpg" width="500px">\n</center>', NULL, NULL, NULL, 't'),
(31, 1, 'Co to jest potok i strumień', 'Potok to se w górach płynie, a strumień jest w każdym lasku. Jeśli nikt nie narobił w mrowisko, to strumień czysty jest', NULL, NULL, NULL, ''),
(32, 2, 'Deska', 'Deska – drewniany element w kształcie płaskiego i silnie wydłużonego prostopadłościanu, wykorzystywany głównie jako materiał budowlany, półprodukt stolarski do wykonywania mebli lub materiał wykończeniowy w architekturze wnętrz, wykorzystywany na przykład do układania boazerii.<br><br>\r\n\r\nWedług PN-75D/96000 Tarcica iglasta ogólnego przeznaczenia deska jest jednym z sortymentów tarcicy, wyróżniającym się grubością w przedziale 19-45 mm, szerokością 75-250 mm i długością od 0,9-6,3 m.<br><br>\r\n\r\nWedług PN-72D/96002 Tarcica liściasta ogólnego przeznaczenia deska jest jednym z sortymentów tarcicy, wyróżniającym się grubością w przedziale 16-45 mm, szerokości 80-100 mm i długości powyżej 1 m.<br><br>\r\n\r\nW Szymbarku znajduje się najdłuższa deska świata wycięta ze 120 letniej daglezji zielonej o długości 46 metrów 53 centymetrów posiadająca wpis do Księgi rekordów Guinnessa[1].<br><br>', NULL, NULL, NULL, ''),
(33, 3, 'Pan Tadeusz', 'Litwo! Ojczyzno moja! Ty jesteś jak zdrowie. Ile cię trzeba było gorąca). wachlarz dla żony przy Bernardynie sędzia u Woźnego lepiej zna się w wielkiej peruce, którą powinna młodź dla płatnych sług swoich, a wzdycha do gospody. Słudzy nie widział, bo tak były pod Twoją opiek ofiarowany, martwą podniosłem powiek i obyczaje, nawet o nich opis zwycięstwa lub papugą w stolic i opisuję, bo tak przekradł się pomieszany, zły i Moskalom przez wzgląd na stół pochylony, z jednej dwórórki. Wyczha! poszli, a Pan świata wie, że zdradza! Taka była największa różnica ogrodniczka dziewczynką zdawała się jak żaczek przed nim padnie. Dalej w domu ziemię kochaną i grabliska suwane po stole i krwi tonęła, gdy inni, więcej książkowej nauki. Ale co dzień za wrócone życie podziękować Bogu tak przekradł się nie śmiano po wielu kosztach i dziwu pobladła. twarz spójrzała, z pierwszej lękliwości całkiem już późno i panie słowem, ubiór galowy. szeptali niejedni, Że miał wielką, i miłość dziecinna i pończoszki. Na piasku drobnym, suchym, białym na kozłach niemczysko chude na kwaterze pan Wojski poznał u panów groni mają od Rejenta, szczuplejszy i rzekł: Wielmożni Szlachta, Bracia Dobrodzieje! Forum myśliwskiem tylko widział swych domysłów tysiące jako jenerał Dąbrowski z nami ruszysz.', '8.cpp', 'cos_cpp.cpp', '2015-11-02', 'p'),
(34, 3, 'Lorem ipsum dolor sit amet dolor', 'Lorem ipsum dolor sit amet dolor. Morbi consequat non, ligula. Ut lobortis laoreet condimentum, dapibus sit amet leo. Maecenas nunc. Fusce tempor ac, blandit sed, congue at, bibendum ac, fringilla neque ante a odio at adipiscing ligula. Fusce sed leo in wisi. Vivamus risus. Sed molestie, lectus elit, consequat mollis ultrices, gravida gravida turpis. Fusce ut leo. Maecenas in ipsum. Pellentesque habitant morbi tristique senectus et ultrices fringilla fringilla purus fringilla ligula at quam. Mauris nec leo non dui lectus, vel tincidunt lorem. Suspendisse bibendum pede. Nullam eros ultrices posuere cubilia Curae, In cursus vitae, ornare egestas sodales, velit eleifend non, feugiat malesuada. Ut eget augue. Praesent wisi vel diam. Nam ac nibh lacus, faucibus condimentum nec, eros. Maecenas scelerisque justo euismod elit. In porttitor a, faucibus justo neque, vitae magna et netus et enim. Aliquam tempus vitae, faucibus quis, eleifend nibh, eu tempor auctor, ante sem volutpat ultricies leo. Integer non ullamcorper id, ullamcorper id, luctus diam. Aenean ut urna. Donec nunc. Donec scelerisque condimentum sagittis luctus, purus est, dapibus tellus. Nulla a posuere a, convallis nisl. Vestibulum sollicitudin. Praesent consequat. Donec euismod rutrum, wisi nec erat sit amet tellus. Donec facilisis diam mollis faucibus, dolor sit amet, consectetuer.', NULL, NULL, NULL, ''),
(35, 3, 'Алексей Федорович Карамазов', 'Алексей Федорович Карамазов был всё время в душе полоснули, говаривал он или искусства заискать и почти все, взглянув на могилы, но есть одна подгородная слободка, и заброшены отцом именно заехать сюда и об уличных происшествиях, за границей, знавал лично и разговоры, к митрополиту Платону при появлении их очень-то, а Потемкин крестным отцом… Федор Павлович на выезде из объятий своих странствий, о тяжелой судьбе нашей русской жизни, в самой келье старца, по тысяче рублей каждому на несколько слов и кажется, что и всё равно, он не самими клерикалами, происходило, вероятно, еще с некоторым смущением. Он вывел лишь, бывало, ее дочерей. Кажется, что бросила дом еще никак нельзя было уже знал, что они тут никакого особенного впечатления. Аделаида Ивановна, дама богатая и всё это мне, как бы под конец жизни старца, сказать ему Федор Павлович и целомудренность. Он уважал свой чин приживальщика, все-таки необъяснимым. Прибавлю еще, что и излюбленный, не взял на дворе, придет, бывало, бежит ко вселенскому патриарху и солдаты, мало экспансивен и забыть его у Федора Павловича. Либерал сороковых и самое мрачное лицо своей супруге ежеминутно своими бесстыдными вымогательствами и не всё же самое только последнее время, все же имя автора, заинтересовались и послушать которых он был лет шестидесяти пяти.', NULL, NULL, NULL, 't');

CREATE TABLE IF NOT EXISTS `odp_ucznia` (
  `id_pliku` int(11) NOT NULL,
  `id_lekcji` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `plik_ucznia` text COLLATE utf8_polish_ci NOT NULL,
  `oryginalna_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` text COLLATE utf8_polish_ci NOT NULL,
  `wynik_testu` text COLLATE utf8_polish_ci NOT NULL,
  `odpowiedz_pisemna` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `odp_ucznia` (`id_pliku`, `id_lekcji`, `id_uzytkownika`, `plik_ucznia`, `oryginalna_nazwa`, `data_dodania`, `wynik_testu`, `odpowiedz_pisemna`) VALUES
(1, 1, 4, '', 'ble.txt', '2015-11-02', '', 'odpowiedz pisemna a das dsd af   sdg s gsdg '),
(9, 1, 3, '', '', '2015-11-03', '', 'Ja sie nie znam i nic nie powiem'),
(10, 3, 3, '', '', '2015-11-03', '', 'Ejze, ide stąd.');

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `typ` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `reset_hasla` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `typ`, `email`, `reset_hasla`) VALUES
(1, 'test', 'test', 'Ziemowit', 'Wielki', 'a', 'test@wp.pl', ''),
(2, 'test2', 'test2', 'Jan', 'Kowalski', 'n', 'test2@wp.pl', ''),
(3, 'test3', 'test3', 'Paweł', 'Kowalski', 'u', 'test3@wp.pl', ''),
(6, 'test4', 'test4', 'Czarny', 'Zawisza', 'u', 'test4@test.pl', ''),
(7, 'czerwony_zyd', 'zyd', 'Żyd', 'Żydowny', 'n', 'zydek@zyd.qp', '');

CREATE TABLE IF NOT EXISTS `zapisy` (
  `id_zapisu` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_kursu` int(11) NOT NULL,
  `data_zapisu` text NOT NULL,
  `plik_uzytkownika` text CHARACTER SET utf8 COLLATE utf8_polish_ci COMMENT 'Przechowuje opcjonalny plik, który użytkownik przesłał do lekcji'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `zapisy` (`id_zapisu`, `id_uzytkownika`, `id_kursu`, `data_zapisu`, `plik_uzytkownika`) VALUES
(1, 3, 1, '2015-10-23', NULL),
(11, 3, 2, '2015-10-24', NULL),
(15, 3, 3, '2015-10-25', NULL),
(21, 6, 1, '2015-11-06', NULL),
(22, 6, 3, '2015-11-06', NULL);

ALTER TABLE `kursy`
  ADD PRIMARY KEY (`id_kursu`), ADD KEY `id_kursu` (`id_kursu`), ADD KEY `id_zalozyciela` (`id_zalozyciela`);

ALTER TABLE `lekcje`
  ADD PRIMARY KEY (`id_lekcji`), ADD KEY `id_kursu` (`id_kursu`);

ALTER TABLE `odp_ucznia`
  ADD PRIMARY KEY (`id_pliku`);

ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

ALTER TABLE `zapisy`
  ADD PRIMARY KEY (`id_zapisu`), ADD KEY `id_uzytkownika` (`id_uzytkownika`), ADD KEY `id_kursu` (`id_kursu`);

ALTER TABLE `kursy`
  MODIFY `id_kursu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;

ALTER TABLE `lekcje`
  MODIFY `id_lekcji` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;

ALTER TABLE `odp_ucznia`
  MODIFY `id_pliku` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;

ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;

ALTER TABLE `zapisy`
  MODIFY `id_zapisu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;

ALTER TABLE `kursy`
ADD CONSTRAINT `uzytkownik-kurs` FOREIGN KEY (`id_zalozyciela`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `lekcje`
ADD CONSTRAINT `kursy-lekcja` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `zapisy`
ADD CONSTRAINT `kurs-zapis` FOREIGN KEY (`id_kursu`) REFERENCES `kursy` (`id_kursu`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `uzytkownik-zapis` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;