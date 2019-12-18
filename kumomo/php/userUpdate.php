<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $userUpdate = userUpdate($_POST['name'], $_POST['birthdate'], $_POST['career']);

    if($userUpdate){
        echo "true";
    }
    else{
        echo "false";
    }
?>