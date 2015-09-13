<?php
    session_start();
    echo $_SESSION['user'];
    if(isset($_SESSION['user'])){
        session_destroy();
        $_SESSION = array();
        header('Location: login.php');
    }
    else{
        header('Location: login.php');
    }
?>
