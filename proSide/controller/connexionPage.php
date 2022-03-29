<?php

require 'model/Database.php';
require 'model/Account.php';

session_start();

if (isset($_POST['confirm'])) {
    //Sélection de la table en fonction du type d'utilisateur
    $account = new Account;
    if ($_SESSION['type'] == 'partners') {
        $account->setTable('partners');
    } else if ($_SESSION['type'] == 'hotels') {
        $account->setTable('hotels');
    }
    $account->setEmail(htmlspecialchars($_POST['mailInput']));
    //On vérifie si le compte existe
    $accountCheckResult = $account->checkIfAccountExists();
    //Si c'est le cas
    if ($accountCheckResult->check) {
        $selectedAccount = $account->getConnexionId();
        //On vérifie que le hash du mot de passe correspond bien au MDP inséré par l'utilisateur
        $passwordCheck = password_verify(htmlspecialchars($_POST['passwordInput']), $selectedAccount->password);
        if ($passwordCheck) {
            $account->setId($selectedAccount->id);
            //ON vérifie si le token est null et que le compte est vérifié
            $tokenCheck = $account->checkIfTokenIsNull();
            $_SESSION['login'] = htmlspecialchars($_POST['mailInput']);
            $_SESSION['id'] = $selectedAccount->id;
            //Si le Token est toujours en BDD
            if ($tokenCheck->result == 0) {
                $errorMessage = 'Votre compte n\'est pas validé, nous vous avons fait parvenir, lors de votre inscription, un mail de confirmation.';
            //Si le compte a été vérifié et le token est null
            } else if ($tokenCheck->result == 1) {
                //On redirige vers l'espace client
                if ($_SESSION['type'] == 'partners') {
                    header('location: ../espaceClient/home.php');
                } else if ($_SESSION['type'] == 'hotels') {
                    header('location: ../espaceClient/home.php');
                }
            }
        } else {
            $errorMessage = 'Aucun compte n\'est associé à cette combinaison';
        }
    } else {
        $errorMessage = 'Aucun compte n\'est associé à cette combinaison';
    }
}
