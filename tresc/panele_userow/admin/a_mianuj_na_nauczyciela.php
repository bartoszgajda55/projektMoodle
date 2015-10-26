<?php
// plik zmienia rangę użytkownika z ucznia na nauczyciela

    // tutaj może przebywać tylko admin
    if (!admin()) return;
 
    // sprawdzamy, czy są przesyłane odpowiednie zmienne GET
    if(!isset($_GET['id'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }
        
    // adresy plików. Jedna zmienna a skraca tyle kodu
    $adres_pliku_powrotnego = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami';
    $adres_tego_pliku = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_mianuj_na_nauczyciela';

    // do awansu wymagamy potwierdzenia poprzez wciśnięcie przycisku TAK
    if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak") 
    {
        // modyfikujemy rekord z danym użytkownikiem. Zmieniamy mu wartość pola typ na n (nauczyciel)
        $id=$_GET['id'];
        // zapytanie zmieniające odpowiednie pole w tabeli
        $zapytanie2 = mysql_query("UPDATE uzytkownicy SET typ='n' WHERE id=$id")
                      or die('Nie udało się zmienić typu użytkownika');
        // Przekierowujemy stronę do panelu zarządzania i tam wyświetlamy komunikat o powodzeniu
        header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami&awans=tak&id={$id}");
        // gdyby jednak header() nie przeniosło to dla bezpieczeństwa zatrzymujemy ten skrypt
        return;
    }
?>
<h3>Nadawanie rangi <b>N</b>auczyciel</h3><hr>
<?php
    //pobieramy dane użytkownika, którego chcemy mianować na nauczyciela
    $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id='$_GET[id]'")
             or die('Nie istenieje taki użytkownik');
    // wyświetlamy informacje o tym użytkowniku w ładnym rekordzie w tabelce
    dany_user($_GET['id']);

    // wyświetlamy pytanie, by potwierdzić chęć awansu użytkownika
    echo '<p class="bg-warning" style="padding: 15px;">Czy chcesz nadać temu użytkownikowi rangę <b>N</b>auczyciela?</p>';
    echo '<a href="'.$adres_tego_pliku.'&id='.$_GET["id"].'&potwierdz=tak" type="button" class="btn btn-success" style="margin-right: 20px; margin-left: 20px;">TAK (awansuj)</a>';
    echo '<a href="'.$adres_pliku_powrotnego.'&awans=nie" type="button" class="btn btn-danger">NIE (powrót)</a> ';
?>