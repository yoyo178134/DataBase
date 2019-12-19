<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $msgUnreadCnt = msgUnreadCnt($_GET['receive_id']);

    if($msgUnreadCnt > 0){
        echo $msgUnreadCnt;
    }
    else{
        echo "false";//沒有未讀
    }

?>