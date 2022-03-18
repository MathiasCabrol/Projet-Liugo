<?php

require '../modele/Database.php';
require '../modele/Bookings.php';
require '../modele/Services.php';
require '../modele/SubService.php';

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

    if (count($errorDate) == 0) {
        $service = new Service;
        $subService = new SubService;
        $serviceId = htmlspecialchars($_POST['serviceId']);
        $service->setServiceId($serviceId);
    
        if ($service->checkIfServiceExists()) {
            $booking = new Booking;
            $booking->setDate($reservationDate);
            $subServiceId = htmlspecialchars($_POST['subServiceId']);
                $subService->setSubServiceId($subServiceId);
                $selectedSubServices = $subService->getSubServiceById();
    
                $jsonTable = array();
    
                if (!$booking->checkIfBookingsOnSameDate($subServiceId)) {
                
                array_push($jsonTable, array(
                    'id' => $selectedSubServices->subServiceId,
                    'title' => $selectedSubServices->subServiceTitle,
                    'startingHour' => substr($selectedSubServices->subServiceStartingHour, 0, 2),
                    'finishingHour' => substr($selectedSubServices->subServiceFinishingHour, 0, 2),
                    'price' => $selectedSubServices->subServicePrice
                ));
    
                }elseif($booking->checkIfBookingsOnSameDate($subServiceId)){
                    $bookedHours = $booking->getBookingHourOnSameDate($subServiceId);
                    foreach($bookedHours as $hour){
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

if(isset($_POST['numberOfPeople'])){
    echo $_POST['numberOfPeople'];
}

if(isset($_POST['date'])){
    $errorReservation = [];
    if (preg_match($dateRegex, $_POST['date'])) {
        $date = htmlspecialchars($_POST['date']);
    } else {
        $errorReservation['date'] = 'Merci d\'insérer une date valide';
    }

    if(isset($_POST['hour'])){
        if (preg_match($hourRegex, $_POST['hour'])) {
            $hour = htmlspecialchars($_POST['hour']);
        } else {
            $errorReservation['hour'] = 'Merci d\'insérer une heure valide';
        }
    }

    if(isset($_POST['numberOfPeople'])){
        if (preg_match($peopleRegex, $_POST['numberOfPeople'])) {
            $hour = htmlspecialchars($_POST['numberOfPeople']);
        } else {
            $errorReservation['numberOfPeople'] = 'Merci d\'insérer un nombre de personnes valide';
        }
    }

}