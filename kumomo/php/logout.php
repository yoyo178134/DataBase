<?php
    session_start();

    //砍掉session
    session_destroy();

    header("Location: chat.php")
    
?>