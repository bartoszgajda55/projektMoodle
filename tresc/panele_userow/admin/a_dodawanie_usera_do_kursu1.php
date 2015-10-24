<h3>Dodawanie użytkownika do kursu, krok <b>1/3</b><hr>
    <small>Wybierz użytkownika</small></h3>
<?php // sprawdzamy uprawnienia do przeglądania pliku
    if (!admin()) return;
?>
<?php
    // wyświetlenie informacji o powodzeniu lub porażce
    if (isset($_GET['sukces']))
    {
        $sukces = $_GET['sukces'];
        if($sukces=="tak")
        {
            // udało się dodać użytkownika
            echo '<div class="alert alert-success" role="alert">Użytkownik został pomyślnie dodany do kursu</div>';
        }
        else if($sukces=="nie")
        {
            // anulowano dodawanie
            echo '<div class="alert alert-danger" role="alert">Anulowano operację dodania użytkownika</div>';
        }
        else if($sukces=="byl_dodany")
        {
            // użytkownik był już dodany do kursu
            echo '<div class="alert alert-info" role="alert">Użytkownik już należy do kursu</div>';
        }
    }

?>
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
$wynik = mysql_query("SELECT * FROM uzytkownicy WHERE typ = 'u'");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // uwstawiamy potrzebne zmienne
        $id = $r['id'];
        // tworzymy link
        $link = "?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_dodawanie_usera_do_kursu2&id_usera={$id}";
        
        // wyświetlamy dany wiersz w tabeli          
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td><p class="btn btn-primary btn-sm">u</p></td>';
        echo '<td><a class="btn btn-default" href="'.$link.'" role="button">Wybierz</a></td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>