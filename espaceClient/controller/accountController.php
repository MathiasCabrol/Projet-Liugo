<?php

require 'modele/Database.php';
require 'modele/Account.php';
require 'modele/Hotels.php';
require 'modele/Partners.php';
require 'modele/Cities.php';
require 'class/Files.php';


session_start();

var_dump($_SESSION);
var_dump($_POST);

if($_SESSION['type'] == 'partners'){
    $account = new Partner;
} elseif($_SESSION['type'] == 'hotels'){
    $account = new Hotel;
}

$dirName = $_SESSION['type'];

$account->setId(htmlspecialchars($_SESSION['id']));
$selectedAccountInfos = $account->getAccountInfosById();
$city = new City;
$city->setId($selectedAccountInfos->id_cities);
$selectedCity = $city->getCityNameFromId();
var_dump($selectedAccountInfos);


if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header('Location: ../proSide/homepage.php');
    exit;
}

if(isset($_POST['deleteConfirm'])){
    $account->deleteAccount();
    $fileCheck = new Files;
    $fileCheck->rrmdir($dirName . '/' . $_SESSION['login']);
    session_destroy();
    header('Location: ../proSide/homepage.php');
    exit;
}


