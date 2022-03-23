<?php

class Booking extends Database {
    private string $date;
    private string $hour;
    private int $pax;
    private string $bookingnumber;
    private int $price;
    private int $idcustomer;
    private int $idpartner;
    private int $idsubservice;


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

    public function createBooking(){
        $query = 'INSERT INTO `bookings` (`bookingnumber`, `id_customers`, `id_partners`, `date`, `hour`, `id_subservices`, `pax`, `price`) VALUES (:bookingnumber, :idcustomers, :idpartners, :bookingdate, :hour, :idsubservice, :pax, :price)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':bookingnumber', $this->bookingnumber, PDO::PARAM_STR);
        $queryStatement->bindValue(':idcustomers', $this->idcustomer, PDO::PARAM_INT);
        $queryStatement->bindValue(':idpartners', $this->idpartner, PDO::PARAM_INT);
        $queryStatement->bindValue(':bookingdate', $this->date, PDO::PARAM_STR);
        $queryStatement->bindValue(':hour', $this->hour, PDO::PARAM_STR);
        $queryStatement->bindValue(':idsubservice', $this->idsubservice, PDO::PARAM_INT);
        $queryStatement->bindValue(':pax', $this->pax, PDO::PARAM_INT);
        $queryStatement->bindValue(':price', $this->price, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setDate($newDate){
        $this->date = $newDate;
    }

    public function setHour($newHour){
        $this->hour = $newHour;
    }

    public function setPax($newPax){
        $this->pax = $newPax;
    }

    public function setPrice($newPrice){
        $this->price = $newPrice;
    }

    public function setBookingNumber($newBookingNumber){
        $this->bookingnumber = $newBookingNumber;
    }

    public function setSubServiceId($newSubServiceId){
        $this->idsubservice = $newSubServiceId;
    }

    public function setPartnerId($newPartnerId){
        $this->idpartner = $newPartnerId;
    }

    public function setCustomerId($newCustomerId){
        $this->idcustomer = $newCustomerId;
    }
}
