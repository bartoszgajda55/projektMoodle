<?php 
// Skrypt tworzy nową lekcję.

    //sprawdzamy, czy jest to poprawny uzytkownik. Wejść tutaj może tylko nauczyciel lub admin
    if (!nauczyciel() && !admin())  
    {
        echo "Dostęp tylko dla nauczyciela lub admina";
        return;
    }
    // sprawdzamy, czy przesłano odpowiednie zmienne przez pasek adresu
    if(!isset($_GET['id_kursu'])) 
    {
        echo "Brak odpowiednich zmiennych w pasku adresu";
        return;
    }
    
    // sprawdzamy, czy formularz został wysłany
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   // sprawdzamy poprawność pól
        if (isset($_POST['temat']) && $_POST['temat']!="" && isset($_POST['tresc']) && $_POST['tresc']!="")
        {
            // wszystko jest poprawnie wypełnione, można dodawać lekcję do bazy
            if(mysql_query("INSERT INTO lekcje (id_kursu, temat, tresc) VALUES ('{$_GET['id_kursu']}','{$_POST['temat']}','{$_POST['tresc']}')")===TRUE)
            {
                // dodanie się powiodło, można przekierować na stronę lista_kursow i wyświetlić komunikat o powodzeniu
                // przekierowanie na listę kursów (trochę nietrafne, dlatego w komentarzu)
                //header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow&dodano_lekcje=tak");
                // niżej przekierowanie lepsze, bo na listę lekcji w danym kursie
                header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_lekcji_w_kursie&id_kursu={$_GET['id_kursu']}&dodano_lekcje=tak");
                return;
            }
        }
        else
        {   // nie wypełniono wszystkich pól, komunikat o błędzie
            komunikat("Wypełnij wszystkie pola","danger");
        }
    }
?>

<h3>Tworzenie nowej lekcji<hr></h3>
<?php // informacje o danym kursie, do którego dodajemy lekcję
 dany_kurs($_GET['id_kursu']);
 ?><br>
<form action="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_stworz_lekcje&wyslano=tak&id_kursu=<?=$_GET['id_kursu']?>" method="post" accept-charset="utf-8" >
  <div class="form-group">
    <label>Temat lekcji</label>
    <input type="nazwa" class="form-control" id="exampleInputEmail1" placeholder="" name="temat">
  </div>
  <div class="form-group ">
    <label>Treść lekcji</label>
    <textarea class="form-control" rows="18" name="tresc"></textarea>
  </div>
  <button type="submit" class="btn btn-default">Stwórz lekcję</button>
</form>