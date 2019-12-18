<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $twitterLike = twitterLike($_POST['id']);

    if($twitterLike){
        echo "true";
    }
    else{
        echo "false";
    }
?>  