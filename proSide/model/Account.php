<?php

class Account extends Database {
    private string $name;
    private string $email;
    private string $password;
    private string $table;

    public function createAccount():bool {
        $query = 'INSERT INTO ' . $this->table . ' (`name`, `email`, `password`) VALUES (:name, :email, :password)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
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

    public function getId() {
        $query = 'SELECT `id` FROM ' . $this->table . ' WHERE :email = `email` AND :password = `password`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryStatement->execute();
        $selectedId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $selectedId;
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

    public function setTable($newTable){
        $this->table = $newTable;
    }
}