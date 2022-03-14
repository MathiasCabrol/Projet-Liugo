<?php
class Hotel extends Database {

    private int $id;
    private string $email;    
    private string $name;
    private string $phone;
    private string $address;
    private string $postcode;
    private string $id_cities;
    
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

    public function updateHotelName():bool {
        $query = 'UPDATE `hotels` SET `name` = :hotelname WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':hotelname', $this->name, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateHotelEmail():bool {
        $query = 'UPDATE `hotels` SET `email` = :hotelemail WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':hotelemail', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateHotelPhone():bool {
        $query = 'UPDATE `hotels` SET `phone` = :hotelphone WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':hotelphone', $this->phone, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateHotelAddress():bool {
        $query = 'UPDATE `hotels` SET `address` = :hoteladdress WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':hoteladdress', $this->address, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateHotelPostCode():bool {
        $query = 'UPDATE `hotels` SET `postcode` = :hotelpostcode, `id_cities` = :id_cities WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':hotelpostcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->bindValue(':id_cities', $this->id_cities, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function deleteHotel():bool {
        $query = 'DELETE FROM `hotels` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setEmail($newEmail):void{
        $this->email = $newEmail;
    }

    public function setName($newName):void{
        $this->name = $newName;
    }

    public function setPhone($newPhone):void{
        $this->phone = $newPhone;
    }

    public function setAddress($newAddress):void{
        $this->address = $newAddress;
    }

    public function setPostCode($newPostCode):void{
        $this->postcode = $newPostCode;
    }

    public function setIdCities($newIdCities):void{
        $this->id_cities = $newIdCities;
    }

    public function setId($newId):void{
        $this->id = $newId;
    }
}