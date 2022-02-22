<?php

class Account extends Database {
    private string $name;
    private string $email;
    private string $password;
    private int $id;
    private string $phone;
    private string $address;
    private string $postcode;
    private int $idCities;
    private string $sector;
    private string $token;
    private string $table;

    public function createAccount():bool {
        $query = 'INSERT INTO ' . $this->table . ' (`name`, `email`, `password`, `token`) VALUES (:name, :email, :password, :token)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function checkIfAccountExists():object {
        $query = 'SELECT COUNT(`id`) AS `check` FROM ' . $this->table . ' WHERE :email = `email`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $numberOfAccounts = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $numberOfAccounts;
    }

    public function subscriptionFinalisationPartners():bool {
        $query = 'UPDATE ' . $this->table . ' SET `phone` = :phone, `address` = :address, `postcode` = :postcode, `id_cities` = :idcities, `sector` = :sector WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryStatement->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->bindValue(':idcities', $this->idCities, PDO::PARAM_INT);
        $queryStatement->bindValue(':sector', $this->sector, PDO::PARAM_STR);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function subscriptionFinalisationHotels():bool {
        $query = 'UPDATE ' . $this->table . ' SET `phone` = :phone, `address` = :address, `postcode` = :postcode, `id_cities` = :idcities WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryStatement->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
        $queryStatement->bindValue(':idcities', $this->idCities, PDO::PARAM_INT);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function getConnexionId():object {
        $query = 'SELECT `id`, `password` FROM ' . $this->table . ' WHERE :email = `email`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $connexionId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $connexionId;
    }

    public function checkIfPhoneIsNull():object {
        $query = 'SELECT COUNT(`id`) AS `result` FROM ' . $this->table . ' WHERE `phone` IS NULL AND `email` = :email;';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    // SELECT COUNT(`id`) AS `result` FROM hotels WHERE `token` IS NULL AND `email` = 'test@gmail.com';
    public function checkIfTokenIsNull():object {
        $query = 'SELECT COUNT(`id`) AS `result` FROM ' . $this->table . ' WHERE `token` IS NULL AND `email` = :email;';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getId() {
        $query = 'SELECT `id` FROM ' . $this->table . ' WHERE :email = `email` AND :password = `password`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $selectedId;
    }

    public function checkToken():object{
        $query = 'SELECT COUNT(`id`) AS `result` FROM ' . $this->table . ' WHERE `token` = :token';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getEmailFromToken():object{
        $query = 'SELECT `email` FROM ' . $this->table . ' WHERE `token` = :token';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function setTokenNull():bool{
        $query = 'UPDATE ' . $this->table . ' SET `token` = NULL WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();;
    }


    public function getMail():string{
        return $this->email;
    }

    public function setToken($newToken) {
        $this->token = $newToken;
    }

    public function setName($newName) {
        $this->name = $newName;
    }

    public function setEmail($newEmail) {
        $this->email = $newEmail;
    }

    public function setPassword($newPassword) {
        $this->password = $newPassword;
    }

    public function setPhone($newPhone) {
        $this->phone = $newPhone;
    }

    public function setAddress($newAddress) {
        $this->address = $newAddress;
    }

    public function setPostcode($newPostcode) {
        $this->postcode = $newPostcode;
    }

    public function setIdCities($newIdCities) {
        $this->idCities = $newIdCities;
    }

    public function setSector($newSector) {
        $this->sector = $newSector;
    }

    public function setId($newId) {
        $this->id = $newId;
    }

    public function setTable($newTable){
        $this->table = $newTable;
    }
}