# projektMoodle
Projekt został stworzony na potrzeby zaliczenia programowania w czwartej klasie technikum informatycznego. Był tworzony na przełomie października i listopada 2015 przez dwóch "mózgów", których dane można znaleźć w wysłanych commitach.


## Działający projekt:
http://projektmoodle.cba.pl/ 

http://projektmoodle.za.pl/

## Wymagnia
- PHP: wersja 5.6 lub niższa
- MySQL

![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/1.png)

## Instalacja projektu
Instalacja sama w sobie jest bardzo prosta i szybka. Projekt potrzebuje jedynie serwera z interpreterem PHP 5.6 oraz bazy danych MySQL.

Na samym początku pobieramy projekt.

W pliku `baza/polaczenie.php` znajdują się konfiguracja połączenia z serwerem bazy. Domyślnie jest to
```php
$adres = '127.0.0.1';
$uzytkownik = 'root';
$haslo = '';
$nazwa_bazy = 'projektMoodle';
```

W projekcie jest instalator, który sam wykryje, że nie ma zaimportowanych tabel. Wystarczy, aby powyższe dane były wpisane poprawnie, a cały proces „instalacji” będzie prowadził użytkownika „za rączkę”. Gdyby jednak tak się nie stało, to w folderze `baza/` znajdują się kilka ostatnich zrzutów bazy, które trzeba zaimportować np. poprzez phpMyAdmin.


## Screeny & info
Projekt to prosta platforma e-learningowa zbudowana na kształt moodli. Strona umożliwia rejestrację trzech typów użytkowników: administrator, nauczyciel i student. Każdy z użytkowników posiada inne prawa i możliwości zarządzania stroną i kursami.

Administrator zarządza wszystkim – kursami, użytkownikami, całą aplikacją

Nauczyciel ma możliwość tworzenia kursów. W obrębie własnego kursu nauczyciel ma możliwość zapisywania użytkowników, dodawania plików do lekcji, tworzenia zadań, umożliwiających pobranie pliku od użytkownika lub bezpośredniej treści wpisanej na stronie zadania.

Każdy użytkownik, który rejestruje się do aplikacji rejestruje się jako student. Administrator może zmienić konto studenta na konto nauczyciela. Student może przegląda

 Student powinien mieć możliwość wejścia tylko do kursów, na które jest zapisany. Studenta może zapisać tylko administrator lub student może dokonać tego samodzielnie na podstawie kodu, który otrzyma od nauczyciela.    

**Poniżej parę screenów:**
Zarządzanie użytkownikami przez administratora
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/2.png)

Tworzenie / edycja lekcji przez nauczyciela
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/3.png)

Podgląd lekcji w kursie przez nauczyciela
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/4.png)


![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/5.png)

Panel ucznia (zwykłego użytkownika platformy)
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/6.png)

Lekcja widoczna dla studenta
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/7.png)

Uczeń może dołączyć do kursu dzięki podaniu kodu
![photo](https://raw.githubusercontent.com/bartoszgajda55/projektMoodle/master/photos_to_readme/8.png)


### Dodatkowe informacje
W pliku `"informacje.txt"` znajduje się trochę przydatnych rzeczy - nazwy zmiennych sesyjnych, nazwy funkcji, opisy plików. (https://github.com/bartekg55/projektMoodle/blob/master/informacje.txt)


