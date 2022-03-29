<?php

require 'clientSide/regex/formRegex.php';
require 'clientSide/modele/Database.php';
require 'clientSide/modele/Hotel.php';
require 'clientSide/modele/Customers.php';

session_start();

if (isset($_POST['guest'])) {
    $hotel = new Hotel;
    $hotelId = htmlspecialchars($_GET['idhotel']);
    $hotel->setId($hotelId);
    //Lors de la connexion en temps qu'invité, si l'hôtel existe, insérer les variables de session pour affichage
    if ($hotel->checkIfHotelExists()) {
        $_SESSION['hotelId'] = $hotelId;
        $_SESSION['type'] = 'guest';
        header('Location: clientSide/customerHomepage.php');
        exit;
    } else {
        //Sinon afficher une erreur sur la page demandant de flasher à nouveau le QR
        $hotelErrorMessage = 'Une erreur est survenue, veuillez quitter la page et flasher à nouveau le QR code.';
    }
}

//Si le client se connecte à un compte utilisateur
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
        //Vérification de token, si il est nul, le compte a été confirmé
        if ($customer->checkIfTokenIsNull()) {
            $connexionInfos = $customer->getConnexionId();
            //Vérification du mot de passe entré avec le hash en base de donnée
            if (password_verify(htmlspecialchars($_POST['password']), $connexionInfos->password)) {
                $_SESSION['id'] = $connexionInfos->id;
                $_SESSION['login'] = $email;
                //La session devient de type compte
                $_SESSION['type'] = 'account';
                if (isset($_GET['idhotel'])) {
                    $hotel = new Hotel;
                    $hotelId = htmlspecialchars($_GET['idhotel']);
                    $hotel->setId($hotelId);
                    //On vérifie si l'établissement existe bien
                    if ($hotel->checkIfHotelExists()) {
                        //Si c'est le cas, l'id de l'établissement ets inséré dans une variable de session
                        $_SESSION['hotelId'] = $hotelId;
                        //redirection vers la page d'accueil
                        header('Location: clientSide/customerHomepage.php');
                        exit;
                    }
                } else {
                    /**
                     * Si l'id de l'hôtel n'est aps renseigné, alors le client n'a pas flashé le QR code et est donc renvboyé 
                     * vers la page des activités
                     */
                    header('Location: clientSide/activities.php');
                }
            }
        }
    }
}
