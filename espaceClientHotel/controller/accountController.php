<?php

require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Cities.php';

session_start();

var_dump($_SESSION);

$hotel = new Hotel;
$hotel->setId(htmlspecialchars($_SESSION['id']));
$selectedHotelInfos = $hotel->getHotelInfosById();
$city = new City;
$city->setId($selectedHotelInfos->id_cities);
$selectedCity = $city->getCityNameFromId();
var_dump($selectedHotelInfos);




