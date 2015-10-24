<!-- Skrypt logowania wraz z formularzem
     Skrypt sprawdza poprawność formularza i wysłanych w nim danych
     Następnie loguje, ustawiając odpowiednie wartości zmiennym $_SESSION
--->
<div class="col-md-2"></div>
<div class="col-md-8">
<?php
    // sprawdzamy, czy formularz zostal przesłany
    if (isset($_POST['email']) && $_POST['login']!="" && $_POST['kod']!="" && $_POST['haslo']!="" && $_POST['nowe_haslo']!="") 
    {     
        // aby uniknąć problemów, przypisujemy zmienne z formularza do zwykłych zmiennych
        $email = $_POST['email'];
        $login = $_POST['login'];
        $kod = $_POST['kod'];
        $haslo = $_POST['haslo'];
        $nowe_haslo = $_POST['nowe_haslo'];
        // konwersja tekstu na "bezpieczny" dla bazy danych (by nie bylo sql injectow itp)
        $email = addslashes($email);
        $login = addslashes($login);
        $kod = addslashes($kod);
        $haslo = addslashes($haslo);
        $nowe_haslo = addslashes($nowe_haslo);
        //inicjujemy tablę na ewentualne błędy
        $bledy;
        
        // sprawdzenie czy istnieje uzytkownik o takim emailu i loginie
        $czy_jest_w_bazie = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login' AND email = '$email'"));
        //Sprawdzamy czy kod jest poprawny 
        $czy_kod_poprawny = mysql_fetch_array(mysql_query("SELECT reset_hasla FROM uzytkownicy WHERE login = '$login' AND email = '$email'"));
        
        // jesli nie ma takiego loginu, kod jest niepoprawny albo haslo sie nie zgadza, wyswietlamy blędy
        if ($czy_jest_w_bazie[0] == 0) 
        {
            $bledy[] = 'Niepoprawny Email. // Nie ma takiego Loginu w bazie //';
        }
        else if ($czy_kod_poprawny[0] != $kod) 
        {
            $bledy[] = 'Kod niepoprawny !';
        }
        else if ($haslo != $nowe_haslo)
        {
            $bledy[] = 'Hasła się nie zgadzają !';
        }
        // jesli wszystko ok, to resetujemy
        else 
        {
            $zmiana_hasla = mysql_query("UPDATE uzytkownicy SET haslo = '$haslo' WHERE uzytkownicy.login = '$login'");
            echo '<div class="alert alert-success" role="alert">Hasło ustawione!</div>';
        }
    }
    // dane w formularzu są puste, trzeba dodać błędy
    // Brak wpisanego emaila
    if (isset($_POST['email']) && $_POST['email']=="") 
    {
        $bledy[] = "Nie podano Emailu";
    }
    // Brak wpisanego loginu
    if (isset($_POST['login']) && $_POST['login']=="")
    {
        $bledy[] = "Nie podano Loginu";
    }
    //Brak kodu
    if (isset($_POST['kod']) && $_POST['kod']=="") 
    {
        $bledy[] = "Nie podano Kodu";
    }
    //Brak wpisanego hasł
    if (isset($_POST['haslo']) && $_POST['haslo']=="") 
    {
        $bledy[] = "Nie podano Hasła";
    }
    //Brak powtórzonego hasła
    if (isset($_POST['nowe_haslo']) && $_POST['nowe_haslo']=="") 
    {
        $bledy[] = "Nie powtórzono Hasła";
    }
    // wyświetlenie zawartości tablicy z błędami    
?>
    
    <div id="logowanie" class="row">
        <legend>Przypomnij Hasło</legend>     
        <form action="?v=tresc/przypomnij_haslo/reset" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="login" class="form-control" name="login" placeholder="Login">
            </div>
            <div class="form-group">
                <input type="text" id="kod" class="form-control" name="kod" placeholder="Kod">
            </div>
            <div class="form-group">
                <input type="text" id="haslo" class="form-control" name="haslo" placeholder="Nowe hasło">
            </div>
            <div class="form-group">
                <input type="text" id="nowe_haslo" class="form-control" name="nowe_haslo" placeholder="Powtórz nowe hasło">
            </div>
            <div class="row">
            <div class="col-md-6"><button type="submit" name="submit" class="btn btn-info btn-block ">Wyślij</button></div>
            </div>
        </form>		
    </div>
    <?php
    if (isset($bledy) &&  $bledy[0]!="")
    {
        echo '<div class="alert alert-danger" role="alert">';
        foreach($bledy as $blad)
        {
            echo $blad."<br>";
        }
        echo '</div>';
    }
    ?>
</div>
<div class="col-md-2"></div>