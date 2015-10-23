<h3>Zablokuj / Odblokuj</h3><hr>
<?php
    // tutaj może przebywać tylko admin
    if (!admin()) 
    {
        echo 'Tylko dla admina';
        return;
    }
    
    // adresy plików. Jedna zmienna a skraca tyle kodu
    $adres_pliku_powrotnego = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami';
    $adres_tego_pliku = 'index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zablokuj_odblokuj';
    $stan = "stan użytkownika";

    //pobieramy dane użytkownika, którego chcemy zablokowac/odblokowac
    $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE id='$_GET[id]'")
             or die('Nie istenieje taki użytkownik');
    // wyświetlamy informacje o tym użytkowniku w ładnym rekordzie w tabelce
    echo '<table class="table">';
    echo '<thead><tr><th>#id</th><th>Login</th><th>Imie</th><th>Nazwisko</th><th>E-mail</th></tr></thead><tbody>';
    while($r = mysql_fetch_assoc($wynik)) 
    {
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['login'].'</td>';
        echo '<td>'.$r['imie'].'</td>';
        echo '<td>'.$r['nazwisko'].'</td>';
        echo '<td>'.$r['email'].'</td>';
        echo '</tr>'; 
        
        // sprawdzamy stan naszego użytkownika - czy zablokowany czy nie
        if($r['typ']=="blocked") $stan = "blocked";
        else $stan = "noblocked";
    }
    echo '</tbody></table>';    
        
    // do zablokowania/odblokowania wymagamy potwierdzenia poprzez wciśnięcie przycisku TAK
    if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak") 
    {
        $id=$_GET['id'];
        
        // Odblokowanie usera
        if($stan=="blocked")
        {
            // uzytkownik jest zablokowany, więc trzeba go odblokować (nadać mu rangę usera)
            $zapytanie2 = mysql_query("UPDATE uzytkownicy SET typ='u' WHERE id=$id")
                      or die('Nie udało się zmienić typu użytkownika');
            // przekierowanie do strony i poinformowanie o sukcesie
            header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami&blokada=nie&id={$id}");

        }
        // zablokowanie usera
        else
        {
            // użytkownik ma normalną rangę - więc trzeba go zablokować
            $zapytanie2 = mysql_query("UPDATE uzytkownicy SET typ='blocked' WHERE id=$id")
                      or die('Nie udało się zmienić typu użytkownika');
            // przekierowanie do strony i poinformowanie o sukcesie
            header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/admin/a_zarzadzanie_uzytkownikami&blokada=tak&id={$id}");

        }
        // dla bezpieczeństwa kończymy skrypt
        return;
    }
    
    // dostosowywanie pytania i przyciksów w zależności czy blokujemy czy oblokowywujemy
    if($stan=="blocked") $przyciskk = "Odblokuj użytkownika";
    else $przyciskk = "Zablokuj użytkownika";
    if($stan=="blocked") $pytaniee = "Czy na pewno chcesz odblokować tego użyttkownika?";
    else $pytaniee = "Czy na pewno chcesz zablokować tego użytkownika?";
    
    // wyświetlamy pytanie, by potwierdzić chęć blokadyu/odblokowania
    echo '<p class="bg-warning" style="padding: 15px;">'.$pytaniee.'</p>';
    echo '<a href="'.$adres_tego_pliku.'&id='.$_GET["id"].'&potwierdz=tak" type="button" class="btn btn-success" style="margin-right: 20px; margin-left: 20px;">'.$przyciskk.'</a>';
    echo '<a href="'.$adres_pliku_powrotnego.'" type="button" class="btn btn-danger">NIE (powrót)</a> ';
?>