<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $msgLast = msgLast($_GET['receive_id']);

    echo json_encode($msgLast);

?>