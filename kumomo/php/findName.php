<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $name = findName($_GET['id']);

    if($name!=null){
        echo $name;
    }
    else{
        echo "false";
    }
?>   