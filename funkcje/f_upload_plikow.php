<?php
// plik zawiera funkcje, które uploadują pliki do odpowiednich katalogów i dodają wpisy do odpowiednich tabel w bazie
 
// dla uploadu nauczyciela


// fucnkja uploaduje plik na serwer i wstawia odpowiednie dane do bazy
// $plik - wymaga zmiennej $_FILES['plik'] - jest to zmienna z plikiem z przesyłanego formularza
// $id_lekcji - id lekcji, do które ma być dodany plik. Jeśli wpiszesz 0, automatycznie wybierana jest ostatnia lekcja
// funkcja zwraca pusty cią ("") jeśli wszystko poszło dobrze. W przypadku błędów zwraca je. Można wyświetlić je za pomochę echo();
function upload_nauczyciel($plik, $id_lekcji)
{
    // ustawienie zmiennych
    $katalog_plikow = "./upload/pliki_nauczyciel/"; // katalog z plikami nauczyciela
    $blady = "";
    if (isset($plik['name'])) 
    {   // sprawdzamy, czy istnieje plik
        $plik_istnieje = "tak";
    }
    else $blady.= " Plik nie istenieje."; // plik nie istenieje, błąd
    
    // jeżeli podano id_lekcji równe 0, to wtedy wybieramy ostatnią lekcję.
    if ($id_lekcji==0)
    {   // odczytujemy ostatnią lekcję (id ostatniej lekcji)
        $ostatnia_lekcja = mysql_query("SELECT * FROM lekcje ORDER BY id_lekcji DESC LIMIT 1") or die('Błąd zapytania');
        while($r = mysql_fetch_assoc($ostatnia_lekcja)) 
        {   // przypisanie id ostatniej lekcji
            $id_lekcji = $r['id_lekcji'];
        }
    }
    
    // plik jest poprawny, zaczynamy operacje
    if ($plik_istnieje == "tak")
    { 
        // stworzenie zmiennych do pozniejszego dodania ich do bazy
        $b_plik_nauczyciela = $id_lekcji;
        $b_oryginalna_nazwa = $plik['name'];
        $b_data_dodania = date("Y-m-d");

        // kilka zmiennych ułątwiających operacje na pliku
        $plik_tmp = $plik['tmp_name'];
        $plik_nazwa = $plik['name'];
        $plik_rozmiar = $plik['size'];
        $plik_rozszerzenie = strtolower(end(explode('.',$plik['name'])));
        
        if(is_uploaded_file($plik_tmp))
        {   // jeśli plik został przesłany to kopiujemy go do katalogu tmp (tymczasowego)
            if(move_uploaded_file($plik_tmp, $katalog_plikow.'tmp/'.$plik_nazwa))
            {  
                // skopiowanie pliku  z katalogu TMP do właściwego katalogu oraz zmienienie mu nazwy
                copy ($katalog_plikow.'tmp/'.$plik_nazwa, $katalog_plikow.$id_lekcji.'.'.$plik_rozszerzenie)  or die("Błąd przy kopiowaniu");
                // zmiana praw dostępu do plików na 777
                chmod($katalog_plikow.'tmp/'.$plik_nazwa,0777); // plik z katalogu TMP
                chmod($katalog_plikow.$id_lekcji.'.'.$plik_rozszerzenie,0777); // plik z dobrego katalogu
                // skasowanie tymaczsowego pliku z katalogu tmp
                unlink($katalog_plikow.'tmp/'.$plik_nazwa);

                //dodanie info do bazy danych
                $bbb = $b_plik_nauczyciela.'.'.$plik_rozszerzenie;
                if(mysql_query("UPDATE lekcje SET plik_nauczyciela='{$bbb}', oryginalna_nazwa='{$b_oryginalna_nazwa}', data_dodania='{$b_data_dodania}' WHERE id_lekcji={$id_lekcji}")===TRUE)
                {
                    $baza = "ok"; 
                }
                else $blady.= " Nie dodano do bazy."; // przypisanie paru błędów do zmiennych                       
            }
            else $blady.= " Nie przeniesiono pliku.";
        }
        else $blady.= " Plik nie jest na serwerze.";
    }
    else $blady.= " Plik nie istenieje.";
    // zwracamy zmienną z błędami. Jeśli pusta (""), znaczy że wszystko poszło ok
    return $blady;
}


