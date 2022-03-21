<?php

class SubServiceButton {
    private string $buttonValue;
    private int $idsubservice;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function insertButtonValue():bool {
        $query = 'INSERT INTO `subservicesbutton` (`buttonValue`, `id_subservices`) VALUES (:buttonValue, :idsubservice)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':buttonValue', $this->buttonValue, PDO::PARAM_STR);
        $queryStatement->bindValue(':idsubservice', $this->idsubservice, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function getButtonValue() {
        $query = 'SELECT `buttonValue` FROM `subservicesbutton` WHERE `id_subservices` = :idsubservice';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idsubservice', $this->idsubservice, PDO::PARAM_INT);
        $queryStatement->execute();
        $buttonValue = $queryStatement->fetchColumn();
        return $buttonValue;
    }

    public function getLastInsertedButton() {
        $query = 'SELECT `id` FROM `subservicesbutton` WHERE `id` = (SELECT LAST_INSERT_ID())';
        $queryStatement = $this->db->query($query);
        $buttonId = $queryStatement->fetchColumn();
        return $buttonId;
    }

    public function getButtonsIdByService($serviceId) {
        $query = 'SELECT `subservicesbutton`.`id` AS `buttonid` FROM `subservicesbutton` INNER JOIN `subservices` ON `subservices`.`id` = `subservicesbutton`.`id_subservices` INNER JOIN `services` ON `subservices`.`id_services` = `services`.`id` WHERE `services`.`id` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $buttonIds = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $buttonIds;
    }

    public function getButtonsIdBySubService($subServiceId){
        $query = 'SELECT `subservicesbutton`.`id` AS `buttonid` FROM `subservicesbutton` INNER JOIN `subservices` ON `subservices`.`id` = `subservicesbutton`.`id_subservices` WHERE `subservices`.`id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $subServiceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $buttonIds = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $buttonIds;
    }

    public function getSingleButtonIDBySS() {
        $query = 'SELECT `subservicesbutton`.`id` AS `id` FROM `subservicesbutton` INNER JOIN `subservices` ON `subservices`.`id` = `subservicesbutton`.`id_subservices` WHERE `subservices`.`id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->idsubservice, PDO::PARAM_INT);
        $queryStatement->execute();
        $buttonId = $queryStatement->fetchColumn();
        return $buttonId;
    }

    public function setButtonValue($newButtonValue):void {
        $this->buttonValue = $newButtonValue;
    } 

    public function setIdSubService($newIdSubService):void {
        $this->idsubservice = $newIdSubService;
    } 
}