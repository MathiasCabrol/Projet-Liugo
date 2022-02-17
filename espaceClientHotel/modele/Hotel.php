<?php
class Hotel extends Database {

    private string $email;    
    
    
    public function getHotelNameFromEmail() {
        $query = 'SELECT `name` FROM `hotels` WHERE `email` = :email';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryStatement->execute();
        $hotelName = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $hotelName;
    }

    public function setEmail($newEmail):void{
        $this->email = $newEmail;
    }
}