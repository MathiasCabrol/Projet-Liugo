<?php
class Service extends Database {

    private int $idhotel;
    private string $serviceTitle;

    public function checkIfServicesAdded() {
        $query = 'SELECT COUNT(`id`) AS `count` FROM `services` WHERE `id_hotels` = :idhotels';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotels', $this->idhotel, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addService(): bool {
        $query = 'INSERT INTO `services` (`id_hotels`, `title`) VALUES (:idhotels, :title)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotels', $this->idhotel, PDO::PARAM_INT);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function getServiceId():int {
        $query = 'SELECT `id` AS `serviceid` FROM `services` WHERE `title` = :title';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        $queryStatement->execute();
        $serviceId = $queryStatement->fetchColumn();
        return $serviceId;
    }
    
    public function getAllServices(int $hotelId):array {
        $query = 'SELECT `S`.`id` AS `id`, `S`.`title` AS `title` FROM `services` AS `S` INNER JOIN `hotels` AS `H` WHERE `H`.`id` = :idhotel';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotel', $hotelId, PDO::PARAM_INT);
        $queryStatement->execute();
        $servicesInfo = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $servicesInfo;
    }

    public function getAllSubServices(int $serviceId){
        $query = 'SELECT `SS`.`title` AS `subServiceTitle`, `SS`.`startingHour` AS `startingHour`, `SS`.`finishingHour` AS `finishingHour`, `SS`.`price` AS `price`, `SS`.`addButton` AS `addButton` FROM `subservices` AS `SS` WHERE :serviceid = `SS`.`id_services`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $subServicesInfo = $queryStatement->fetchAll(PDO::FETCH_OBJ);
    return $subServicesInfo;
    }

    public function setServiceTitle($newServiceTitle): void {
        $this->serviceTitle = $newServiceTitle;
    }
    
    public function setHotelId($newHotelId){
        $this->idhotel = $newHotelId;
    }

    public function getHotelId(){
        return $this->idhotel;
    }

}