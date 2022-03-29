<?php

class City extends Database {
    private int $cityId;

    public function getCityNameFromCityId():string{
        $query = 'SELECT `ville_nom` FROM `villes_france_free` WHERE `ville_id` = :idcity';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idcity', $this->cityId, PDO::PARAM_INT);
        $queryStatement->execute();
        $cityName = $queryStatement->fetchColumn();
        return $cityName;
    }

    public function setCityId($newCityId){
        $this->cityId = $newCityId;
    }
}