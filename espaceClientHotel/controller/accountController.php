<?php

require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Cities.php';


session_start();

var_dump($_SESSION);
var_dump($_POST);

$hotel = new Hotel;
$hotel->setId(htmlspecialchars($_SESSION['id']));
$selectedHotelInfos = $hotel->getHotelInfosById();
$city = new City;
$city->setId($selectedHotelInfos->id_cities);
$selectedCity = $city->getCityNameFromId();
var_dump($selectedHotelInfos);


if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header('Location: ../proSide/homepage.php');
    exit;
}

if(isset($_POST['deleteConfirm'])){
    $hotel->deleteHotel();
    header('Location: ../proSide/homepage.php');
    exit;
}


