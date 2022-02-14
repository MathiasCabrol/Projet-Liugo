<?php
class Sector extends Database {

    public function getSectors():array{
        $query = 'SELECT `sector` FROM `sectors`';
        $queryStatement = $this->db->query($query);
        $sectorsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $sectorsList;
    }
}