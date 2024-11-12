<?php
require 'Database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = [];
  $success = [];

  $department = $_POST['department'];
  $semester = $_POST['semester'];
  $course = $_POST['course'];
  $lecturer = $_POST['lecturer'];
  $venue = $_POST['venue'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  if(empty(trim($time))){
    $errors['time'] = 'Required!';
  }

  if(empty(trim($date))){
    $errors['date'] = 'Required!';
  }

  if(empty(trim($venue))){
    $errors['venue'] = 'Required!';
  }

  if($semester == '--choose--'){
    $errors['semester'] = 'Required!';
  }

  if($department == '--choose--'){
    $errors['department'] = 'Required!';
  }

  if($course == '--choose--'){
    $errors['course'] = 'Required!';
  }

  if($lecturer == '--choose--'){
    $errors['lecturer'] = 'Required!';
  }

  if(empty($errors)){
    $stmt = $db->conn->prepare('INSERT INTO timeschedule (department,semester,course,time,date,lecturer,venue) VALUES (:department,:semester,:course,:time,:date,:lecturer, :venue) ');
    $stmt->execute([
      ':department' => $department,
      ':semester' => $semester,
      ':course' => $course,
      ':time' => $time,
      ':date' => $date,
      ':lecturer' => $lecturer,
      ':venue' => $venue
    ]);
  }

  if(count($errors) > 0){
    echo json_encode([
      'status' => false,
      'errors' => $errors
    ]);
  }else{
    echo json_encode([
      'status' => true,
      'success' => $success
    ]);

  }



}