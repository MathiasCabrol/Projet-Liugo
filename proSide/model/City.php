<?php
class City extends Database {

    public function getCorespondingCity():array{
        $query = 'SELECT `ville_id`, `ville_slug` AS `city` FROM `villes_france_free` WHERE `ville_code_postal` = :postcode';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':postcode', htmlspecialchars($_POST['postCode']), PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedCity = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $selectedCity;
    }

}