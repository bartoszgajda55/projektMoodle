<!-- Plik umożliwia zarządzanie użytkownikami:
    Awansowanie na nauczyciela, degradacja do ucznia
    blokowanie i odblokowywanie użytkownika
-->
<?php // sprawdzamy uprawnienia do przeglądania pliku
    if (!admin()) return;
?>
<h2>Zarządzanie użytkownikami</h2>
<hr>
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
            $awans = '<a href="'.$adres_pliku.'&prawa=tresc/panele_userow/admin/a_degraduj_na_ucznia&id='.$id.'" type="button" class="btn btn-primary">Degraduj</a>';
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
            $blokada = '<a href="'.$adres_pliku.'&prawa=tresc/panele_userow/admin/a_zablokuj_odblokuj&id='.$id.'&stan=odblokuj" type="button" class="btn btn-success">Odblokuj</a>';
        }
        else $blokada = '<a href="'.$adres_pliku.'&prawa=tresc/panele_userow/admin/a_zablokuj_odblokuj&id='.$id.'&stan=zablokuj" type="button" class="btn btn-danger">Zablokuj</a>';
        
        // podświetlamy wiersz z użytkownikiem, który właśnie został zmodyfikowany (warning to kolor żółty)
        if (isset($_GET['id']) && $_GET['id']==$id)
        {
            echo '<tr class="warning">';
        }
        else
        {
            echo '<tr>';
        }
        // wyświetlamy dany wiersz w tabeli
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

<?php
    // wyświetlamy komunikaty potwierdzające sukces wykonywanych operacji (lub ich zaniechanie)
    // dokonano awansu na nauczyciela
    if(isset($_GET['awans']) && $_GET['awans']=="tak")
    {
        echo '<div class="alert alert-success" role="alert">Awans na nauczyciela zakończony sukcesem</div>';
    }
    // zaniechano dokonania awansu 
    else if(isset($_GET['awans']) && $_GET['awans']=="nie")
    {
        echo '<div class="alert alert-info" role="alert">Nie wprowadzono zmian, nikogo nie awansowano</div>';
    }
    
    // zdegradowano nauczyciela do ucznia
    if(isset($_GET['degradacja']) && $_GET['degradacja']=="tak")
    {
        echo '<div class="alert alert-success" role="alert">Degradacja do rangi ucznia zakończona sukcesem</div>';
    }
    // zaniechanie degradacji nauczyciela na ucznia
    else if(isset($_GET['degradacja']) && $_GET['degradacja']=="nie")
    {
        echo '<div class="alert alert-info" role="alert">Nie wprowadzono zmian, nikt nie został zdegradowany do rangi ucznia</div>';
    }
    // założono blokadę na użytkownika
    if(isset($_GET['blokada']) && $_GET['blokada']=="tak")
    {
        echo '<div class="alert alert-danger" role="alert">Założono blokadę na użytkownika</div>';
    }
    // zdjęcto blokadę z użytkownika
    else if(isset($_GET['blokada']) && $_GET['blokada']=="nie")
    {
        echo '<div class="alert alert-success" role="alert">Blokada z użytkownika została pomyślnie zdjęta</div>';
    }
?>
