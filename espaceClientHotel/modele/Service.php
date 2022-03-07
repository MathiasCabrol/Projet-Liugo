<?php
class Service extends Database {

    private int $idhotel;
    private string $serviceTitle;
    private int $serviceId;

    public function checkIfServicesAdded() {
        $query = 'SELECT COUNT(`id`) AS `count` FROM `services` WHERE `id_hotels` = :idhotels';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotels', $this->idhotel, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function checkIfServiceExists() {
        $query = 'SELECT COUNT(`id`) AS `result` FROM `services` AS `S` WHERE `S`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
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

    public function displayService() {
        $query = 'SELECT `S`.`title` AS `serviceTitle`, `S`.`id` AS `serviceId` FROM `services` AS `S` WHERE `S`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $serviceInfo = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $serviceInfo;
    }

    public function updateServiceTitle(){
        $query = 'UPDATE `services` SET `title` = :title WHERE `id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function deleteService() {
        $query = 'DELETE FROM `services` WHERE `services`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setServiceId($newServiceId){
        $this->serviceId = $newServiceId;
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