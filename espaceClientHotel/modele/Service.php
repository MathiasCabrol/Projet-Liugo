<?php
class Service extends Database {

    private int $idhotel;

    public function checkIfServicesAdded() {
        $query = 'SELECT COUNT(`id`) AS `count` FROM `services` WHERE `id_hotels` = :idhotels';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotels', $this->idhotel, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function setHotelId($newHotelId){
        $this->idhotel = $newHotelId;
    }
}