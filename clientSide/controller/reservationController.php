<?php

require '../modele/Database.php';
require '../modele/Bookings.php';
require '../modele/Services.php';
require '../modele/SubService.php';

$dateRegex = '/^20[2-9][0-9]-((0[1-9])||(1[0-2]))-((0[1-9])||([1-2][0-9])||(3[0-1]))$/';

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
