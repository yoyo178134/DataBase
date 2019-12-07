<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $msgRead = msgRead($_POST['send_id'], $_POST['receive_id']);

    if($msgRead){
        echo 'true';
    }
    else{
        echo 'false';
    }

?>