<?php

require 'modele/Database.php';
require 'modele/Customers.php';

session_start();

$errorList = [];

if (isset($_GET['token'])) {
    $customer = new Customer;
    $customer->setToken(htmlspecialchars($_GET['token']));
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
    $customerInfos = $customer->getIdAndEmailFromToken();
    var_dump($customerInfos->email);
    $customer->setEmail($customerInfos->email);
    var_dump($customer->setTokenNull());
    if ($customer->setTokenNull()) {
        $_SESSION['id'] = $customerInfos->id;
        $_SESSION['login'] = $customerInfos->email;
        $tokenChecks = true;
    } else {
        $tokenChecks = false;
    }
}
