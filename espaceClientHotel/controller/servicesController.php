<?php

require 'modele/Database.php';
require 'modele/Service.php';
require 'modele/SubService.php';
require 'modele/subServicesButton.php';
require 'class/Files.php';

//Regex pour gestion du formulaire
$titleRegex = '/^([A-Za-zÀ-ÖØ-öø-ÿ])+[- .]*$/';
$hourRegex = '/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/';
$priceRegex = '/^[0-9]{1,5}([.-][0-9]{2})?$/';
$boolRegex = '/^[0-1]$/';

//Début de session
session_start();

var_dump($_SESSION);

//Instance de la classe de gestion de fichiers
$fileCheck = new Files;
//Instance de la classe modele service
$service = new Service;

//Paramètrage de l'id dans la classe de gestion des services
$service->setHotelId($_SESSION['id']);
//Vérifiation de service déja créé pôur affichage
$checkIfServiceExist = $service->checkIfServicesAdded();
//Nombre de services déja créés
$numberOfServices = $checkIfServiceExist->count;

//Conditions pour affichage
if ($numberOfServices == 0) {
    $tutoText = 'Ajoutez votre premier service ! Cliquez sur le bouton + afin de proposer un nouveau service à vos clients !';
    $newUser = true;
} else {
    $newUser = false;
}

if(isset($_GET['action']) && $_SERVER['PHP_SELF'] == '/espaceClientHotel/services.php'){
    if($_GET['action'] == 'delete'){
        if(isset($_GET['id'])){
            $service->setServiceId(htmlspecialchars($_GET['id']));
            if($service->checkIfServiceExists()){
                $service->deleteService();
            }
        }
    } elseif($_GET['action'] == 'modify'){
        if(isset($_GET['id'])){
            $service->setServiceId(htmlspecialchars($_GET['id']));
            if($service->checkIfServiceExists()){
                $_SESSION['serviceId'] = htmlspecialchars($_GET['id']);
                header('location: modifyService.php');
            }
        }
    }
}

//Récupération des données pour affichage si l'utilisateur a déja créé des services
if(!$newUser && $_SERVER['PHP_SELF'] == '/espaceClientHotel/services.php'){
    var_dump($service->getAllServices($service->getHotelId()));
    $servicesInfos = $service->getAllServices($service->getHotelId());
    $files = scandir('hotels/' . $_SESSION['login'] . '\/category/');
    $files = array_splice($files, 2);
    $fileCheck->setFilesArray($files);
    foreach($servicesInfos as $info){
        $subService = new subService;
        $subServicesInfos[$info->id] = $subService->getAllSubServices($info->id);
        $returnedFile = $fileCheck->returnFile($info->id);
        $returnedFileArray = explode('.', $returnedFile);
        $extension[$info->id] = end($returnedFileArray);
    }
}

