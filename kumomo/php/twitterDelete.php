<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $twitterDelete = twitterDelete($_POST['id']);

    if($twitterDelete){
        echo "yes";
    }
    else{
        echo "no";
    }
?>  