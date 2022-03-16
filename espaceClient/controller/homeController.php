<?php session_start();

var_dump($_SESSION);

require 'class/Files.php';
require 'modele/Database.php';
require 'modele/Account.php';
require 'modele/Presentation.php';
require 'modele/Hotels.php';
require 'modele/Partners.php';
require 'modele/HotelsPresentation.php';
require 'modele/PartnersPresentation.php';

//Regex qui servira aux tests de l'input description
$descriptionRegex = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'._\s-]{10,600}$/';

$presentation = new Presentation;

if($_SESSION['type'] == 'partners'){
    $account = new Partner;
    $presentation = new HotelPresentation;
    $presentation->setIdType(1);
    //Déclaration d'un tableau contenant le nom des fichiers ainsi que les messages d'erreur
$filesArray = ['homePhoto' => 'Merci d\'insérer une photo d\'accueil'];
}elseif($_SESSION['type'] == 'hotels'){
    $account = new Hotel;
    $presentation = new PartnerPresentation;
    $presentation->setIdType(2);
    //Déclaration d'un tableau contenant le nom des fichiers ainsi que les messages d'erreur
    $filesArray = ['homePhoto' => 'Merci d\'insérer une photo d\'accueil', 'activityPhoto' => 'Merci d\'insérer une photo pour la section activités', 'servicePhoto' => 'Merci d\'insérer une photo pour la section service'];
}
$dirName = $_SESSION['type'];

$fileCheck = new Files;

if (isset($_POST['confirm'])) {
    //Création d'un tableau d'erreur vide
    $errorList = [];
    //Si le dossier du client n'existe pas, on le crée en utilisant son login
    if (!is_dir($dirName . '/' . $_SESSION['login'] . '/' . 'home' . '/')) {
        mkdir($dirName . '/' . $_SESSION['login'] . '/' . 'home' . '/', 0777, true);
    }
    //Détermination du chemin pour l'ajout des fichiers
    $path = $dirName . '/' . $_SESSION['login'] . '/' . 'home' . '/';
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
    //Si la description est renseignée et que le test de regex est passé, on l'insère dans une variable, sinon un message d'erreur est généré
    if (isset($_POST['description'])) {
        if (preg_match($descriptionRegex, $_POST['description'])) {
            $description = htmlspecialchars($_POST['description']);
        } else {
            $errorList['description'] = 'Merci d\'entrer une description contenant entre 10 et 600 cractères. Les séparateurs, espaces et accents sont acceptés.';
        }
    } else {
        $errorList['description'] = 'Merci d\'entrer une description pour votre établissement.';
    }

    //Si il n'y aucune erreur rencontrée
    if (count($errorList) == 0) {
        //Setter du modele Presentation.php
        $presentation->setDescription($description);
        /* Méthode qui renvoie un objet avec un attribut "result", si celui-ci est égal à 1, alors une description 
        existe déja pour cet id de la table hotels, sinon, aucune description n'était renseignée précédement. */
        $checkIfDescriptionExists = $presentation->checkIfDescriptionIsSet($_SESSION['id']);
        if ($checkIfDescriptionExists->result) {
            //Si une description existe, on la met à jour
            $presentation->updateDescription($_SESSION['id']);
            //$selectedDescription est la variable qui sert d'affichage dans l'exemple vue client
            $SelectedDescription = $presentation->getDescription($_SESSION['id']);
        } else {
            //Si aucune description n'existe, on en ajoute une nouvelle associée à l'id de l'hotel
            $presentation->insertDescription($_SESSION['id']);
            $SelectedDescription = $presentation->getDescription($_SESSION['id']);
        }
    }
}

/* Si le formulaire n'a pas été confirmée et qu'une description existe, on l'attribue à la 
variable $selectedDescription pour afichage dans exemple vue client */ 
if (!isset($_POST['confirm'])) {
    $checkIfDescriptionExists = $presentation->checkIfDescriptionIsSet($_SESSION['id']);
        if ($checkIfDescriptionExists->result) {
    $SelectedDescription = $presentation->getDescription($_SESSION['id']);
    }
}


function is_dir_empty($dir) {
    if (!is_readable($dir)) return null; 
    return (count(scandir($dir)) == 2);
  }


//Si le dossier existe, Pour chaque fichier enregistré, insère le chemin dans le tableau $filePath pour affichage dans exemple vue client
if(is_dir($dirName . '/' . $_SESSION['login'] . '/')){
    if (!is_dir_empty($dirName . '/' . $_SESSION['login'] . '/')) {
        $files = scandir($dirName . '/' . $_SESSION['login'] . '/');
        $files = array_splice($files, 2);
        if(!$files){
            foreach ($filesArray as $fileName => $errorMessage) {
                $fileCheck->setFilesArray($files);
                if ($fileCheck->array_partial_search($fileName)) {
                    $file[$fileName] = $fileCheck->returnFile($fileName);
                    $filePath[$fileName] = $dirName . '/' . $_SESSION['login'] . '/' . $file[$fileName];
                }
            }
        }
}


}


//Utilisation du modele Account.php afin de récupérer le nom de l'établissement pour affichage
$account->setEmail($_SESSION['login']);
$accountName = $account->getAccountNameFromEmail();
