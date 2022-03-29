<?php

class numberGenerator {

    public function createBookingNumber(string $partnerName): string{
        //On récupère les deux premières lettres du nom du partenaire en paramètre
        $twoFirstLetters = substr($partnerName, 0, 2);
        //Transformation en lettres majuscules
        $twoFirstLatterUpperCase = strtoupper($twoFirstLetters);
        //Nombre aléatoire entre 0 et 9
        $bookingNumber = rand(0, 9);
        //On répète l'opération 3 fois en concaténant le résultat à chaque tour de boucle
        for($i = 0; $i < 3; $i++){
            $bookingNumber .= rand(0, 9);
        }
        //On concatène les lettres avec le numéro généré
        $finalBookingNumber = $twoFirstLatterUpperCase . $bookingNumber;
        //Retourne le numéro de réservation final
        return $finalBookingNumber;
    }
}