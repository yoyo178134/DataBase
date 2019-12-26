<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $msgSend = msgSend($_POST['text'], $_POST['send_id'], $_POST['receive_id']);

    if($msgSend){
        echo "true";
    }
    else{
        echo "false";
    }
?>    