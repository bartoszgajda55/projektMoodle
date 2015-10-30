<!-- Skrypt wyświetla listę kursów danego nauczyciela lub wszystkich, jeśli to admin
-->
<h3>Lista kursów</h3><hr>
<?php //sprawdzamy, czy jest to poprawny uzytkownik. Wejść tutaj może tylko nauczyciel lub admin
    if (!nauczyciel() && !admin()) 
    {
        echo "Dostęp tylko dla nauczyciela lub admina";
        return;
    }
    
    // wyświetlenie komunikatu z pliku n_stworz_kurs
    if (isset($_GET['dodano']) && $_GET['dodano']=="tak")
    {
        komunikat("Nowy kurs został dodany poprawnie","success");
    }
    // wyświetlenie komunikatu z pliku n_edycja_kursu
    if (isset($_GET['edytowano']) && $_GET['edytowano']=="tak")
    {
        komunikat("Dane kursu zostały zmienione poprawnie","info");
    }
    // wyświetlenie komunikatu z pliku n_stworz_lekcje
    if (isset($_GET['dodano_lekcje']) && $_GET['dodano_lekcje']=="tak")
    {
        komunikat("Dodano lekcję poprawnie","success");
    }
?>
 <table class="table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Nazwa</th>
      <th>Klucz dostępu</th>
      <?php // jeśli to admin, to wyświetlamy dodatkowo jedną kolumnę z imieniem i nazwiskiem nauczyciela
      if(admin()) echo("<th>Nauczyciel</th>"); ?>
      <th>Edycja</th>
    </tr>
  </thead>
    <tbody>
<?php
// wyświetlenie tabeli z kursami
// jeżeli jesteśmy adminem, to dostajemy pełną listę kursów
    if(admin())
    {   
        $wynik = mysql_query("SELECT * FROM kursy INNER JOIN uzytkownicy WHERE uzytkownicy.id=kursy.id_zalozyciela AND stan='dobry' ORDER BY id_kursu");
    }
    else if (nauczyciel())
    {   // jeśli jesteśmy nauczycielem, mamy dostęp tylko do swoich kursów
        $wynik = mysql_query("SELECT * FROM kursy WHERE id_zalozyciela={$_SESSION['id_usera']} AND stan='dobry'");
    }

    while($r = mysql_fetch_assoc($wynik)) 
    {  
        //stworzenie zmiennych do linków
        // link do edycji kursu
        $edycja_kursu = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_edycja_kursu"
                . "&id_kursu={$r['id_kursu']}";
        // link do wyświetlenia listy lekcji
        $lekcje = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/nauczyciel/n_lista_lekcji_w_kursie"
                . "&id_kursu={$r['id_kursu']}";
        
        // wyświetlamy dany wiersz w tabeli          
        echo '<tr>';
        echo '<td>'.$r['id_kursu'].'</td>';
        echo '<td><a href="'.$lekcje.'">'.$r['nazwa'].'</a></td>'; // nazwa kursu też jest linkiem do listy jego lekcji
        echo '<td>'.$r['klucz_dostepu'].'</td>';
        
        // jeśli admin to wyświetlamy dodatkową kolumnę z imieniem i nazwiskiem nauczycie;a
        if(admin()) echo '<td>'.$r['imie'].' '.$r['nazwisko'].'</td>';

        // przycisk edycji kursu        
        echo '<td><a href="'.$edycja_kursu.'" class="btn btn-default btn"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
        // przycisk dodawania lekcji do kursu
        echo '<td><a href="'.$lekcje.'" class="btn btn-default "> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Lista lekcji</a></td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>