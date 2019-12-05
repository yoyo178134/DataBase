<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $signup = signup($_POST['account'], $_POST['password'], $_POST['passwordConfirm'], $_POST['name'], $_POST['birthdate'], $_POST['career'], $_POST['gender']);

    if($signup){
        echo 'true';
    }
    else{
        echo 'false';
    }
?>