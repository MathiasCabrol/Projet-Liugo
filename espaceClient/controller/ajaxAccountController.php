<?php
require '../modele/Database.php';
require '../modele/Account.php';
require '../modele/Hotels.php';
require '../modele/Partners.php';
require '../modele/Cities.php';

session_start();

$regexName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';
$regexMail = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$regexPhone = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$regexAddress = '/^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/';
$regexPostcode = '/^[0-9]{5}$/';

if($_SESSION['type'] == 'partners'){
    $account = new Partner;
} elseif($_SESSION['type'] == 'hotels'){
    $account = new Hotel;
}

$account->setId($_SESSION['id']);


if (isset($_POST['name'])) {
    //Vérification REGEX
    if (preg_match($regexName, $_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $account->setName($name);
        //Mise à jour de l'information
        $account->updateAccountName();
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
    //Vérification REGEX
    if (preg_match($regexMail, $_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $account->setEmail($email);
        //Mise à jour de l'information
        $account->updateAccountEmail();
    } else {
        $errorList['email'] = 'Merci d\'entrer un email valide';
    }
} else {
    $errorList['email'] = 'Merci d\'entrer un email';
}

if (isset($_POST['phone'])) {
    //Vérification REGEX
    if (preg_match($regexPhone, $_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        $account->setPhone($phone);
        //Mise à jour de l'information
        $account->updateAccountPhone();
    } else {
        $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide';
    }
} else {
    $errorList['phone'] = 'Merci d\'entrer un un numéro de téléphone valide';
}

if (isset($_POST['address'])) {
    //Vérification REGEX
    if (preg_match($regexAddress, $_POST['address'])) {
        $address = htmlspecialchars($_POST['address']);
        $account->setAddress($address);
        //Mise à jour de l'information
        $account->updateAccountAddress();
    } else {
        $errorList['address'] = 'Merci d\'entrer une addresse valide';
    }
} else {
    $errorList['address'] = 'Merci d\'entrer une addresse valide';
}

if (isset($_POST['postcode'])) {
    if(isset($_POST['cityId'])){
        //Vérification REGEX
        if (preg_match($regexPostcode, $_POST['postcode'])) {
            $postcode = htmlspecialchars($_POST['postcode']);
            $account->setPostCode($postcode);
            $account->setIdCities(htmlspecialchars($_POST['cityId']));
            //Mise à jour de l'information
            $account->updateAccountPostCode();
        } else {
            $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
        }
    } else {
        $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
    }
} else {
    $errorList['postcode'] = 'Merci d\'entrer un code postal valide';
}

//Génération du SELECT avec choix de nom de ville en AJAX en fonction du code postal
if(isset($_POST['postCodeValue'])){
    $jsonCity = new City;
    $jsonCity->setPostCode(htmlspecialchars($_POST['postCodeValue']));
    $postCodeCity = $jsonCity->getCorespondingCity();
    //Création et envoie en réponse d'un JSON

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
