<?php
class Presentation extends Database {

    private string $description;

    public function insertDescription($hotelId):bool{
        $query = 'INSERT INTO `presentation` (`description`, `hotels_id`) VALUES (:description, :hotel_id)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryStatement->bindValue(':hotel_id', $hotelId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function updateDescription($hotelId):bool{
        $query = 'UPDATE `presentation` SET `description` = :description WHERE `hotels_id` = :hotel_id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryStatement->bindValue(':hotel_id', $hotelId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function checkIfDescriptionIsSet($hotelId):object{
        $query = 'SELECT COUNT(`description`) AS `result` FROM `presentation` WHERE `hotels_id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $hotelId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getDescription($hotelId):object{
        $query = 'SELECT `description` FROM `presentation` WHERE `hotels_id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $hotelId, PDO::PARAM_INT);
        $queryStatement->execute();
        $description = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $description;
    }

    public function setDescription($newDescription):void{
        $this->description = $newDescription;
    }
}