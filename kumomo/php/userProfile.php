<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $data = userProfile($_GET['id']);
    if(!empty($data)){
        
        echo json_encode($data);
        
        /*$profile = array('name'=> $data['name'], 'birthdate'=> $data['birthdate'], 'career'=> $data['career'], 'gender'=> $data['gender']);
        $profile_json = json_encode($profile);
        echo($profile_json);*/
    }
    else{
        echo "false";
    }

?>