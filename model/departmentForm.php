<?php
    require 'Database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $success = [];
      $errors = [];
      $faculty = $_POST['faculty'];
      $department = $_POST['department'];

      if($faculty == '--choose--'){
        $errors['faculty'] = 'Faculty is required!';
      }

      if(empty(trim($department))){
        $errors['department'] = 'Department is required!';
      }

      if(empty($errors)){
        session_start();
        $user = $_SESSION['email'];
        $stmt = $db->conn->prepare('INSERT INTO `department_tbl` (faculty_ID, Department, RegisterBy) VALUES (:faculty_ID, :Department, :RegisterBy) ');
        $result = $stmt->execute([
          ':faculty_ID' => $faculty,
          ':Department' => $department,
          ':RegisterBy' => $user
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