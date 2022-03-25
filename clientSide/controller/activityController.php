<?php

require 'modele/Database.php';
require 'modele/Services.php';
require 'modele/City.php';

session_start();

$service = new Service;
$city = new City;

$servicesByPage = $service->getAllPartnersServices(1);

//Pour chaque service par page
foreach($servicesByPage as $selectedService){
    $service->setServiceId($selectedService->id);
    //Récupération du prix le plus bas des sous-services rattachés pour affichage
    $serviceLowestPrice[$selectedService->id] = $service->getSubServiceLowerPriceFromService()->lowestPrice;
    $city->setCityId($selectedService->cityId);
    //Récupération du nom de la ville par l'id
    $cityName[$selectedService->id] = $city->getCityNameFromCityId();
}