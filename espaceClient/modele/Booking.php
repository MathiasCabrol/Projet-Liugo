<?php

class Booking {
    private int $price;
    private int $idpartner;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    public function getConfirmedBookingsData():object{
        $query = 'SELECT COUNT(`id`) AS `numberOfBookings`, SUM(`pax`) AS `numberOfPeople`, SUM(`price`) AS `totalPrice` FROM `bookings` AS `B` WHERE `id_partners` = :idpartner AND `canceled` = 0';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idpartner', $this->idpartner, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getCanceledBookingsData():object{
        $query = 'SELECT COUNT(`id`) AS `numberOfBookings`, SUM(`pax`) AS `numberOfPeople`, SUM(`price`) AS `totalPrice` FROM `bookings` AS `B` WHERE `id_partners` = :idpartner AND `canceled` = 1';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idpartner', $this->idpartner, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function setPartnerId($newPartnerId){
        $this->idpartner = $newPartnerId;
    }
}