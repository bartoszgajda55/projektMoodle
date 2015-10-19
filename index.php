<?php session_start(); 
    //rozpoczęcie sesji
    // oraz dołączenie plików z funkcjami
    // niechcący kod może być dołączony kilka razy, dlatego używamy dyrektywy require_once
    // plik f_include zawiera funkcje, które dołączają pliki z treścią do strony
    require_once("funkcje/f_include.php");
    // plik f_przyciski zawiera funkcje które wyswietlaja przyciski
    require_once("funkcje/f_przyciski.php");
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
            <div class="row">
                 <?php 
                     // dołącza plik, jaki jest podany w zmiennej $_GET['v'] (pierwszy argument)
                     // jeśli taka zmienna nie istnieje, jest dodawany plik 'tresc/strona_glowna' (drugi argument)
                     dolacz_plik("v", "tresc/strona_glowna"); 
                 ?>
            </div> 
        </div>    

        <!-- Dołączenie skryptów z bootstrapa i jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
