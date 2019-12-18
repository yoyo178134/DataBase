<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $twitterPost = twitterPost($_POST['text']);

    if($twitterPost){
        echo 'true';
    }
    else{
        echo 'false';
    }
?>   