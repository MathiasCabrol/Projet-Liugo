<?php

require 'regex/formRegex.php';
require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Customers.php';

session_start();

if (isset($_POST['confirm'])) {
    $errorList = [];

    if (isset($_POST['lastName'])) {
        if (preg_match($nameRegex, $_POST['lastName'])) {
            $lastName = htmlspecialchars($_POST['lastName']);
        } else {
            $errorList['lastName'] = 'Merci d\'entrer un nom de famille valide.';
        }
    } else {
        $errorList['lastName'] = 'Merci d\'indiquer un nom de famille.';
    }

    if (isset($_POST['firstName'])) {
        if (preg_match($nameRegex, $_POST['firstName'])) {
            $firstName = htmlspecialchars($_POST['firstName']);
        } else {
            $errorList['firstName'] = 'Merci d\'entrer un prénom valide.';
        }
    } else {
        $errorList['firstName'] = 'Merci d\'indiquer un prénom.';
    }

    if (isset($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['mail']);
        } else {
            $errorList['mail'] = 'Merci d\'entrer une adresse email valdie.';
        }
    } else {
        $errorList['mail'] = 'Merci d\'indiquer une adresse email.';
    }

    if (isset($_POST['phone'])) {
        if (preg_match($phoneRegex, $_POST['phone'])) {
            $phone = htmlspecialchars($_POST['phone']);
        } else {
            $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide.';
        }
    } else {
        $errorList['phone'] = 'Merci d\'indiquer un numéro de téléphone.';
    }

    if (count($errorList) == 0) {
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['type'] = 'guest';
        $hotel = new Hotel;
        $hotelId = htmlspecialchars($_GET['idhotel']);
        $hotel->setId($hotelId);
        if ($hotel->checkIfHotelExists()) {
            $_SESSION['hotelId'] = $hotelId;
            header('Location: customerHomepage.php');
            exit;
        } else {
            $hotelErrorMessage = 'Une erreur est survenue, veuillez quitter la page et flasher à nouveau le QR code.';
        }
    }
}

if (isset($_POST['login'])) {

    $loginErrorList = [];

    if (isset($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $errorList['email'] = 'Merci d\'entrer une adresse email valdie.';
        }
    } else {
        $errorList['email'] = 'Merci d\'indiquer une adresse email.';
    }

    if (count($loginErrorList) == 0) {
        $customer = new Customer;
        $customer->setEmail($email);
        if ($customer->checkIfTokenIsNull()) {
            $connexionInfos = $customer->getConnexionId();
            if (password_verify(htmlspecialchars($_POST['password']), $connexionInfos->password)) {
                $_SESSION['id'] = $connexionInfos->id;
                $_SESSION['login'] = $email;
                $_SESSION['type'] = 'account';
                if (isset($_GET['idhotel'])) {
                    $hotel = new Hotel;
                    $hotelId = htmlspecialchars($_GET['idhotel']);
                    $hotel->setId($hotelId);
                    if ($hotel->checkIfHotelExists()) {
                        $_SESSION['hotelId'] = $hotelId;
                        header('Location: customerHomepage.php');
                        exit;
                    }
                } else {
                    // header('Location: customerHomepage.php');
                }
            }
        }
    }
}
