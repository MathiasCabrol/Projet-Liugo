<?php
require 'modele/Database.php';
require 'modele/SubService.php';
require 'modele/SubServicesButton.php';
require 'class/Files.php';

$titleRegex = '/^([A-Za-zÀ-ÖØ-öø-ÿ])+[- .]*$/';
$hourRegex = '/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/';
$priceRegex = '/^[0-9]{1,5}([.-][0-9]{2})?$/';
$boolRegex = '/^[0-1]$/';

session_start();

$subService = new SubService;
$errorMessage = 'Une erreur s\'est produite, veuillez réessayer';

if (isset($_GET['id'])) {
    $ssId = htmlspecialchars($_GET['id']);
    $subService->setId($ssId);
    if ($subService->checkIfSubServiceExists()) {
        $selectedSubService = $subService->getSubServiceById($ssId);
        if($selectedSubService->addButton){
            $subServiceButton = new SubServiceButton;
            $subServiceButton->setIdSubService($ssId);
            $buttonValue = $subServiceButton->getButtonValue();
            $buttonId = $subServiceButton->getSingleButtonIDBySS();
        }
    }
} else {
    header('Location: home.php');
    exit;
}

if (isset($_POST['saveModification'])) {
    $errorList = [];
    //Vérifications du champ de titre de service dans le formulaire
    if (!empty($_POST['ssTitle'])) {
        if (preg_match($titleRegex, $_POST['ssTitle'])) {
            $ssTitle = htmlspecialchars($_POST['ssTitle']);
        } else {
            $errorList['ssTitle'] = 'Merci d\'entrer un titre de sous-service valide(tirets et espaces acceptés)';
        }
    } else {
        $errorList['ssTitle'] = 'Merci d\'entrer un titre de sous-service';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['ssStartingHour'])) {
        if (preg_match($hourRegex, $_POST['ssStartingHour'])) {
            $ssStartingHour = htmlspecialchars($_POST['ssStartingHour']);
        } else {
            $errorList['ssStartingHour'][] = 'Merci d\'entrer une heure de début valide';
        }
    } else {
        $errorList['ssStartingHour'] = 'Merci d\'entrer une heure de début';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['ssFinishingHour'])) {
        if (preg_match($hourRegex, $_POST['ssFinishingHour'])) {
            $ssFinishingHour = htmlspecialchars($_POST['ssFinishingHour']);
        } else {
            $errorList['ssFinishingHour'][] = 'Merci d\'entrer une heure de fin valide';
        }
    } else {
        $errorList['ssFinishingHour'] = 'Merci d\'entrer une heure de fin';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['ssPrice'])) {
        if (preg_match($priceRegex, $_POST['ssPrice'])) {
            $ssPrice = htmlspecialchars($_POST['ssPrice']);
        } else {
            $errorList['ssPrice'][] = 'Merci d\'entrer un prix valide';
        }
    } else {
        $errorList['ssPrice'] = 'Merci d\'entrer un prix';
    }

    if($selectedSubService->addButton){
        if (isset($_POST['ssButtonValue'])) {
            if (preg_match($titleRegex, $_POST['ssButtonValue'])) {
                $ssButtonValue = htmlspecialchars($_POST['ssButtonValue']);
            } else {
                $errorList['ssButtonValue'][] = 'Merci d\'entrer une valeur de bouton valide';
            }
        } else {
            $errorList['ssButtonValue'] = 'Merci d\'entrer une valeur de bouton';
        }

        if(!$_FILES['buttonFile']['error'] && count($errorList) == 0){
            $fileCheck = new Files;
            $fileCheck->deleteButtonFile($buttonId);
            $fileCheck->registerButtonFile($_FILES['buttonFile']['tmp_name'], $_FILES['buttonFile']['name'], $buttonId);
        } else {
            $errorList['buttonFile'] = 'Le fichier n\'a pas été téléchargé';
        }
    }
    if(count($errorList) == 0) {
        $subService->setTitle($ssTitle);
        $subService->setStartingHour($ssStartingHour);
        $subService->setFinishingHour($ssFinishingHour);
        $subService->setPrice($ssPrice);
        if($subService->updateSubService()){
            header('Location: modifyService.php?id=' . $subService->getServiceId());
        }
    }
}
