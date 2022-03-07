<?php
require 'modele/Database.php';
require 'modele/Service.php';
require 'modele/SubService.php';
require 'modele/SubServicesButton.php';
require 'class/Files.php';

$titleRegex = '/^([A-Za-zÀ-ÖØ-öø-ÿ])+[- .]*$/';

session_start();

var_dump($_SESSION);


    $newService = new Service;
    if(!isset($_SESSION['serviceId'])){
        $serviceId = htmlspecialchars($_GET['id']);
    } else {
        $serviceId = $_SESSION['serviceId'];
    }
    $_SESSION['serviceId'] = $serviceId;
    $newService->setServiceId($serviceId);
    $serviceInfos = $newService->displayService();
    $newSubService = new SubService;
    $subServiceInfos = $newSubService->getAllSubServices($serviceInfos->serviceId);
    foreach($subServiceInfos as $subService){
        if($subService->addButton){
            $newSubServiceButton = new SubServiceButton;
            $newSubServiceButton->setIdSubService($subService->subServiceId);
            $buttonValue[$subService->subServiceId] = $newSubServiceButton->getButtonValue();
        }
    }

    if(isset($_GET['delete'])){
        if($_GET['delete'] == '1'){
            $infoMessage = 'Le sous-service a bien été supprimé';
        } else {
            $infoMessage = 'Une erreur est survenue lors de la suppression';
        }
    }

    //Si le paramètre GET est set et que l'utilisateur se trouve sur la bonne page
if(isset($_GET['action'])){
    //Si le paramètre action est égal à "delete" qui est définis par le clic de l'utilisateur
    if($_GET['action'] == 'delete'){
        //Si le paramètre id existe et n'a pas été modifié volontairement
        if(isset($_GET['subServiceId'])){
            //Setter de la classe service correspondant à l'id du service séléctionné
            $newSubService->setId(htmlspecialchars($_GET['subServiceId']));
            //On vérifie si l'id correspond bien dans la base de donnée, retourne 1 en cas de réussite ou 0 en cas d'échec
            var_dump($newSubService->checkIfSubServiceExists());
            if($newSubService->checkIfSubServiceExists()){
                //Suppression du service
                if($newSubService->deleteSubService()){
                    header('Location: modifyService.php?id=' . $serviceId . '&delete=1');
                }
            } else {
                //Si l'id ne correspond à aucune ligne dans la table, affichage d'un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
        //Si le paramètre action et égal à "modify"
    } elseif($_GET['action'] == 'modify'){
        if(isset($_GET['subServiceId'])){
            //Setter de la classe service
            $newSubService->setId(htmlspecialchars($_GET['subServiceId']));
            //On vérifie si le service existe dans la bdd
            if($newSubService->checkIfSubServiceExists()){
                //On redirige vers la page de modification de service en insérant en paramètre GET l'id du service à modifier
                header('location: modifySubService.php?id=' . $_GET['subServiceId']);
            } else {
                //Si l'id n'existe pas, on affiche un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
    }
}

    if (isset($_POST['saveChanges'])) {
        $fileCheck = new Files;
        $errorList = [];
        $fileError = [];
        $fileName = 'categoryPhoto';
        if (!$_FILES[$fileName]['error']) {
            $fileCheck->deleteCategoryFile($serviceId);
            $fileCheck->registerCategoryFile($_FILES[$fileName]['tmp_name'], $_FILES[$fileName]['name'], $serviceId);
        } else {
            $fileError[$fileName] = $errorMessage;
        }

        if (!empty($_POST['serviceTitle'])) {
            if (preg_match($titleRegex, $_POST['serviceTitle'])) {
                $serviceTitle = htmlspecialchars($_POST['serviceTitle']);
            } else {
                $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
            }
        } else {
            $errorList['serviceTitle'] = 'Merci d\'entrer un titre de service';
        }

        if(count($errorList) == 0) {
            $newService->setServiceId($serviceId);
            $newService->setServiceTitle($serviceTitle);
            if($newService->updateServiceTitle()){
                $successMessage = 'Le nom du service a bien été modifié';
            } else {
                $errorMessage = 'Une erreur est survenue lors de la modification du nom de service.';
            }   
        }
    }    

    var_dump($newService->displayService());