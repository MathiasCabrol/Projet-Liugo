<?php


if (isset($_POST['postCode'])) {
    require '../model/Database.php';
    require '../model/Sector.php';
    require '../model/City.php';
} else {
    require 'model/Database.php';
    require 'model/Sector.php';
    require 'model/City.php';
    require 'model/Account.php';
}

session_start();

if (isset($_GET['type'])) {
    $_SESSION['type'] = $_GET['type'];
}


$phoneRegex = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$adressRegex = '/^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/';
$postCodeRegex = '/^[0-9]{5}$/';

//Création du tableau vide de listes d'erreurs

if (isset($_POST['confirm']) && $_POST['confirm'] == "confirmer") {

    $errorList = [];

    //Définition des erreurs du champ 'téléphone'

    if ($_SESSION['type'] == 'presta') {
        if (!empty($_POST['sector'])) {
            if (!checkIfSectorExists($_POST['sector'])) {
                $errorList['sector'] = 'Merci d\'entrer un secteur valide.';
            } else {
                $sector = htmlspecialchars($_POST['sector']);
            }
        } else {
            $errorList['sector'] = 'Veuillez entrer un numéro de téléphone.';
        }
    }

    function checkIfSectorExists($value): bool
    {
        $sectorArray = ['restauration', 'indoor', 'outdoor', 'transport', 'mixte'];
        return in_array($value, $sectorArray);
    }

    //Définition des erreurs du champ 'téléphone'

    if (!empty($_POST['phoneInput'])) {
        if (!preg_match($phoneRegex, $_POST['phoneInput'])) {
            $errorList['phoneInput'] = 'Merci d\'entrer un numéro de téléphone avec unnformat valide.';
        } else {
            $phone = htmlspecialchars($_POST['phoneInput']);
        }
    } else {
        $errorList['phoneInput'] = 'Veuillez entrer un numéro de téléphone.';
    }

    //Définition des erreurs du champ 'adresse'

    if (!empty($_POST['addressInput'])) {
        if (!preg_match($adressRegex, $_POST['addressInput'])) {
            $errorList['addressInput'] = 'Merci d\'entrer une adresse valide.';
        } else {
            $address = htmlspecialchars($_POST['addressInput']);
        }
    } else {
        $errorList['addressInput'] = 'Merci d\'entrer une adresse';
    }

    //Définition des erreurs du champ 'code postal'

    if (!empty($_POST['postCodeInput'])) {
        if (!preg_match($postCodeRegex, $_POST['postCodeInput'])) {
            $errorList['postCodeInput'] = 'Merci d\'entrer un code postal valide (5 chiffres).';
        } else {
            $postCode = htmlspecialchars($_POST['postCodeInput']);
        }
    } else {
        $errorList['postCodeInput'] = 'Merci d\'entrer un code postal.';
    }

    //Définition des erreurs du champ 'ville'

    if (!empty($_POST['city'])) {
        $city = htmlspecialchars($_POST['city']);
    } else {
        $errorList['city'] = 'Merci d\'entrer une ville.';
    }

    if (isset($_GET['token'])) {
        $account = new Account;
        //Vérification préalable du type de compte
        if ($_SESSION['type'] == 'presta') {
            $account->setTable('partners');
        } else if ($_SESSION['type'] == 'hotel') {
            $account->setTable('hotels');
            $header = '../espaceClientHotel/home.php';
        }
        $account->setToken(htmlspecialchars($_GET['token']));
        $result = $account->checkToken();
        if ($result->result) {
            $token = $_GET['token'];
        } else {
            $errorList['token'] = 'Le jeton unique d\'identification ne correspond à aucun compte';
        }
    } else {
        $errorList['token'] = 'Aucun jeton unique n\'est reconnu, merci d\'utiliser à nouveau le lien fourni par email.';
    }

    //Si il n'y a pas d'erreur, j'envois mes données
    if (count($errorList) == 0) {
        $email = $account->getEmailFromToken();
        $account->setEmail($email->email);
        if ($_SESSION['type'] == 'presta') {
            $account->setSector($sector);
        }
        $account->setPhone($phone);
        $account->setAddress($address);
        $account->setPostCode($postCode);
        $account->setIdCities($city);
        $check = $account->checkIfPhoneIsNull();
        if ($check->result) {
            if ($_SESSION['type'] == 'presta') {
                if ($account->subscriptionFinalisationPartners()) {
                    $account->setTokenNull();
                }
            } else if ($_SESSION['type'] == 'hotel') {
                if ($account->subscriptionFinalisationHotels()) {
                    if($account->setTokenNull()){
                        header('Location: ../espaceClientHotel/home.php');
                    }
                }
            }
        } else {
            $errorList['account'] = 'Vous avez déja renseignées ces informations, merci de vous connecter.';
        }
    }
} else {
    $confirmationError = 'Merci d\'entrer une valeur de bouton valide';
}




//Envoi de la corrsepondance entre le code postal et le nom de la ville dans la base de données en ajax à javascript 

if (isset($_POST['postCode'])) {
    $city = new City;
    $city->setPostCode(htmlspecialchars($_POST['postCode']));
    $postCodeCity = $city->getCorespondingCity();
    // encode array to json

    $jsonTable = array();

    foreach ($postCodeCity as $city) {
        array_push($jsonTable, array(
            'id' => $city->ville_id,
            'city' => $city->city
        ));
    }
    $json = json_encode($jsonTable);
    echo $json;
}

$sector = new Sector;
$sectorList = $sector->getSectors();

