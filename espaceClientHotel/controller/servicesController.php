<?php

require 'modele/Database.php';
require 'modele/Service.php';

$titleRegex = '/^[\p{L}- ]*$/';

session_start();

var_dump([$_SESSION]);
var_dump($_SESSION['login']);

$service = new Service;

$service->setHotelId($_SESSION['id']);
$checkIfServiceExist = $service->checkIfServicesAdded();
$numberOfServices = $checkIfServiceExist->count;
var_dump($numberOfServices);

if($numberOfServices == 0) {
    $tutoText = 'Ajoutez votre premier service ! CLiquez sur le bouton + afin de proposer un nouveau service à vos clients !';
    $newUser = true;
} else {
    $newUser = false;
}

if(isset($_POST['saveChanges'])){
    $errorList = [];
    var_dump($_POST);
    var_dump($_FILES);
    if(isset($_POST['serviceTitle1'])){
        if(preg_match($titleRegex, $_POST['serviceTitle1'])){
            $servieTitle1 = htmlspecialchars($_POST['serviceTitle1']);
        } else {
            $errorList['category1']['serviceTitle'] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
        }
    } else {
        $errorList['category1']['serviceTitle'] = 'Merci d\'entrer un titre de service';
    }
}