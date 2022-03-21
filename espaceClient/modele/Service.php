<?php
class Service {

    private int $idaccount;
    private string $serviceTitle;
    private int $serviceId;
    private string $slug;
    protected string $idtype;
    protected string $table;
    protected int $typeofid;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function checkIfServicesAdded() {
        $query = 'SELECT COUNT(`id`) AS `count` FROM `services` WHERE ' . $this->idtype . ' = :accountid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':accountid', $this->idaccount, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function checkIfServiceExists() {
        $query = 'SELECT COUNT(`id`) AS `result` FROM `services` AS `S` WHERE `S`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function addService(): bool {
        $query = 'INSERT INTO `services` (' . $this->idtype . ', `title`, `id_type`, `slug`) VALUES (:accountid, :title, ' . $this->typeofid . ', :slug)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':accountid', $this->idaccount, PDO::PARAM_INT);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        $queryStatement->bindValue(':slug', $this->slug, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function getServiceId():int {
        $query = 'SELECT `id` AS `serviceid` FROM `services` WHERE `title` = :title';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        $queryStatement->execute();
        $serviceId = $queryStatement->fetchColumn();
        return $serviceId;
    }

    public function getAllServices(int $idaccount):array {
        $query = 'SELECT `S`.`id` AS `id`, `S`.`title` AS `title` FROM `services` AS `S` WHERE ' . $this->idtype . ' = :accountid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':accountid', $idaccount, PDO::PARAM_INT);
        $queryStatement->execute();
        $servicesInfo = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $servicesInfo;
    }

    public function displayService() {
        $query = 'SELECT `S`.`title` AS `serviceTitle`, `S`.`id` AS `serviceId` FROM `services` AS `S` WHERE `S`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $serviceInfo = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $serviceInfo;
    }

    public function updateServiceTitle(){
        $query = 'UPDATE `services` SET `title` = :title WHERE `id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->serviceTitle, PDO::PARAM_STR);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function deleteService() {
        $query = 'DELETE FROM `services` WHERE `services`.`id` = :serviceId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceId', $this->serviceId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setServiceId($newServiceId){
        $this->serviceId = $newServiceId;
    }

    public function setServiceTitle($newServiceTitle): void {
        $this->serviceTitle = $newServiceTitle;
    }
    
    public function setAccountId($newAccountId):void {
        $this->idaccount = $newAccountId;
    }

    public function setSlug($newSlug): void {
        $this->slug = $newSlug;
    }

    public function getHotelId(){
        return $this->idaccount;
    }

    public function beginTransaction(){
        return $this->db->beginTransaction();
    }

    public function commit(){
        return $this->db->commit();
    }

    public function rollback(){
        return $this->db->rollback();
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

}