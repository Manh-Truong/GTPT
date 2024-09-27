<?php
    session_start();

    include 'connect.php';
    session_destroy();

    header('location: login.php');

    session_destroy();
    header('location: ./index.php');

?>
