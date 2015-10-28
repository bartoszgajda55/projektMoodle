/* 
Custom robota, a nie jakieś gotowce !
r - pola rejestracji
p - pola przypominania (wysłanie kodu)
s - pola resetu hasła (z kodem)
k - pola zmiany hasła w panelu użytkownika (po zalogowaniu)
*/
$().ready(function() {
    $("#rejestracja").validate({
        rules: {
            r_login: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            r_haslo1: {
                required: true,
                minlength: 4,
                maxlength: 20
            },
            r_haslo2: {
                required: true,
                minlength: 4,
                maxlength: 20,
                equalTo: "#r_haslo"
            },
            r_email: {
                required: true,
                email: true
            },
            r_imie: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            r_nazwisko: {
                required: true,
                minlength: 2,
                maxlength: 20
            }
        },
        messages : {
            r_login: {
                required: "Wpisz login !",
                minlength: "Wpisz co najmniej 2 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            r_haslo1: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            r_haslo2: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !",
                equalTo: "Wpisane hasła są różne !"
            },
            r_email: {
                required: "Wpisz email !",
                email: "Zły format adresu !"
            },
            r_imie: {
                required: "Wpisz imie !",
                minlength: "Wpisz co najmniej 2 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            r_nazwisko: {
                required: "Wpisz nazwisko !",
                minlength: "Wpisz co najmniej 2 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            }
        }
    });
    $("#przypomnij").validate({
        rules: {
            p_login: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            p_email: {
                required: true,
                email: true
            }
        },
        messages : {
            p_login: {
                required: "Wpisz login !",
                minlength: "Wpisz co najmniej 2 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            p_email: {
                required: "Wpisz email !",
                email: "Zły format adresu !"
            }
        }
    });
    $("#reset").validate({
        rules: {
            s_login: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            s_haslo: {
                required: true,
                minlength: 4,
                maxlength: 20
            },
            s_nowe_haslo: {
                required: true,
                minlength: 4,
                maxlength: 20,
                equalTo: "#s_haslo"
            },
            s_email: {
                required: true,
                email: true
            },
            s_kod: {
                required: true,
            }
        },
        messages : {
            s_login: {
                required: "Wpisz login !",
                minlength: "Wpisz co najmniej 2 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            s_haslo: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            s_nowe_haslo: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !",
                equalTo: "Wpisane hasła są różne !"
            },
            s_email: {
                required: "Wpisz email !",
                email: "Zły format adresu !"
            },
            s_kod: {
                required: "Wpisz email !",
            }
        }
    });
    $("#zmiana_panel").validate({
        rules: {
            k_stare_haslo: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            k_haslo1: {
                required: true,
                minlength: 4,
                maxlength: 20
            },
            k_haslo2: {
                required: true,
                minlength: 4,
                maxlength: 20,
                equalTo: "#k_haslo1"
            }
        },
        messages : {
            k_stare_haslo: {
                required: "Wpisz stare hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            k_haslo1: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !"
            },
            k_haslo2: {
                required: "Wpisz hasło !",
                minlength: "Wpisz co najmniej 4 znaki !",
                maxlength: "Wpisz co najwyżej 20 znaków !",
                equalTo: "Wpisane hasła są różne !"
            }
        }
    });
});

