<?php
// plik wyświetla pliki przesłane do danej lekcji
// plik dla nauczyciela lub administratora
    if (!admin() & !nauczyciel()) return;

    // sprawdzamy, czy istenieje $_GET['id_lekcji']
    if (!isset($_GET['id_lekcji']))
    {   // jeśli nie istenieje, to wyświetlamy komunikat i przycisk do menu wyboru lekcji
        komunikat("Wybierz najpierw lekcję z panelu 'Lista lekcji'","info");
        echo '<br><a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_lekcji_w_kursie" role="button">Przejdź do listy lekcji</a>';
        return;
    }
    // przypisanie kilku zmiennych lokalnych
    $id_lekcji = $_GET['id_lekcji'];
    
// plik jest podzielony na dwie cześći:
    // 1. Jeśli zadanie ma odpowiedź plikową, wyświetla tabelkę z plikami do pobrania
    // 2. Jeśli zadanie ma odpowiedź tekstową, wyświetla odpowiedzi wszystkich użytkownikow
    
    // 1 - Tabelka z plikami
    if (upload_sprawdz_typ($id_lekcji)== "p")
    {
        // naglowek tabelki
        echo '<table class="table"><thead><tr><th>Użytkownik</th><th>Nazwa pliku</th>'
               . '<th>Data dodania</th><th>Pobierz</th></tr></thead><tbody>';

        // wyświetlenie tabelki z plikami do pobrania
        $wynik = mysql_query("SELECT * FROM `odp_ucznia` INNER JOIN `uzytkownicy` ON uzytkownicy.id = odp_ucznia.id_uzytkownika WHERE id_lekcji={$id_lekcji}") or die("Blad");
        while ($r = mysql_fetch_assoc($wynik)) 
        {
            echo '<tr>';
            echo '<td>'.$r['imie'].' '.$r['nazwisko'].'</td>';
            echo '<td><a href="'.plik_uczen_link($r['id'], $id_lekcji).'">'.$r['oryginalna_nazwa'].'</a></td>'; 
            echo '<td>'.$r['data_dodania'].'</td>'; 
            echo '<td><a class="btn btn-default " href="'.plik_uczen_link($r['id'], $id_lekcji).'" role="button"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></td>';
            echo '</tr>';
        }
    }
    
    // 2 - wyświetlenie wiadomości tekstowych
    else if (upload_sprawdz_typ($id_lekcji)== "t")
    {   // naglowek tabelki
        echo '<table class="table"><thead> <tr><th>Użytkownik</th><th>Odpowiedź pisemna</th>'
               . '<th>Data dodania</th></tr></thead><tbody>';
        
        // wyświetlenie tabelki z odpowiedziami tekstowymi
        $wynik = mysql_query("SELECT * FROM `odp_ucznia` INNER JOIN `uzytkownicy` ON uzytkownicy.id = odp_ucznia.id_uzytkownika WHERE id_lekcji={$id_lekcji}") or die("Blad");
        while ($r = mysql_fetch_assoc($wynik)) 
        {
            echo '<tr>';
            echo '<td>'.$r['imie'].' '.$r['nazwisko'].'';
            echo '<td>'.$r['odpowiedz_pisemna'].'</td>'; 
            echo '<td>'.$r['data_dodania'].'</td>'; 
            echo '</tr>';
        }    
    }
?>