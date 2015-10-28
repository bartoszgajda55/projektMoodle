<?php
// plik wyświetla daną lekcję (czyli temat i zawartosć). Tzw. podgląd lekcji
// plik dla nauczyciela lub administratora
    if (!admin() & !nauczyciel()) return;

    // sprawdzamy, czy istenieje $_GET['id_lekcji']
    if (!isset($_GET['id_lekcji']))
    {   // jeśli nie istenieje, to wyświetlamy komunikat i przycisk do menu wyboru lekcji
        komunikat("Wybierz najpierw lekcję z panelu 'Lista lekcji'","info");
        echo '<br><a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_lekcji_w_kursie" role="button">Przejdź do listy lekcji</a>';
        return;
    }
    // kilka zmiennych globalnych
    $id_lekcji = $_GET['id_lekcji'];

    // wyświetlenie zawartości danej lekcji
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_lekcji={$id_lekcji}");
    $nr = 0;
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        // wyświetlenie tematu
        echo "<h3><small>Temat:</small> {$r['temat']} </h3>";
        echo '<hr><br>';
        // wyświetlenie treści
        echo '<p>'.$r['tresc'].'</p>';
    }
?>