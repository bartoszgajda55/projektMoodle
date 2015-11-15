<?php
    //plik zawiera funkcje tworzące "inteligentne" przyciski.
    //inteligentny przycisk to taki, który jest zaznaczony, jeśli został kliknięty

// standardowy przycisk.
// $adres - pierwszy argument - adres, do którego odwołuje się przycisk
// $tresc - drugi argument - treść, jaka się wyświetla na przycisku
// $podswietlenie - trzeci argument - domyślna wartość to 1, przycisk będzie podświetlany po kliknięciu i załadowaniu strony, do której on wskazuje
function standardowy_przycisk($adres, $tresc, $podswietlenie=1)
{
    // sprawdzamy czy w adresie ($_SERVER) znajduje się ciąg z adresu przycisku ($adres)
    // jeśli tak, to dodajemy klasę .active
    // w przeciwnym wypadku nic nie zmieniamy i wyświetlamy bez podświetlenia
    if( strpos( $_SERVER['REQUEST_URI'], $adres) && $podswietlenie==1)
    {
        echo '<li class="active"><a href="'.$adres.'">'.$tresc.'</a></li>';
    }
    else
    {
        echo '<li><a href="'.$adres.'">'.$tresc.'</a></li>';
    }  
}

// wyświetla komunikat o błędzie lub powodzeniu
function komunikat($tresc, $kolor="info")
{
    echo '<div class="alert alert-'.$kolor.'" role="alert">'.$tresc.'</div>';
}

// losuje glyphicone
function losuj_ikone()
{
    // tablica z ikonami
    $ikona[]="asterisk";$ikona[]="plus";$ikona[]="euro";$ikona[]="eur";$ikona[]="minus";$ikona[]="cloud";$ikona[]="envelope";$ikona[]="pencil";
    $ikona[]="glass";$ikona[]="music";$ikona[]="search";$ikona[]="heart";
    $ikona[]="heart";$ikona[]="star";$ikona[]="star-empty";$ikona[]="user";
	$ikona[]="film";$ikona[]="th";$ikona[]="list";$ikona[]="ok";
	$ikona[]="remove";$ikona[]="cog";$ikona[]="zoom-in";$ikona[]="off";
	$ikona[]="signal";$ikona[]="trash";$ikona[]="file";$ikona[]="road";
	$ikona[]="download-alt";$ikona[]="repeat";$ikona[]="refresh";$ikona[]="volume-off";
	$ikona[]="print";$ikona[]="font";$ikona[]="play";$ikona[]="stop";
	$ikona[]="ok-sign";$ikona[]="arrow-down";$ikona[]="resize-full";$ikona[]="resize-small";
	$ikona[]="calendar";$ikona[]="magnet";$ikona[]="tasks";$ikona[]="tasks";
	$ikona[]="tasks";$ikona[]="tasks";$ikona[]="pushpin";$ikona[]="sort-by-attributes";
	$ikona[]="briefcase";$ikona[]="globe";$ikona[]="phone";$ikona[]="wrench";
	$ikona[]="tower";$ikona[]="ice-lolly-tasted";$ikona[]="console";$ikona[]="sunglasses";
  
    // wylosowana ikona
    $wylosowana_liczba=rand(0, count($ikona)-1);
    $wylosowana =$ikona[$wylosowana_liczba];
    // nazwa ikony
    $nazwa="glyphicon glyphicon-{$wylosowana}";
    // zwrócenie ikony
    return '<span class="'.$nazwa.'" aria-hidden="true"></span>';
}


?>