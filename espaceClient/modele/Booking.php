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

    public function getBookingsInformations():array{
        $query = 'SELECT `bookingnumber`, `date`, `hour`, `C`.`lastname` AS `customerLastname`, `C`.`firstname` AS `customerFirstname`, `C`.`email` AS `customerEmail`, `C`.`phone` AS `customerPhone`, `SS`.`title` AS `subserviceTitle` FROM `bookings` INNER JOIN `customers` AS `C` ON `bookings`.`id_customers` = `C`.`id` INNER JOIN `subservices` AS `SS` ON `bookings`.`id_subservices` = `SS`.`id` WHERE `bookings`.`canceled` = 0';
        $queryStatement = $this->db->query($query);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function setPartnerId($newPartnerId){
        $this->idpartner = $newPartnerId;
    }
}