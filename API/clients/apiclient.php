<?php

include_once 'client.php';

class ApiClient{


    function getAll(){
        $client = new Client();
        $clients = array();
        
        $clients["listA"] = array();
        $res = $client->getListA();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                $item = array(
                    "id" => $row['id'],                 
                    "name" => $row['name'],                 
                    "dni" => $row['dni'],                 
                    "locality" => $row['locality'],                 
                    "province" => $row['province']                 
                );
                array_push($clients["listA"], $item);
            }
            
            
        }
        
        $clients["listB"] = array();
        $res2 = $client->getListB();

        if($res2->rowCount()){
            while ($row = $res2->fetch(PDO::FETCH_ASSOC)){
    
                $item = array(
                    "id" => $row['id'],                 
                    "name_province" => $row['name_province'],                 
                    "name_locality" => $row['name_locality'],                 
                    "number" => $row['number']                 
                );
                array_push($clients["listB"], $item);
            }
        
        }
        echo json_encode($clients);
    }


    function addClient($name,$dni,$province_id,$localities_id){
        $client = new Client();
        $res = $client->createClient($name,$dni,$province_id,$localities_id);
        echo json_encode(array('msg' => "Cliente Agregado"));
    }


    function setClient($id,$name,$dni,$provinces_id,$localities_id){
        
        $client = new Client();
        $res = $client->setClient($id,$name,$dni,$provinces_id,$localities_id);
        echo json_encode(array('msg' => "Cliente Modificado"));
    }


    function getClientPerID($id){
        $client = new Client();
        $clients = array();
        
        $clients["data"] = array();
        $res = $client->getClientPerID($id);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                $item = array(
                    "id" => $row['id'],                 
                    "name" => $row['name'],                 
                    "dni" => $row['dni'],                 
                    "provinces_id" => $row['provinces_id'],                 
                    "localities_id" => $row['localities_id']                 
                );
                array_push($clients["data"], $item);
            }
            $clients["success"] = true;
            
        }else {
            $clients["success"] = false;
            $clients["msg"] = 'ID corrupto';
        }
        echo json_encode($clients);
    }
}

?>