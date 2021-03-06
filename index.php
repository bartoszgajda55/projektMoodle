<?php session_start(); 
    //rozpoczęcie sesji #lol hahaha
    //rozpoczęcie sesji
    // oraz dołączenie plików z funkcjami 
    // niechcący kod może być dołączony kilka razy, dlatego używamy dyrektywy require_once
    // plik f_include zawiera funkcje, które dołączają pliki z treścią do strony
    require_once("funkcje/f_include.php");
    // plik f_przyciski zawiera funkcje które wyswietlaja przyciski
    require_once("funkcje/f_przyciski.php");
    // plik f_uzytkownicy zawiera funkcje, które sprawdzają zalogowanego użytkownika
    require_once("funkcje/f_uzytkownicy.php");
    // plik f_tabelki_z_bazy zawiera funkcje, które wyświetlają małe, jednowierszowe tabelki z bazy danych
    require_once("funkcje/f_tabelki_z_bazy.php");
    // plik f_widgety zawiera funkcje wyświetlające małe widgetty na paskach z lewej lub z prawej strony
    require_once("funkcje/f_widgety.php");
    // plik f_upload_plikow zawiera funkcje do uploadu i zapisu plikow
    require_once("funkcje/f_upload_plikow.php");
    // podłączenie do bazy danych
    require_once("baza/polaczenie.php");
?>
<!DOCTYPE html>
<html>
        
<?php 
    // dołączenie <head> witryny
    include("funkcje/head.php");
?>  
    
    <body>     
<?php
    // dołączenie menu na górze (górna belka)
    include("funkcje/menu_gorna_belka.php");
?>
        <!-- Tutaj zaczyna się treść danej podstrony -->
        <!-- Całość jest zawarta w containerze oraz w jednym row -->
        <div class="container">
            <div id="z_panel_calosc" class="row">
                 <?php 
                     // dołącza plik, jaki jest podany w zmiennej $_GET['v'] (pierwszy argument)
                     // jeśli taka zmienna nie istnieje, jest dodawany plik 'tresc/strona_glowna' (drugi argument)
                     dolacz_plik("v", "tresc/logowanie/logowanie"); 
                 ?>
            </div> 
        </div>    

        <!-- Dołączenie skryptów z bootstrapa i jQuery -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/jquery.validate.js"></script>
        <script src="bootstrap/js/walidacja.js"></script>
        <script src="bootstrap/js/flat-ui.js"></script>
    </body>
</html>
