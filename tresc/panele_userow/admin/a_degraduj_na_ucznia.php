<?php
// skrypt zmienia rangę użytkownika z nauczyciela na ucznia.
    // tutaj może przebywać tylko admin, sprwadzamy czy nie doszło do niepowołanego dostępu
    if (!admin()) 
    {
        echo 'Tylko dla admina';
        return;
    }
    // sprawdzamy, czy zostały przesłane odpowiednie zmienne
    if (!isset($_GET['id']) || $_GET['id'] =="") return;
    
    // kilka zmiennych - adresy plików, by zmniejszyć ilość kodu i zwiększyć jego czytelność
    $adres_pliku_powrotnego = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami';
    $adres_tego_pliku = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_degraduj_na_ucznia';

    // do degradacji wymagamy potwierdzenia poprzez wciśnięcie przycisku TAK
    // jeśli przycisk TAK został wciśnięty, wykona się ten kod
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
?>
<h3>Degradacja do rangi <b>U</b>czeń</h3><hr>
<?php
    //pobieramy dane użytkownika, którego chcemy mianować na nauczyciela
    $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id='$_GET[id]'")
             or die('Nie istenieje taki użytkownik');
    // wyświetlamy informacje o tym użytkowniku w ładnym rekordzie w tabelce
    dany_user($_GET['id']);
 
    // wyświetlamy pytanie, by potwierdzić chęć awansu użytkownika
    echo '<p class="bg-warning" style="padding: 15px;">Czy chcesz zdegradować tego nauczyciela do rangi <b>U</b>cznia?</p>';
    echo '<a href="'.$adres_tego_pliku.'&id='.$_GET["id"].'&potwierdz=tak" type="button" class="btn btn-success" style="margin-right: 20px; margin-left: 20px;">TAK (degraduj)</a>';
    echo '<a href="'.$adres_pliku_powrotnego.'&degradacja=nie" type="button" class="btn btn-danger">NIE (powrót)</a> ';
?>