<?php
class Hotel extends Database {

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

    public function setEmail($newEmail):void{
        $this->email = $newEmail;
    }
}