<!--- Jest to główny plik
      Z lewej strony zawiera menu
      Z prawej strony wyświetlają się podstrony
--->
<h1>Informacje o koncie i zarządzanie kursami</h1>
<hr>

<?php
// w tym miejscu musimy sprawdzic parę zmiennych $_GET
// zmienna $_GET['zarejestrowano']==tak - oznacze że użytkownik się zarejestrował i trzeba wyświetlić stosowny komunikat
// zmienna $_GET['zalogowano']==tak - oznacza, że użytkownik sie zalogował. Trzeba go o tym poinformować piknie

    // użytkownik się zarejstrował
    if (isset($_GET['zarejestrowano']) && $_GET['zarejestrowano']=="tak")
    {
        echo ('<p class="btn-lg bg-success">Zarejestrowano pomyślnie</p><hr>');
    }
    // użytkownik się zalogował
    else if (isset($_GET['zalogowano']) && $_GET['zalogowano']=="tak")
    {
        echo ('<p class=" btn-lg bg-info">Zalogowano pomyślnie</p><hr>');
    }

?>
<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <?php
        // $plik to adres do tego pliku. Zrobiono dla wygody
        $plik = "?v=tresc/panele_userow/index";
        // przyciski do podstron
        standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/u_info", "Główne informacje");
        standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/u_zmiana_hasla", "Zmiana hasła");
        standardowy_przycisk("{$plik}&prawa=____KOLEJNY__ADRES____", "Kolejny przycisk");
        // jeśli jesteśmy nauczycielem lub adminem, mamy dostęp do dodatkowych opcji (przycisków)
        if (nauczyciel() || admin())
        {   
            echo "<hr>";
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__1__", "Stwórz nowy kurs");
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__2__", "Dodaj użytkownika do kursu");
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__3__", "Ble ble ble");
        }
        if (admin())
        {
            echo "<hr>";
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__11__", "Mianuj na nauczyciela");
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__22__", "Jesztem admin!");
        }
        
        ?>
    </ul>
</div>
<div class="col-md-8">
    
    <?php
    // dołączmy plik z $_GET['prawa']
    dolacz_plik("prawa", "tresc/panele_userow/p_info"); 
    ?>
</div>