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

?>