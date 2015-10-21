<?php
// Plik zawiera funkcje które zwracają TRUE lub FALSE
// Funkcje sprawdzają, czy uzytkownik jest zalogowany
// A także, czy to uzytkownik, nauczyciel czy admin
// Dzięki TRUE lub FALSE mozna stosować je w zapytaniach w takiej składni
// if(zalogowany()) {} lub if(nauczyciel()) {}

// funkcja zwraca TRUE, jeśli użytkownik jest zalogowany. W przeciwnym wypadku FALSE
function zalogowany()
{
   if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==TRUE)
   {
       return TRUE;
   }
   else 
   {
       return FALSE;
   }
}

// inna nazwa funkcji, bo można pomylić się z odmianą
function zalogowano()
{
    return zalogowany();
}

// zwraca TRUE, jeśli użytkownik to admin ("typ" to literka "a")
// w przeciwnym wypadku FALSE
function admin()
{
   if(zalogowany())
   {
        if (isset($_SESSION['typ']) && $_SESSION['typ']=="a")
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
   else 
   {
       return FALSE;
   }
}

// zwraca true, jeśli to nauczyciel (literka "n")
function nauczyciel()
{
   if(zalogowany())
   {
        if (isset($_SESSION['typ']) && $_SESSION['typ']=="n")
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
   else 
   {
       return FALSE;
   }
}
