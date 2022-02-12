<?php

class Hotels extends Database {
    private string $name;
    private string $email;
    private string $password;

    public function createAccount():bool {
        $query = 'INSERT INTO `hotels` (`name`, `email`, `password`) VALUES (:name, :email, :password)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function checkIfAccountExists():object {
        $query = 'SELECT COUNT(`id`) AS `check` FROM `hotels` WHERE :email = `email`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $numberOfAccounts = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $numberOfAccounts;
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
}