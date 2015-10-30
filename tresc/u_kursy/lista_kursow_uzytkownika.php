<!-- Plik zawiera listę kursów do których dany użytkownik ma dostęp -->
<div id="z_lista_lekcji_lewa" class="col-md-9">
<div class="thumbnail">
    <h3>Lista kursów, do których masz dostęp</h3><hr>
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa kursu</th>
      <th>Nauczyciel</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
<?php
// wyświetlenie tabeli z kursami
// zpaytanie, które wyświetla kursy (wraz z nazwami) do których jest zapisany uzytkownik
$wynik = mysql_query("SELECT * FROM `zapisy` INNER JOIN kursy ON zapisy.id_kursu = kursy.id_kursu WHERE zapisy.id_uzytkownika={$_SESSION['id_usera']} AND stan='dobry'");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // zapytanie i pętla
        // zamiast numeru ID wyświetla pełnoprawne imię i nazwisko założyciela kursu
        $nazwa_nauczyciela =  mysql_query("SELECT * FROM `kursy` INNER JOIN uzytkownicy ON kursy.id_zalozyciela = uzytkownicy.id WHERE uzytkownicy.id={$r['id_zalozyciela']}");
        $imie_i_nazwisko_nauczyciela="brak";
        while($g = mysql_fetch_assoc($nazwa_nauczyciela)) 
        {
            // przypisujemy imię i nazwisko danego założyciela (nauczyciela) kursu
            $imie_i_nazwisko_nauczyciela = $g['imie']." ".$g['nazwisko'];
        }
        // tworzenie linku do danego kursu
        $link = "?v=tresc/u_kursy/lista_lekcji&id={$r['id_kursu']}";
        // tabela wyświetlająca listę kursów
        echo '<tr>';
        echo '<td><a href="'.$link.'">'.$r['nazwa'].'</a></td>';
        echo '<td>'.$imie_i_nazwisko_nauczyciela.'</td>';
        echo '<td><a class="btn btn-default btn-sm" href="'.$link.'" role="button">Przejdź do kursu</a></td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>
<hr>
<a class="btn btn-default" href="?v=tresc/u_kursy/dolacz_do_kursu" role="button">Dołącz do nowego kursu</a>
</div>
</div>
<div id="z_lista_lekcji_prawa" class="col-md-3">
    <div class="thumbnail">
    <p>Jakaś tam lista
    <p>Albo inny kontent
    </div>
</div>