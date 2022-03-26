<?php

class Customer extends Database {
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private string $password;
    private string $token;
    private int $id;

    public function checkIfAccountExists():object {
        $query = 'SELECT COUNT(`id`) AS `check` FROM `customers` WHERE :email = `email`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $numberOfAccounts = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $numberOfAccounts;
    }

    public function checkToken():object{
        $query = 'SELECT COUNT(`id`) AS `result` FROM `customers` WHERE `token` = :token';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getIdAndEmailFromToken(){
        $query = 'SELECT `id`, `email` FROM `customers` WHERE `token` = :token';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function createAccount():bool {
        $query = 'INSERT INTO `customers` (`firstname`, `lastname`, `phone`, `email`, `password`, `token`) VALUES (:firstname, :lastname, :phone, :email, :password, :token)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':firstname', $this->firstName, PDO::PARAM_STR);
        $queryStatement->bindValue(':lastname', $this->lastName, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryStatement->bindValue(':token', $this->token, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function getId() {
        $query = 'SELECT `id` FROM `customers` WHERE :email = `email` AND :password = `password`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $selectedId;
    }

    public function getIdByMail():int{
        $query = 'SELECT `id` FROM `customers` WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $userId = $queryStatement->fetchColumn();
        return $userId;
    }

    public function getCustomerDetails():object{
        $query = 'SELECT `lastname`, `firstname`, `email`, `phone` FROM `customers` WHERE `id` = :customerid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':customerid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $userInformations = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $userInformations;
    }

    public function updateAccountEmail():bool {
        $query = 'UPDATE `customers` SET `email` = :accountemail WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountemail', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function updateAccountPhone():bool {
        $query = 'UPDATE `customers` SET `phone` = :accountphone WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->bindValue(':accountphone', $this->phone, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function setTokenNull():bool{
        $query = 'UPDATE `customers` SET `token` = NULL WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();;
    }

    public function checkIfTokenIsNull():string {
        $query = 'SELECT COUNT(`id`) AS `result` FROM `customers` WHERE `token` IS NULL AND `email` = :email;';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetchColumn();
        return $result;
    }

    public function getConnexionId():object {
        $query = 'SELECT `id`, `password` FROM `customers` WHERE :email = `email`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $connexionId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $connexionId;
    }

    public function deleteAccount():bool {
        $query = 'DELETE FROM `customers` WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setFirstName($newFirstName):void{
        $this->firstName = $newFirstName;
    }

    public function setLastName($newLastName):void{
        $this->lastName = $newLastName;
    }

    public function setPhone($newPhone):void{
        $this->phone = $newPhone;
    }

    public function setEmail($newEmail):void{
        $this->email = $newEmail;
    }

    public function setPassword($newPassword):void{
        $this->password = $newPassword;
    }

    public function setToken($newToken):void {
        $this->token = $newToken;
    }

    public function setId($newId):void {
        $this->id = $newId;
    }
}