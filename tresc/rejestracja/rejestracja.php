<div class="row">
        <div id="l_panel_lewy" class="col-md-6">
            <legend>Rejestracja</legend>     
        <form action="?v=tresc/rejestracja/rejestracja" id="rejestracja" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" id="login" class="form-control" name="r_login" placeholder="Login" value="">
            </div>
            <div class="form-group">
                <input type="password" id="r_haslo" class="form-control" name="r_haslo1" placeholder="Hasło" >
            </div>
            <div class="form-group">
                 <input type="password" id="r_haslo2" class="form-control" name="r_haslo2" placeholder="Powtórz hasło">
            </div>
            <div class="form-group">
                <input type="email" id="email" class="form-control" name="r_email" placeholder="Email" value="<?=@$_POST['email']?>">
            </div>
            <div class="form-group">
                <input type="text" id="imie" class="form-control" name="r_imie" placeholder="Imię" value="<?=@$_POST['imie']?>">
            </div>
            <div class="form-group">
                <input type="text" id="nazwisko" class="form-control" name="r_nazwisko" placeholder="Nazwisko" value="<?=@$_POST['nazwisko']?>" >
            </div>	
            <button type="submit" name="submit" class="btn btn-info btn-block ">Rejestracja</button>
            
        </form>		
    </div>
<?php
// Skrypt rejestracji nowego użytkownika
// Sprawdzamy, czy użytkownik rzypadkiem nie jest zalogowany i czy nie wszedł tutaj przez przypadek
if (zalogowano())
{
    echo "Jesteś już zalogowany, po co rejestrować się powtórnie?";
    return;
}
    
// zaczynamy skrypt rejestracji
// sprawdzamy czy są podane wszystkie dany i czy te dane są w miare poprawne
//inicjujemy tablicę na ewentualne błędy oraz "licznik błędów"
    $bledy;
    $licznik_bledow = 0;
// sprawdzamy, czy pola zostały wypełnione
if(!isset($_POST['r_login']) || !isset($_POST['r_haslo1']) || !isset($_POST['r_imie']) || !isset($_POST['r_nazwisko']) || !isset($_POST['r_email'])
       || $_POST['r_login']=="" || $_POST['r_haslo1']=="" || $_POST['r_imie']=="" || $_POST['r_nazwisko']=="" || $_POST['r_email']=="")
{
    $bledy[] = "Wypełnij wszystkie pola";
    $licznik_bledow++;
}
// hasła się nie zgadzają
else if (isset($_POST['haslo1']) && $_POST['haslo1']!=$_POST['haslo2']) 
{
    $bledy[] = "Hasła się nie zgadzają";
    $licznik_bledow++;
}

// jeżeli licznik_bledów jest równy 0, znaczy że wszystko jest poprawne i można wysyłać dane do bazy
if($licznik_bledow == 0) 
{
    // usuwamy znaki specjalne z pól, dla bezpieczeństwa
    $login=htmlentities($_POST['r_login']);
    $haslo=htmlentities($_POST['r_haslo1']);
    $imie=htmlentities($_POST['r_imie']);
    $nazwisko=htmlentities($_POST['r_nazwisko']);
    $email=htmlentities($_POST['r_email']);
    
    // sprawdzamy, czy przypadkiem nie istenieje użytkownik z takim loginem
    if($rezultat=mysql_query("SELECT * FROM uzytkownicy WHERE login='$login'")) 
    {
        // jeśli zapytanie nic nie zwróciło, znaczy to tyle że można dodawać nowego użytkownika
        if(mysql_num_rows($rezultat) == 0)
        {
            // wstawiamy dane do tabeli. Sprawdzamy, czy wszystko się udaje
            if(mysql_query("INSERT INTO uzytkownicy (login, haslo, imie, nazwisko, typ, email) VALUES ('$login','$haslo','$imie','$nazwisko','u','$email')")===TRUE)
            {
                $rejestracja_pomyslna = TRUE;
            }
            // może się to nie udać, wtedy wyświetlamy komunikat o błędzie
            else
            {
                $bledy[] =  "Problem z dodaniem użytkownika do bazy";
            }
        }
        // gdy w bazie znajduje się użytkownik z takim loginem
        else
        {
            $bledy[] = "W bazie istnieje już użytkownik z takim loginem";
        }
    }
// jeżeli rejestracja się powiodła należy zalogować użytkownika i wyświetlić panel z informacjami
    if (isset($rejestracja_pomyslna) && $rejestracja_pomyslna==TRUE) 
    {
        // logowanie jest bardzo uproszczone. Ustawiamy tylko odpowiednio zmienne sesyjne
        $_SESSION['zalogowany'] = TRUE;
        $_SESSION['login'] = $login;
        // dla pewności można pobrać dane z bazy
        $wynik = mysql_query("SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'");
        while($r = mysql_fetch_assoc($wynik)) 
        {
            $_SESSION['typ'] = $r['typ'];
            $_SESSION['id_usera'] = $r['id'];    
            $_SESSION['imie'] = $r['imie'];
            $_SESSION['nazwisko'] = $r['nazwisko'];
        }
        // przekierowanie użytkownika na stronę z informacjami
        header("Location: index.php?v=tresc/strona_glowna&zarejestrowano=tak");
    }
    if (isset($bledy) &&  $bledy[0]!="")
    {
        echo '<div class="alert alert-danger" role="alert">';
        foreach($bledy as $blad)
        {
            echo $blad."<br>";
        }
        echo '</div>';
    }
}
?>

<div id="l_panel_prawy" class="col-md-6">
    <h2>Rejestracja</h2>
    <br><p>Rejestracja na portalu umożliwi Ci korzystanie z wszelkich dobrodziejstw tej platformy.
        Po ukończeniu rejestracji zostaniesz automatycznie zalogowany. Bez potwierdzania emailem.
    <p>
</div>
</div>