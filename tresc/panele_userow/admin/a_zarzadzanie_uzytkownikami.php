<h2>Zarządzanie użytkownikami</h2>
Plik umożliwia: <br>
 - mianowanie na nauczyciela <br>
 - degradacja z nauczyciela do użytkownika <br>
 - blokowanie użytkownika <br>
 - odlbokowanie użytkownika <br> <br><hr><hr>
 
 <table class="table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Login</th>
      <th>Imie</th>
      <th>Nazwisko</th>
      <th>E-mail</th>
      <th>Typ</th>
      <th>Blokada</th>
      <th>Nauczyciel</th>
    </tr>
  </thead>
    <tbody>
<?php
$adres_pliku = "?v=tresc/panele_userow/panel_glowny";
// wyświetlenie tabeli z uzytkowniami
$wynik = mysql_query("SELECT * FROM uzytkownicy");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // uwstawiamy potrzebne zmienne
        $id = $r['id'];
        // sprawdzamy typ konta, by wyświetlić ładną tabelkę
        if($r['typ']=="a") $typp = '<p class="btn btn-default">a</p>';
        else if($r['typ']=="n") $typp = '<p  class="btn btn-warning">n</p>';
        else if($r['typ']=="u") $typp = '<p class="btn btn-primary">u</p>';
        else if($r['typ']=="blocked") $typp = '<p class="btn btn-danger">X</p>';
        
        // sprawdzamy, czy możemy awansować danego użytkownika. 
        // Jeśli jest już nauczycielem bądź adminem to nie awansujemy
        if($r['typ']=="a") 
        {
            // jak admin to nic nie możemy zrobić. Admin forever
            $awans = '';
        }
        else if($r['typ']=="n")
        {
            // jak nauczyciel to dajemy możliwość degradacji do zwykłego usera
            $awans = '<a href="" type="button" class="btn btn-primary">Degraduj</a>';
        } 
        else if($r['typ']=="u") 
        {
            // jak user to dajemy możliwość awansu na nauczyciela
            $awans = '<a href="'.$adres_pliku.'&prawa=tresc/panele_userow/admin/a_mianuj_na_nauczyciela&id='.$id.'" type="button" class="btn btn-warning">Awansuj</a>';
        }
        
        // sprawdzamy, czy użytkownik nie jest zablokowany
        // wyświetlamy możliwość zablokowania lub odblokowania
        if($r['typ']=="blocked")
        {
            // dodac komenty
            $blokada = '<a href="" type="button" class="btn btn-success">Odblokuj</a>';
        }
        else $blokada = '<a href="" type="button" class="btn btn-danger">Zablokuj</a>';
        
        
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td>'.$typp.'</td>';
        echo '<td>'.$blokada.'</td>';
        echo '<td>'.$awans.'</td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>
