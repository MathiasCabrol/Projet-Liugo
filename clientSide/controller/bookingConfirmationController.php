<?php

require 'modele/Database.php';
require 'modele/Bookings.php';

session_start();

$booking = new Booking;
$booking->setId(htmlspecialchars($_GET['bookingId']));
$confirmedBookingNumber = $booking->getReservationNumberFromId();

