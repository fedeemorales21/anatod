<?php
    include_once 'apiclient.php';
    
    $api = new ApiClient();
    
    $api->getClientPerID($_GET['id'])
    
?>