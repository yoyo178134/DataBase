<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $findName = findName($_POST['id']);

    if($findName!=null){
        echo $findName;
    }
    else{
        echo "false";
    }
?>   