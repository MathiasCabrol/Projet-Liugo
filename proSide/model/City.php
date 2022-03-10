<?php
class City extends Database {

    private string $postcode;

    public function getCorespondingCity():array{
        $query = 'SELECT `ville_id`, `ville_slug` AS `city` FROM `villes_france_free` WHERE `ville_code_postal` = :postcode';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedCity = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $selectedCity;
    }

    public function setPostCode($newPostcode){
        $this->postcode = $newPostcode;
    }

}