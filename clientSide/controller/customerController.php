<?php

require 'regex/formRegex.php';
require 'modele/Database.php';
require 'modele/Hotel.php';

if(isset($_POST['confirm'])){
    $errorList = [];

    if(isset($_POST['lastName'])){
        if(preg_match($nameRegex, $_POST['lastName'])){
            $lastName = htmlspecialchars($_POST['lastName']);
        } else {
            $errorList['lastName'] = 'Merci d\'entrer un nom de famille valide.';
        }
    } else {
        $errorList['lastName'] = 'Merci d\'indiquer un nom de famille.';
    }
    
    if(isset($_POST['firstName'])){
        if(preg_match($nameRegex, $_POST['firstName'])){
            $firstName = htmlspecialchars($_POST['firstName']);
        } else {
            $errorList['firstName'] = 'Merci d\'entrer un prénom valide.';
        }
    } else {
        $errorList['firstName'] = 'Merci d\'indiquer un prénom.';
    }

    if(isset($_POST['mail'])){
        if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $email = htmlspecialchars($_POST['mail']);
        } else {
            $errorList['mail'] = 'Merci d\'entrer une adresse email valdie.';
        }
    } else {
        $errorList['mail'] = 'Merci d\'indiquer une adresse email.';
    }

    if(isset($_POST['phone'])){
        if(preg_match($phoneRegex, $_POST['phone'])){
            $phone = htmlspecialchars($_POST['phone']);
        } else {
            $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide.';
        }
    } else {
        $errorList['phone'] = 'Merci d\'indiquer un numéro de téléphone.';
    }

    if(count($errorList) == 0){
        session_start();
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $hotel = new Hotel;
        $hotelId = htmlspecialchars($_GET['idhotel']);
        $hotel->setId($hotelId);
        if($hotel->checkIfHotelExists()){
            $_SESSION['hotelId'] = $hotelId;
            header('Location: customerHomepage.php');
            exit;
        } else {
            $hotelErrorMessage = 'Une erreur est survenue, veuillez quitter la page et flasher à nouveau le QR code.';
        }
    }

} 