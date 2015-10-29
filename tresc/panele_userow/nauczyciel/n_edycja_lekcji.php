<!-- Plik, który edytuje daną lekcję (temat, treść, plik) -->
<?php
 // dostęp ma tutaj tylko admin lub tylko nauczyciel
    if (!admin() && !nauczyciel()) return;
    // sprawdzamy, czy istnieje odpowiednie zmienne na pasku adresu
    if (!isset($_GET['id_lekcji']) || $_GET['id_lekcji']=="") return;

    // ustawienie odpowiednich zmiennych globalnych dla tego skryptu
    $id_lekcji = $_GET['id_lekcji'];
    
    // pobranie danych z bazy i przypisanie ich do zmiennych. Zmienne dzieki magii PHP są dostępnie globalnie w całym pliku
    $wynik_kurs_nazwa = mysql_query("SELECT * FROM `lekcje` WHERE id_lekcji={$id_lekcji}");
    while ($r = mysql_fetch_assoc($wynik_kurs_nazwa)) 
    {
        $b_id_lekcji = $r['id_lekcji'];
        $b_id_kursu = $r['id_kursu'];
        $b_temat = $r['temat'];
        $b_tresc = $r['tresc'];
        $b_plik_nauczyciela = $r['plik_nauczyciela'];
    }
        
    // sprawdzamy, czy formularz został wysłany
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   // sprawdzamy, czy pola są wypełnione
        if(isset($_POST['temat']) && $_POST['temat']!="" && isset($_POST['tresc']) && $_POST['tresc']!="")
        {   // edytujemy wpis w bazie
            if(mysql_query("UPDATE lekcje SET temat='{$_POST['temat']}', tresc='{$_POST['tresc']}', plik_nauczyciela='brak' WHERE id_lekcji={$id_lekcji}")===TRUE)
            {   // edycja lekcji się powiodła, przekierowanie na podgląd lekcji
                header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_podglad_lekcji&id_lekcji={$id_lekcji}&edytowano=tak");
                return;
            }
        }
        else
        {   // jeśli jednak coś poszło ne tak
            komunikat("Wypełnij wszystkie pola", "danger");
        }
    }
?>
<h3>Edycja lekcji id <b>#<?=$_GET['id_lekcji']?></b><hr><small>Lekcja z kursu: </small></h3>
<?php dany_kurs($b_id_kursu); ?>
<br>
<form action="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_edycja_lekcji&id_lekcji=<?=$_GET['id_lekcji']?>&wyslano=tak" method="post" accept-charset="utf-8" >
  <div class="form-group">
    <label>Temat lekcji</label>
    <input type="temat" class="form-control" id="exampleInputEmail1" placeholder="" name="temat" value="<?=$b_temat?>">
  </div>
  <div class="form-group ">
    <label>Treść lekcji</label>
    <textarea class="form-control" rows="18" name="tresc"><?=$b_tresc?></textarea>
  </div>
    <button type="submit" class="btn btn-default"><b>Zatwierdź zmiany</b></button> 
  <a class="btn btn-default" href="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_podglad_lekcji&id_lekcji=<?=$id_lekcji?>" role="button"><i>Podgląd lekcji</i></a> <i> (Bez zatwiedzonych zmian, otwiera nową kartę) </i>
</form>