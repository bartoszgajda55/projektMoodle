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
            // jeśli zalogowano, wyświetlamy inne menu
            if (zalogowany())
            {
                standardowy_przycisk("?v=tresc/panele_userow/index", "<b>{$_SESSION['imie']} {$_SESSION['nazwisko']}</b>");
                
                // jeśli zalogowano jako admin lub nauczyciel, to wyświetlamy przycisk z zarządzniem kursami
                if (admin() || nauczyciel())
                {
                    standardowy_przycisk("?v=tresc/panele_userow/index&prawa=tresc/panele_userow/____jakis__adres__1__", "Zarządzanie kursami", 0);
                }
                // jeśli zalogowano jako użytkownik to wyświetlamy przycisk "Moje kursy"
                else
                {
                    standardowy_przycisk("?v=__kursy_danego_uzytkownika____", "Moje kursy");
                }
                
                standardowy_przycisk("tresc/logowanie/wyloguj.php?wyloguj=tak", "Wyloguj");
            }   
            
            // jeśli NIE zalogowano jest inne menu
            else
            {
                standardowy_przycisk("index.php?v=tresc/test_menu_z_lewej/glowne", "Testy");
                standardowy_przycisk("?v=tresc/logowanie/logowanie", "Logowanie");
                standardowy_przycisk("index.php?v=tresc/rejestracja/rejestracja", "Rejestracja");   
            }
              ?>
            <!--<li><a href="index.php" class=""></a></li> -->
            
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>