<div class="col-md-2"></div>
<div class="col-md-8">
       
<?php
// w tym miejscu musimy sprawdzic parę zmiennych $_GET
// zmienna $_GET['zarejestrowano']==tak - oznacze że użytkownik się zarejestrował i trzeba wyświetlić stosowny komunikat
// zmienna $_GET['zalogowano']==tak - oznacza, że użytkownik sie zalogował. Trzeba go o tym poinformować piknie
    // użytkownik się zarejstrował
    if (isset($_GET['zarejestrowano']) && $_GET['zarejestrowano']=="tak")
    {
        echo ('<p class="btn-lg bg-success">Zarejestrowano pomyślnie</p><hr>');
    }
    // użytkownik się zalogował
    else if (isset($_GET['zalogowano']) && $_GET['zalogowano']=="tak")
    {
        echo ('<p class=" btn-lg bg-info">Zalogowano pomyślnie</p><hr>');
    }

?>
    <h3>Witaj <?=$_SESSION['imie']?> <?=$_SESSION['nazwisko']?></h3>
      
Ble ble ble - główna strona z informacjami dla uzytkownika.

  </div>
        <div class="col-md-2"></div>