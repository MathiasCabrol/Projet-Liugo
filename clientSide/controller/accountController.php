<?php

session_start();

require 'modele/Database.php';
require 'modele/Customers.php';

$customer = new Customer;
$customer->setId(htmlspecialchars($_SESSION['id']));
$customerDetails = $customer->getCustomerDetails();
