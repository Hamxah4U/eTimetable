<?php
if(!isset($_SESSION['id']) && !isset($_SESSION['uname'])){
    header('location:../index.php');
    exit();
}
