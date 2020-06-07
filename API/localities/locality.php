<?php
include_once '../database.php';
class locality extends DB
{
    function getLocalities($id){
        $query = $this->connect()->prepare('SELECT * FROM localities WHERE provinces_id = :id');
        $query->execute(['id' => $id]);
        return $query;
    }

}