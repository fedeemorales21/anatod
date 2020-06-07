<?php
include_once '../database.php';
class province extends DB
{
    function getProvinces(){
        $query = $this->connect()->query('SELECT * FROM provinces');
        return $query;
    }

}
