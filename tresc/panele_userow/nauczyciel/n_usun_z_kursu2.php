<h3>Usuwanie użytkownika z kursu, krok <b>2/3</b>
<a class="btn btn-default" href="?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_usun_z_kursu1" role="button">Wstecz</a><hr></h3>
<?php // zabezpieczenie przed niepowołanym dostępem
    if (!admin() && !nauczyciel()) return;
    // sprawdzamy, czy w GET są przekazywane odpowiednie zmienne
    if(!isset($_GET['id_kursu'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }
?>

<!--- Tabelka z informacją o wybranym kursie ---------------------- -->
<?php
dany_kurs($_GET['id_kursu']);


    // wyświetlenie informacji o powodzeniu lub porażce
    if (isset($_GET['sukces']))
    {
        $sukces = $_GET['sukces'];
        if($sukces=="tak")
        {
            // udało się dodać użytkownika
            echo '<div class="alert alert-success" role="alert">Użytkownik został usunięty z kursu</div>';
        }
        else if($sukces=="nie")
        {
            // anulowano dodawanie
            echo '<div class="alert alert-info" role="alert">Anulowano operację usuniecia użytkownika z kursu</div>';
        }
        else if($sukces=="nie_masz_prawa")
        {
            // użytkownik był już dodany do kursu
            echo '<div class="alert alert-danger" role="alert">Nie masz prawa wykonać tej operacji!</div>';
        }
    }
?>

<!--- Tabela z listą użytkowników ---------------------- -->
<h3><small>Lista użytkowników w tym kursie</small></h3>
 <table class="table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Login</th>
      <th>Imie</th>
      <th>Nazwisko</th>
      <th>E-mail</th>
      <th>Typ</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
<?php
// wyświetlenie tabeli z uzytkowniami
$wynik = mysql_query("SELECT * FROM zapisy INNER JOIN uzytkownicy ON zapisy.id_uzytkownika = uzytkownicy.id WHERE id_kursu={$_GET['id_kursu']}") or die("blee");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // uwstawiamy potrzebne zmienne
        $id = $r['id'];
        // tworzymy link
        $link = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_usun_z_kursu3"
                . "&id_kursu={$_GET['id_kursu']}"
                . "&id_usera={$id}";
        
        // wyświetlamy dany wiersz w tabeli          
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td><p class="btn btn-primary btn-sm">u</p></td>';
        echo '<td><a class="btn btn-default" href="'.$link.'" role="button">Usuń z kursu</a></td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>