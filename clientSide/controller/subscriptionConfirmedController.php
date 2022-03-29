<?php

require 'modele/Database.php';
require 'modele/Customers.php';

session_start();

$errorList = [];

//Si le token est présent dans le paramètre du site
if (isset($_GET['token'])) {
    $customer = new Customer;
    $customer->setToken(htmlspecialchars($_GET['token']));
    //On vérifie si le token correspond
    $result = $customer->checkToken();
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
    //Récupération de l'adresse e-mail et de l'id
    $customerInfos = $customer->getIdAndEmailFromToken();
    $customer->setEmail($customerInfos->email);
    //Si le token est bien devenu nul et donc la vérification validée
    if ($customer->setTokenNull()) {
        //Insertion des valeurs dans la superglobale de SESSION
        $_SESSION['id'] = $customerInfos->id;
        $_SESSION['login'] = $customerInfos->email;
        //Variable de vérification
        $tokenChecks = true;
    } else {
        $tokenChecks = false;
    }
}
