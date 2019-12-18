<?php
      require_once 'kumomo_connect.php';
      require_once 'functions.php';

      $checkLogin = checkLogin($_POST['account'], $_POST['password']);
      
      if($checkLogin){
          echo "true";
          header("Location: ../article.php");
      }
      else{
          echo "false";
      }
?>