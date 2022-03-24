<?php

require '../modele/Database.php';
require '../modele/Bookings.php';
require '../modele/Services.php';
require '../modele/SubService.php';
require '../class/NumberGenerator.php';


//Regex de vérification
$dateRegex = '/^20[2-9][0-9]-((0[1-9])||(1[0-2]))-((0[1-9])||([1-2][0-9])||(3[0-1]))$/';
$hourRegex = '/^((0[1-9])||(1[0-9])||(2[0-3])):[0-5][0-9]$/';
$peopleRegex = '/^[1-9]$/';


if (isset($_POST['reservationDate'])) {
    $errorDate = [];
    if (preg_match($dateRegex, $_POST['reservationDate'])) {
        $reservationDate = htmlspecialchars($_POST['reservationDate']);
    } else {
        $errorDate['reservationDate'] = 'Merci d\'insérer une date valide';
    }

    //Si la donnée insérée passe les tests
    if (count($errorDate) == 0) {
        $service = new Service;
        $subService = new SubService;
        $serviceId = htmlspecialchars($_POST['serviceId']);
        $service->setServiceId($serviceId);
        //Vérification de l'existance du service
        if ($service->checkIfServiceExists()) {
            $booking = new Booking;
            $booking->setDate($reservationDate);
            $subServiceId = htmlspecialchars($_POST['subServiceId']);
            $subService->setSubServiceId($subServiceId);
            $selectedSubServices = $subService->getSubServiceById();

            //Création d'un tableau vide
            $jsonTable = array();

            //Si aucune autre réservation n'est déha présente sur cette date
            if (!$booking->checkIfBookingsOnSameDate($subServiceId)) {

                array_push($jsonTable, array(
                    'id' => $selectedSubServices->subServiceId,
                    'title' => $selectedSubServices->subServiceTitle,
                    'startingHour' => substr($selectedSubServices->subServiceStartingHour, 0, 2),
                    'finishingHour' => substr($selectedSubServices->subServiceFinishingHour, 0, 2),
                    'price' => $selectedSubServices->subServicePrice
                ));
                //SI une uatre réservation est présente sur cette date
            } elseif ($booking->checkIfBookingsOnSameDate($subServiceId)) {
                //ON récupère l'heure de la réservation déja présente
                $bookedHours = $booking->getBookingHourOnSameDate($subServiceId);
                //Pour chaque créneau déja réservé, on l'insère dans un tableau qui sera envoyé en ajax 
                foreach ($bookedHours as $hour) {
                    $bookedHoursArray[] = substr($hour, 0, 2);
                }
                array_push($jsonTable, array(
                    'id' => $selectedSubServices->subServiceId,
                    'title' => $selectedSubServices->subServiceTitle,
                    'startingHour' => substr($selectedSubServices->subServiceStartingHour, 0, 2),
                    'bookedHours' => $bookedHoursArray,
                    'finishingHour' => substr($selectedSubServices->subServiceFinishingHour, 0, 2),
                    'price' => $selectedSubServices->subServicePrice
                ));
            }

            $json = json_encode($jsonTable);
            echo $json;
        }
    }
}

if (isset($_POST['date'])) {
    $errorReservation = [];
    if (preg_match($dateRegex, $_POST['date'])) {
        $date = htmlspecialchars($_POST['date']);
    } else {
        $errorReservation['date'] = 'Merci d\'insérer une date valide';
    }

    if (isset($_POST['hour'])) {
        if (preg_match($hourRegex, $_POST['hour'])) {
            $hour = htmlspecialchars($_POST['hour']);
        } else {
            $errorReservation['hour'] = 'Merci d\'insérer une heure valide';
        }
    }

    if (isset($_POST['numberOfPeople'])) {
        if (preg_match($peopleRegex, $_POST['numberOfPeople'])) {
            $pax = htmlspecialchars($_POST['numberOfPeople']);
        } else {
            $errorReservation['numberOfPeople'] = 'Merci d\'insérer un nombre de personnes valide';
        }
    }

    //TODO débugguer le système de gestion des crénaux horaires déja réservés
    if (count($errorReservation) == 0) {
        $newService = new Service;
        $newService->setServiceId(htmlspecialchars($_POST['serviceId']));
        //Si l'id correspond bien à un service existant
        if ($newService->checkIfServiceExists()) {
            $subService = new SubService;
            $subServiceId = htmlspecialchars($_POST['subServiceId']);
            $subService->setSubServiceId($subServiceId);
            //Si l'id correspond bien à un sous-service existant
            if ($subService->checkIfSubServiceExists()) {
                $bookingCreation = new Booking;
                $numberGenerator = new numberGenerator;
                //Récupéraiton du prix du sous-service
                $subServicePrice = $subService->getSubServicePriceById();
                //Récupération des informations du partenaire
                $partnerId = $newService->getPartnerId();
                $partnerName = $newService->getPartnerName();
                /**
                 * Génération d'un numéro de réservation aléatoire contenant également les deuxc premières lettre sud nom
                 * du partenraire
                 */
                $bookingNumber = $numberGenerator->createBookingNumber($partnerName->name);
                $bookingCreation->setBookingNumber($bookingNumber);
                //Si les numéro de réservation existe déja
                if ($bookingCreation->checkIfReservationNumberExists()) {
                    //On génère un nouveau numéro de réservation jsuq'à ce qu'il n'existe pas
                    while ($bookingCreation->checkIfReservationNumberExists()) {
                        $bookingNumber = $numberGenerator->createBookingNumber($partnerName->name);
                        $bookingCreation->setBookingNumber($bookingNumber);
                    }
                }
                $bookingCreation->setDate($date);
                $bookingCreation->setHour($hour . ':00');
                $bookingCreation->setPax($pax);
                $bookingCreation->setPrice($subServicePrice);
                $bookingCreation->setSubServiceId($subServiceId);
                $bookingCreation->setPartnerId($partnerId);
                $bookingCreation->setCustomerId(htmlspecialchars($_POST['customerId']));
                if ($bookingCreation->createBooking()) {
                    $lastCreatedBookingId = $bookingCreation->getLastCreatedBooking();
                    echo 'bookingConfirmation.php?bookingId=' . $lastCreatedBookingId;
                    exit;
                }
            }
        }
    }
}
