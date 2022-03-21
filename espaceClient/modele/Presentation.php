<?php
class Presentation {

    private string $description;
    private string $id_type;
    protected string $typeofid;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function insertDescription($id):bool{
        $query = 'INSERT INTO `presentation` (`description`, ' . $this->typeofid . ', `id_type`) VALUES (:description, :id, :idtype)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $queryStatement->bindValue(':idtype', $this->id_type, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function updateDescription($id):bool{
        $query = 'UPDATE `presentation` SET `description` = :description WHERE ' . $this->typeofid . ' = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryStatement->bindValue(':hotel_id', $id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function checkIfDescriptionIsSet($id):object{
        $query = 'SELECT COUNT(`description`) AS `result` FROM `presentation` WHERE ' . $this->typeofid . ' = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getDescription($id):object{
        $query = 'SELECT `description` FROM `presentation` WHERE ' . $this->typeofid . ' = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $queryStatement->execute();
        $description = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $description;
    }

    public function setDescription($newDescription):void{
        $this->description = $newDescription;
    }

    public function setIdType($newIdType):void{
        $this->id_type = $newIdType;
    }
}