<?php include('../../php/navbar.php'); ?>
<?php
    session_start();
    session_destroy();
    header('Location: ../login.html');
    exit;
?>



