<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $datas = msgLast();

    echo json_encode($datas, JSON_UNESCAPED_UNICODE);

?>