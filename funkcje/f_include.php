<?php
/* 
 * Plik zawiera funkcje, które dołączają pliki podane przez GET
 * Skrypt sprawdza warunki, czy dany plik istnieje
 * Najpierw dołączana jest wersja pliku z rozserzeniem .php
 * Gdy plik taki nie istnieje wyszukiwana jest wersja z .html
 * Gdy i takiego pliku nie ma, skrypt wyświetla błąd 404 (brak pliku).
 */

//pierwszy argument to nazwa zmiennej $_GET['nazwa'];
// drugi argument to domyślny plik, gdyby zmienna $_GET nie wskazywała na zaden poprawny
function dolacz_plik($nazwa_zmiennej_get, $domyslny_plik)
{
    // pobieramy parametr z GET (w naszym przypadku jest to ogólnie nazwany $nazwa_zmiennej_get)
    @$plik = $_GET[$nazwa_zmiennej_get];
    
    // sprawdzmy, czy w adresie jest przekazywana dana zmienna $_GET
    // jeśli jej nie ma, przypisujemy domyślną wartość, czyli $strona_startowa
    if (isset($plik))
    {
        $pokaz=$plik;
    }
    else
    {
        $pokaz=$domyslny_plik;
    }
    
    // jak jest w nim znak kropki - wyswietlamy domyslny skrypt
    // nazwy podajemy bez rozszerzeń, skrypt sam zadba o odpowiednie
    if (strpos($pokaz,'.')!==false)
    {
        $pokaz=$domyslny_plik;
    }
    // skrypy dodaje odpowiednie rozszerznie -  w pierwszej kolejnosci php, potem html
    if (file_exists($pokaz.'.php'))
    {
        $pokaz.='.php';
    }
    else
    {
        $pokaz.='.html';
    }
        
    // gdy już mamy gotową nazwę pliku, możemy go spróbować dołączyć do skryptu
    if (file_exists($pokaz)) 
    {
	include($pokaz);
    }
    else
    {
        // wyświetlamy błąd, gdy plik nie istnieje
        echo("Błąd 404 - brak pliku <b> {$plik} </b><br>");
        echo('Zmienna <b>$_GET["'.$nazwa_zmiennej_get.'"];</b><br>');
    }
}

?>