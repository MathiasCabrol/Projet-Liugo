<?php
require 'modele/Database.php';
require 'modele/Service.php';
require 'modele/PartnersService.php';
require 'modele/HotelsService.php';
require 'modele/SubService.php';
require 'modele/SubServicesButton.php';
require 'class/Files.php';

$titleRegex = '/^([A-Za-zÀ-ÖØ-öø-ÿ])+[- .]*$/';

session_start();

if ($_SESSION['type'] == 'partners') {
    $newService = new PartnerService;
    $dirName = 'partners';
} elseif ($_SESSION['type'] == 'hotels') {
    $newService = new HotelService;
    $dirName = 'hotels';
}

$fileCheck = new Files;
if (isset($_GET['id'])) {
    $serviceId = htmlspecialchars($_GET['id']);
    $_SESSION['serviceId'] = htmlspecialchars($_GET['id']);
}

$serviceId = $_SESSION['serviceId'];
$newService->setServiceId($serviceId);
$serviceInfos = $newService->displayService();
$newSubService = new SubService;
$subServiceInfos = $newSubService->getAllSubServices($serviceInfos->serviceId);
$newSubServiceButton = new SubServiceButton;
foreach ($subServiceInfos as $subService) {
    //Insertion de la valeur des boutons respectifs dans un tableau avec en index l'id du service correspondant
    if ($subService->addButton) {
        $newSubServiceButton->setIdSubService($subService->subServiceId);
        $buttonValue[$subService->subServiceId] = $newSubServiceButton->getButtonValue();
    }
}

//Si l'utilisateur souhaite supprimer le sous-service
if (isset($_GET['delete'])) {
    if ($_GET['delete'] == '1') {
        $infoMessage = 'Le sous-service a bien été supprimé';
    } else {
        $infoMessage = 'Une erreur est survenue lors de la suppression';
    }
}

//Si le paramètre GET est set et que l'utilisateur se trouve sur la bonne page
if (isset($_GET['action'])) {
    //Si le paramètre action est égal à "delete" qui est définis par le clic de l'utilisateur
    if ($_GET['action'] == 'delete') {
        //Si le paramètre id existe et n'a pas été modifié volontairement
        if (isset($_GET['subServiceId'])) {
            //Setter de la classe service correspondant à l'id du service séléctionné
            $newSubService->setId(htmlspecialchars($_GET['subServiceId']));
            //On vérifie si l'id correspond bien dans la base de donnée, retourne 1 en cas de réussite ou 0 en cas d'échec
            if ($newSubService->checkIfSubServiceExists()) {
                $buttonsIds = $newSubServiceButton->getButtonsIdBySubService(htmlspecialchars($_GET['subServiceId']));
                foreach ($buttonsIds as $buttonsId) {
                    $fileCheck->deleteButtonFile($buttonsId->buttonid, $dirName);
                }
                //Suppression du service
                if ($newSubService->deleteSubService()) {
                    header('Location: modifyService.php?id=' . $serviceId . '&delete=1');
                    exit;
                }
            } else {
                //Si l'id ne correspond à aucune ligne dans la table, affichage d'un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
        //Si le paramètre action et égal à "modify"
    } elseif ($_GET['action'] == 'modify') {
        if (isset($_GET['subServiceId'])) {
            //Setter de la classe service
            $newSubService->setId(htmlspecialchars($_GET['subServiceId']));
            //On vérifie si le service existe dans la bdd
            if ($newSubService->checkIfSubServiceExists()) {
                //On redirige vers la page de modification de service en insérant en paramètre GET l'id du service à modifier
                header('location: modifySubService.php?id=' . $_GET['subServiceId']);
            } else {
                //Si l'id n'existe pas, on affiche un message d'erreur
                $getErrorMessage = 'Une erreur a été détéctée, veuillez réessayer.';
            }
        }
    }
}

//Si le service est modifié
if (isset($_POST['saveChanges'])) {
    $fileCheck = new Files;
    $errorList = [];
    $fileError = [];
    $fileName = 'categoryPhoto';
    //Si le nouveau fichier ne contient pas d'erreur
    if (!$_FILES[$fileName]['error']) {
        //Suppression du fichier précédent
        $fileCheck->deleteCategoryFile($serviceId, $dirName);
        //Ajout du nouveau fichier
        $fileCheck->registerCategoryFile($_FILES[$fileName]['tmp_name'], $_FILES[$fileName]['name'], $serviceId, $dirName);
    } else {
        //Sinon on génère un message d'erreur dans un tableau avec en index le nom du fichier
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

    //Si aucune erreur n'est présente
    if (count($errorList) == 0) {
        $newService->setServiceId($serviceId);
        $newService->setServiceTitle($serviceTitle);
        //Mise à jour du service
        if ($newService->updateServiceTitle()){ 
            //Message de confirmation
            $successMessage = 'Le service a bien été modifié';
        } else {
            //Message d'erreur
            $errorMessage = 'Une erreur est survenue lors de la modification du service.';
        }
    }
}
