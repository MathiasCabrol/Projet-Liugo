<?php

require 'regex/formRegex.php';
require 'modele/Database.php';
require 'modele/Hotel.php';
require 'modele/Customers.php';

session_start();

if (isset($_POST['guest'])) {
    $hotel = new Hotel;
    $hotelId = htmlspecialchars($_GET['idhotel']);
    $hotel->setId($hotelId);
    if ($hotel->checkIfHotelExists()) {
        $_SESSION['hotelId'] = $hotelId;
        $_SESSION['type'] = 'guest';
        header('Location: customerHomepage.php');
        exit;
    } else {
        $hotelErrorMessage = 'Une erreur est survenue, veuillez quitter la page et flasher à nouveau le QR code.';
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
                    header('Location: activities.php');
                }
            }
        }
    }
}
