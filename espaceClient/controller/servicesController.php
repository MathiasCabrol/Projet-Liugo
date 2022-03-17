<?php

require 'modele/Database.php';
require 'modele/Service.php';
require 'modele/SubService.php';
require 'modele/SubServicesButton.php';
require 'modele/PartnersService.php';
require 'modele/HotelsService.php';
require 'class/Files.php';
require 'class/Slugify.php';

//Regex pour gestion du formulaire
$titleRegex = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'._\s-]{2,50}$/';
$hourRegex = '/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/';
$priceRegex = '/^[0-9]{1,5}([.-][0-9]{2})?$/';
$boolRegex = '/^[0-1]$/';

//Début de session
session_start();

var_dump($_SESSION);

//Instance de la classe de gestion de fichiers
$fileCheck = new Files;

if ($_SESSION['type'] == 'partners') {
    $service = new PartnerService;
    $dirName = 'partners';
} elseif ($_SESSION['type'] == 'hotels') {
    $service = new HotelService;
    $dirName = 'hotels';
}

//Paramètrage de l'id dans la classe de gestion des services
$service->setAccountId($_SESSION['id']);
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

//Si le paramètre GET est set et que l'utilisateur se trouve sur la bonne page
if (isset($_GET['action']) && $_SERVER['PHP_SELF'] == '/espaceClient/services.php') {
    //Si le paramètre action est égal à "delete" qui est définis par le clic de l'utilisateur
    if ($_GET['action'] == 'delete') {
        //Si le paramètre id existe et n'a pas été modifié volontairement
        if (isset($_GET['id'])) {
            $serviceId = htmlspecialchars($_GET['id']);
            //Setter de la classe service correspondant à l'id du service séléctionné
            $service->setServiceId($serviceId);
            //On vérifie si l'id correspond bien dans la base de donnée, retourne 1 en cas de réussite ou 0 en cas d'échec
            if ($service->checkIfServiceExists()) {
                //Récupération de l'id des boutons liés au service
                $subServicesButtonsIds = new SubServiceButton;
                $selectedButtons = $subServicesButtonsIds->getButtonsIdByService($serviceId);
                //Suppression du service
                $service->deleteService();
                //Suppression de l'image liée à ce service
                $fileCheck->deleteCategoryFile($serviceId, $dirName);
                //Suppresion des images liées aux boutons de ce service
                var_dump($selectedButtons);
                foreach ($selectedButtons as $subServiceButton) {
                    $fileCheck->deleteButtonFile($subServiceButton->buttonid, $dirName);
                }
            } else {
                //Si l'id ne correspond à aucune ligne dans la table, affichage d'un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
        //Si le paramètre action et égal à "modify"
    } elseif ($_GET['action'] == 'modify') {
        if (isset($_GET['id'])) {
            //Setter de la classe service
            $service->setServiceId(htmlspecialchars($_GET['id']));
            //On vérifie si le service existe dans la bdd
            if ($service->checkIfServiceExists()) {
                //On redirige vers la page de modification de service en insérant en paramètre GET l'id du service à modifier
                header('location: modifyService.php?id=' . $_GET['id']);
                exit;
            } else {
                //Si l'id n'existe pas, on affiche un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
    }
}

//Récupération des données pour affichage si l'utilisateur a déja créé des services
if (!$newUser && $_SERVER['PHP_SELF'] == '/espaceClient/services.php') {
    //Récupération des différents services en fonction de l'id de l'hotel pour affichage
    $servicesInfos = $service->getAllServices($service->getHotelId());
    //Scan du dossier dans lequel sont enregistrés les images des services
    $files = scandir($dirName . '/' . $_SESSION['login'] . '\/category/');
    //Supression des deux premiers index du tableau, égaux à "." et ".."
    $files = array_splice($files, 2);
    //Utilisation du setter de la classe Files
    $fileCheck->setFilesArray($files);
    //Pour chaque service, récupération de l'extension pour affichage
    foreach ($servicesInfos as $info) {
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
    if (!is_dir($dirName . '/' . $_SESSION['login'] . '\/category/')) {
        mkdir($dirName . '/' . $_SESSION['login'] . '\/category/', 0777, true);
    }
    //Détermination du chemin pour l'ajout des fichiers
    $path = $dirName . '/' . $_SESSION['login'] . '\/category/';
    //Tableau qui retourne tous les fichiers dans le dossier du client
    $files = scandir($path);
    //Suppression des deux premiers indexs qui retournent respectivement "." et ".."
    $files = array_splice($files, 2);
    //Différents setters de la classe Files.php
    $fileCheck->setLogin($_SESSION['login']);
    $fileCheck->setFilesArray($files);

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

    var_dump($errorList);

    //On compte le nombre d'erreurs liées au formulaire
    if (count($errorList) == 0) {
        //Ajout du service
        $service->setServiceTitle($serviceTitle);
        //Instance de la classe permettant la création du slug
        $slugify = new Slug;
        //Transformation du titre du service en slug
        $serviceSlug = $slugify->slugify($serviceTitle);
        $service->setSlug($serviceSlug);
        $service->addService();
        //Récupération de son id
        $serviceId = $service->getServiceId();
        /* Utilisation du tableau déclaré plus haut, pour chaque fichier, si l'on ne rencontre pas 
        d'erreur lors du téléchargement, insérer le fichier dans le dossier, sinon créer un message d'erreur correspondant */
        foreach ($filesArray as $fileName => $errorMessage) {
            if (!$_FILES[$fileName]['error']) {
                $fileCheck->fileRegistration($fileName, $path);
            } else {
                $errorList[$fileName] = $errorMessage;
            }
        }
        //On vient renommer le fichier pour que son nom corresponde à l'id du service enregistré par l'utilisateur
        foreach ($filesArray as $fileName => $errorMessage) {
            if (!$_FILES[$fileName]['error']) {
                $fileCheck->renameFile($fileName, $path, $serviceId, $dirName);
            } else {
                $errorList[$fileName] = $errorMessage;
            }
        }
        //Pour chaque sous-service enregistré
        for ($i = 0; $i < (count($checkedServiceName)); $i++) {
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
            if ($subService->addSubService()) {
                //Récupération de l'id du sous-service
                $subServiceId = $subService->getSubServiceId();
                //Si l'utilisateur souhaite ajouter un bouton
                if ($buttonQuestion[$i] == '1') {
                    var_dump('bonjour');
                    //Instanciation du modèle bouton sous-service
                    $subServiceButton = new SubServiceButton;
                    $subServiceButton->setButtonValue($buttonName[$i]);
                    $subServiceButton->setIdSubService($subServiceId);
                    //INsertion du bouton dans la bdd
                    if ($subServiceButton->insertButtonValue()) {
                        if (!is_dir($dirName . '/' . $_SESSION['login'] . '\/buttonFiles/')) {
                            mkdir($dirName . '/' . $_SESSION['login'] . '\/buttonFiles/', 0777, true);
                        }
                        $buttonId = $subServiceButton->getLastInsertedButton();
                        $fileCheck->registerButtonFile($_FILES['buttonFile']['tmp_name'][$i], $_FILES['buttonFile']['name'][$i], $buttonId, $dirName);
                    }
                }
            }
        }
        header('Location: services.php');
        exit;
    }
}
