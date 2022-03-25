<?php

session_start();

require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Services.php';
require 'modele/SubService.php';
require 'modele/SubServiceButton.php';

if(isset($_GET['serviceId'])){
    //Instanciation des différentes classes utilisées
    $hotel = new Hotel;
    $service = new Service;
    $subService = new SubService;
    $subServiceButton = new SubServiceButton;
    //Insertion de l'id dans l'instance grace au setter
    $service->setServiceId(htmlspecialchars($_GET['serviceId']));
    //Récupération de l'id de l'hôtel correspon,dant à l'id du service
    $hotelIdOfService = $service->checkIfServiceLinkedToHotel();
    //Si l'id de l'hôtel correspond bien à la variable de session
    if($hotelIdOfService == $_SESSION['hotelId']){
        $hotel->setId(htmlspecialchars($_SESSION['hotelId']));
        $selectedHotelEmail = $hotel->getHotelEmailFromId();
        $selectedService = $service->getServiceByServiceId(htmlspecialchars($_GET['serviceId']));
        //Récupération de toutes les valeurs des sous-services liés au service
        $selectedServiceSS = $subService->getServicesSS(htmlspecialchars($_GET['serviceId']));
        foreach($selectedServiceSS as $subService){
            //Si l'utilisateur avait choisi d'ajouter un bouton dans le sous-service
            if($subService->ssAddButton == 1){
                //ON récupère les valeurs du bouton dans la table associée grâce à l'id du sous-service
                $linkedButton = $subServiceButton->getButtonFromSS($subService->ssId);
                //Création de tableau multidimensionnel avec les valeurs
                $ssButtonArray[$subService->ssId] = [
                    'buttonId' => $linkedButton->bid,
                    'buttonValue' => $linkedButton->bbuttonvalue
                ];
            }
        }
    } //Else à faire avec erreur
}