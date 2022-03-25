<?php

require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Services.php';

session_start();

$hotel = new Hotel;
$service = new Service;

$hotel->setId(htmlspecialchars($_SESSION['hotelId']));
$selectedHotel = $hotel->getHotelInfosFromId();
$selectedDescription = $hotel->getDescription();
$hotelPhone = $selectedHotel->phone;
$hotelPhone = implode(".", str_split($hotelPhone, 2));

$hotelServices = $service->getAllServicesByHotelId(htmlspecialchars($_SESSION['hotelId']));
