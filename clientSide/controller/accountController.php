<?php

session_start();

require 'modele/Database.php';
require 'modele/Customers.php';

//Instance de l'objet Customer
$customer = new Customer;
$customer->setId(htmlspecialchars($_SESSION['id']));
//Récupération des informations du client
$customerDetails = $customer->getCustomerDetails();

//Si l'utilisateur clique sur le bouton de suppression de compte
if (isset($_POST['deleteConfirm'])) {
    //Si le compte est bien supprimé 
    if ($customer->deleteAccount()) {
        //On détruit la session
        session_destroy();
        //Redirection vers la page d'accueil
        header('Location: ../index.php');
        exit;
        //Si le compte n'est pas supprimé, une erreur est affichée
    } else {
        $deleteError = 'Une erreur est survenue lors de la suppression du compte, veuillez conatcter l\'administrateur';
    }
}

//Si l'utilisateur souhaite se déconnecter
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    //Destruction de la session
    session_destroy();
    //Redirection vers la page d'accueil
    header('Location: ../index.php');
    exit;
}
