<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $account = findIDtoAccount($_GET['id']);

    if($account){
        echo $account;
    }
    else{
        echo "false";
    }
?>   