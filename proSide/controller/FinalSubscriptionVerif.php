<?php
$textRegex = '/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-\'\.]+$/';
$phoneRegex = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$siretRegex = '/^[0-9]{14}$/';

//Création du tableau vide de listes d'erreurs

if (isset($_POST['confirm']) && $_POST['confirm'] == "confirmer") {

$errorList = [];

//Définition des erreurs du champ 'nom'

if(!empty($_POST['sectorInput'])){ 
    if(!preg_match($textRegex, $_POST['sectorInput'])){
        $errorList['sectorInput'] = 'Merci d\'entrer un secteur d\'activité composé d\'une majuscule, de lettres caractères accentués, tirets et/ou apostrophes.';
    } else {
        $sectorInput = htmlspecialchars($_POST['sectorInput']);
    }
} else {
    $errorList['sectorInput'] = 'Veuillez d\'entrer un secteur d\'activité.';
}

//Définition des erreurs du champ 'prénom'

if(!empty($_POST['phoneInput'])){ 
    if(!preg_match($phoneRegex, $_POST['phoneInput'])){
        $errorList['phoneInput'] = 'Merci d\'entrer un numéro de téléphone avec un format valide.';
    } else {
        $phoneInput = htmlspecialchars($_POST['phoneInput']);
    }
} else {
    $errorList['phoneInput'] = 'Merci d\'entrer un numéro de téléphone.';
}

//Définition des erreurs du champ 'date de naissance'

if(!empty($_POST['siretInput'])){ 
    if(!preg_match($siretRegex, $_POST['siretInput'])){
        $errorList['siretInput'] = 'Merci d\'entrer un numéro de Siret avec un format valide.';
    } else {
        $siretInput = htmlspecialchars($_POST['siretInput']);
    }
} else {
    $errorList['siretInput'] = 'Merci d\'entrer un numéro de Siret.';
}
if(!empty($_POST['fileInput'])){
    if (!in_array($extension, $valide))
    { 
        $errorList['fileInput'] = 'Merci d\'entrer un fichier au format valide (JPEG, JPG, PNG, PDF).';
    } else {
        $fileInput = htmlspecialchars($_POST['fileInput']);
    }
} else {
    $errorList['fileInput'] = 'Merci d\'insérer un fichier.';
}

} else {
    $confirmationError = 'Merci d\'entrer une valeur de bouton valide';
}
?>