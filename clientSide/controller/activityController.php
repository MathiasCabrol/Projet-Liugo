<?php

require 'modele/Database.php';
require 'modele/Services.php';
require 'modele/City.php';

session_start();

$service = new Service;
$city = new City;

$servicesByPage = $service->getAllPartnersServices(1);

foreach($servicesByPage as $selectedService){
    $service->setServiceId($selectedService->id);
    $serviceLowestPrice[$selectedService->id] = $service->getSubServiceLowerPriceFromService()->lowestPrice;
    $city->setCityId($selectedService->cityId);
    $cityName[$selectedService->id] = $city->getCityNameFromCityId();
}