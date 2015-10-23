<?php
if (!zalogowano()) return;
?>

Tabelka z informacjami o userze
<hr>

<?php
echo "zalogowany - <b>".$_SESSION['zalogowany']."</b><br>";
echo "login - <b>".$_SESSION['login']."</b><br>";
echo "typ - <b>".$_SESSION['typ']."</b><br>";
echo "id_usera - <b>".$_SESSION['id_usera']."</b><br>";
echo "imie - <b>".$_SESSION['imie']."</b><br>";
echo "nazwisko - <b>".$_SESSION['nazwisko']."</b><br>";
//echo "".."<br>";
?>