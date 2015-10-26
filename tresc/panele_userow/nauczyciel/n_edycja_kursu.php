<!-- Plik, który edytuje dany kurs  -->
<h3>Edycja kursu nr. <b>#<?=$_GET['id_kursu']?></b><hr></h3>
<?php
 // dostęp ma tutaj tylko admin lub tylko nauczyciel
    if (!admin() && !nauczyciel()) return;
    // sprawdzamy, czy istnieje odpowiednie zmienne na pasku adresu
    if (!isset($_GET['id_kursu']) || $_GET['id_kursu']=="") return;
    
    // wyswietlamy kurs, który chcemy edytować
    dany_kurs($_GET['id_kursu']);
    
    // przypisanie danych do wyświetlenia ich w formularzu
    $wynik = mysql_query("SELECT * FROM kursy WHERE id_kursu={$_GET['id_kursu']}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        $b_nazwa = $r['nazwa'];
        $b_klucz = $r['klucz_dostepu'];
    }
    
    // sprawdzenie czy formularz jest przesylany
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   // sprawdzenie wszystkich pól, czy są wypelnione
        if(isset($_POST['nazwa']) && $_POST['nazwa']!="" && isset($_POST['klucz']) && $_POST['klucz']!="")
        { 
            // wszystko jest poprawnie wypełnione, można edytować dane w bazie
            if(mysql_query("UPDATE kursy SET nazwa='{$_POST['nazwa']}', klucz_dostepu='{$_POST['klucz']}' WHERE id_kursu={$_GET['id_kursu']}")===TRUE)
            {
                // dodanie się powiodło, można przekierować na stronę lista_kursow i wyświetlić komunikat o powodzeniu
                header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow&edytowano=tak");
                return;
            }
        }
        else
        {   // nie wypełniono wszystkich pól, komunikat o błędzie
            komunikat("Wypełnij wszystkie pola", "danger");
        }
    }
?>
<br>
<form action="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_edycja_kursu&id_kursu=<?=$_GET['id_kursu']?>&wyslano=tak" method="post" accept-charset="utf-8" >
  <div class="form-group">
    <label>Nazwa kursu</label>
    <input type="nazwa" class="form-control" id="exampleInputEmail1" placeholder="Wpisz nazwę nowego kursu" name="nazwa" value="<?=$b_nazwa?>">
  </div>
  <div class="form-group ">
    <label>Klucz dostępu</label>
    <input type="klucz" class="form-control" id="exampleInputEmail1" placeholder="" name="klucz" value="<?=$b_klucz?>">
  </div>
  <button type="submit" class="btn btn-default">Zamień dane</button>
</form>