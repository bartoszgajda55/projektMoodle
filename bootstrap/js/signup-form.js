/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
                equalTo: "#password1"
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
});

