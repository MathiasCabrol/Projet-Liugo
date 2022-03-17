<?php

require 'modele/Database.php';
require 'modele/Services.php';
require 'class/SLugify.php';

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

if(!isset($searchErrorMessage)){
    $slug = new Slug;
    $service = new Service;
    $sluggedResult = $slug->slugify($search);
    $servicesByPage = $service->searchService($sluggedResult, 1);
}