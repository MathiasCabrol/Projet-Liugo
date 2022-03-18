<?php

class Booking extends Database {
    private string $date;

    public function checkIfBookingsOnSameDate(int $idSubService){
        $query = 'SELECT COUNT(`ìd`) FROM `bookings` WHERE `id_subservices` = :subserviceid AND `date` = :reservationDate';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':reservationDate', $this->date, PDO::PARAM_STR);
        $queryStatement->bindValue(':subserviceid', $idSubService, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function getBookingHourOnSameDate($idSubService){
        $query = 'SELECT `hour` FROM `bookings` WHERE `date` = :bookedDate AND `id_subservices` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $idSubService, PDO::PARAM_INT);
        $queryStatement->bindValue(':bookedDate', $this->date, PDO::PARAM_STR);
        $queryStatement->execute();
        $bookedHours = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $bookedHours;
    }

    public function setDate($newDate){
        $this->date = $newDate;
    }
}
