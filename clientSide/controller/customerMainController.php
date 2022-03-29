<?php

require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Services.php';

session_start();

$hotel = new Hotel;
$service = new Service;

$hotel->setId(htmlspecialchars($_SESSION['hotelId']));
//Récupération des informations de l'établissement hôtelier pour affichage
$selectedHotel = $hotel->getHotelInfosFromId();
$selectedDescription = $hotel->getDescription();
$hotelPhone = $selectedHotel->phone;
//INsertion des points pour la lisibilité
$hotelPhone = implode(".", str_split($hotelPhone, 2));

//Récupération des informations des différents services de l'hotel
$hotelServices = $service->getAllServicesByHotelId(htmlspecialchars($_SESSION['hotelId']));
