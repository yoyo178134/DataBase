<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $account = findAccount($_GET['id']);

    if($account!=null){
        echo $account;
    }
    else{
        echo "false";
    }
?>   