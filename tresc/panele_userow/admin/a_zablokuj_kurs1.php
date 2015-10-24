<!-- Skrypt, w którym wybieramy kurs, który ma zostać zablokowany
    Zablokowany kurs oznacza tyle, że jest niewidoczny dla użytkowników i nauczycieli
-->
<h3>Blokuj lub odblokuj kurs</h3><hr>
<?php // zabezpieczenie przed niepowołanym dostępem
    if (!admin()) return;
?>
<?php
// ----------------------------------------------------------------------------
// blokada lub odblokowanie kursu
// sprawdzamy, czy wciśnięto przycisk
if (isset($_GET['potwierdz']) && $_GET['potwierdz']=="tak")
{
    // zmieniamy ustawienie w tabeli
    if (isset($_GET['blok']) && $_GET['blok']=="zablokuj")
    {
        $zapytanie2 = mysql_query("UPDATE kursy SET stan='blocked' WHERE id_kursu={$_GET['id_kursu']}")
                      or die('Nie udało się zablokować kursu');
        // komunikat o powodzeniu
        echo '<div class="alert alert-danger" role="alert">Kurs #'.$_GET['id_kursu'].' został zablokowany</div>';
    }
    else if (isset($_GET['blok']) && $_GET['blok']=="odblokuj")
    {
        $zapytanie2 = mysql_query("UPDATE kursy SET stan='dobry' WHERE id_kursu={$_GET['id_kursu']}")
                      or die('Nie udało się odblokować kursu');
        // komunikat o powodzeniu
        echo '<div class="alert alert-success" role="alert">Kurs #'.$_GET['id_kursu'].' został odblokowany</div>';
    }
    
}


// ----------------------------------------------------------------------------
?>
 <table class="table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Nazwa</th>
      <th>Stan kursu</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
<?php
// wyświetlenie tabeli z kursami
    $wynik = mysql_query("SELECT * FROM kursy");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        // tworzymy link, który przekierowuje na stronę z blokowaniem kursu (lub z odblokowaniem)
        $link = "index.php?v=tresc/panele_userow/panel_glowny"
                . "&prawa=tresc/panele_userow/admin/a_zablokuj_kurs1"
                . "&id_kursu={$r['id_kursu']}"
                . "&potwierdz=tak";
        
        // ustawienie odpowiedniej ikonki stanu oraz przycisku
        // jeśli kurs jest zablokowany, to ustawiamy przycisk odblokuj oraz ustawiamy czerwoną ikonkę
        if ($r['stan']=="blocked")
        {
            $ikonka = '<span class="glyphicon glyphicon-remove btn-lg" style="color:red;"></span>';
            $przycisk = "<a href='{$link}&blok=odblokuj' type='button' class='btn btn-success'>Odblokuj</a>";
        }
        // w przeciwnym wypadku przycisk Zablokuj i zielona ikonka
        else
        {
            $ikonka = '<span class="glyphicon glyphicon-ok btn-lg" style="color:green;"></span>';
            $przycisk = "<a href='{$link}&blok=zablokuj' type='button' class='btn btn-danger'>Zablokuj</a>";
        }
        
        // wyświetlamy dany wiersz w tabeli          
        echo '<tr>';
        echo '<td>'.$r['id_kursu'].'</td>';
        echo '<td>'.$r['nazwa'].'</td>';
        echo '<td>'.$ikonka.'</td>';
        echo '<td>'.$przycisk.'</td>';
        echo '</tr>'; 
    }
?>
  </tbody>
</table>