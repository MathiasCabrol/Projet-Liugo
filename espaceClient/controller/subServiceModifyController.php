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

if($_SESSION['type'] == 'partners'){
    $dir = 'partners';
} else if($_SESSION['type'] == 'hotels'){
    $dir = 'hotels';
}

$subService = new SubService;
$errorMessage = 'Une erreur s\'est produite, veuillez réessayer';

//Si le paramètre id existe
if (isset($_GET['id'])) {
    $ssId = htmlspecialchars($_GET['id']);
    $subService->setId($ssId);
    //Si l'id correspond bien 
    if ($subService->checkIfSubServiceExists()) {
        $selectedSubService = $subService->getSubServiceById($ssId);
        //Si un bouton est bien associé au sous-services
        if($selectedSubService->addButton){
            $subServiceButton = new SubServiceButton;
            $subServiceButton->setIdSubService($ssId);
            $buttonValue = $subServiceButton->getButtonValue();
            $buttonId = $subServiceButton->getSingleButtonIDBySS();
        }
    }
//Si l'id n'est pas paramètré, on redirige vers la page d'accueil
} else {
    header('Location: home.php');
    exit;
}

//Si le sous-service en modifié
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

        //Si aucune erreur de fichier n'est détectée et que le formualaire est entièrement vérifié
        if(!$_FILES['buttonFile']['error'] && count($errorList) == 0){
            $fileCheck = new Files;
            //Suppression du fichier du bouton
            $fileCheck->deleteButtonFile($buttonId, $dir);
            //Enregistrement du nouveau fichier
            $fileCheck->registerButtonFile($_FILES['buttonFile']['tmp_name'], $_FILES['buttonFile']['name'], $buttonId, $dir);
        } else {
            $errorList['buttonFile'] = 'Le fichier n\'a pas été téléchargé';
        }
    }
    //Si l'utilisateur choisi de ne pas ajouter de bouton
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
