<?php

session_start();

if (!isset($_SESSION['id_cliente'])) {
    session_destroy();
    
    header('Location: /Ecomercy/pages/login/login.html'); 
    
    exit; 
}
?>