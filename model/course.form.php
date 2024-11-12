<?php
  require 'Database.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $faculty = htmlspecialchars($_POST['faculty']);
    $department = htmlspecialchars($_POST['department']);
    $course = htmlspecialchars($_POST['course']);
    $code = htmlspecialchars($_POST['code']);
    $errors = [];
    $success = [];

    $stmt = $db->checkExist('SELECT CourseTitle, CourseCode, faculty, dpt FROM `course_tbl` WHERE CourseTitle=:course AND CourseCode=:code AND faculty=:faculty AND dpt=:dpt',[
      ':course' => $course,
      ':code' => $code,
      ':faculty' => $faculty,
      ':dpt' => $department
    ]);

    $stmt->fetchAll(PDO::FETCH_ASSOC);
    $courseExist = $stmt->rowCount();


    if($faculty == '--choose--'){
      $errors['faculty'] = 'Required!';
    }

    if($department == '--choose--'){
      $errors['department'] = 'Requird!';
    }

    if(empty(trim($course))){
      $errors['course'] = 'Course is required!';
    }

    if(empty(trim($code))){
      $errors['code'] = 'Course code is required!';
    }elseif($courseExist > 0){
      $errors['code'] = 'already exist!';
    }

    if(empty($errors)){
      session_start();
      $user = $_SESSION['email'];
      $stmt = $db->conn->prepare('INSERT INTO `course_tbl` (CourseTitle, CourseCode, faculty, dpt, Registerby) VALUES (:CourseTitle, :CourseCode, :faculty, :dpt, :Registerby) ');
      $result = $stmt->execute([
        ':CourseTitle' => $course,
        ':CourseCode' => $code,
        ':faculty' => $faculty,
        ':dpt' => $department,
        ':Registerby' => $user
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
?>