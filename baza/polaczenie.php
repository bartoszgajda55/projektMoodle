<?php
// połączenie z bazą danych MySQL
// lokalnie jest to baza: projektMoodle

    $adres = '127.0.0.1';
    $uzytkownik = 'root';
    $haslo = 'bazydanych';
    $nazwa_bazy = 'projektMoodle';

    // ustanawiamy połączenie z bazą, jak się nie łączy, wyświetlamy błąd
    $connection = @mysql_connect($adres, $uzytkownik, $haslo)
    or die('Brak polaczenia z serwerem MySQL.<br />Błąd: '.mysql_error());

    // wybieramy odpowiednią bazę danych
    $db = @mysql_select_db($nazwa_bazy, $connection)
    or die('Nie moge polaczyć sie z baza danych<br />Blad: '.mysql_error());

    // ustawiamy kodowanie na utf8
    mysql_query("SET NAMES utf8");

?>
