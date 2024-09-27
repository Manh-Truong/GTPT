<?php
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'gtpt';
    $con = mysqli_connect($hname,$uname,$pass,$db);
    if(!$con){
        die("Không thể kết nối tới database".mysqli_connect_error());
    }
?>