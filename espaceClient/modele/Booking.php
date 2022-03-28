<?php

class Booking {
    private int $price;
    private int $idpartner;
    private string $date;
    private string $name;

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

    public function getBookingsInformationsByDate():array{
        $query = 'SELECT `bookingnumber`, `date`, `hour`, `C`.`lastname` AS `customerLastname`, `C`.`firstname` AS `customerFirstname`, `C`.`email` AS `customerEmail`, `C`.`phone` AS `customerPhone`, `SS`.`title` AS `subserviceTitle` FROM `bookings` INNER JOIN `customers` AS `C` ON `bookings`.`id_customers` = `C`.`id` INNER JOIN `subservices` AS `SS` ON `bookings`.`id_subservices` = `SS`.`id` WHERE `bookings`.`canceled` = 0 AND `date` = :date';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':date', $this->date, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getBookingsInformationsByName():array{
        $query = 'SELECT `bookingnumber`, `date`, `hour`, `C`.`lastname` AS `customerLastname`, `C`.`firstname` AS `customerFirstname`, `C`.`email` AS `customerEmail`, `C`.`phone` AS `customerPhone`, `SS`.`title` AS `subserviceTitle` FROM `bookings` INNER JOIN `customers` AS `C` ON `bookings`.`id_customers` = `C`.`id` INNER JOIN `subservices` AS `SS` ON `bookings`.`id_subservices` = `SS`.`id` WHERE `bookings`.`canceled` = 0 AND `C`.`lastname` LIKE CONCAT("%", :name, "%")';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function setPartnerId($newPartnerId){
        $this->idpartner = $newPartnerId;
    }

    public function setDate($newDate){
        $this->date = $newDate;
    }

    public function setName($newName){
        $this->name = $newName;
    }
}