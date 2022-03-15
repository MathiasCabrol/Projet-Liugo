<?php

class Service extends Database {
    
private int $serviceId;

    public function getAllServicesByHotelId($hotelId):array{
        $query = 'SELECT `id`, `title` FROM `services` WHERE `id_hotels` = :idhotel';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotel',$hotelId, PDO::PARAM_INT);
        $queryStatement->execute();
        $services = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $services;
    }

    public function getServiceByServiceId():object{
        $query = 'SELECT `id`, `title` FROM `services` WHERE `id` = :idservice';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idservice', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function checkIfServiceLinkedToHotel() {
        $query = 'SELECT `hotels`.`id` FROM `services` INNER JOIN `hotels` ON `services`.`id_hotels` = `hotels`.`id` WHERE `services`.`id` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $hotelId = $queryStatement->fetchColumn();
        return $hotelId;
    }

    public function setServiceId($newServiceId):void{
        $this->serviceId = $newServiceId;
    }
}