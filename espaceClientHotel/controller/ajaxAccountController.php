<?php
require '../modele/Database.php';
require '../modele/Hotel.php';
require '../modele/Cities.php';

session_start();

$regexName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';
$regexMail = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$regexPhone = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$regexAddress = '/^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/';
$regexPostcode = '/^[0-9]{5}$/';

$hotel = new Hotel();
$hotel->setId($_SESSION['id']);


if (isset($_POST['name'])) {
    if (preg_match($regexName, $_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $hotel->setName($name);
        $hotel->updateHotelName();
    } else {
        $errorList['name'] = 'Merci d\'entrer un nom valide';
    }
} else {
    $errorList['name'] = 'Merci d\'entrer un nom';
}

/**
    //TODO: Création de l'envoi de confirmation par email avec génération d'un code aléatoire à 6 caractères
    //! Attention celui-ci doit ensuite être inséré dans un input créé en js pour valider l'identité
 **/

if (isset($_POST['email'])) {
    if (preg_match($regexMail, $_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $hotel->setEmail($email);
        $hotel->updateHotelEmail();
    } else {
        $errorList['email'] = 'Merci d\'entrer un email valide';
    }
} else {
    $errorList['email'] = 'Merci d\'entrer un email';
}

if (isset($_POST['phone'])) {
    if (preg_match($regexPhone, $_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        $hotel->setPhone($phone);
        $hotel->updateHotelPhone();
    } else {
        $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide';
    }
} else {
    $errorList['phone'] = 'Merci d\'entrer un un numéro de téléphone valide';
}

if (isset($_POST['address'])) {
    if (preg_match($regexAddress, $_POST['address'])) {
        $address = htmlspecialchars($_POST['address']);
        $hotel->setAddress($address);
        $hotel->updateHotelAddress();
    } else {
        $errorList['address'] = 'Merci d\'entrer une addresse valide';
    }
} else {
    $errorList['address'] = 'Merci d\'entrer une addresse valide';
}

if (isset($_POST['postcode'])) {
    if(isset($_POST['cityId'])){
        if (preg_match($regexPostcode, $_POST['postcode'])) {
            $postcode = htmlspecialchars($_POST['postcode']);
            $hotel->setPostCode($postcode);
            $hotel->setIdCities(htmlspecialchars($_POST['cityId']));
            $hotel->updateHotelPostCode();
        } else {
            $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
        }
    } else {
        $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
    }
} else {
    $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
}

if(isset($_POST['postCodeValue'])){
    $jsonCity = new City;
    $jsonCity->setPostCode(htmlspecialchars($_POST['postCodeValue']));
    $postCodeCity = $jsonCity->getCorespondingCity();
    // encode array to json

    $jsonTable = array();

    foreach ($postCodeCity as $singleCity) {
        array_push($jsonTable, array(
            'id' => $singleCity->ville_id,
            'city' => $singleCity->city
        ));
    }
    $json = json_encode($jsonTable);
    echo $json;
}
