<div class="col-md-2"></div>
<div class="col-md-8">
<?php
// plik wyświetla daną lekcję (czyli temat i zawartosć)

    // sprawdzamy, czy istenieje $_GET[id]
    if (!isset($_GET['id']))
    {
        echo "Nie podano zmiennej ID";
        return;
    }
    
    // kilka zmiennych globalnych
    $id = $_GET['id'];
    
    // sprawdzenie czy użytkownik należy do kursu. Jeśli nie, nic nie wyświetlamy
    if(!zalogowano()) return;
    if (zalogowano())
    {   
        // jeśli to zapytanie da 0 wyników, znaczy to tyle że usera nie ma w tym kursie
        $wynik = mysql_query("SELECT * FROM `zapisy` WHERE id_uzytkownika={$_SESSION['id_usera']}");
        if(mysql_num_rows($wynik) <=0) 
        {
            echo "Nie należysz do tego kursu!";
            return;
        }
    }
    
    // jeśli skrypt doszedł tutaj, znaczy że użytkownik moze przeglądać tą lekcję, bo należy do kursu z tą lekcją
?>
    
<?php
    // wyświetlenie zawartości danej lekcji
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_lekcji={$id}");
    $nr = 0;
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        // wyświetlenie tematu
        echo "<h3><small>Temat:</small> {$r['temat']} </h3>";
        echo '<hr><br>';
        // wyświetlenie treści
        echo '<p>'.$r['tresc'].'</p>';
        
        // link powrotny. Dodatkowo mamy wartość id_kursu. Id_kursu przechowuje id kursu do którego należy dana lekcja
        // aby móc poprawnie wrócić, musimy ja przechowywać a potem zwrócić w linku
        $link = "?v=tresc/u_kursy/lista_lekcji&id={$_GET['id_kursu']}";
        echo '<br><hr><a class="btn btn-default" href="'.$link.'" role="button">Powrót do listy tematów</a></td>';
    }  
?>
</div>
<div class="col-md-2"></div>