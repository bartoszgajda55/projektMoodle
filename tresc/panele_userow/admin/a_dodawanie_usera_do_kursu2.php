<h3>
    Dodawanie użytkownika do kursu, krok <b>2/3</b>
    <a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu1" role="button">Wstecz</a>
    <hr>
    <small>Wybierz kurs</small>
</h3>
<?php // sprawdzamy uprawnienia do przeglądania pliku
    if (!admin()) return;
    // sprawdzamy, czy są przesyłane odpowiednie zmienne GET
    if(!isset($_GET['id_usera'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }
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
$wynik = mysql_query("SELECT * FROM kursy");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // uwstawiamy potrzebne zmienne
        $id = $r['id_kursu'];
        // tworzymy link
        $link = "?v=tresc/panele_userow/panel_glowny"
                ."&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu3"
                ."&id_usera={$_GET['id_usera']}"
                ."&id_kursu={$id}";
        
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