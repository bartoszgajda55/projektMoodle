<!-- Skrypt tylko dla nauczyciela (nie dla admina)
     Możliwość stworzenia nowego kursu
-->
<h3>Tworzenie nowego kursu<hr></h3>
<?php //sprawdzamy, czy jest to poprawny uzytkownik. Wejść tutaj może tylko nauczyciel
    if (!nauczyciel())   
    {
        echo "Dostęp tylko dla nauczyciela";
        return;
    }
    
    // sprawdzenie poprawności pól i wyświetlenie komunikatu
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {
        if(isset($_POST['nazwa']) && $_POST['nazwa']!="" && isset($_POST['klucz']) && $_POST['klucz']!="")
        {
            // wszystko jest poprawnie wypełnione, można dodawac dane do bazy
            if(mysql_query("INSERT INTO kursy (id_zalozyciela, nazwa, klucz_dostepu, stan) VALUES ('{$_SESSION['id_usera']}','{$_POST['nazwa']}','{$_POST['klucz']}', 'dobry')")===TRUE)
            {
                // dodanie się powiodło, można przekierować na stronę lista_kursow i wyświetlić komunikat o powodzeniu
                header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow&dodano=tak");
            }
        }
        else
        {
            // nie wypełniono wszystkich pól, komunikat o błędzie
            echo '<div class="alert alert-danger" role="alert">Wypełnij wszystkie pola</div><br>';
        }
    }
    
    
?>

<form action="index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_stworz_kurs&wyslano=tak" method="post" accept-charset="utf-8" >
  <div class="form-group">
    <label>Nazwa kursu</label>
    <input type="nazwa" class="form-control" id="exampleInputEmail1" placeholder="Wpisz nazwę nowego kursu" name="nazwa">
  </div>
   
  <div class="form-group ">
    <label>Klucz dostępu</label>
    <input type="klucz" class="form-control" id="exampleInputEmail1" placeholder="" name="klucz">
  </div>
  <button type="submit" class="btn btn-default">Dodaj kurs</button>
</form>

