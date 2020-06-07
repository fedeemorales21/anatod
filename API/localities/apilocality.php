<?php

include_once 'locality.php';

class ApiLocalities{


    function getAllLocalities($id){
        $locality = new locality();
        $localities = array();
        $localities["data"] = array();

        $res = $locality->getLocalities($id);

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item = array(
                    "id" => $row['id'],
                    "name" =>  $row['name']                 
                );
                array_push($localities["data"], $item);
            }
        
            echo json_encode($localities);
        }else{
            echo json_encode(array('msg' => 'No hay elementos'));
        }
    }


}

?>