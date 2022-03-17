<?php

class Hotel extends Database {
    private int $id;

    public function checkIfHotelExists(){
        $query = 'SELECT COUNT(`id`) AS `result` FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function getHotelInfosFromId():object{
        $query = 'SELECT `email`, `name`, `phone` FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getHotelEmailFromId(){
        $query = 'SELECT `email` FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getDescription():object{
        $query = 'SELECT `description` FROM `presentation` WHERE `id_hotels` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    public function setId($newId):void{
        $this->id = $newId;
    }
}