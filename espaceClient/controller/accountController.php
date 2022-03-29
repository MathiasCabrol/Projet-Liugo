<?php

require 'modele/Database.php';
require 'modele/Account.php';
require 'modele/Hotels.php';
require 'modele/Partners.php';
require 'modele/Cities.php';
require 'modele/Booking.php';
require 'class/Files.php';


session_start();

//Si le compte est un partenaire, on instancie l'objet Partner
if ($_SESSION['type'] == 'partners') {
    $account = new Partner;
    //Si le compte est un partenaire, on instancie l'objet Hotel
} elseif ($_SESSION['type'] == 'hotels') {
    $account = new Hotel;
}

//On récupère le nom de la session qui correspond également au nom du dossier
$dirName = $_SESSION['type'];

$account->setId(htmlspecialchars($_SESSION['id']));
//Récupération des données du compte
$selectedAccountInfos = $account->getAccountInfosById();
$city = new City;
$city->setId($selectedAccountInfos->id_cities);
//Récupération du nom de la ville qui correspond à l'id
$selectedCity = $city->getCityNameFromId();

//Si l'utilisateur souhaite se déconnecter
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    //Destruction de la session
    session_destroy();
    //Redirection
    header('Location: ../proSide/homepage.php');
    exit;
}

//Si l'utilisateur souhaite supprimer son compte
if (isset($_POST['deleteConfirm'])) {
    //Suppression du compte
    $account->deleteAccount();
    $fileCheck = new Files;
    //Suppression des fichiers ainsi que du dossier concernant l'utilisateur
    $fileCheck->rrmdir($dirName . '/' . $_SESSION['login']);
    session_destroy();
    header('Location: ../proSide/homepage.php');
    exit;
}

//Si l'utilisateur souhaite consulter le sstatistiques
if (isset($_GET['action']) && $_GET['action'] == 'stats') {
    $booking = new Booking;
    $booking->setPartnerId(htmlspecialchars($_SESSION['id']));
    //Récupération des données des réservations confirmées
    $confirmedBookingsData = $booking->getConfirmedBookingsData();
    //Récupération des données des réservations annulées
    $canceledBookingsData = $booking->getCanceledBookingsData();
}
