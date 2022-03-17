<?php

require 'modele/Database.php';
require 'modele/Customers.php';
require '../proSide/class/Token.php';

session_start();

$nameRegex = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';
$mailRegex = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$phoneRegex = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$passwordRegex = '/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/';

//Création du tableau vide de listes d'erreurs


if (isset($_POST['inscription'])) {
    $errorList = [];

    //Définition des erreurs du champ 'name'

    if (!empty($_POST['lastname'])) {
        if (!preg_match($nameRegex, $_POST['lastname'])) {
            $errorList['lastname'] = 'Merci d\'entrer un nom composé d\'une majuscule, de lettres caractères accentués, tirets et/ou apostrophes.';
        } else {
            $lastName = htmlspecialchars($_POST['lastname']);
        }
    } else {
        $errorList['lastname'] = 'Veuillez entrer un nom.';
    }

    //Définition des erreurs du champ 'prénom'

    if (!empty($_POST['firstname'])) {
        if (!preg_match($nameRegex, $_POST['firstname'])) {
            $errorList['firstname'] = 'Merci d\'entrer un prénom composé d\'une majuscule, de lettres caractères accentués, tirets et/ou apostrophes.';
        } else {
            $firstName = htmlspecialchars($_POST['firstname']);
        }
    } else {
        $errorList['firstname'] = 'Veuillez entrer un nom.';
    }

    //Définition des erreurs du champ 'téléphone'

    if (!empty($_POST['phone'])) {
        if (!preg_match($phoneRegex, $_POST['phone'])) {
            $errorList['phone'] = 'Merci d\'entrer un numéro de téléphone valide.';
        } else {
            $phone = htmlspecialchars($_POST['phone']);
        }
    } else {
        $errorList['phone'] = 'Veuillez entrer un numéro de téléphone.';
    }

    //Définition des erreurs du champ 'mail'

    if (!empty($_POST['email'])) {
        if (!preg_match($mailRegex, $_POST['email'])) {
            $errorList['email'] = 'Merci d\'entrer une adresse e-mail avec un format valide.';
        } else {
            $email = htmlspecialchars($_POST['email']);
        }
    } else {
        $errorList['email'] = 'Merci d\'entrer une adresse e-mail.';
    }

    //Définition des erreurs du champ 'password'

    if (!empty($_POST['password'])) {
        if (!preg_match($passwordRegex, $_POST['password'])) {
            $errorList['password'] = 'Merci d\'entrer un mot de passe suffisament fort (Un caractère spécial, une majuscule, au minimum 6 caractères).';
        } else {
            $password = htmlspecialchars($_POST['password']);
        }
    } else {
        $errorList['password'] = 'Merci d\'entrer un mot de passe.';
    }

    var_dump($errorList);

    //Insertion des données
    if (count($errorList) == 0) {
        //Hashage du mdp
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //Création d'une nouvelle instance CLients
        $customer = new Customer;
                //Setters
                $customer->setLastName($lastName);
                $customer->setFirstName($firstName);
                $customer->setPhone($phone);
                $customer->setEmail($email);
                $customer->setPassword($hashedPassword);
                $checkAccountExists = $customer->checkIfAccountExists();
                //Si L'adresse e-mail ne correspond à aucun compte existant dans la bdd, insérer les données
                if (!$checkAccountExists->check) {
                    $token = new Token;
                    $generatedToken = $token->createToken();
                    $customer->setToken($generatedToken);
                    if($customer->createAccount()){
                        /**
                         * Envoi du mail contenant le lien de confirmation
                         */
                        // $to = $account->getMail();
                        // $subject = 'Liugo : Confirmation d\'inscription';
                        // $message = '<html>
                        // <head><title>LiveP2 : Confirmation de l\'inscription</title></head>
                        // <body><h1>Bienvenue chez Liugo.</h1>
                        // <p>Il ne reste plus qu\'une étape pour faire partie de nos membres. Merci de valider votre adresse mail en cliquant sur le lien ci-dessous.</p>
                        //<a href="http://liugo/clientSide/subscriptionConfirmed.php?token= . $generatedToken . ">Clique ici</a></body>
                        // </html>';
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        // $headers[] = 'MIME-Version: 1.0';
                        // $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                        // $headers[] = 'From: Liugo <mathiascabrol@gmail.com>';
                        // mail($to, $subject, $message, implode("\r\n", $headers));
                        $idObject = $customer->getId();
                        header('Location: subscriptionConfirmed.php?token=' . $generatedToken);
                        exit;
                    }
                    
                    //Sinon créer un message d'erreur
                } else {
                    $errorList['account'] = 'Cette adresse e-mail est déja liée à un compte';
                }
        
    }
}

