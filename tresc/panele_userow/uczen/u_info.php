<?php
if (!zalogowano()) return;
?>

<h3>Szczegółowe informacje o użytkowniku</h3>

<hr>

<p>Jesteś zalogowany jako: <b><?=$_SESSION['imie']?> <?=$_SESSION['nazwisko']?></b></p>
<p>Login: <b><?=$_SESSION['login']?></b></p>
<p>Mail: <b></b></p>
<p>Ranga: <b><?=$_SESSION['typ']?></b></p>


<?php
/*
echo "zalogowany - <b>".$_SESSION['zalogowany']."</b><br>";
echo "login - <b>".$_SESSION['login']."</b><br>";
echo "typ - <b>".$_SESSION['typ']."</b><br>";
echo "id_usera - <b>".$_SESSION['id_usera']."</b><br>";
echo "imie - <b>".$_SESSION['imie']."</b><br>";
echo "nazwisko - <b>".$_SESSION['nazwisko']."</b><br>";
echo "".."<br>";*/
?>