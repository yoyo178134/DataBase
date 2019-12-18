<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';
    
    $datas = msgRsv($_GET['send_id'], $_GET['receive_id']);
    if(!empty($datas)){
        echo json_encode($datas, JSON_UNESCAPED_UNICODE);
    }
    else{
        echo "false";
    }
?>