<h3>
    Dodawanie użytkownika do kursu, krok <b>3/3</b>
    <?php
    $link1 = "?v=tresc/panele_userow/panel_glowny"
                ."&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu2"
                ."&id_usera={$_GET['id_usera']}";
    ?>
    <a class="btn btn-default" href="<?=$link1?>" role="button">Wstecz</a>
    <br><small>Potwierdzenie operacji</small><hr>
</h3>
<?php // sprawdzamy uprawnienia do przeglądania pliku
    if (!admin()) return;
    // sprawdzamy, czy są przesyłane odpowiednie zmienne GET
    if(!isset($_GET['id_usera']) || !isset($_GET['id_kursu'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }
?>
<?php
    // stworzenie kilku zmiennych
    $id_usera = $_GET['id_usera'];
    $id_kursu = $_GET['id_kursu'];
?>

<h4>Czy chcesz dodać tego użytkownika </h4>
<!-- tabelka z userem --------------------------------------------------------------------------------- -->
<div class="alert alert-warning" role="alert">
 <table class="table"><thead><tr>
   <th>#id</th><th>Login</th><th>Imie</th><th>Nazwisko</th><th>E-mail</th><th>Typ</th>
</tr></thead><tbody>
<?php
// wyświetlenie użytkownika
$wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id={$id_usera}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
       // wyświetlamy jeden wiersz z userem          
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td><p class="btn btn-primary btn-sm">u</p></td>';
        echo '</tr>'; 
    }
?>
  </tbody></table></div>

<h4> do tego kursu? </h4>

<!-- tabelka z kursem --------------------------------------------------------------------------------- -->
<div class="alert alert-info" role="alert">
 <table class="table"><thead><tr><th>#id</th><th>Nazwa</th></tr></thead>
  <tbody>
<?php
// wyświetlenie tabeli z kursami
$wynik = mysql_query("SELECT * FROM kursy WHERE id_kursu={$id_kursu}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // wyświetlamy dany kurs z tabeli (tylko jeden)        
        echo '<tr>';
        echo '<td>'.$r['id_kursu'].'</td>';
        echo '<td>'.$r['nazwa'].'</td>';
        echo '</tr>'; 
    }
?>
  </tbody></table></div>

<!-- kod z potwierdzeniem i dodaniem ------------------------------------------------------------------- -->
<?php
    // do akcji potrzeba potwierdzenia poprzez wciśnięcie przycisku TAK
    if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak") 
    {
        // sprawdzamy, czy uzytkownik przypadkiem już nie należy do tego kursu
        $zapytanie1 = mysql_query("SELECT * FROM zapisy WHERE id_uzytkownika={$id_usera} AND id_kursu={$id_kursu}");
        $ilosc_wierszy = mysql_num_rows($zapytanie1);
        if ($ilosc_wierszy !=0) 
        {
            // jeśli użytkownik już należy do kursu, to przenosimy do głównego skryptu i wyświetlamy odpowiedź
            header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu1&sukces=byl_dodany");
        }
        
        // jeśli użytkownik nie należy do kursu, to możemy go dodać do niego
        // wystarczy dodać jeden wpis do tabeli zapisy
        $dataa = (string) date("Y-m-d");
        $zapytanie2 = mysql_query("INSERT INTO zapisy (id_uzytkownika, id_kursu, data_zapisu) VALUES ({$id_usera}, {$id_kursu}, '{$dataa}')")
                      or die('Nie udało się dodać użytkownika do kursu');
        // Przekierowujemy stronę do panelu 1 (pierwszego i tam wyświetlamy komunikat o powodzeniu
        header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu1&sukces=tak");
        // gdyby jednak header() nie przeniosło to dla bezpieczeństwa zatrzymujemy ten skrypt
        return;
    }



    // wyświetlenie przycisków
    $link5 = "index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu3"
            . "&id_usera={$id_usera}"
            . "&id_kursu={$id_kursu}"
            . "&potwierdz=tak";
    echo '<a href="'.$link5.'" type="button" class="btn btn-success btn-lg" style="margin-right: 20px; margin-left: 20px;">Tak</a>';
    echo '<a href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu1&sukces=nie" type="button" class="btn btn-danger btn-lg">Nie</a> ';

?>

