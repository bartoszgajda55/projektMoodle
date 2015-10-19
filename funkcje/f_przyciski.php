<?php
    //plik zawiera funkcje tworzące "inteligentne" przyciski.
    //inteligentny przycisk to taki, który jest zaznaczony, jeśli został kliknięty

function standardowy_przycisk($adres, $tresc)
{
    // sprawdzamy czy w adresie ($_SERVER) znajduje się ciąg z adresu przycisku ($adres)
    // jeśli tak, to dodajemy klasę .active
    // w przeciwnym wypadku nic nie zmieniamy i wyświetlamy bez podświetlenia
    if( strpos( $_SERVER['REQUEST_URI'], $adres) )
    {
        echo '<li class="active"><a href="'.$adres.'">'.$tresc.'</a></li>';
    }
    else
    {
        echo '<li><a href="'.$adres.'">'.$tresc.'</a></li>';
    }  
}

?>