    <div class="">
        <form id="zmiana_panel" action="?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/uczen/u_zmiana_hasla" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="password" id="k_stare_haslo" class="form-control" name="k_stare_haslo" placeholder="Obecne Hasło">
            </div>
            <div class="form-group">
                <input type="password" id="k_haslo1" class="form-control" name="k_haslo1" placeholder="Nowe Hasło">
            </div>
            <div class="form-group">
                <input type="password" id="k_haslo2" class="form-control" name="k_haslo2" placeholder="Powtórz Nowe Hasło">
            </div>
            <div class=""><button type="submit" name="submit" class="btn btn-block ">Zmień hasło</button></div>
        </form>		
    </div>
<?php

    $stare_haslo=@$_POST['k_stare_haslo'];
    $haslo1=@$_POST['k_haslo1'];
    $haslo2=@$_POST['k_haslo2'];
    $login = $_SESSION['login'];
    $faktyczne_haslo = mysql_fetch_array(mysql_query("SELECT haslo FROM uzytkownicy WHERE login = '$login'"));

if($stare_haslo != "" || $haslo1 != "" || $haslo2 != "")
{    
    // sprawdzamy, czy podane stare hasło, pokrywa się z faktycznym
    if($stare_haslo == $faktyczne_haslo[0]) 
    {
        $zmiana_hasla = mysql_query("UPDATE uzytkownicy SET haslo = '$haslo1' WHERE uzytkownicy.login = '$_SESSION[login]'");
        echo '<div class="alert alert-success" role="alert">Hasło zmienione!</div>';
    }
    else
    {
        echo "<div class='alert alert-danger'>Podane Stare Hasło jest nieprawidłowe!</div>";
    }
}
else
{
    
}
?>    
    
    
    
    
    
    
    
    
    
    
    