<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';
    
    $datas = twitterLoad();
    if(!empty($datas)){
        foreach($datas as $data){
            echo json_encode($data);
        }
    }
    else{
        echo "false";
    }
?>