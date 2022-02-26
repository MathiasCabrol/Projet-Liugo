<?php
class SubService extends Database {

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

}