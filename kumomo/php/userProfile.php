<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $data = userProfile();
    
    if(!empty($data)){
        echo json_encode($data);
    }
    else{
        echo "false";
    }
?>