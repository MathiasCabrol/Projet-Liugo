<?php
require 'modele/Database.php';
require 'modele/SubService.php';
require 'modele/SubServicesButton.php';

session_start();

$subService = new SubService;
$errorMessage = 'Une erreur s\'est produite, veuillez réessayer';

if(isset($_GET['id'])){
    $ssId = htmlspecialchars($_GET['id']);
    $subService->setId($ssId);
    if($subService->checkIfSubServiceExists()){
        $selectedSubService = $subService->getSubServiceById($ssId);
        var_dump($selectedSubService);
    }
} else {
    header('Location: home.php');
}