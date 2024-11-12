<?php
    @session_start();
    @session_regenerate_id();
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "coe_db";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die();
?>