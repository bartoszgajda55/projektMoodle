<!-- Skrypt logowania wraz z formularzem
     Skrypt sprawdza poprawność formularza i wysłanych w nim danych
     Następnie loguje, ustawiając odpowiednie wartości zmiennym $_SESSION
--->
<div class="col-md-6">
<?php
    // sprawdzamy, czy formularz zostal przesłany
    if (isset($_POST['login']) && $_POST['login']!="") 
    {     
        // aby uniknąć problemów, przypisujemy zmienne z formularza do zwykłych zmiennych
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        // konwersja tekstu na "bezpieczny" dla bazy danych (by nie bylo sql injectow itp)
        $haslo = addslashes($haslo);
        $login = addslashes($login);
        $login = htmlspecialchars($login);
        //inicjujemy tablę na ewentualne błędy
        $bledy;
        
        // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
        $czy_zaloguje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'")); 

        // jesli nie ma takiego loginu albo haslo sie nie zgadza, wyswietlamy blad
        if ($czy_zaloguje[0] == 0) 
        {
            $bledy[] = 'Niepoprawne dane logownia !';
        } 
        // jesli wszystko ok, to logujemy
        else 
        {
            // po zalogowaniu przypisanie waznych danych do sesji
            $_SESSION['zalogowany'] = TRUE;
            $_SESSION['login'] = $login;
            
            // odczytujemy najwazniejsze dane z bazy i przypisujemy do zmiennych sesyjnych
            $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'");
            while($r = mysql_fetch_assoc($wynik)) 
            {
                $_SESSION['typ'] = $r['typ'];
                $_SESSION['id_usera'] = $r['id'];    
                $_SESSION['imie'] = $r['imie'];
                $_SESSION['nazwisko'] = $r['nazwisko'];
            }   
            
            // jesli user jest zablokowany, nie pozwolamy logowac
            if ($_SESSION['typ']=="blocked") 
            {
                echo "Jestes zablokowany";
                //usuwamy sesje
                $_SESSION = array();
                if (isset($_COOKIE[session_name()]))
                    setcookie(session_name(), '', time()-42000, '/');
                    session_destroy();
                    //zakończenie skryptu
                    return;
            }
            // przenosimy usera na strone z informacjami o zalogowaniu
            header("Location: index.php?v=tresc/strona_glowna&zalogowano=tak");
        }
    }
    // dane w formularzu są puste, trzeba dodać błędy
    // Brak wpisanego loginu
    if (isset($_POST['login']) && $_POST['login']=="") 
    {
        $bledy[] = "Nie podano loginu";
    }
    // Brak wpisanego hasła
    if (isset($_POST['haslo']) && $_POST['haslo']=="")
    {
        $bledy[] = "Nie podano hasła";
    }
    // Jeśli zalogowany użytkownik tutaj niechcący wejdzie, nie pozwalamy mu na powtórne logowanie
    if (zalogowany()) 
    { 
        echo "Jesteś już zalogowany"; 
        // zakończenie skryptu
        return;  
    }

    // wyświetlenie zawartości tablicy z błędami
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
    
    <div id="logowanie" class="row">
        <legend>Logowanie</legend>     
        <form action="?v=tresc/logowanie/logowanie" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="email" class="form-control" name="login" placeholder="Login">
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" name="haslo" placeholder="Hasło">
            </div>
            <div class="col-md-6"><button type="submit" name="submit" class="btn btn-info btn-block ">Zaloguj</button></div>
            <div class="col-md-6"><button type="button" name="przypomnij" class="btn  btn-block" 
                                          onclick="parent.location='index.php?v=tresc/przypomnij_haslo/przypomnij'">Przypomnij haslo</button></div>
        </form>		
    </div>
</div>
<div class="col-md-6">
    <h2>Witaj na Moodle!</h2>
    <p>Trafiłeś na stronę główną Moodle Project!
        Możesz zalogować się aby rozpocząć naukę, lub zacząć od rejestracji jeśli jesteś tutaj pierwszy raz. Miłej nauki !
    <p>Dwa przyciski na górze pozwolą Ci rozpocząć przygodę z naszym serwisem.
</div>