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

    public function setServiceTitle($newServiceTitle): void {
        $this->serviceTitle = $newServiceTitle;
    }
    
    public function setHotelId($newHotelId){
        $this->idhotel = $newHotelId;
    }

}