<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';
    
    $datas = msgAllSendRsv($_GET['receive_id']);
    
    echo json_encode($datas, JSON_UNESCAPED_UNICODE);

?>