// sprawdza, czy w danej lekcji został przesłany plik
// $id_lekcji - id lekcji. Jeśli podasz 0, wybiera ostatnią lekcję
// funkcja zwraca "nie" jeśli w tej lekcji nie przesłano pliku
// jeśli w tej lekcji jest jakiś plik, zwraca ścieżkę dostępu do tego pliku
function plik_nauczyciel_link($id_lekcji)
{
    // tworzymy zapytanie do bazy danych o plik
    $zapytanie = mysql_query("SELECT * FROM lekcje WHERE id_lekcji={$id_lekcji}") or die('Błąd zapytania 1');
     if ($id_lekcji==0)
    {   // jeśli poadno 0, odczytujemy ostatnią lekcję (id ostatniej lekcji)
        $zapytanie = mysql_query("SELECT * FROM lekcje ORDER BY id_lekcji DESC LIMIT 1") or die('Błąd zapytania 2');
    }
    
    // pobranie adresu pliku
    while($r = mysql_fetch_assoc($zapytanie)) 
    {   // przypisanie id ostatniej lekcji
        $plik = $r['plik_nauczyciela'];
        // jeśli nazwa pliku to pusty ciąg to zwracamy "nie"
        if ($plik=="" || $plik=="NULL")
        {
            return "nie";
        }
    }
    // jeśli plik istenieje w tej lekcji, zwracamy ścieżkę dostępu do pliku
    $cala_sciezka = "upload/pliki_nauczyciel/".$plik;
    return $cala_sciezka;
}

// wyświetla ładną tabelkę z informacjami o pliku nauczyciela
// jeśli plik nie istenieje, nic sie nie dzieje
function plik_nauczyciel_info($id_lekcji, $kolor="success")
{
    // tworzymy odpowiednie zapytanie
    $zapytanie = mysql_query("SELECT * FROM lekcje WHERE id_lekcji={$id_lekcji}") or die('Błąd zapytania 1');
     if ($id_lekcji==0) // jeśli podano id_lekcji jako 0, wybieramy ostatnią lekcję
    {   // odczytujemy ostatnią lekcję (id ostatniej lekcji)
        $zapytanie = mysql_query("SELECT * FROM lekcje ORDER BY id_lekcji DESC LIMIT 1") or die('Błąd zapytania 2');
    }
    // jeśli nie ma pliku w tej lekcji, zakańczamy funkcję i nic nie wyświetlamy
    if (plik_nauczyciel_link($id_lekcji)=="nie") return;
    
    // w przeciwnym wypadku wyświetlamy tabelkę z możliwością pobrania pliku
    echo '<div class="alert alert-'.$kolor.'" role="alert">';
    echo '<table class="table"><thead><tr><th>Nazwa pliku od nauczyciela</th><th>Data dodania</th></tr></thead>';
    echo '<tbody>';
    while($r = mysql_fetch_assoc($zapytanie)) 
    {
        echo '<tr>';
        echo '<td><a href="'.plik_nauczyciel_link($id_lekcji).'">'.$r['oryginalna_nazwa'].'</a></td>';
        echo '<td>'.$r['data_dodania'].'</td>';
        echo '<td><a href="'.plik_nauczyciel_link($id_lekcji).'" class="btn btn-default">Pobierz plik</a></td>';
        echo '</tr>'; 
    }
    echo '</tbody></table></div>';
}

// usuwa plik nauczyciela o ile on istenieje
function plik_nauczyciel_usun($id_lekcji)
{
    // jeśli plik nie istenieje, nic nie robimy
    if (plik_nauczyciel_link($id_lekcji)=="nie") return;
    
    // jeśli jednak plik istenieje, usuwamy go funkcją unlink
    unlink(plik_nauczyciel_link($id_lekcji));
    
    // następnie usuwamy informacje o nim z bazy
    if(mysql_query("UPDATE lekcje SET plik_nauczyciela='', oryginalna_nazwa='', data_dodania='' WHERE id_lekcji={$id_lekcji}")===TRUE)
    {
        $baza = "ok";
    }
}

// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// ------------------------------------UPLOAD USERA--------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// UPLOAD USERA

// funkcja zwraca typ, jaki może być przechowywany od użytkownika
// p - plik
// q - quiz
// t - tekst (odpowiedź tekstowa)
function upload_sprawdz_typ($id_lekcji)
{
     $zapytanie = mysql_query("SELECT * FROM lekcje WHERE id_lekcji={$id_lekcji}") or die('Błąd zapytania 1');
     if ($id_lekcji==0)
    {   // jeśli poadno 0, odczytujemy ostatnią lekcję (id ostatniej lekcji)
        $zapytanie = mysql_query("SELECT * FROM lekcje ORDER BY id_lekcji DESC LIMIT 1") or die('Błąd zapytania 2');
    }
    
    $typ = "";
    // pobranie adresu pliku
    while($r = mysql_fetch_assoc($zapytanie)) 
    {   // przypisanie id ostatniej lekcji
        $typ = $r['typ_odpowiedzi'];
        // jeśli nazwa pliku to pusty ciąg to zwracamy "nie"
    }
    return $typ;
}

