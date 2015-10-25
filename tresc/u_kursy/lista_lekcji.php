<div class="col-md-2"></div>
<div class="col-md-8">
<?php
// plik wyświetla listę lekcji w danym kursie.
// Po kliknięciu na daną lekcję można przejść do niej

    // sprawdzamy, czy istenieje $_GET[id]
    // zmienna ta przechowuje id kursu, który ma być wyświetlony
    // jeśli tej zmiennej nie ma to możemy od razu darować sobie wszystko i nic nie wyświetlać
    if (!isset($_GET['id']))
    {
        echo "Nie podano zmiennej ID";
        return;
    }
    
    // następnie tworzymy kilka zmiennych globalnych i przypisujemy do nich domyślne wartości
    // niektóre wartości zmiennych będą zmieniane podczas trwania skryptu
    $id = $_GET['id'];
    $nazwa_kursu = "Brak nazwy kursu";
    
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
    
    // jeśli skrypt doszedł tutaj, znaczy że użytkownik moze przeglądać ten kurs, bo do niego należy
    // pobranie nazwy kursu i przypisanie jej do zmiennej $nazwa_kursu
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `kursy` WHERE id_kursu={$id}");
    while ($nazwa_kursu_row = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        $nazwa_kursu = $nazwa_kursu_row['nazwa'];
    }
?>
    <h3><a href="?v=tresc/u_kursy/lista_kursow_uzytkownika"><?=$nazwa_kursu?></a></h3>
    Lista lekcji w kursie
    <hr>
    <?php
        // komunikaty z pliku dolacz_do_kursu.php
        if (isset($_GET['dodano']) && $_GET['dodano']=="tak")
        {
            echo '<div class="alert alert-success" role="alert">Zostałeś dodany do tego kursu pomyślnie</div>';
        }
        else if (isset($_GET['dodano']) && $_GET['dodano']=="nalezysz")
        {
            echo '<div class="alert alert-info" role="alert">Należysz już do tego kursu</div>';
        }
    ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nr. lekcji</th>
                <th>Temat</th>
                <th></th>
             </tr>
        </thead>
        <tbody>
<?php
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_kursu={$id}");
    $nr = 0;
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        $nr++; // licznik lekcji
        // stworzenie linku
        $link = "?v=tresc/u_kursy/dana_lekcja&id={$r['id_lekcji']}&id_kursu={$id}";
        // tabela z listą lekcji
        echo '<tr>';
        echo '<td>'.$nr.'</td>';
        echo '<td><a href="'.$link.'">'.$r['temat'].'</a></td>';
        echo '<td><a class="btn btn-default btn-sm" href="'.$link.'" role="button">Przejdź do lekcji</a></td>';
        echo '</tr>'; 
    }  
?>
        </tbody>
    </table>
</div>
<div class="col-md-2"></div>