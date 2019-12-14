<?php
    header("Content-Type:text/html; charset=utf-8");
    session_start();

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'kumomo';

    $_SESSION['link'] = mysqli_connect($host, $username, $password, $db);

    if($_SESSION['link']->connect_error){
        echo("IM DIE");
        die($_SESSION['link']->connect_error);
    }
    else{
        mysqli_query($_SESSION['link'], "SET NAMES utf8");
    }
?>