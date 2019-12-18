<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';
    
    $datas = msgRsv($_GET['send_id'], $_GET['receive_id']);
    if(!empty($datas)){
        foreach($datas as $data){
            echo json_encode($data);
        }
    }
    else{
        echo "false";
    }
?>