<?php
    session_start();

    if(!isset($_SESSION['id_pessoa'])){
        session_destroy();
        header('Location: ../pages/login.html'); 
        exit;
    }
?>
