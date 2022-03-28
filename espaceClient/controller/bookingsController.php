<?php

session_start();

require 'modele/Database.php';
require 'modele/Booking.php';

$booking = new Booking;

$bookingsWithoutSearch = $booking->getBookingsInformations();
var_dump($bookingsWithoutSearch);