if (isset($_POST['saveChanges'])) {
    $errorList = [];

    //Gestion du fichier
    //Décflaration d'un tableau contenant le nom des fichiers ainsi que les messages d'erreur
    $filesArray = ['categoryPhoto' => 'Merci d\'insérer une photo de service'];
    //Si le dossier du client n'existe pas, on le crée en utilisant son login
    if (!is_dir('hotels/' . $_SESSION['login'] . '\/category/')) {
        mkdir('hotels/' . $_SESSION['login'] . '\/category/', 0777, true);
    }
    //Détermination du chemin pour l'ajout des fichiers
    $path = 'hotels/' . $_SESSION['login'] . '\/category/';
    //Tableau qui retourne tous les fichiers dans le dossier du client
    $files = scandir($path);
    //Suppression des deux premiers indexs qui retournent respectivement "." et ".."
    $files = array_splice($files, 2);
    //Différents setters de la classe Files.php
    $fileCheck->setLogin($_SESSION['login']);
    $fileCheck->setFilesArray($files);
    /* Utilisation du tableau déclaré plus haut, pour chaque fichier, si l'on ne rencontre pas 
    d'erreur lors du téléchargement, insérer le fichier dans le dossier, sinon créer un message d'erreur correspondant */
    foreach ($filesArray as $fileName => $errorMessage) {
        if (!$_FILES[$fileName]['error']) {
            $fileCheck->registrationChecks($fileName, $path);
        } else {
            $errorList[$fileName] = $errorMessage;
        }
    }

    //Vérifications du champ de titre de service dans le formulaire
    if (!empty($_POST['serviceTitle'])) {
        if (preg_match($titleRegex, $_POST['serviceTitle'])) {
            $serviceTitle = htmlspecialchars($_POST['serviceTitle']);
        } else {
            $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
        }
    } else {
        $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service';
    }

    //Vérifications du champ de titre de sous-service dans le formulaire
    if (isset($_POST['serviceName'])) {
        foreach ($_POST['serviceName'] as $serviceName) {
            if (!empty($serviceName)) {
                if (preg_match($titleRegex, $serviceName)) {
                    $checkedServiceName[] = htmlspecialchars($serviceName);
                } else {
                    $errorList['serviceName'][] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
                }
            }
        }
    } else {
        $errorList['serviceName'] = 'Merci d\'entrer un nom de sous-service';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['serviceStartingHour'])) {
        foreach ($_POST['serviceStartingHour'] as $serviceStartingHour) {
            if (!empty($serviceStartingHour)) {
                if (preg_match($hourRegex, $serviceStartingHour)) {
                    $checkedServiceStartingHour[] = htmlspecialchars($serviceStartingHour);
                } else {
                    $errorList['serviceStartingHour'][] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
                }
            }
        }
    } else {
        $errorList['serviceStartingHour'] = 'Merci d\'entrer une heure de début';
    }

    //Vérifications du champ de prix dans le formulaire
    if (isset($_POST['servicePrice'])) {
        foreach ($_POST['servicePrice'] as $servicePrice) {
            if (!empty($servicePrice)) {
                if (preg_match($priceRegex, $servicePrice)) {
                    $checkedServicePrice[] = htmlspecialchars($servicePrice);
                } else {
                    $errorList['servicePrice'][] = 'Merci d\'entrer un prix valide';
                }
            }
        }
    } else {
        $errorList['servicePrice'] = 'Merci d\'entrer une heure de début';
    }

    //Vérifications du champ de heure de fin dans le formulaire
    if (isset($_POST['serviceEndingHour'])) {
        foreach ($_POST['serviceEndingHour'] as $serviceEndingHour) {
            if (!empty($serviceEndingHour)) {
                if (preg_match($hourRegex, $serviceEndingHour)) {
                    $checkedServiceEndingHour[] = htmlspecialchars($serviceEndingHour);
                } else {
                    $errorList['serviceEndingHour'][] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
                }
            }
        }
    } else {
        $errorList['serviceEndingHour'] = 'Merci d\'entrer une heure de début';
    }

    //Vérification des champs de sous-services en fonction de leur quantité personalisable
    for ($i = 0; $i <= (count($_POST['serviceName']) - 1); $i++) {
        if (isset($_POST['buttonQuestion' . $i])) {
            //Vérification regex de la b aleur du bouton radio
            if (preg_match($boolRegex, $_POST['buttonQuestion' . $i])) {
                //Insertion de la valeur (1 ou 0) dans la base de donnée
                $buttonQuestion[] = htmlspecialchars($_POST['buttonQuestion' . $i]);
                //Si l'utilisateur veux ajouter un bouton et que la valeur du nom est entrée
                if (isset($_POST['buttonName'][$i]) && $_POST['buttonQuestion' . $i] == '1') {
                    $buttonName[$i] = htmlspecialchars($_POST['buttonName'][$i]);
                //Si il n'y a pas de valeur entrée dans le nom du bouton    
                } else if (empty($_POST['buttonName'][$i]) && $_POST['buttonQuestion' . $i] == '1') {
                    $errorList['buttonName'][$i] = 'Merci de renseigner le nom du bouton que vous souhaitez ajouter, sinon cocher "non"';
                }
            } else {
                $errorList['buttonQuestion' . $i] = 'Merci d\'entrer une valeur valide dans le bouton de choix.';
            }
        } else {
            $errorList['buttonQuestion' . $i] = 'Merci de cocher une valeur du bouton de choix';
        }
    }

    //On compte le nombre d'erreurs liées au formulaire
    if (count($errorList) == 0) {
        //Ajout du service
        $service->setServiceTitle($serviceTitle);
        $service->addService();
        //Récupération de son id
        $serviceId = $service->getServiceId();
        //On vient renommer le fichier pour que son nom corresponde à l'id du service enregistré par l'utilisateur
        foreach ($filesArray as $fileName => $errorMessage) {
            if (!$_FILES[$fileName]['error']) {
                $fileCheck->renameFile($fileName, $path, $serviceId);
            } else {
                $errorList[$fileName] = $errorMessage;
            }
        }
        //Pour chaque sous-service enregistré
        for ($i = 0; $i <= (count($checkedServiceName) - 1); $i++) {
            //INstance du modele sous-service
            $subService = new SubService;
            //Les différents setter pour chaque tour de boucle
            $subService->setTitle($checkedServiceName[$i]);
            $subService->setStartingHour($checkedServiceStartingHour[$i]);
            $subService->setPrice($checkedServicePrice[$i]);
            $subService->setFinishingHour($checkedServiceEndingHour[$i]);
            $subService->setAddButton($buttonQuestion[$i]);
            $subService->setIdService($serviceId);
            //Ajout du sous-service dans la bdd
            $subService->addSubService();
            //Récupération de l'id du sous-service
            $subServiceId = $subService->getSubServiceId();
            //Si l'utilisateur souhaite ajouter un bouton
            if ($buttonQuestion[$i] == '1') {
                //>Instanciation du modèle bouton sous-service
                $subServiceButton = new SubServiceButton;
                $subServiceButton->setButtonValue($buttonName[$i]);
                $subServiceButton->setIdSubService($subServiceId);
                //INsertion du bouton dans la bdd
                $subServiceButton->insertButtonValue();
            }
        }
    }
}
