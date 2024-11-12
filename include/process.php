<?php
// Add Data
include '../include/conn.php';
if(isset($_POST['added'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO faculty_tbl(FacultyName) VALUES ('$title')";
    if (mysqli_query($con,$query)){
        echo json_encode(array("status" => 1));
    }
    else{
        echo json_encode(array("status"=>2));
    }
}