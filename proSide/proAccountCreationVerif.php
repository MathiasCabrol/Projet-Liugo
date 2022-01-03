<?php
$nameRegex = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';
$mailRegex = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$passwordRegex = '/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/';

//Création du tableau vide de listes d'erreurs

$errorList = [];

//Définition des erreurs du champ 'name'

if(!empty($_POST['name'])){ 
    if(!preg_match($nameRegex, $_POST['name'])){
        $errorList['name'] = 'Merci d\'entrer un nom composé d\'une majuscule, de lettres caractères accentués, tirets et/ou apostrophes.';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }
} else {
    $errorList['name'] = 'Veuillez entrer un nom.';
}

//Définition des erreurs du champ 'mail'

if(!empty($_POST['mail'])){ 
    if(!preg_match($mailRegex, $_POST['mail'])){
        $errorList['mail'] = 'Merci d\'entrer une adresse e-mail avec un format valide.';
    } else {
        $mail = htmlspecialchars($_POST['mail']);
    }
} else {
    $errorList['mail'] = 'Merci d\'entrer une adresse e-mail.';
}

//Définition des erreurs du champ 'password'

if(!empty($_POST['password'])){ 
    if(!preg_match($siretRegex, $_POST['password'])){
        $errorList['password'] = 'Merci d\'entrer un mot de passe suffisament fort (Un caractère spécial, une majuscule, au minimum 6 caractères).';
    } else {
        $password = htmlspecialchars($_POST['password']);
    }
} else {
    $errorList['password'] = 'Merci d\'entrer un mot de passe.';
}
