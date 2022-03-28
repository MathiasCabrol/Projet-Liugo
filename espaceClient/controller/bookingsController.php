<?php

session_start();

var_dump($_SESSION);

require 'modele/Database.php';
require 'modele/Booking.php';

$booking = new Booking;

$booking->setPartnerId(htmlspecialchars($_SESSION['id']));
$confirmedBookingsData = $booking->getConfirmedBookingsData();
$canceledBookingsData = $booking->getCanceledBookingsData();
