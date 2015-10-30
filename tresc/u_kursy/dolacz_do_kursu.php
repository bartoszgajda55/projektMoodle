<div id="z_lista_lekcji_lewa" class="col-md-9">
<div class="thumbnail">
<h3>Dołączanie do kursu<hr>
    <small>Wpisz kod dostępu:</small></h3><br>
    <div>
        <form action="index.php?v=tresc/u_kursy/dolacz_do_kursu&wyslano=tak" method="post" accept-charset="utf-8" >
        <div>
           <div class="input-group">
               <input type="text" class="form-control" placeholder="Kod dostępu" name="klucz" value="<?=@$_POST['klucz']?>">
             <span class="input-group-btn">
                 <button type="submit" class="btn btn-default" type="button">Dołącz do kursu</button>
             </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
        </form>
    </div>   
<?php
    // sprawdzamy, czy użytkownik jest zalogowany, jeśli nie to return; i do widzenia
    if(!zalogowano()) return;
    
    // skrypt wygląda, jak by był robiony od końca, ale tak nie jest.
    // poniższy warunek sprawdza, czy został wciśnięty przycisk TAK, który może jeszcze nie istenieć
    // chodź dziwnie to brzmi, tak właśnie być musi
    // sprawdzamy, czy wciśnięto TAK (potwierdzenie dodania do kursu)
    if(isset($_GET['dolacz']) && $_GET['dolacz']=="tak")
    {
        // sprawdzamy, czy uzytkownik przypadkiem już nie należy do tego kursu
        $zapytanie1 = mysql_query("SELECT * FROM zapisy WHERE id_uzytkownika={$_SESSION['id_usera']} AND id_kursu={$_GET['id_kursu']}");
        $ilosc_wierszy = mysql_num_rows($zapytanie1);
        if ($ilosc_wierszy !=0) 
        {
            // jeśli użytkownik już należy do kursu, to przenosimy do głównego skryptu i wyświetlamy odpowiedź
            header("Location: index.php?v=tresc/u_kursy/lista_lekcji&id={$_GET['id_kursu']}&dodano=nalezysz");
            return;
        }
        
        // jeśli skrypt dotarł tutaj, to znak, że user nie należy do tego kursu i można go do niego dopisać
        // dodanie wpisu do tabeli z zapisami do kursów
        $dataa = (string) date("Y-m-d");
        $zapytanie2 = mysql_query("INSERT INTO zapisy (id_uzytkownika, id_kursu, data_zapisu) VALUES ({$_SESSION['id_usera']}, {$_GET['id_kursu']}, '{$dataa}')")
                      or die('Nie udało się dodać użytkownika do kursu');
        // przekierowanie od razu do tego kursu
        header("Location: index.php?v=tresc/u_kursy/lista_lekcji&id={$_GET['id_kursu']}&dodano=tak");
        return;
    }
    
    
    
    // sprawdzamy, czy formularz został wysłany.
    if(isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   
        // sprawdzamy, czy klucz został wysłany
        if (isset($_POST['klucz']) && $_POST['klucz']!="")
        {   
            // ustawiamy zmienne
            $id = 0;
            // zapytanie do bazy, czy istenieje kurs z takim kluczem
            $wynik = mysql_query("SELECT * FROM kursy WHERE kursy.klucz_dostepu='{$_POST['klucz']}' AND stan='dobry'");
            // jeśli zapytanie zwróci dokłanie jeden rekord, wszysto jest ok
            if(mysql_num_rows($wynik) == 1) 
            {
                // przypisanie wartości klucza do zmiennej $id
                while($r = mysql_fetch_assoc($wynik)) 
                {
                    $id=$r['id_kursu'];
                }
                // wyświetlenie tabelki z danym kursem
                dany_kurs($id);
                
                // pytanie, czy użytkownik chce na pewno dołączyć do tego kursu
                echo '<h4>Czy chcesz dołaczyć do tego kursu?</h4>';
                // wyświetlenie przycisków z dołączeniem do kursu
                echo '<a href="index.php?v=tresc/u_kursy/dolacz_do_kursu&wyslano=tak&dolacz=tak&id_kursu='.$id.'" type="button" class="btn btn-success" style="margin-right: 20px; margin-left: 20px;">Tak (dołącz)</a>';
                echo '<a href="index.php?v=tresc/u_kursy/lista_kursow_uzytkownika" type="button" class="btn btn-default">Nie (powrót)</a> ';
                
            }
            // jeśli zapytanie zwróci więcej niż jeden rekord, znaczy że jest problem z kluczami
            else if(mysql_num_rows($wynik) > 1) 
            {
               echo '<br><div class="alert alert-warning" role="alert">Do tego klucza przypisanych jest kilka kursów. Skontaktuj się z administratorem i zgłoś błąd</div>';
            }
            // jeśli zapytanie nie zwróci nic, znaczy że nie ma takiego klucza w bazie, czyli jest on niepoprawny
            else if(mysql_num_rows($wynik) <= 0)
            {
                 echo '<br><div class="alert alert-danger" role="alert">Niepoprawny klucz dostępu</div>';
            }
            
        }
        else if (!isset($_POST['klucz']) || $_POST['klucz']=="") // nie podano klucza
        {
             echo '<br><div class="alert alert-danger" role="alert">Nie podałeś klucza dostępu</div>';
        }
    }
?>
    </div>
</div>
<div id="z_lista_lekcji_prawa" class="col-md-3">
    <div class="thumbnail">
        <p>Wpisz kod dostępu, podany przez nauczyciela
            Jeśli go nie masz, poproś nauczyciela o ręczne dodanie do kursu.
    </div>
</div>
