<?php
    include_once 'apilocality.php';

    $api = new ApiLocalities();

    $api->getAllLocalities($_GET['id']);
    
?>