// zapisujemy tekst pobrany o uzytkownika
// $id_uzytkownika - id użytkownika, co wrzuca odpowiedz tekstowa
// $id_lekcji - do ktorej lekcji ma byc to dodane
// $odpowiedz - odpowiedz tekstowa uzytkownika
function upload_odp_tekst($id_uzytkownika, $id_lekcji, $odpowiedz)
{
    // jeżeli do tego zadania nie da się wysłac odpowiedzi tekstowej, funkcję przerywamy
    if (upload_sprawdz_typ($id_lekcji)!= "t") return;
    $data_dodania = date("Y-m-d");
  
    // dodanie rekordu do tabelki z odpowiedziami
    mysql_query("INSERT INTO `odp_ucznia` (`id_lekcji`, `id_uzytkownika`, `plik_ucznia`, `oryginalna_nazwa`, `data_dodania`, `wynik_testu`, `odpowiedz_pisemna`) "
    . "VALUES ('{$id_lekcji}', '{$id_uzytkownika}', '', '', '{$data_dodania}', '', '{$odpowiedz}')")
    or die("Niepoprawne zapytanie - dodanie odpowiedzi usera do lekcji");
}

// uploaduje pliki ucznia
// $id_uzytkownika - id uzytkownika
// $id_lekcji - id lekcji do ktorej ma byc uploadowany ten plik
// $plik - zmienna z plikiem $_FILES['plik']
function upload_plik_uczen($id_uzytkownika, $id_lekcji, $plik)
{
    // jeżeli do tego zadania nie da się wysyłać pliku, anulujemy wykonywanie funkcji
    if (upload_sprawdz_typ($id_lekcji)!= "p") return;
    
    // ustawienie zmiennych
    $katalog_plikow = "./upload/pliki_uczen/"; // katalog z plikami ucznia
    $blady = "";
    if (isset($plik['name'])) 
    {   // sprawdzamy, czy istnieje plik
        $plik_istnieje = "tak";
    }
    else $blady.= " Plik nie istenieje."; // plik nie istenieje, błąd
    
    // jeżeli podano id_lekcji równe 0, to wtedy wybieramy ostatnią lekcję.
    if ($id_lekcji==0)
    {   // odczytujemy ostatnią lekcję (id ostatniej lekcji)
        $ostatnia_lekcja = mysql_query("SELECT * FROM lekcje ORDER BY id_lekcji DESC LIMIT 1") or die('Błąd zapytania');
        while($r = mysql_fetch_assoc($ostatnia_lekcja)) 
        {   // przypisanie id ostatniej lekcji
            $id_lekcji = $r['id_lekcji'];
        }
    }
    
    // plik jest poprawny, zaczynamy operacje
    if ($plik_istnieje == "tak")
    { 
        // stworzenie zmiennych do pozniejszego dodania ich do bazy
        $b_plik_ucznia = $id_lekcji.'_'.$id_uzytkownika; // nazwa pliku bez rozszerzenia
        $b_oryginalna_nazwa = $plik['name'];
        $b_data_dodania = date("Y-m-d");

        // kilka zmiennych ułątwiających operacje na pliku
        $plik_tmp = $plik['tmp_name'];
        $plik_nazwa = $plik['name'];
        $plik_rozmiar = $plik['size'];
        $plik_rozszerzenie = strtolower(end(explode('.',$plik['name'])));
        
        if(is_uploaded_file($plik_tmp))
        {   // jeśli plik został przesłany to kopiujemy go do katalogu tmp (tymczasowego)
            if(move_uploaded_file($plik_tmp, $katalog_plikow.'tmp/'.$plik_nazwa))
            {  
                // skopiowanie pliku z katalogu TMP do właściwego katalogu oraz zmienienie mu nazwy
                copy ($katalog_plikow.'tmp/'.$plik_nazwa, $katalog_plikow.$b_plik_ucznia.'.'.$plik_rozszerzenie)  or die("Błąd przy kopiowaniu");
                // zmiana praw dostępu do plików na 777
                chmod($katalog_plikow.'tmp/'.$plik_nazwa,0777); // plik z katalogu TMP
                chmod($katalog_plikow.$b_plik_ucznia.'.'.$plik_rozszerzenie,0777); // plik z dobrego katalogu
                // skasowanie tymaczsowego pliku z katalogu tmp
                unlink($katalog_plikow.'tmp/'.$plik_nazwa);

                //dodanie info do bazy danych
                $bbb = $b_plik_ucznia.'.'.$plik_rozszerzenie;
                if(mysql_query("INSERT INTO `odp_ucznia` (`id_lekcji`, `id_uzytkownika`, `plik_ucznia`, `oryginalna_nazwa`, `data_dodania`, `wynik_testu`, `odpowiedz_pisemna`) "
                            . "VALUES ('{$id_lekcji}', '{$id_uzytkownika}', '{$bbb}', '$b_oryginalna_nazwa', '{$b_data_dodania}', '', '')")===TRUE)
                {
                    $baza = "ok"; 
                }
                else $blady.= " Nie dodano do bazy."; // przypisanie paru błędów do zmiennych                       
            }
            else $blady.= " Nie przeniesiono pliku.";
        }
        else $blady.= " Plik nie jest na serwerze.";
    }
    else $blady.= " Plik nie istenieje.";
    // zwracamy zmienną z błędami. Jeśli pusta (""), znaczy że wszystko poszło ok
    return $blady;
}

