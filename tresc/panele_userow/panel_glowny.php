<!--- Jest to główny plik
      Z lewej strony zawiera menu
      Z prawej strony wyświetlają się podstrony
--->
<div id='panel'><h1>Panel użytkownika</h1></div>
<hr>

<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <?php
        // $plik to adres do tego pliku. Zrobiono dla wygody
        $plik = "?v=tresc/panele_userow/panel_glowny";
        // przyciski do podstron
        standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/uczen/u_info", "Główne informacje");
        standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/uczen/u_zmiana_hasla", "Zmiana hasła");
        //standardowy_przycisk("{$plik}&prawa=____KOLEJNY__ADRES____", "Kolejny przycisk");
        // jeśli jesteśmy nauczycielem lub adminem, mamy dostęp do dodatkowych opcji (przycisków)
        if (nauczyciel() || admin())
        {   
            echo "<hr><center><p>Panel Nauczyciela</p></center>";
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__1__", "Stwórz nowy kurs");
           // standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__2__", "Dodaj użytkownika do kursu");
           // standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/____jakis__adres__3__", "Ble ble ble");
        }
        if (admin())
        {
            echo "<hr><center><p>Panel Administratora</p></center>";
            standardowy_przycisk("{$plik}&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami", "Zarządzanie użytkownikami");
        }
        
        ?>
    </ul>
</div>
<div class="col-md-8">
    
    <?php
    // dołączmy plik z $_GET['prawa']
    dolacz_plik("prawa", "tresc/panele_userow/uczen/u_info"); 
    ?>
</div>