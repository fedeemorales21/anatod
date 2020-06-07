<?php

include_once 'province.php';

class ApiProvince{


    function getAllProvonces(){
        $province = new province();
        $provinces = array();
        $provinces["data"] = array();

        $res = $province->getProvinces();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['id'],
                    "name" =>  $row['name']                 
                );
                array_push($provinces["data"], $item);
            }
        
            echo json_encode($provinces);
        }else{
            echo json_encode(array('msg' => 'No hay elementos'));
        }
    }


}

?>