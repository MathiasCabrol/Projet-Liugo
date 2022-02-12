<?php 

class Database {

public function __construct()
{
    try {
        $this->db = new PDO('mysql:host=localhost;port=3307;dbname=liugo;charset=utf8', 'root');
    } catch (Exception $error) {
        die($error->getMessage());
    }
}

}