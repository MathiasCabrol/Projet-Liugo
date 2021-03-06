<?php

require 'modele/Database.php';
require 'modele/Services.php';
require 'modele/SubService.php';

session_start();

if(isset($_GET['serviceId'])){
    $service = new Service;
    $subService = new SubService;
    $service->setServiceId(htmlspecialchars($_GET['serviceId']));
    //Si le service existe
    if($service->checkIfServiceExists()){
        //ON récupère toutes les informations our affichage
        $selectedServiceInfos = $service->getServiceById();
        $selectedSubServices = $subService->getAllSubServicesFromServiceId($selectedServiceInfos->serviceId);    
    }
    //Récupération des différents horaires pour affichage
    foreach($selectedSubServices as $subService){
        for($i = substr($subService->subServiceStartingHour, 0, 2); $i < substr($subService->subServiceFinishingHour, 0, 2); $i++){
            if($i < 10){
                $subServiceHourSlots[$subService->subServiceId][] = '0' . $i . ':00';
            } else {
                $subServiceHourSlots[$subService->subServiceId][] = $i . ':00';
            }
        }
    }
}