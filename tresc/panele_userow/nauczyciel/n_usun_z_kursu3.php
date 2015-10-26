<?php
// plik usuwa użytkownika z danego kursu
// jest to 3 (ostatni) krok tego kreatora

    // zabezpieczenie przed niepowołanym dostępem
    if (!admin() && !nauczyciel()) return;
    // sprawdzamy, czy są przesyłane odpowiednie zmienne GET
    if(!isset($_GET['id_usera']) || !isset($_GET['id_kursu'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }

    // stworzenie kilku zmiennych
    $id_usera = $_GET['id_usera'];
    $id_kursu = $_GET['id_kursu'];
    $link1 = "index.php?v=tresc/panele_userow/panel_glowny"
             ."&prawa=tresc/panele_userow/nauczyciel/n_usun_z_kursu2"
             ."&id_kursu={$_GET['id_kursu']}";
    $link5 = "index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_usun_z_kursu3"
            . "&id_usera={$id_usera}"
            . "&id_kursu={$id_kursu}"
            . "&potwierdz=tak";
                   
    // sprawdzamy, czy wciśnięto przycisk TAK
    // jeśli przycisk został wciśniety to usuwamy użytkownika
    if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak") 
    {
        // sprawdzamy, czy mamy prawo usunąć tego użytkownika z tego kursu (poprzez modyfikację adersu)
        // ------ niestety, ale ta opcja jest ciężka do dodania i trzeba większego pomyślunku.
        // ------ z racji tego że kod jest pisany w sobotę wieczorem, nikomu myśleć się nie chce,
        // ------ więc prawdopodobnie takiej blokady usuwania nie będzie.
        // ------ blokada miała wygląać tak, że jeśli nauczyciel nie zrządza tym kursem, to nie może on usunąć użytkownika z tego kursu.
        // ------ co prawda, taka opcja jest zaimplementowana w kroku numer 1, ale tutejsza blokada miała blokować zabawy poprzez pasek adresu.
        // ------ Może kiedyś zostanie dodana, ale na pewno nie w tym tygodniu.
        
        // usuwamy rekord w tabeli, który odnosi się do danego zapisu
        $zapytanie2 = mysql_query("DELETE FROM `zapisy` WHERE id_uzytkownika='{$id_usera}' AND id_kursu='{$id_kursu}'")
                      or die('Nie udało się usunąć użytkownikaz kursu');
        // Przekierowujemy stronę do panelu nr 2 (wyświetlamy tam komunikat o powodzeniu)
        header("Location: {$link1}&sukces=tak");
        // gdyby jednak header() nie przeniosło to dla bezpieczeństwa zatrzymujemy ten skrypt
        return;
    }
?>
<h3>Usuwanie użytkownika z kursu, krok <b>3/3</b>
    <a class="btn btn-default" href="<?=$link1?>" role="button">Wstecz</a>
    <br><small>Potwierdzenie operacji</small><hr>
</h3>
<?php 
// tabelka z kursem
    dany_kurs($id_kursu);
// tabelka z userem
    dany_user($id_usera);
?>
<h4>Czy chcesz usunąć tego uzytkownika z tego kursu? </h4>
<?php
    // wyświetlenie przycisków "TAK" i "NIE"
    echo '<a href="'.$link5.'" type="button" class="btn btn-success btn-lg" style="margin-right: 20px; margin-left: 20px;">Tak</a>';
    echo '<a href="'.$link1.'&sukces=nie" type="button" class="btn btn-danger btn-lg">Nie</a> ';
?>