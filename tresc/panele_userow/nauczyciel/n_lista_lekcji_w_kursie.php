<?php
// wyświetla w tabelcę listę lekcji w danym kursie.
    // tutaj dostęp ma tylko admin lub tylko nauczyciel
    if(!admin() && !nauczyciel()) return;
    
    // sprawdzamy, czy są ustawione odpowiednie zmienne, jeśli nie, wyświetlamy stosowny komunikat
    // trzeba wtedy uświadomić usera, by przeszedł do pliku z listą kursów i wybrał odpowiedni do wyświetlenia
    if (!isset($_GET['id_kursu']))
    {
        komunikat("Wybierz najpierw kurs z panelu 'Lista kursów'","info");
        // przycisk z linkiem do listy kursów
        echo '<br><a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow" role="button">Przejdź do listy kursów</a>';
        return;
    }
    // ustawienie kilku zmiennych globalnych
    $id = $_GET['id_kursu'];
    $nazwa_kursu = "Brak nazwy kursu";
    
    // pobranie nazwy kursu i przypisanie jej do zmiennej $nazwa_kursu
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `kursy` WHERE id_kursu={$id}");
    while ($nazwa_kursu_row = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        $nazwa_kursu = $nazwa_kursu_row['nazwa'];
    }
?>
    <h3>Kurs: <?=$nazwa_kursu?></h3>
    Zarządzanie lekcjami w kursie
    <hr>
<?php
      // wyświetlenie komunikatu z pliku n_stworz_lekcje (po dodaniu nowej lekcji)
    if (isset($_GET['dodano_lekcje']) && $_GET['dodano_lekcje']=="tak")
    {
        komunikat("Dodano lekcję poprawnie","success");
        echo '<br>';
    }
?>
<a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_stworz_lekcje&id_kursu=<?=$_GET['id_kursu']?>"
   role="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Dodaj nową lekcję</a><br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Nr. lekcji</th>
                <th>Temat</th>
                <th>Edycja</th>
             </tr>
        </thead>
        <tbody>
<?php
    // wyświetlenie tabeli z listą lekcji i przyciskami
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_kursu={$id}");
    $nr = 0;
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        $nr++; // licznik lekcji
        // link do pliku z edycją lekcji
        $edycja_lekcji = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_edycja_lekcji"
                . "&id_lekcji={$r['id_lekcji']}";
        // link do pliku z podglądem lekcji
        $podglad_lekcji = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_podglad_lekcji"
                . "&id_lekcji={$r['id_lekcji']}";
                
        echo '<tr>';
        echo '<td>'.$nr.'</td>';
        echo '<td><a href="'.$podglad_lekcji.'">'.$r['temat'].'</a></td>';
        // przyciski
        echo '<td><a class="btn btn-default" href="'.$edycja_lekcji.'" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
        echo '<td><a class="btn btn-default " href="'.$podglad_lekcji.'" role="button"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Podgląd lekcji</a></td>';
        echo '</tr>'; 
    }
?>
        </tbody>
    </table>