<!-- 3 krokowy skrpyt, który ma za zadanie usunąć danego ucznia z kursu
    dostęp do pliku ma Administrator i Nauczyciel
-->
<h3>Usuwanie użytkownika z kursu, krok <b>1/3</b><hr>
    <small>Wybierz kurs:</small>
</h3><br>
<?php // zabezpieczenie przed niepowołanym dostępem
    if (!admin() && !nauczyciel()) return;
?>

 <table class="table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Nazwa</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
<?php
// wyświetlenie tabeli z kursami
    if(admin())
    {   // jeżeli jesteśmy adminem, to dostajemy pełną listę kursów
        $wynik = mysql_query("SELECT * FROM kursy");
    }
    else if (nauczyciel())
    {   // jeśli jesteśmy nauczycielem, mamy dostęp tylko do swoich kursów
        $wynik = mysql_query("SELECT * FROM kursy WHERE id_zalozyciela={$_SESSION['id_usera']}");
    }

    while($r = mysql_fetch_assoc($wynik)) 
    {
        // uwstawiamy potrzebne zmienne
        $id = $r['id_kursu'];
        // tworzymy link
        $link = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_usun_z_kursu2"
                . "&id_kursu={$id}";
        
        // wyświetlamy dany wiersz w tabeli          
        echo '<tr>';
        echo '<td>'.$r['id_kursu'].'</td>';
        echo '<td>'.$r['nazwa'].'</td>';
        echo '<td><a class="btn btn-default" href="'.$link.'" role="button">Wybierz kurs</a></td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>