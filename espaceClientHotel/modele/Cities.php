<?php

class City extends Database {

    private int $id;

    public function getCityNameFromId(){
        $query = 'SELECT `ville_slug` FROM `villes_france_free` WHERE `ville_id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $cityName = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $cityName;
    }

    public function setId($newId){
        $this->id = $newId;
    }

}