<?php

class SubServiceButton extends Database {
    private string $buttonValue;
    private int $idsubservice;

    public function insertButtonValue():bool {
        $query = 'INSERT INTO `subservicesbutton` (`buttonValue`, `id_subservices`) VALUES (:buttonValue, :idsubservice)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':buttonValue', $this->buttonValue, PDO::PARAM_STR);
        $queryStatement->bindValue(':idsubservice', $this->idsubservice, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setButtonValue($newButtonValue):void {
        $this->buttonValue = $newButtonValue;
    } 

    public function setIdSubService($newIdSubService):void {
        $this->idsubservice = $newIdSubService;
    } 
}