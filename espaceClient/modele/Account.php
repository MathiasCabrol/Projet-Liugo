<?php
class Account extends Database {

    private int $id;
    private string $email;    
    private string $name;
    private string $phone;
    private string $address;
    private string $postcode;
    private string $id_cities;
    protected string $table;

    /**
     * Fonction qui retourne un objet avec l'attribut name contenant le nom de l'établissement connecté
     * @return object
     */

    public function getAccountNameFromEmail():object {
        $query = 'SELECT `name` FROM ' . $this->table . ' WHERE `email` =  :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $accountName = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $accountName;
    }

    public function getAccountInfosById():object {
        $query = 'SELECT `name`, `email`, `phone`, `address`, `postcode`, `id_cities` FROM ' . $this->table . ' WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $hotelInfos = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $hotelInfos;
    }

    public function updateAccountName():bool {
        $query = 'UPDATE ' . $this->table . ' SET `name` = :accountname WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountname', $this->name, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateAccountEmail():bool {
        $query = 'UPDATE ' . $this->table . ' SET `email` = :accountemail WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountemail', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateAccountPhone():bool {
        $query = 'UPDATE ' . $this->table . ' SET `phone` = :accountphone WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountphone', $this->phone, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateAccountAddress():bool {
        $query = 'UPDATE ' . $this->table . ' SET `address` = :accountaddress WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountaddress', $this->address, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateAccountPostCode():bool {
        $query = 'UPDATE ' . $this->table . ' SET `postcode` = :accountpostcode, `id_cities` = :id_cities WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountpostcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->bindValue(':id_cities', $this->id_cities, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function deleteAccount():bool {
        $query = 'DELETE FROM ' . $this->table . ' WHERE `id` = :id';
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
