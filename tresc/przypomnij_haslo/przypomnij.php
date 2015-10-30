<!-- Skrypt logowania wraz z formularzem
     Skrypt sprawdza poprawność formularza i wysłanych w nim danych
     Następnie loguje, ustawiając odpowiednie wartości zmiennym $_SESSION
--->
<?php
    // sprawdzamy, czy formularz zostal przesłany
    if (isset($_POST['p_email']) && $_POST['p_login']!="") 
    {     
        // aby uniknąć problemów, przypisujemy zmienne z formularza do zwykłych zmiennych
        $email = $_POST['p_email'];
        $login = $_POST['p_login'];
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
            echo '<div class="alert alert-danger" role="alert">Podany Login i Email nie znajdują się w bazie</div>';
        } 
        // jesli wszystko ok, to wysyłamy
        else 
        {
        echo '<div class="alert alert-success" role="alert">Wysłano kod to zresetowania hasła!</div>';
        }
    }   
?>
<div class="row">
    <div id="l_panel_lewy" class="col-md-6">
        <legend>Podaj Dane</legend>     
        <form action="?v=tresc/przypomnij_haslo/przypomnij" id="przypomnij" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="email" class="form-control" name="p_email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="password" class="form-control" name="p_login" placeholder="Login">
            </div>
            <div id="l_button_lewy"><button type="submit" name="submit" class="btn btn-info btn-block ">Wyślij Kod</button></div>
            <div id="l_button_prawy"><button type="button" name="wpisz" class="btn  btn-block" 
                                          onclick="parent.location='index.php?v=tresc/przypomnij_haslo/reset'">Już mam Kod !</button></div>      
        </form>		
    </div>
    <div id="l_panel_prawy" class="col-md-6">
        <h2>Resetowanie Hasła</h2><br>
        <p>Aby zresetować swoje hasło musisz podaj najpierw dane które ułatwią nam identyfikację Ciebie w bazie danych.
            Potem, na Twój adres email zostanie wysłany kod, który umożliwi Ci ustawienie nowego hasła.
        <p>Jeśli już otrzymałeś swój kod, przejdź dalej przyciskiem "Już mam kod".
    </div>
</div>