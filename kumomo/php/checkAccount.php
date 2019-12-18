<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $check = checkHasAccont($_POST['account']);

    if($check){
        echo "false";
    }
    else{
        echo "true";
    }
?>