<?php


include_once '../database.php';
class client extends DB
{
    function getListA(){
        $query = $this->connect()->query("SELECT C.id, C.name, C.dni, L.name AS 'locality', P.name AS 'province' FROM `clients` C INNER JOIN `provinces` P INNER JOIN `localities`  L WHERE C.`provinces_id` = P.id AND  C.`localities_id` = L.id");
        return $query;
    }
    
    function getListB(){
        $query = $this->connect()->query("SELECT P.id, P.name AS 'name_province', L.name AS 'name_locality', COUNT(C.id) as 'number' FROM `clients` C INNER JOIN `provinces` P INNER JOIN `localities`  L   WHERE C.`provinces_id` = P.id AND  C.localities_id = L.id GROUP BY C.localities_id");
        return $query;
    }
    
    function getClientPerID($id){
        $query = $this->connect()->prepare("SELECT * FROM clients WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query;
    }

    function createClient($name,$dni,$provinces_id,$localities_id){
        $query = $this->connect()->prepare('INSERT INTO clients (name,dni,provinces_id,localities_id) VALUES (:name, :dni,:provinces_id,:localities_id)');
        $query->execute(['name' => $name, 'dni' => $dni,'provinces_id' => $provinces_id,'localities_id' => $localities_id]);
        return $query;
    }

    
    function setClient($id,$name,$dni,$provinces_id,$localities_id){
        $query = $this->connect()->prepare("UPDATE clients SET name = :name, dni = :dni, provinces_id = :provinces_id, localities_id = :localities_id WHERE id = :id");
        $query->execute(['name' => $name, 'dni' => $dni,'provinces_id' => $provinces_id,'localities_id' => $localities_id,'id' => $id]);
        return $query;
    }
}
