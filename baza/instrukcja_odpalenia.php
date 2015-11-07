<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Projekt Moodle - instrukcja odpalenia</title>
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/flat-ui.css" rel="stylesheet">
    </head>  
    
    <body>     
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
        <a class='navbar-brand' href='../index.php'><img src='../img/logo.png'></a>        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
	
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>        <!-- Tutaj zaczyna się treść danej podstrony -->
        <div class="container">
            <div id="z_panel_calosc" class="row">
<div class="row">   
<div class="col-md-2"></div>
<div class="col-md-8">

<?php
    // jeśli udało się stworzyć tabele
    if (isset($_GET['stworzono']) && $_GET['stworzono']=="tak")
    {   
        echo '<div class="alert alert-success" role="alert">Udało się stworzyć bazę danych wraz z tabelami. <a href="../index.php"><b>Wróć do strony głównej</b></a></div>';
        return;
    }
?>
    
    
<legend>Instrukcja odpalenia</legend>     

<hr>
<a class="btn btn-danger" href="stworz_baze.php">Spróbuj automatycznie stworzyć bazę i zaimportować do niej tabele</a> <i>Operacja może potrwać dłuższą chwilę.</i>
<hr>
W folderze <u><i>baza</i></u> znajduje się plik SQL z zrzutem bazy danych. Wystarczy go zaimportować do phpMyAdmin do bazy <b><i>projektMoodle</b></i><br><br>
Domyślne dane połączenia to:<br>
<ul>
    <li>adres = <b>127.0.0.1</b></li>
    <li>uzytkownik = <b>root</b></li>
    <li>haslo = <b></b></li>
    <li>nazwa_bazy = <b>projektMoodle</b></li>
</ul>
Łączenie następuje w pliku <u><i>baza/polaczenie.php</i></u> Tam też można zmianiać dane dostępowe.
	 
</div>
<div class="col-md-2"></div>

</div>            </div> 
        </div>    

        <!-- Dołączenie skryptów z bootstrapa i jQuery -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/jquery.validate.js"></script>
        <script src="bootstrap/js/walidacja.js"></script>
        <script src="bootstrap/js/flat-ui.js"></script>
    </body>
</html>