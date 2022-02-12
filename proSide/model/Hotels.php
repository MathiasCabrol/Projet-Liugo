<?php

class Partners extends Database {
    private string $name;
    private string $email;
    private string $password;

    public function createAccount() {
        $query = 'INSERT INTO `hotels` (`name`, `email`, `password`) VALUES (:name, :email, :address)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindvalues(':name', $this->name, PDO::PARAM_STR);
        $queryStatement->bindvalues(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->bindvalues(':password', $this->password, PDO::PARAM_STR);
        return $queryStatement->execute();
    }
}