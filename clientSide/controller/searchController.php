<?php

require '../modele/Database.php';
require '../modele/Services.php';
require '../class/Slugify.php';
require '../modele/City.php';

$searchRegex = '/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'!._\s-]{2,50}$/';

if(isset($_POST['search'])){
    if(!empty($_POST['search'])){
        if(preg_match($searchRegex, $_POST['search'])){
            $search = htmlspecialchars($_POST['search']);
        } else {
            $searchErrorMessage = 'Merci d\'insérer une recherche valide';
            echo $searchErrorMessage;
        }
    } else {
        $searchErrorMessage = 'Merci d\'insérer une valeur dans le champ de recherche';
        echo $searchErrorMessage;
    }
}

if(!isset($searchErrorMessage) && isset($_POST['search'])){
    $slug = new Slug;
    $service = new Service;
    $city = new City;
    $sluggedResult = $slug->slugify($search);
    $searchedServices = $service->searchService($sluggedResult, 1);

// encode array to json

$jsonTable = array();

foreach ($searchedServices as $selectedService) {
    $service->setServiceId($selectedService->id);
    $serviceLowestPrice[$selectedService->id] = $service->getSubServiceLowerPriceFromService()->lowestPrice;
    $city->setCityId($selectedService->cityId);
    $cityName[$selectedService->id] = $city->getCityNameFromCityId();
    array_push($jsonTable, array(
        'id' => $selectedService->id,
        'title' => $selectedService->title,
        'partnerEmail' => $selectedService->partnerEmail,
        'partnerName' => $selectedService->partnerName,
        'serviceLowestPrice' => $serviceLowestPrice[$selectedService->id],
        'cityName' => $cityName[$selectedService->id]
    ));
}
$json = json_encode($jsonTable);
echo $json;

}