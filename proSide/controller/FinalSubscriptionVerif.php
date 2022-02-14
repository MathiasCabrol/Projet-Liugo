<?php

require 'model/Database.php';
require 'model/Sector.php';
require 'model/City.php';

$phoneRegex = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$adressRegex = '/^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/';
$postCodeRegex = '/^[0-9]{5}$/';

//Création du tableau vide de listes d'erreurs

if (isset($_POST['confirm']) && $_POST['confirm'] == "confirmer") {

$errorList = [];

//Définition des erreurs du champ 'nom'

if(!empty($_POST['phoneInput'])){ 
    if(!preg_match($phoneRegex, $_POST['phoneInput'])){
        $errorList['phoneInput'] = 'Merci d\'entrer un numéro de téléphone avec unnformat valide.';
    } else {
        $phone = htmlspecialchars($_POST['phoneInput']);
    }
} else {
    $errorList['phoneInput'] = 'Veuillez entrer un numéro de téléphone.';
}

//Définition des erreurs du champ 'prénom'

if(!empty($_POST['addressInput'])){ 
    if(!preg_match($adressRegex, $_POST['addressInput'])){
        $errorList['addressInput'] = 'Merci d\'entrer une adresse valide.';
    } else {
        $address = htmlspecialchars($_POST['addressInput']);
    }
} else {
    $errorList['addressInput'] = 'Merci d\'entrer une adresse';
}

//Définition des erreurs du champ 'date de naissance'

if(!empty($_POST['postCodeInput'])){ 
    if(!preg_match($postCodeRegex, $_POST['postCodeInput'])){
        $errorList['postCodeInput'] = 'Merci d\'entrer un code postal valide (5 chiffres).';
    } else {
        $siretInput = htmlspecialchars($_POST['postCodeInput']);
    }
} else {
    $errorList['postCodeInput'] = 'Merci d\'entrer un code postal.';
}


$city = new City;
$postCodeCity = $city->getCorespondingCity();
echo $postCodeCity->city;

} else {
    $confirmationError = 'Merci d\'entrer une valeur de bouton valide';
}

$sector = new Sector;
$sectorList = $sector->getSectors();


