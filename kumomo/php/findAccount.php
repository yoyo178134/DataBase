<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $id = findAccount($_GET['account']);

    if($id!=null){
        echo $id;
    }
    else{
        echo "false";
    }
?>   