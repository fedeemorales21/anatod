<?php
    include_once 'apiclient.php';
    
    $api = new ApiClient();
    
    if(isset($_POST['name']) && isset($_POST['dni']) && isset($_POST['provinces_id']) && isset($_POST['localities_id']) ){
   
        $api->addClient($_POST['name'],$_POST['dni'],$_POST['provinces_id'], $_POST['localities_id'] );

    }else{
        echo json_encode(array('success' => false,'msg' => "Faltan Campos"));
    }
    
?>