// sprawdza, czy został podesłany plik
// $id_lekcji - id lekcji
// $id_uzytkownika - id zuytkownika
// funkcja zwraca "nie" jeśli w tej lekcji nie przesłano pliku
// jeśli do tej lekcji uzytkownik dosłał plik, zwraca adres tego pliku
// jeśli typ lekcji się nie zgadza, zwraca "zly_typ_lekcji".
function plik_uczen_link($id_uzytkownika, $id_lekcji)
{
    // jeżeli do tego zadania nie da się wysyłać pliku, anulujemy wykonywanie funkcji
    if (upload_sprawdz_typ($id_lekcji)!= "p") return "zly_typ_lekcji";
    
    // tworzymy zapytanie do bazy danych o plik
    $zapytanie = mysql_query("SELECT * FROM odp_ucznia WHERE id_lekcji={$id_lekcji} AND id_uzytkownika={$id_uzytkownika}") or die('Błąd zapytania 1');
    
    // pobranie adresu pliku
    while($r = mysql_fetch_assoc($zapytanie)) 
    {   
        $plik = $r['plik_ucznia'];
        // jeśli nazwa pliku to pusty ciąg to zwracamy "nie"
        if ($plik=="" || $plik=="NULL")
        {
            return "nie";
        }
    }
    // jeśli plik istenieje w tej lekcji, zwracamy ścieżkę dostępu do pliku
    $cala_sciezka = "upload/pliki_uczen/".$plik;
    return $cala_sciezka;
}

// wyświetla ładną tabelkę z informacjami o pliku ucznia dla danej lekcji
// jeśli plik nie istenieje, wyswietla sie komunikat, że nei został wysłany
function plik_uczen_info($id_uzytkownika, $id_lekcji, $kolor="info")
{
    // jeżeli do tego zadania nie byl przewidziany plik, anulujemy robote
    if (upload_sprawdz_typ($id_lekcji)!= "p") return;
    
    // tworzymy odpowiednie zapytanie
    $zapytanie = mysql_query("SELECT * FROM odp_ucznia WHERE id_lekcji={$id_lekcji} AND id_uzytkownika={$id_uzytkownika}") or die('Błąd zapytania 1');

    // jeśli nie ma pliku podeslanego do tej lekcji, wyswietlamy informacje o jego braku
    if ( plik_uczen_link($id_uzytkownika, $id_lekcji)=="nie")
    {
        komunikat("Nie wysłałeś jeszcze pliku", $kolor);
        return;
    }
    
    // w przeciwnym wypadku wyświetlamy tabelkę z możliwością pobrania pliku
    echo '<div class="alert alert-'.$kolor.'" role="alert">';
    echo '<table class="table"><thead><tr><th>Nazwa twojego pliku</th><th>Data dodania</th></tr></thead>';
    echo '<tbody>';
    while($r = mysql_fetch_assoc($zapytanie)) 
    {
        echo '<tr>';
        echo '<td><a href="'.plik_uczen_link($id_uzytkownika, $id_lekcji).'">'.$r['oryginalna_nazwa'].'</a></td>';
        echo '<td>'.$r['data_dodania'].'</td>';
        echo '<td><a href="'.plik_uczen_link($id_uzytkownika, $id_lekcji).'" class="btn btn-default">Pobierz plik</a></td>';
        echo '</tr>'; 
    }
    echo '</tbody></table></div>';
}




?>