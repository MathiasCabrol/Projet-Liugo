<?php

class SubService extends Database {

    private int $id;
    
    public function getServicesSS($serviceId):array{
        $query = 'SELECT `ss`.`id` AS `ssId`, `ss`.`title` AS `ssTitle`, `ss`.`startingHour` AS `ssStartingHour`, `ss`.`finishingHour` AS `ssFinishingHour`, `ss`.`price` AS `ssPrice`, `ss`.`addButton` AS `ssAddButton` FROM `subservices` AS `ss` INNER JOIN `services` AS `s` ON `ss`.`id_services` = `s`.`id` WHERE `s`.`id` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAllSubServicesFromServiceId($serviceId){
        $query = 'SELECT `SS`.`id` AS `subServiceId`, `SS`.`title` AS `subServiceTitle`, `SS`.`startingHour` AS `subServiceStartingHour`, `SS`.`finishingHour` AS `subServiceFinishingHour`, `SS`.`price` AS `subServicePrice`, `SS`.`addButton` AS `addButton`, `SSB`.`id` AS `buttonId`, `SSB`.`buttonValue` AS `buttonValue` FROM `subservices` AS `SS` INNER JOIN `subservicesbutton` AS `SSB` ON `SS`.`id` = `SSB`.`id_subservices` WHERE `SS`.`id_services` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getSubServiceById(){
        $query = 'SELECT `SS`.`id` AS `subServiceId`, `SS`.`title` AS `subServiceTitle`, `SS`.`startingHour` AS `subServiceStartingHour`, `SS`.`finishingHour` AS `subServiceFinishingHour`, `SS`.`price` AS `subServicePrice`, `SS`.`addButton` AS `addButton` FROM `subservices` AS `SS` WHERE `SS`.`id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getSubServicePriceById(){
        $query = 'SELECT `price` FROM `subservices` WHERE `id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function checkIfSubServiceExists() {
        $query = 'SELECT COUNT(`id`) AS `result` FROM `subservices` AS `SS` WHERE `SS`.`id` = :subserviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceId', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function setSubServiceId($newSubServiceId){
        $this->id = $newSubServiceId;
    }
}