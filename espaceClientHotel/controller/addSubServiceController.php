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

if (isset($_POST['save'])) {
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
            $errorList['ssStartingHour'] = 'Merci d\'entrer une heure de début valide';
        }
    } else {
        $errorList['ssStartingHour'] = 'Merci d\'entrer une heure de début';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['ssFinishingHour'])) {
        if (preg_match($hourRegex, $_POST['ssFinishingHour'])) {
            $ssFinishingHour = htmlspecialchars($_POST['ssFinishingHour']);
        } else {
            $errorList['ssFinishingHour'] = 'Merci d\'entrer une heure de fin valide';
        }
    } else {
        $errorList['ssFinishingHour'] = 'Merci d\'entrer une heure de fin';
    }

    //Vérifications du champ de heure de début dans le formulaire
    if (isset($_POST['ssPrice'])) {
        if (preg_match($priceRegex, $_POST['ssPrice'])) {
            $ssPrice = htmlspecialchars($_POST['ssPrice']);
        } else {
            $errorList['ssPrice'] = 'Merci d\'entrer un prix valide';
        }
    } else {
        $errorList['ssPrice'] = 'Merci d\'entrer un prix';
    }

    if(isset($_POST['selectButton'])){
        if (preg_match($boolRegex, $_POST['selectButton'])) {
            $buttonBool = htmlspecialchars($_POST['selectButton']);
            if($_POST['selectButton'] == '1'){
                if(isset($_POST['ssButtonValue'])){
                    if (preg_match($titleRegex, $_POST['ssButtonValue'])){
                        $buttonValue = htmlspecialchars($_POST['ssButtonValue']);
                    } else {
                        $errorList['ssButtonValue'] = 'Merci d\'entrer une valeur de bouton valide.';
                    }
                } else {
                    $errorList['ssButtonValue'] = 'Merci d\'entrer une valeur de bouton.';
                }
            } elseif($_POST['selectButton'] == '0'){
                unset($_POST['ssButtonValue']);
            }
        } else {
            $errorList['selectButton'] = 'Merci d\'entrer une valeur de bouton valide';
        }
    } else {
        $errorList['selectButton'] = 'Merci de sélectionner un bouton';
    }

    if($_FILES['buttonFile']['error']){
        $erroList['buttonFiles'] = 'Le fichier n\'a pas été téléchargé.';
    }

    if(count($errorList) == 0){
        $subService->setTitle($ssTitle);
        $subService->setStartingHour($ssStartingHour);
        $subService->setFinishingHour($ssFinishingHour);
        $subService->setPrice($ssPrice);
        $subService->setIdService(htmlspecialchars($_SESSION['serviceId']));
        $subService->setAddButton($buttonBool);
        if($subService->addSubService() && $_POST['selectButton'] == '1'){
            $lastInsertedId = $subService->getLastInsertedSubService();
            $subServiceButton = new SubServiceButton;
            $subServiceButton->setIdSubService($lastInsertedId);
            $subServiceButton->setButtonValue($buttonValue);
            if($subServiceButton->insertButtonValue()){
                $buttonId = $subServiceButton->getLastInsertedButton();
                $fileCheck = new Files;
                if(!$_FILES['buttonFile']['error']){
                    $fileCheck->registerButtonFile($_FILES['buttonFile']['tmp_name'], $_FILES['buttonFile']['name'], $buttonId);
                }
            }
            $successMessage = 'Le sous-service a bien été ajouté';
        }

    }
}