<?php
// zawiera funkcje wyświetlające małe widgety
// kazda funkcja z tego pliku zaczyna się od prefixu w_ (w jak widget)

// funkcja wyświetla małą tabelkę z ostatnimi kursami, do ktorych nalezy użytkownik
// $id_usera pobiera numer użytkownika
// $ilosc - pobiera ilość rekordów do wyświetlenia
function w_lista_kursow($id_usera, $ilosc = 3)
{
    // wyświetlenie nagłówka
    echo '<div class="thumbnail">'
          .'<div class="caption">'
          .'<h4>Ostatnie kursy</h4><br>'
          .'<table class="table">'
          .'<tbody>';

    // wyświetlenie małej tabelki z ostatnimi kursami
    // zpaytanie, które wyświetla kursy (wraz z nazwami) do których jest zapisany uzytkownik podany przez id
    $wynik = mysql_query("SELECT * FROM `zapisy` INNER JOIN kursy ON zapisy.id_kursu = kursy.id_kursu WHERE zapisy.id_uzytkownika={$id_usera} AND stan='dobry' ORDER BY id_zapisu DESC LIMIT {$ilosc}");
        while($r = mysql_fetch_assoc($wynik)) 
        {
            // zapytanie i pętla
            // zamiast numeru ID wyświetla pełnoprawne imię i nazwisko założyciela kursu
            $nazwa_nauczyciela =  mysql_query("SELECT * FROM `kursy` INNER JOIN uzytkownicy ON kursy.id_zalozyciela = uzytkownicy.id WHERE uzytkownicy.id={$r['id_zalozyciela']}");
            $imie_i_nazwisko_nauczyciela="brak";
            while($g = mysql_fetch_assoc($nazwa_nauczyciela)) 
            {   // przypisujemy imię i nazwisko danego założyciela (nauczyciela) kursu
                $imie_i_nazwisko_nauczyciela = $g['imie']." ".$g['nazwisko'];
            }
            // tworzenie linku do danego kursu
            $link = "?v=tresc/u_kursy/lista_lekcji&id={$r['id_kursu']}";
            // tabela wyświetlająca kurs i nazwę bauczyciela
            echo '<tr>';
            echo '<td><a href="'.$link.'">'.$r['nazwa'].'</a><br><small>'.$imie_i_nazwisko_nauczyciela.'</small></td>';
            echo '</tr>'; 
        }
    // jeżeli to nauczyciel lub admin, nie wyświetlamy ich kursów, tylko komunikat
    if (nauczyciel() || admin())
    {
        komunikat("Aby zobaczyć kursy, przejdź do zarządzania");
    }
    // zakończenie tabeli i ramki
    echo '</tbody>'
          .'</table>'
          .'</div>'
          .'</div>';
}

// wyświetla widget z informacjami o użytkownku
// w argumencie pobiera id użytkownika, dla ktorego ma wyświetlić informację
function w_dane_usera($id_usera)
{
     echo '<div class="thumbnail">'
          .'<div class="caption">'
          .'<h4>Informacje o uzytkowniku</h4><hr>';
    ?>
        <p>Jesteś zalogowany jako: <b><?=$_SESSION['imie']?> <?=$_SESSION['nazwisko']?></b></p>
        <p>Login: <b><?=$_SESSION['login']?></b></p>
        <p>Mail: <b></b></p>
        <p>Ranga: <b><?=$_SESSION['typ']?></b></p>
   <?php
    echo '</div>'
          .'</div>';
}

// widget wyświetlający listę dwóch ostatnich lekcji z ostatnich $ilosc kursów
function w_osatnie_lekcje($id_usera, $ilosc = 3)
{
    // wyświetlenie nagłówka
    echo '<div class="thumbnail">'
          .'<div class="caption">'
          .'<h4>Ostatnio dodane lekcje</h4><br>'
          .'<table class="table">'
          .'<tbody>';

    // wyświetlenie małej tabelki z ostatnimi (ostatnio dodanymi) lekcjami dla danego użytkownika
    // pierwsza pętla podaje tylko te kursy, do których jest zapisany użytkownik.
    $wynik = mysql_query("SELECT * FROM `zapisy` WHERE id_uzytkownika={$id_usera} ORDER BY id_zapisu DESC LIMIT {$ilosc}");
        while($r = mysql_fetch_assoc($wynik)) 
        {
            // druga pętla wyświetla po dwie ostatnie lekcje z każdego kursu
            $nazwa_lekcji =  mysql_query("SELECT * FROM `lekcje` WHERE id_kursu={$r['id_kursu']} ORDER BY id_lekcji DESC LIMIT 2");
            while($g = mysql_fetch_assoc($nazwa_lekcji)) 
            {   
                // trzecia pętla sprawdza, jak nazywa się dany kurs
                $nazwa_kursu =  mysql_query("SELECT * FROM `kursy` WHERE id_kursu={$r['id_kursu']}");
                while($gg = mysql_fetch_assoc($nazwa_kursu)) 
                {
                    $kursik = $gg['nazwa'];
                }
                
                $link = "?v=tresc/u_kursy/dana_lekcja&id={$g['id_lekcji']}&id_kursu={$g['id_kursu']}";
                echo '<tr>';
                // wyświetlenie wiersza w tabelce z linkiem do lekcji
                echo "<td><a href='{$link}'>{$g['temat']}</a> <br><small><b>{$kursik}</b>, <i>{$r['data_zapisu']}</i></small><td>";
                echo '</tr>'; 
            }
        }
    // jeżeli to nauczyciel lub admin, nie wyświetlamy ich kursów, tylko komunikat
    if (nauczyciel() || admin())
    {
        komunikat("Aby zobaczyć lekcje, przejdź do zarządzania");
    }
    // zakończenie tabeli i ramki
    echo '</tbody>'
          .'</table>'
          .'</div>'
          .'</div>';
}
?>