<!-- Skrypt logowania wraz z formularzem
     Skrypt sprawdza poprawność formularza i wysłanych w nim danych
     Następnie loguje, ustawiając odpowiednie wartości zmiennym $_SESSION
--->
<div class="col-md-2"></div>
<div class="col-md-8">
<?php
    // sprawdzamy, czy formularz zostal przesłany
    if (isset($_POST['email']) && $_POST['login']!="") 
    {     
        // aby uniknąć problemów, przypisujemy zmienne z formularza do zwykłych zmiennych
        $email = $_POST['email'];
        $login = $_POST['login'];
        // konwersja tekstu na "bezpieczny" dla bazy danych (by nie bylo sql injectow itp)
        $email = addslashes($email);
        $login = addslashes($login);
        $login = htmlspecialchars($login);
        //inicjujemy tablę na ewentualne błędy
        $bledy;
        
        // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
        $czy_jest_w_bazie = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login' AND email = '$email'")); 

        // jesli nie ma takiego loginu albo haslo sie nie zgadza, wyswietlamy blad
        if ($czy_jest_w_bazie[0] == 0) 
        {
            $bledy[] = 'Niepoprawny Email. // Nie ma takiego Loginu w bazie //';
        } 
        // jesli wszystko ok, to wysyłamy
        else 
        {
        echo '<div class="alert alert-success" role="alert">Wysłano kod to zresetowania hasła!</div>';
        }
    }
    // dane w formularzu są puste, trzeba dodać błędy
    // Brak wpisanego loginu
    if (isset($_POST['email']) && $_POST['email']=="") 
    {
        $bledy[] = "Nie podano Emailu";
    }
    // Brak wpisanego hasła
    if (isset($_POST['login']) && $_POST['login']=="")
    {
        $bledy[] = "Nie podano Loginu";
    }    
?>
    
    <div id="logowanie" class="row">
        <legend>Przypomnij Hasło</legend>     
        <form action="?v=tresc/przypomnij_haslo/przypomnij" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="password" class="form-control" name="login" placeholder="Login">
            </div>
            <div class="row">
            <div class="col-md-6"><button type="submit" name="submit" class="btn btn-info btn-block ">Wyślij Kod</button></div>
            <div class="col-md-6"><button type="button" name="wpisz" class="btn  btn-block" 
                                          onclick="parent.location='index.php?v=tresc/przypomnij_haslo/reset'">Już mam Kod !</button></div>
            </div>
            
        </form>		
    </div>
    <?php
    // wyświetlenie zawartości tablicy z błędami
    if (isset($bledy) &&  $bledy[0]!="")
    {
        echo '<div class="row alert alert-danger" role="alert">';
        foreach($bledy as $blad)
        {
            echo $blad."<br>";
        }
        echo '</div>';
    }
    ?>
</div>
<div class="col-md-2"></div>