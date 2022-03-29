<?php

require 'modele/Database.php';
require 'modele/Bookings.php';
require 'modele/SubService.php';
require 'modele/City.php';


session_start();

//On récupère toutes les réservations éffectuées par le client
$bookings = new Booking;
$subService = new SubService;
$bookings->setCustomerId(htmlspecialchars($_SESSION['id']));
//la variable customerBookings récupère toutes les données des réservations liées à l'id du client
$customerBookings = $bookings->getAllBookingsFromCustomerId();
//Pour chaque réservation récupérée
foreach ($customerBookings as $individualBooking) {
    //On vient insérer dans la variable la date ainsi que l'heure de la réservation
    $dateTimeToConvert = $individualBooking->date . ' ' . substr($individualBooking->hour, 0, 5);
    //On les transforme ensuite en Timestamp
    $timeStamp = strtotime($dateTimeToConvert);
    //On vient récupérer la date pour la convertir en format européen
    $date = explode('-', $individualBooking->date);
    $individualBooking->date = $date[2] . '/' . $date[1] . '/' . $date[0];
    //Si la date et l'heure de la réservation sont passés
    if ($timeStamp < time()) {
        $previousBookings[] = $individualBooking;
    //Si la date et l'heure de la réservation ne sont pas passés
    } elseif ($timeStamp > time()) {
        $nextBookings[] = $individualBooking;
    }
    $subService->setSubServiceId($individualBooking->id_subservices);
    //On vient récupérer les détails des sous-services, services, et partnerais en passant par le sous-service
    $bookingDetails[$individualBooking->id] = $subService->getSubServiceAndPartnerDetails();
    //Formatage de l'adresse pour affichage
    $address = $bookingDetails[$individualBooking->id]->partnerAddress;
    $address .= ' ' . $bookingDetails[$individualBooking->id]->partnerPostcode;
    $city = new City;
    //Conversion de l'id de la ville pour récupérer son nom dans la liste des villes de France
    $city->setCityId($bookingDetails[$individualBooking->id]->partnerCity);
    $cityName = $city->getCityNameFromCityId();
    $address .= ' ' . $cityName;
    //Création d'un nouvel attribut
    $bookingDetails[$individualBooking->id]->address = $address;
}


/**
 * Si l'utilisateur choisi de modifier une réservation, alors il est redirigé vers la page de modificaiton avec en paramètre GET l'id de la
 * réservation
 */

if(isset($_POST['modify'])){
    header('Location: bookingModification.php?bookingId=' . htmlspecialchars($_POST['bookingId']));
}

/**
 * Si l'utilisateur souhaites annuler une réservation
 */

if(isset($_POST['cancel'])){
    $bookingToCancel = new Booking;
    $bookingToCancel->setId(htmlspecialchars($_POST['bookingId']));
    //Si la réservation est bien annulée
    if($bookingToCancel->cancelBooking()){
        //Récupération du numéro de réservation pour affichage de la confirmation d'annulation
        $canceledBookingNumber = $bookingToCancel->getReservationNumberFromId();
        header('Location: myBookings.php');
        exit;
    }
}
