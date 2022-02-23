<?php

$titleRegex = '/^[\p{L}- ]*$/';

if(isset($_POST['saveChanges'])){
    $errorList = [];
    var_dump($_POST);
    var_dump($_FILES);
    if(isset($_POST['serviceTitle1'])){
        if(preg_match($titleRegex, $_POST['serviceTitle1'])){
            $servieTitle1 = htmlspecialchars($_POST['serviceTitle1']);
        } else {
            $errorList['category1']['serviceTitle'] = 'Merci d\'entrer un titre de service valide(tirets et espaces acceptés)';
        }
    } else {
        $errorList['category1']['serviceTitle'] = 'Merci d\'entrer un titre de service';
    }
}