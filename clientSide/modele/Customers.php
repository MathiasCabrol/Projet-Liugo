<?php

class Customer extends Database {
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private string $password;
    private string $token;

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

    public function getIdByMail(){
        $query = 'SELECT `id` FROM `customers` WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue('email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $userId = $queryStatement->fetchColumn();
        return $userId;
    }

    public function setTokenNull():bool{
        $query = 'UPDATE `customers` SET `token` = NULL WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        return $queryStatement->execute();;
    }

    public function setFirstName($newFirstName){
        $this->firstName = $newFirstName;
    }

    public function setLastName($newLastName){
        $this->lastName = $newLastName;
    }

    public function setPhone($newPhone){
        $this->phone = $newPhone;
    }

    public function setEmail($newEmail){
        $this->email = $newEmail;
    }

    public function setPassword($newPassword){
        $this->password = $newPassword;
    }

    public function setToken($newToken) {
        $this->token = $newToken;
    }
}