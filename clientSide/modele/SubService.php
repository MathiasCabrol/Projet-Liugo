<?php

class SubService extends Database {
    
    public function getServicesSS($serviceId):array{
        $query = 'SELECT `ss`.`id` AS `ssId`, `ss`.`title` AS `ssTitle`, `ss`.`startingHour` AS `ssStartingHour`, `ss`.`finishingHour` AS `ssFinishingHour`, `ss`.`price` AS `ssPrice`, `ss`.`addButton` AS `ssAddButton` FROM `subservices` AS `ss` INNER JOIN `services` AS `s` ON `ss`.`id_services` = `s`.`id` WHERE `s`.`id` = :serviceid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':serviceid', $serviceId, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}