<?php

require 'model/Database.php';
require 'model/Account.php';

session_start();

if(isset($_POST['confirm'])){
    $account = new Account;
    if($_SESSION['type'] == 'presta'){
        $account->setTable('partners');
    }else if($_SESSION['type'] == 'hotel'){
        $account->setTable('hotels');
    }
    $account->setEmail(htmlspecialchars($_POST['mailInput']));
    $selectedAccount = $account->getConnexionId();
    $passwordCheck = password_verify(htmlspecialchars($_POST['passwordInput']), $selectedAccount->password);
    if($passwordCheck){
        $account->setId($selectedAccount->id);
        $phoneCheck = $account->checkIfPhoneIsNull();
        $_SESSION['login'] = htmlspecialchars($_POST['mailInput']);
        $_SESSION['id'] = $selectedAccount->id;
        if($phoneCheck->result){ 
            header('location: subscriptionFinalisation.php');
        } else {
            if($_SESSION['type'] == 'presta'){
                // header(location: '') page non crée pour le moment
            }else if($_SESSION['type'] == 'hotel'){
                header('location: ../espaceClientHotel/home.php');
            }
        }
    } else {
        $errorMessage = 'Aucun compte n\'est associé à cette combinaison';
    }
}