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

if(isset($_SESSION['type'])){
    if($_SESSION['type'] == 'partners'){
        $directory = 'partners';
    } else if($_SESSION['type'] == 'hotels'){
        $directory = 'hotels';
    }
}

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

    //Vérifications du champ de de sélection du bouton dans le formulaire
    if(isset($_POST['selectButton'])){
        if (preg_match($boolRegex, $_POST['selectButton'])) {
            $buttonBool = htmlspecialchars($_POST['selectButton']);
            //Si l'utilisateur décide d'ajouter un bouton
            if($_POST['selectButton'] == '1'){
                //Si la valeur du bouton a été renseignée
                if(isset($_POST['ssButtonValue'])){
                    if (preg_match($titleRegex, $_POST['ssButtonValue'])){
                        $buttonValue = htmlspecialchars($_POST['ssButtonValue']);
                    } else {
                        $errorList['ssButtonValue'] = 'Merci d\'entrer une valeur de bouton valide.';
                    }
                //Si la valeur du bouton est vide, afficher un message d'erreur
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

    //Si aucune erreur n'est détectée
    if(count($errorList) == 0){
        $subService->setTitle($ssTitle);
        $subService->setStartingHour($ssStartingHour);
        $subService->setFinishingHour($ssFinishingHour);
        $subService->setPrice($ssPrice);
        $subService->setIdService(htmlspecialchars($_SESSION['serviceId']));
        $subService->setAddButton($buttonBool);
        //Si le sous-service est bien ajouté et que l'utilisateur décide d'ajouter un bouton
        if($subService->addSubService() && $_POST['selectButton'] == '1'){
            //Récupération de l'id du dernier sous-service enregistré
            $lastInsertedId = $subService->getLastInsertedSubService();
            $subServiceButton = new SubServiceButton;
            $subServiceButton->setIdSubService($lastInsertedId);
            $subServiceButton->setButtonValue($buttonValue);
            //Insertion dce la valeur du bouton
            if($subServiceButton->insertButtonValue()){
                //Récupéraiton de l'id du dernier bouton enregistré
                $buttonId = $subServiceButton->getLastInsertedButton();
                $fileCheck = new Files;
                //Si aucune erreur n'est détectée sur le fichier
                if(!$_FILES['buttonFile']['error']){
                    //Enregistrement du fichier
                    $fileCheck->registerButtonFile($_FILES['buttonFile']['tmp_name'], $_FILES['buttonFile']['name'], $buttonId, $directory);
                }
            }
            //Message de réussite de l'ajout pour vue
            $successMessage = 'Le sous-service a bien été ajouté';
        }

    }
}