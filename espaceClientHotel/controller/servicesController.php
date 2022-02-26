<?php

require 'modele/Database.php';
require 'modele/Service.php';
require 'modele/SubService.php';
require 'modele/subServicesButton.php';

$titleRegex = '/^([A-Za-zÀ-ÖØ-öø-ÿ])+[- .]*$/';
$hourRegex = '/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/';
$priceRegex = '/^[0-9]{1,5}([.-][0-9]{2})?$/';
$boolRegex = '/^[0-1]$/';

session_start();

$service = new Service;

$service->setHotelId($_SESSION['id']);
$checkIfServiceExist = $service->checkIfServicesAdded();
$numberOfServices = $checkIfServiceExist->count;

if ($numberOfServices == 0) {
    $tutoText = 'Ajoutez votre premier service ! Cliquez sur le bouton + afin de proposer un nouveau service à vos clients !';
    $newUser = true;
} else {
    $newUser = false;
}

if (isset($_POST['saveChanges'])) {
    $errorList = [];
    if (!empty($_POST['serviceTitle'])) {
        if (preg_match($titleRegex, $_POST['serviceTitle'])) {
            $serviceTitle = htmlspecialchars($_POST['serviceTitle']);
        } else {
            $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
        }
    } else {
        $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service';
    }


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

    for($i = 0; $i <= (count($_POST['serviceName']) -1); $i++) {
        if (isset($_POST['buttonQuestion' . $i])) {
            var_dump($_POST['buttonQuestion' . $i]);
            if (preg_match($boolRegex, $_POST['buttonQuestion' . $i])) {
                $buttonQuestion[] = htmlspecialchars($_POST['buttonQuestion' . $i]);
                var_dump($buttonQuestion);
                if(!empty($_POST['buttonName'][$i]) && $_POST['buttonQuestion' . $i] == '1'){
                    $buttonName[] = htmlspecialchars($_POST['buttonName'][$i]);
                    var_dump($buttonName);
                } else if(empty($_POST['buttonName'][$i]) && $_POST['buttonQuestion' . $i] == '1'){
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
    
    if(count($errorList) == 0){
        $service->setServiceTitle($serviceTitle);
        $service->addService();
        $serviceId = $service->getServiceId();

        for($i = 0; $i <= (count($checkedServiceName) -1); $i++){
            $subService = new SubService;
            $subService->setTitle($checkedServiceName[$i]);
            $subService->setStartingHour($checkedServiceStartingHour[$i]);
            $subService->setPrice($checkedServicePrice[$i]);
            $subService->setFinishingHour($checkedServiceEndingHour[$i]);
            $subService->setAddButton($buttonQuestion[$i]);
            $subService->setIdService($serviceId);
            $subService->addSubService();
            $subServiceId = $subService->getSubServiceId();
            var_dump($subServiceId);
            if($buttonQuestion[$i] == '1'){
                $subServiceButton = new SubServiceButton;
                $subServiceButton->setButtonValue($buttonName[$i]);
                $subServiceButton->setIdSubService($subServiceId);
                $subServiceButton->insertButtonValue();
            }
       }
    }


}
