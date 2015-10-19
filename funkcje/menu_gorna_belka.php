<?php
// plik zawiera menu główne (belka na górze)
// kod PHP jest wymagany do zmieniania przycisków w zależności od zalogowania
// (np. niezalogowany, user, nauczyciel, admin)
?>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Projekt moodle</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <?php
                standardowy_przycisk("?v=tresc/strona_glowna", "Logowanie");
                standardowy_przycisk("index.php?v=tresc/test_menu_z_lewej/glowne", "Rejestracja");
              ?>
            <!--<li><a href="index.php" class=""></a></li> -->
            
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>