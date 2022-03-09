<?php
class SubService extends Database {

    private int $id;
    private string $title;
    private string $startingHour;
    private float $price;
    private string $finishingHour;
    private int $addButton;
    private int $idservice;

    public function addSubService(): bool {
        $query = 'INSERT INTO `subServices` (`title`, `startingHour`, `price`, `finishingHour`, `addButton`, `id_services`) VALUES (:title, :startingHour, :price, :finishingHour, :addButton, :idservices)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryStatement->bindValue(':startingHour', $this->startingHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':price', $this->price, PDO::PARAM_STR);
        $queryStatement->bindValue(':finishingHour', $this->finishingHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':addButton', $this->addButton, PDO::PARAM_INT);
        $queryStatement->bindValue(':idservices', $this->idservice, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function getSubServiceId():int {
        $query = 'SELECT `id` FROM `subservices` WHERE `title` = :title';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryStatement->execute();
        $subServiceId = $queryStatement->fetchColumn();
        return $subServiceId;
    }

    public function getAllSubServices(int $serviceId){
        $query = 'SELECT `SS`.`id` AS `subServiceId`, `SS`.`title` AS `subServiceTitle`, `SS`.`startingHour` AS `startingHour`, `SS`.`finishingHour` AS `finishingHour`, `SS`.`price` AS `price`, `SS`.`addButton` AS `addButton` FROM `subservices` AS `SS` WHERE :serviceid = `SS`.`id_services`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $subServicesInfo = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $subServicesInfo;
    }

    public function getSubServiceById(){
        $query = 'SELECT `SS`.`title` AS `subServiceTitle`, `SS`.`startingHour` AS `startingHour`, `SS`.`finishingHour` AS `finishingHour`, `SS`.`price` AS `price`, `SS`.`addButton` AS `addButton` FROM `subservices` AS `SS` WHERE :subserviceid = `SS`.`id`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $subServicesInfo = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $subServicesInfo;
    }

    public function getServiceId(){
        $query = 'SELECT `id_services` FROM `subservices` WHERE `id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function getLastInsertedSubService() {
        $query = 'SELECT `id` FROM `subservices` WHERE `id` = (SELECT LAST_INSERT_ID())';
        $queryStatement = $this->db->query($query);
        $subserviceid = $queryStatement->fetchColumn();
        return $subserviceid;
    }

    public function checkIfSubServiceExists() {
        $query = 'SELECT COUNT(`id`) AS `result` FROM `subservices` WHERE `id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function deleteSubService() {
        $query = 'DELETE FROM `subservices` WHERE `id` = :subserviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':subserviceid', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function updateSubService() {
        $query = 'UPDATE `subservices` SET `title` = :title, `startingHour` = :startingHour, `finishingHour` = :finishingHour, `price` = :price WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryStatement->bindValue(':startingHour', $this->startingHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':finishingHour', $this->finishingHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':price', $this->price, PDO::PARAM_STR);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setTitle($newTitle):void {
        $this->title = $newTitle;
    }

    public function setStartingHour($newStartingHour):void {
        $this->startingHour = $newStartingHour;
    }

    public function setPrice($newPrice):void {
        $this->price = $newPrice;
    }

    public function setFinishingHour($newFinishingHour):void {
        $this->finishingHour = $newFinishingHour;
    }

    public function setAddButton($newAddButton):void {
        $this->addButton = $newAddButton;
    }

    public function setIdService($newIdService):void {
        $this->idservice = $newIdService;
    }

    public function setId($newId):void {
        $this->id = $newId;
    }

}