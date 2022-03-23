<?php

class numberGenerator {

    public function createBookingNumber(string $partnerName): string{
        $twoFirstLetters = substr($partnerName, 0, 2);
        $twoFirstLatterUpperCase = strtoupper($twoFirstLetters);
        $bookingNumber = rand(0, 9);
        for($i = 0; $i < 3; $i++){
            $bookingNumber .= rand(0, 9);
        }
        $finalBookingNumber = $twoFirstLatterUpperCase . $bookingNumber;
        return $finalBookingNumber;
    }
}