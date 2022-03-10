<?php
class Hotel extends Database {

    private int $id;
    private string $email;    
    
    /**
     * Fonction qui retourne un objet avec l'attribut name contenant le nom de l'établissement connecté
     * @return object
     */
    public function getHotelNameFromEmail():object {
        $query = 'SELECT `name` FROM `hotels` WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $hotelName = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $hotelName;
    }

    public function getHotelInfosById():object {
        $query = 'SELECT `name`, `email`, `phone`, `address`, `postcode`, `id_cities` FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $hotelInfos = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $hotelInfos;
    }

    public function setEmail($newEmail):void{
        $this->email = $newEmail;
    }

    public function setId($newId):void{
        $this->id = $newId;
    }
}