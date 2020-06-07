<?php
    include_once 'apiclient.php';
    
    $api = new ApiClient();
    
    $api->setClient($_POST['id'],$_POST['name'],$_POST['dni'],$_POST['provinces_id'],$_POST['localities_id'])
?>