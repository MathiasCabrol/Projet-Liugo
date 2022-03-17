<?php

class Service extends Database {
    
private int $serviceId;

    public function getAllServicesByHotelId($hotelId):array{
        $query = 'SELECT `id`, `title` FROM `services` WHERE `id_hotels` = :idhotel';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idhotel',$hotelId, PDO::PARAM_INT);
        $queryStatement->execute();
        $services = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $services;
    }

    public function getAllPartnersServices($page){
        $query = 'SELECT `S`.`id` AS `id`, `S`.`title` AS `title`, `P`.`email` AS `partnerEmail`, `P`.`name` AS `partnerName`, `P`.`id_cities` AS `cityId` FROM `services` AS `S` INNER JOIN `partners` AS `P` ON `P`.`id` = `S`.`id_partners` WHERE `id_type` = 1 ORDER BY title DESC LIMIT :number, 10';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':number', ($page - 1) * 10, PDO::PARAM_INT);
        $queryStatement->execute();
        $servicesByPage = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $servicesByPage;
    }

    public function getSubServiceLowerPriceFromService(){
        $query = 'SELECT `SS`.`price` AS `lowestPrice` FROM `services` AS `S` INNER JOIN `subservices` AS `SS` ON `S`.`id` = `SS`.`id_services` WHERE `S`.`id` = :serviceid ORDER BY `SS`.`price` ASC LIMIT 1';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $subServiceLowestPrice = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $subServiceLowestPrice;
    }

    public function getServiceByServiceId():object{
        $query = 'SELECT `id`, `title` FROM `services` WHERE `id` = :idservice';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':idservice', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function checkIfServiceLinkedToHotel() {
        $query = 'SELECT `hotels`.`id` FROM `services` INNER JOIN `hotels` ON `services`.`id_hotels` = `hotels`.`id` WHERE `services`.`id` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $this->serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $hotelId = $queryStatement->fetchColumn();
        return $hotelId;
    }

    public function searchService($search, $page){
        $query = 'SELECT `S`.`id` AS `id`, `S`.`title` AS `title`, `P`.`email` AS `partnerEmail`, `P`.`name` AS `partnerName`, `P`.`id_cities` AS `cityId` FROM `services` AS `S` INNER JOIN `partners` AS `P` ON `P`.`id` = `S`.`id_partners` WHERE `S`.`slug` LIKE CONCAT("%", :search, "%") ORDER BY title DESC LIMIT :number, 10';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':search', $search, PDO::PARAM_STR);
        $queryStatement->bindValue(':number', ($page - 1) * 10, PDO::PARAM_INT);
        $queryStatement->execute();
        $searchedService = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $searchedService;
    }

    public function setServiceId($newServiceId):void{
        $this->serviceId = $newServiceId;
    }
}