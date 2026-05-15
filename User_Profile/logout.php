<?php
    session_start();
    if(isset($_SESSION['logedin'])){
        session_destroy();
        header("Location: ../index.php");
    }
?>