<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $profile = userProfile($_GET['id']);
    if(!empty($profile)){
        echo "true";
    }
    else{
        echo "false";
    }

?>