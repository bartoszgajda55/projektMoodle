<?php
// skrypt wylogowywuje użytkonika
// UWAGA! - skrypt jest stand-alone, nie można go includować.
// działa tylko jako bezpośrednie odwołanie w pasku adresu

// sprawdzamy, czy w adresie jest prosba o wylogowanie
if(@$_GET['wyloguj'] == 'tak')
{
    // na wszelki wypadek ustawiamy ważne zmienne sesyjne na przeciwne wartości
    $_SESSION['zalogowany']=FALSE;
    $_SESSION['id_usera']=0;
    // na wszelki wypadek usuwamy zmienne sesyjne
    unset($_SESSION['zalogowany']);
    unset($_SESSION['typ']);
    // niszczymy sesje
    $_SESSION = array();
    if (isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-42000, '/');
    // koniec sesji
    session_destroy();
    // przekierowanie do strony głównej i wyświetlenie komunikatu o wylogowaniu
    // komunikatu jeszcze nie ma zrobionego, więc się nic nie wyświetla
    header("Location: ../../index.php?wylogowano=tak");
}

?>

