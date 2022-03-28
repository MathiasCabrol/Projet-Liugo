<?php

$dateRegex = '/^20[2-9][0-9]-((0[1-9])||(1[0-2]))-((0[1-9])||([1-2][0-9])||(3[0-1]))$/';
$nameRegex = '/^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/';

session_start();

require 'modele/Database.php';
require 'modele/Booking.php';

$booking = new Booking;


$bookingsDisplayed = $booking->getBookingsInformations();

if (isset($_POST['dateSearch'])) {
    if (preg_match($dateRegex, $_POST['dateSearch'])) {
        $searchedDate = htmlspecialchars($_POST['dateSearch']);
        $booking->setDate($searchedDate);
        $bookingsDisplayed = $booking->getBookingsInformationsByDate();
    } else {
        $dateErrorMessage = 'Merci d\'insérer une date au format valide';
    }
}

if (isset($_POST['nameSearch'])) {
    if (preg_match($nameRegex, $_POST['nameSearch'])) {
        $searchedName = htmlspecialchars($_POST['nameSearch']);
        $booking->setName($searchedName);
        $bookingsDisplayed = $booking->getBookingsInformationsByName();
    } else {
        $nameErrorMessage = 'Merci d\'insérer une nom au format valide';
    }
}
