<?php

//TODO: Création de la gestion de reuête AJAX pour la modification des informations du compte

session_start();

require '../modele/Database.php';
require '../modele/Customers.php';

$regexMail = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$regexPhone = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';

$account = new Customer;

$account->setId($_SESSION['id']);


/**
    //TODO: Création de l'envoi de confirmation par email avec génération d'un code aléatoire à 6 caractères
    //! Attention celui-ci doit ensuite être inséré dans un input créé en js pour valider l'identité
 **/

if (isset($_POST['email'])) {
    if (preg_match($regexMail, $_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $account->setEmail($email);
        echo $account->updateAccountEmail();
    } else {
        $errorList['email'] = 'Merci d\'entrer un email valide';
    }
} else {
    $errorList['email'] = 'Merci d\'entrer un email';
}

if (isset($_POST['phone'])) {
    if (preg_match($regexPhone, $_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        $account->setPhone($phone);
        echo $account->updateAccountPhone();
    } else {
        $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide';
    }
} else {
    $errorList['phone'] = 'Merci d\'entrer un un numéro de téléphone valide';
}
  
