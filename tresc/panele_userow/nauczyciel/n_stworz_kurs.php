<?php 
// Skrypt tylko dla nauczyciela (nie dla admina)
// Możliwość stworzenia nowego kursu

    // jeśli zagląda tutaj admin, przekierowywujemy do innego pliku 
    if (admin())
    {
        header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_stworz_kurs_admin");
        return;
    }
    //sprawdzamy, czy jest to poprawny uzytkownik. Wejść tutaj może tylko nauczyciel
    if (!nauczyciel())  
    {
        echo "Dostęp tylko dla nauczyciela";
        return;
    }
   
    
    // sprawdzamy, czy formularz został wysłany
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   // sprawdzamy poprawność pól
        if (isset($_POST['nazwa']) && $_POST['nazwa']!="" && isset($_POST['klucz']) && $_POST['klucz']!="")
        {
            // wszystko jest poprawnie wypełnione, można dodawac kurs do bazy
            if(mysql_query("INSERT INTO kursy (id_zalozyciela, nazwa, klucz_dostepu, stan) VALUES ('{$_SESSION['id_usera']}','{$_POST['nazwa']}','{$_POST['klucz']}', 'dobry')")===TRUE)
            {
                // dodanie się powiodło, można przekierować na stronę lista_kursow i wyświetlić komunikat o powodzeniu
                header("Location: index.php?v=tresc/panele_userow/panel_glowny&prawa=tresc/panele_userow/nauczyciel/n_lista_kursow&dodano=tak");
                return;
            }
        }
        else
        {   // nie wypełniono wszystkich pól, komunikat o błędzie
            komunikat("Wypełnij wszystkie pola","danger");
        }
    }
?>

<h3>Tworzenie nowego kursu<hr></h3>
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