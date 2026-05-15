<?php
    $sn = "localhost";
    $un = "root";
    $pass = "";
    $dbn = "final_project";

    $con = mysqli_connect($sn,$un,$pass,$dbn);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>