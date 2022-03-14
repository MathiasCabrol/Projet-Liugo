<?php

class Hotel extends Database {
    private int $id;

    public function checkIfHotelExists(){
        $query = 'SELECT COUNT(`id`) AS `result` FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id',$this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }





    public function setId($newId):void{
        $this->id = $newId;
    }
}