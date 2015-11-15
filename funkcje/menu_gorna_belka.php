<?php
// plik zawiera menu główne (belka na górze)
// kod PHP jest wymagany do zmieniania przycisków w zależności od zalogowania
// (np. niezalogowany, user, nauczyciel, admin)
?>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <?php
        // jeśli użytkownik jest zalogowany to dajemy inny link do strony głownej
        if (zalogowany())
        {
            echo ("<a class='navbar-brand' href='index.php?v=tresc/strona_glowna'><img src='img/logo.png'></a>");
        }
        // jeśli nie ma zalogowania, to wyświetlamy standardowe okno logowania
        else
        {
            echo ("<a class='navbar-brand' href='index.php'><img src='img/logo.png'></a>");
        }
                  
        ?>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <?php
            
            standardowy_przycisk("index.php?v=tresc/zadanie", losuj_ikone()); 
            // jeśli zalogowano, wyświetlamy inne menu
            if (zalogowany())
            {
                standardowy_przycisk("?v=tresc/panele_userow/panel_glowny", "<b>{$_SESSION['imie']} {$_SESSION['nazwisko']}</b>");
                
                // jeśli zalogowano jako admin lub nauczyciel, to wyświetlamy przycisk z zarządzniem kursami
                if (admin() || nauczyciel())
                {
                    standardowy_przycisk("?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow", "Zarządzanie kursami", 0);
                }
                // jeśli zalogowano jako użytkownik to wyświetlamy przycisk "Moje kursy"
                else
                {
                    standardowy_przycisk("?v=tresc/u_kursy/lista_kursow_uzytkownika", "Moje kursy");
                }
                
                standardowy_przycisk("tresc/logowanie/wyloguj.php?wyloguj=tak", "Wyloguj");
            }   
            
            // jeśli NIE zalogowano jest inne menu
            else
            {
                standardowy_przycisk("?v=tresc/logowanie/logowanie", "Logowanie");
                standardowy_przycisk("index.php?v=tresc/rejestracja/rejestracja", "Rejestracja");   
            }
              ?>
            <!--<li><a href="index.php" class=""></a></li> -->
           
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>