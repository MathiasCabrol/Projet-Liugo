<?php session_start();

require 'class/Files.php';
require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Presentation.php';

$descriptionRegex = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'._\s-]{10,600}$/';

$fileCheck = new Files;
$presentation = new Presentation();

//Décflaration d'un tableau contenant le nom des fichiers ainsi que les messages d'erreur
$filesArray = ['homePhoto' => 'Merci d\'insérer une photo d\'accueil', 'activityPhoto' => 'Merci d\'insérer une photo pour la section activités', 'servicePhoto' => 'Merci d\'insérer une photo pour la section service',];

if (isset($_POST['confirm'])) {
    $errorList = [];
    if (!is_dir('hotels/' . $_SESSION['login'] . '/')) {
        mkdir('hotels/' . $_SESSION['login'] . '/', 0777, true);
    }
    $path = 'hotels/' . $_SESSION['login'] . '/';
    $files = scandir($path);
    $files = array_splice($files, 2);
    $fileCheck->setLogin($_SESSION['login']);
    $fileCheck->setFilesArray($files);
    foreach ($filesArray as $fileName => $errorMessage) {
        if (!$_FILES[$fileName]['error']) {
            $fileCheck->registrationChecks($fileName);
        } else {
            $errorList[$fileName] = $errorMessage;
        }
    }
    if (isset($_POST['description'])) {
        if (preg_match($descriptionRegex, $_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $errorList['description'] = 'Merci d\'entrer une description contenant entre 10 et 600 cractères. Les séparateurs, espaces et accents sont acceptés.';
        }
    } else {
        $errorList['description'] = 'Merci d\'entrer une description pour votre établissement.';
    }

    if (count($errorList) == 0) {
        $presentation->setDescription($description);
        $checkIfDescriptionExists = $presentation->checkIfDescriptionIsSet($_SESSION['id']);
        if ($checkIfDescriptionExists->result) {
            $presentation->updateDescription($_SESSION['id']);
            $SelectedDescription = $presentation->getDescription($_SESSION['id']);
        } else {
            $presentation->insertDescription($_SESSION['id']);
            $SelectedDescription = $presentation->getDescription($_SESSION['id']);
        }
    }
}

if (!isset($_POST['confirm'])) {
    $checkIfDescriptionExists = $presentation->checkIfDescriptionIsSet($_SESSION['id']);
        if ($checkIfDescriptionExists->result) {
    $SelectedDescription = $presentation->getDescription($_SESSION['id']);
    }
}




//Pour chaque fichier enregistré, insère le chemin dans le tableau $filePath pour affichage
$files = scandir('hotels/' . $_SESSION['login'] . '/');
$files = array_splice($files, 2);
foreach ($filesArray as $fileName => $errorMessage) {
    $fileCheck->setFilesArray($files);
    if ($fileCheck->array_partial_search($fileName)) {
        $file[$fileName] = $fileCheck->returnFile($fileName);
        $filePath[$fileName] = 'hotels/' . $_SESSION['login'] . '/' . $file[$fileName];
    }
}

$hotel = new Hotel;
$hotel->setEmail($_SESSION['login']);
$hotelName = $hotel->getHotelNameFromEmail();
