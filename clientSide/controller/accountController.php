<?php

session_start();

require 'modele/Database.php';
require 'modele/Customers.php';

$customer = new Customer;
$customer->setId(htmlspecialchars($_SESSION['id']));
$customerDetails = $customer->getCustomerDetails();

if (isset($_POST['deleteConfirm'])) {
    if ($customer->deleteAccount()) {
        session_destroy();
        header('Location: customerLandingPage.php');
        exit;
    } else {
        $deleteError = 'Une erreur est survenue lors de la suppression du compte, veuillez conatcter l\'administration';
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: ../index.php');
    exit;
}
