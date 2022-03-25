<?php

require '../modele/Database.php';
require '../modele/Services.php';
require '../class/Slugify.php';
require '../modele/City.php';

$searchRegex = '/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'!._\s-]{2,50}$/';

// Si le bouton de recherche est utilisé
if(isset($_POST['search'])){
    if(!empty($_POST['search'])){
        if(preg_match($searchRegex, $_POST['search'])){
            $search = htmlspecialchars($_POST['search']);
        } else {
            //Le message d'erreur est renvoyé en réponse au JS en AJAX
            $searchErrorMessage = 'Merci d\'insérer une recherche valide';
            echo $searchErrorMessage;
        }
    } else {
        //Le message d'erreur est renvoyé en réponse au JS en AJAX
        $searchErrorMessage = 'Merci d\'insérer une valeur dans le champ de recherche';
        echo $searchErrorMessage;
    }
}

//Si il n'y a uncun message d'erreur
if(!isset($searchErrorMessage) && isset($_POST['search'])){
    //Instanciation des différentes classes
    $slug = new Slug;
    $service = new Service;
    $city = new City;
    //Slug du résultat
    $sluggedResult = $slug->slugify($search);
    //Recherche de correspondance avec les slugs des services
    $searchedServices = $service->searchService($sluggedResult, 1);

//Création d'un tableau vide
$jsonTable = array();

//Pour chaque service trouvé dans la recherche
foreach ($searchedServices as $selectedService) {
    $service->setServiceId($selectedService->id);
    //Révupération du prix le plus bas
    $serviceLowestPrice[$selectedService->id] = $service->getSubServiceLowerPriceFromService()->lowestPrice;
    $city->setCityId($selectedService->cityId);
    //Récupéraiton du nom de la ville avec l'id
    $cityName[$selectedService->id] = $city->getCityNameFromCityId();
    //Création du fichier JSON
    array_push($jsonTable, array(
        'id' => $selectedService->id,
        'title' => $selectedService->title,
        'partnerEmail' => $selectedService->partnerEmail,
        'partnerName' => $selectedService->partnerName,
        'serviceLowestPrice' => $serviceLowestPrice[$selectedService->id],
        'cityName' => $cityName[$selectedService->id]
    ));
}
//Encodage et envoi en AJAX
$json = json_encode($jsonTable);
echo $json;

}