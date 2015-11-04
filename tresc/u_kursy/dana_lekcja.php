<div id="z_lista_lekcji_lewa" class="col-md-9">
    <div class="thumbnail">
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

    
    // wyświetlenie zawartości danej lekcji
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_lekcji={$id}");
    $nr = 0;
    // zmienne ułatwiające operowanie na kodzie
    $id_lekcji = $id;
    $id_uzytkownika = $_SESSION['id_usera'];
    
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        // wyświetlenie tematu
        echo "<h3><small>Temat:</small> {$r['temat']} </h3>";
        echo '<hr><br>';
        // wyświetlenie treści
        echo '<p>'.$r['tresc'].'</p>';
        
        echo '<br><br>';
        // dane z plikiem
        plik_nauczyciel_info($id);
        echo '<br><br>';
   
// sprawdzenie, czy przypadkiem uzytkownik nie musi przypadkiem czegoś przesłać na lekcję        
        // dla tej lekcji wymagane jest wysłanie pliku
        if (upload_sprawdz_typ($_GET['id'])== "p")
        {
            // sprawdzenie czy wysyłamy plik
            if (isset($_FILES['plik']['name']) && $_FILES['plik']['name']!="")
            {   // upload pliku               
                $errory_uploadu = upload_plik_uczen($_SESSION['id_usera'], $id, $_FILES['plik']);
            }
            
            // sprawdzenie czy chcemy usunąć plik
            if (isset($_GET['usun']) && $_GET['usun']=="tak")
            {   // usuwanie pliku
                 plik_uczen_usun($_SESSION['id_usera'], $id);
                 komunikat("Plik został usunięty", "success");
            }
            
            // jeśli jeszcze nie przesłano pliku, wyświetlamy formularz
            if (plik_uczen_link($_SESSION['id_usera'], $id)=="nie" || plik_uczen_link($_SESSION['id_usera'], $id)=="")
            {
            ?>
                <form action="index.php?v=tresc/u_kursy/dana_lekcja&wyslano=tak&id=<?=$_GET['id']?>&id_kursu=<?=$_GET['id_kursu']?>" method="post" ENCTYPE="multipart/form-data" accept-charset="utf-8" >
                <div class="form-group">
                <label>Wyślij plik do oceny</label>
                <input type="file" name="plik"/>
                </div>
                <button type="submit" class="btn btn-default">Wyslij</button>
                </form>
            <?php
            }
            // jeśli już plik wysłano jest możliwość jego usunięcia i tabelka z plikiem
            else if (plik_uczen_link($_SESSION['id_usera'], $id)!="nie")
            {   // wyswietla ładną tabelkę
                plik_uczen_info($_SESSION['id_usera'], $id);
                // wyświetla przycisk, który umożliwia usunięcie pliku
                echo "<a href='index.php?v=tresc/u_kursy/dana_lekcja&usun=tak&id={$_GET['id']}&id_kursu={$_GET['id_kursu']}'>Usuń plik</a>";
            }
        }
    
      // dla lekcji jest wymagane podanie odpowiedzi tekstowej
        else if (upload_sprawdz_typ($_GET['id'])== "t")
        {
             // sprawdzenie czy chcemy usunąć odpowiedz
            if (isset($_GET['usun']) && $_GET['usun']=="tak")
            {   // usuwanie odpowiedzi
                 odp_uczen_usun($_SESSION['id_usera'], $id); 
                 komunikat("Odpowiedź usunięto", "success");
            }
            
            // sprawdzenie czy wysyłamy odpowiedź
            if (isset($_POST['tresc']) && $_POST['tresc']!="")
            {   // dodanie odpowiedzi              
                upload_odp_tekst($_SESSION['id_usera'], $id, $_POST['tresc']);
                komunikat("Odpowiedź dodano", "success");
            }
            else if (isset($_POST['tresc']) && $_POST['tresc']=="")
            {
                komunikat("Wypełnij polę odpowiedzi", "danger");
            }
            
            // jeśli odpowiedź nie istenieje, to wyświetlamy formularz do dodania tejże
            if (uczen_odpowiedz_wyswietl($_SESSION['id_usera'], $id)==FALSE) 
            {
                ?>
                <form action="index.php?v=tresc/u_kursy/dana_lekcja&wyslano=tak&id=<?=$_GET['id']?>&id_kursu=<?=$_GET['id_kursu']?>" method="post" ENCTYPE="multipart/form-data" accept-charset="utf-8" > 
                <div class="form-group">
                <label>Twoja odpowiedź na zadanie</label>
                <textarea class="form-control" rows="5" name="tresc"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Dodaj odpowiedź</button>
                </form>
        
                <?php
            }
            // jeśli odpowiedź została przesłana, wyświetlamy ją
            else 
            {
                $odp = uczen_odpowiedz_wyswietl($_SESSION['id_usera'], $id);
                echo "<h5>Twoja odpowiedź na to zadanie</h5>";
                echo '<hr>';
                echo $odp;
                echo "<br><a class='btn btn-default' href='index.php?v=tresc/u_kursy/dana_lekcja&usun=tak&id={$_GET['id']}&id_kursu={$_GET['id_kursu']}'>Usuń odpowiedź</a>";
                echo'<hr>';
            }
        }
    
        // link powrotny. Dodatkowo mamy wartość id_kursu. Id_kursu przechowuje id kursu do którego należy dana lekcja
        // aby móc poprawnie wrócić, musimy ja przechowywać a potem zwrócić w linku
        $link = "?v=tresc/u_kursy/lista_lekcji&id={$_GET['id_kursu']}";
        echo '<br><hr><a class="btn btn-default" href="'.$link.'" role="button">Powrót do listy tematów</a></td>';
    }  
?>
</div>
</div>
<div id="z_lista_lekcji_prawa" class="col-md-3">
    <div class="thumbnail">
    <p>Jakaś tam lista
    <p>Albo inny kontent
    </div>
</div>