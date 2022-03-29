<?php

class SubServiceButton extends Database {

    public function getButtonFromSS($idSS):object{
        $query = 'SELECT `b`.`id` AS `bid`, `b`.`buttonValue` AS `bbuttonvalue` FROM `subservicesbutton` AS `b` WHERE `id_subservices` = :idss';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idss', $idSS, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}