<?php
require 'model/Database.php';
require 'model/Account.php';
require 'class/Token.php';

session_start();

if(isset($_GET['type'])){
    $_SESSION['type'] = $_GET['type'];
}


$nameRegex = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';
$mailRegex = '/^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i';
$passwordRegex = '/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/';

//Création du tableau vide de listes d'erreurs


if (isset($_POST['inscription'])) {
    $errorList = [];

    //Définition des erreurs du champ 'name'

    if (!empty($_POST['name'])) {
        if (!preg_match($nameRegex, $_POST['name'])) {
            $errorList['name'] = 'Merci d\'entrer un nom composé d\'une majuscule, de lettres caractères accentués, tirets et/ou apostrophes.';
        } else {
            $name = htmlspecialchars($_POST['name']);
        }
    } else {
        $errorList['name'] = 'Veuillez entrer un nom.';
    }

    //Définition des erreurs du champ 'mail'

    if (!empty($_POST['mail'])) {
        if (!preg_match($mailRegex, $_POST['mail'])) {
            $errorList['mail'] = 'Merci d\'entrer une adresse e-mail avec un format valide.';
        } else {
            $mail = htmlspecialchars($_POST['mail']);
        }
    } else {
        $errorList['mail'] = 'Merci d\'entrer une adresse e-mail.';
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

    //Insertion des données
    if (count($errorList) == 0) {
        //Hashage du mdp
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $account = new Account;
        //Selon le type d'utilisateur, configurer la table de création de compte
        if (isset($_GET['type'])) {
            if ($_GET['type'] == 'hotels') {
                $account->setTable('hotels');
            } else if ($_GET['type'] == 'partners') {
                $account->setTable('partners');
            }
                //Création d'une nouvelle instance Hotels
                //Setters
                $account->setName($name);
                $account->setEmail($mail);
                $account->setPassword($hashedPassword);
                $checkAccountExists = $account->checkIfAccountExists();
                //Si L'adresse e-mail ne correspond à aucun compte existant dans la bdd, insérer les données
                if (!$checkAccountExists->check) {
                    $token = new Token;
                    $generatedToken = $token->createToken();
                    $account->setToken($generatedToken);
                    if($account->createAccount()){
                        /**
                         * Envoi du mail contenant le lien de confirmation
                         */
                        // $to = $account->getMail();
                        // $subject = 'Liugo : Confirmation d\'inscription';
                        // $message = '<html>
                        // <head><title>LiveP2 : Confirmation de l\'inscription</title></head>
                        // <body><h1>Bienvenue chez Liugo.</h1>
                        // <p>Il ne reste plus qu\'une étape pour faire partie de nos membres. Merci de valider votre adresse mail en cliquant sur le lien ci-dessous.</p>
                        //<a href="http://liugo/proSide/subscriptionFinalisation.php?token= . $generatedToken . '&type=' . $_GET['type'] . ">Clique ici</a></body>
                        // </html>';
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        // $headers[] = 'MIME-Version: 1.0';
                        // $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                        // $headers[] = 'From: Liugo <mathiascabrol@gmail.com>';
                        // mail($to, $subject, $message, implode("\r\n", $headers));
                        $idObject = $account->getId();
                        header('location: subscriptionFinalisation.php?type=' . $_SESSION['type'] . '&token=' . $generatedToken);
                        exit;
                    }
                    
                    //Sinon créer un message d'erreur
                } else {
                    $errorList['account'] = 'Cette adresse e-mail est déja liée à un compte';
                }
        }
    }
}
