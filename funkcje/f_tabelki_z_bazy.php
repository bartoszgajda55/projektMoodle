<?php
    // plik zawiera zestaw funkcji, które wyświetlają małe tabelki z bazy danych
    // małe tabelki - czyli jodnowierszowe tabele w jakimś tle


// wyświetla tabelkę z danym kursem. Można zmienić kolor, ale domyślnie jest to info (niebieski)
// tabelka ta ma tylko jeden wiersz i wyświetla tylko informacje o kursie podanymi w $id
function dany_kurs($id, $kolor="info")
{
    echo '<div class="alert alert-'.$kolor.'" role="alert">';
    echo '<h3><small>Wybrany kurs</small></h3>';
    echo '<table class="table"><thead><tr><th>#id</th><th>Nazwa</th></tr></thead>';
    echo '<tbody>';

    // wyświetlenie tabeli z kursami
    $wynik = mysql_query("SELECT * FROM kursy WHERE id_kursu={$id}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // wyświetlamy dany kurs z tabeli (tylko jeden)        
        echo '<tr>';
        echo '<td>'.$r['id_kursu'].'</td>';
        echo '<td>'.$r['nazwa'].'</td>';
        echo '</tr>'; 
    }
    echo '</tbody></table></div>';
}


// wyświetla tabelkę z danym uzytkownikiem
// wyświetla informacje tylko o jednym uzytkowniku, o id podanym w zmiennej $id.
function dany_user($id, $kolor="warning")
{
    echo '<div class="alert alert-'.$kolor.'" role="alert">';
    echo '<h3><small>Wybrany użytkownik</small></h3>';
    echo '<table class="table"><thead><tr>';
    echo '<th>#id</th><th>Login</th><th>Imie</th><th>Nazwisko</th><th>E-mail</th><th>Typ</th>';
    echo '</tr></thead><tbody>';

    // wyświetlenie użytkownika
    $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id={$id}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // ustawiamy odpowiednią ikonkę typu
        if($r['typ']=="a") $typp = '<p class="btn btn-default">a</p>';
        else if($r['typ']=="n") $typp = '<p  class="btn btn-warning">n</p>';
        else if($r['typ']=="u") $typp = '<p class="btn btn-primary">u</p>';
        else if($r['typ']=="blocked") $typp = '<p class="btn btn-danger">X</p>';
       // wyświetlamy jeden wiersz z userem          
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td>'.$typp.'</td>';
        echo '</tr>'; 
    }

  echo '</tbody></table></div>';
}