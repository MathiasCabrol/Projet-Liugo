<?php

class City extends Database {

    private int $id;
    private string $postcode;
    
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getCityNameFromId(){
        $query = 'SELECT `ville_slug` FROM `villes_france_free` WHERE `ville_id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $cityName = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $cityName;
    }

    public function getCorespondingCity():array{
        $query = 'SELECT `ville_id`, `ville_slug` AS `city` FROM `villes_france_free` WHERE `ville_code_postal` = :postcode';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedCity = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $selectedCity;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setPostCode($newPostcode){
        $this->postcode = $newPostcode;
    }

}