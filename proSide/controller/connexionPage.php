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
        $tokenCheck = $account->checkIfTokenIsNull();
        var_dump($tokenCheck->result);
        $_SESSION['login'] = htmlspecialchars($_POST['mailInput']);
        $_SESSION['id'] = $selectedAccount->id;
        if($tokenCheck->result == 0){ 
            $errorMessage = 'Votre compte n\'est pas validé, nous vous avons fait parvenir, lors de votre inscription, un mail de confirmation.';
        } else if($tokenCheck->result == 1){
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