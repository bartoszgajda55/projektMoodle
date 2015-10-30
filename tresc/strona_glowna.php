
<div id="z_strona_glowna_lewa" class="col-md-8">
       
<?php
// w tym miejscu musimy sprawdzic parę zmiennych $_GET
// zmienna $_GET['zarejestrowano']==tak - oznacze że użytkownik się zarejestrował i trzeba wyświetlić stosowny komunikat
// zmienna $_GET['zalogowano']==tak - oznacza, że użytkownik sie zalogował. Trzeba go o tym poinformować piknie
    // użytkownik się zarejstrował
    if (isset($_GET['zarejestrowano']) && $_GET['zarejestrowano']=="tak")
    {
        echo ('<div class="alert alert-info">Zarejestrowano pomyślnie</div><hr>');
    }
    // użytkownik się zalogował
    else if (isset($_GET['zalogowano']) && $_GET['zalogowano']=="tak")
    {
        echo ('<div class="alert alert-info">Zalogowano pomyślnie</div><hr>');
    }

?>
<?php
//Wyświtla ramkę z danymi użytkownika
w_dane_usera($_SESSION['id_usera']);

?>
  </div>
        <div id="z_strona_glowna_prawa" class="col-md-4">    <?php w_lista_kursow($_SESSION['id_usera'], 4); ?></div>
        
    