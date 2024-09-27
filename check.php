<?php
    if (!isset($_SESSION['Username'])) {
        header('location: ../login.php');
        die();
    } else if (isset($_SESSION['Username']) && $_SESSION['ROLE'] != 1) {
        header('location: ../login.php');
        die();
    }
    // echo $_SESSION['Username'];
?>


