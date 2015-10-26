<h3>Degradacja do rangi <b>U</b>czeń</h3><hr>
<?php
    // tutaj może przebywać tylko admin
    if (!admin()) 
    {
        echo 'Tylko dla admina';
        return;
    }
    
    // adresy plików. Jedna zmienna a skraca tyle kodu
    $adres_pliku_powrotnego = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami';
    $adres_tego_pliku = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_degraduj_na_ucznia';

    //pobieramy dane użytkownika, którego chcemy mianować na nauczyciela
    $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id='$_GET[id]'")
             or die('Nie istenieje taki użytkownik');
    // wyświetlamy informacje o tym użytkowniku w ładnym rekordzie w tabelce
    dany_user($_GET['id']);

    // do degradacji wymagamy potwierdzenia poprzez wciśnięcie przycisku TAK
    if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak") 
    {
        // modyfikujemy rekord z danym użytkownikiem. Zmieniamy mu wartość pola typ na n (nauczyciel)
        $id=$_GET['id'];
        // zapytanie zmieniające odpowiednie pole w tabeli
        $zapytanie2 = mysql_query("UPDATE uzytkownicy SET typ='u' WHERE id=$id")
                      or die('Nie udało się zmienić typu użytkownika');
        // Przekierowujemy stronę do panelu zarządzania i tam wyświetlamy komunikat o powodzeniu
        header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami&degradacja=tak&id={$id}");
        // gdyby jednak header() nie przeniosło to dla bezpieczeństwa zatrzymujemy ten skrypt
        return;
    }
    
        
    // wyświetlamy pytanie, by potwierdzić chęć awansu użytkownika
    echo '<p class="bg-warning" style="padding: 15px;">Czy chcesz zdegradować tego nauczyciela do rangi <b>U</b>cznia?</p>';
    echo '<a href="'.$adres_tego_pliku.'&id='.$_GET["id"].'&potwierdz=tak" type="button" class="btn btn-success" style="margin-right: 20px; margin-left: 20px;">TAK (degraduj)</a>';
    echo '<a href="'.$adres_pliku_powrotnego.'&degradacja=nie" type="button" class="btn btn-danger">NIE (powrót)</a> ';
?>