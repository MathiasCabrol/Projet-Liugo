<?php
class City extends Database {
    public function getCorespondingCity():object{
        $query = 'SELECT `ville_slug` AS `city` FROM `citiesdb` WHERE `ville_code_postal` = :postcode';
        $queryStatement = $this->db->query($query);
        $selectedCity = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $selectedCity;
    }

}