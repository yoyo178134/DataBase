<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $datas = findCareerUser($_GET['career']);

    if($datas){
        echo json_encode($datas, JSON_UNESCAPED_UNICODE);
    }
    else{
        echo "false";
    }
?>    