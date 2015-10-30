<!-- Skrypt logowania wraz z formularzem
     Skrypt sprawdza poprawność formularza i wysłanych w nim danych
     Następnie loguje, ustawiając odpowiednie wartości zmiennym $_SESSION
--->
<div class="row">  
    <div id="l_panel_lewy" class="col-md-6">
        <legend>Ustaw Nowe Hasło</legend>     
        <form action="?v=tresc/przypomnij_haslo/reset" method="post" id="reset" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="s_email" class="form-control" name="s_email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="s_login" class="form-control" name="s_login" placeholder="Login">
            </div>
            <div class="form-group">
                <input type="text" id="s_kod" class="form-control" name="s_kod" placeholder="Kod">
            </div>
            <div class="form-group">
                <input type="password" id="s_haslo" class="form-control" name="s_haslo" id="s_haslo" placeholder="Nowe hasło">
            </div>
            <div class="form-group">
                <input type="password" id="s_nowe_haslo" class="form-control" name="s_nowe_haslo" placeholder="Powtórz nowe hasło">
            </div>
            <div class=""><button type="submit" name="submit" class="btn btn-info btn-block ">Ustaw Nowe Hasło</button></div>
        </form>
        <?php
    // sprawdzamy, czy formularz zostal przesłany
    if (isset($_POST['s_email']) && $_POST['s_login']!="" && $_POST['s_kod']!="" && $_POST['s_haslo']!="" && $_POST['s_nowe_haslo']!="") 
    {     
        // aby uniknąć problemów, przypisujemy zmienne z formularza do zwykłych zmiennych
        $email = $_POST['s_email'];
        $login = $_POST['s_login'];
        $kod = $_POST['s_kod'];
        $haslo = $_POST['s_haslo'];
        $nowe_haslo = $_POST['s_nowe_haslo'];
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
            echo '<div class="alert alert-danger" role="alert">Podany Login i Email nie znajdują się w bazie</div>';
        }
        else if ($czy_kod_poprawny[0] != $kod) 
        {
            echo '<hr><div class="alert alert-danger" role="alert">Podany Kod jest niepoprawny !</div>';
        }
        else 
        {
            $zmiana_hasla = mysql_query("UPDATE uzytkownicy SET haslo = '$haslo' WHERE uzytkownicy.login = '$login'");
            echo '<div class="alert alert-success" role="alert">Hasło ustawione!</div>';
        }
    }  
?>
    </div>
<div id="l_panel_prawy" class="col-md-6">
    <h2>Ustawianie Hasła</h2>
    <p>Jeśli dotarłeś na tą stronę, to znaczy że otrzymałeś już swój unikalny kod.
        Wpisz go koniecznie, bez niego proces zmiany hasła nie powiedzie sie.
    <p>Uważnie wpisz swoje nowe hasło. I koniecznie zapamiętaj, każdy nowy kod kosztuje 2,46 zł + VAT.<br>
    <center><img src="img/zyd.jpg" height='300'></center>
</div>
</div>