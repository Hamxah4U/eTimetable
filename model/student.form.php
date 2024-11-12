<?php

require 'Database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = [];
  $success = [];
  $fname = $_POST['fnam'];
  $snam = $_POST['surname'];
  $email = $_POST['email'];
  $matricno = $_POST['matricno'];
  $faculty = $_POST['faculty'];
  $dpt = $_POST['dpt'];
  $level = $_POST['level'];
  $pass = 'password';
  $password = password_hash($pass, PASSWORD_BCRYPT);

  if($dpt == '--choose--'){
    $errors['department'] = 'Department is required!';
  }

  if($faculty == '--choose--'){
    $errors['faculty'] = 'Faculty is required!';
  }

 
  $stmtEmail = $db->checkExist('SELECT `Email` FROM `student_tbl` WHERE `Email` = :email',[':email' => $email]);
  $emailExist = $stmtEmail->rowCount();

  $stmtMatric = $db->checkExist('SELECT `Reg_no` FROM `student_tbl` WHERE `Reg_no` = :Reg_no', [':Reg_no' => $matricno]);
  $matricExist = $stmtMatric->rowCount();

  if(empty(trim($matricno))){
    $errors['matricno'] = 'matric number is required!';
  }elseif($matricExist > 0){
    $errors['matricno'] = 'Matric number already exist!';
  }

  if($level == '--choose--'){
    $errors['level'] = 'Student level is required!';
  }

  if(empty(trim($fname))){
    $errors['fname'] = 'Firstname is required!';
  }

  if(empty(trim($snam))){
    $errors['sname'] = 'Surname is required!';
  }


  if(empty(trim($email))){
    $errors['emails'] = 'Email is required!';
  }elseif($emailExist){
    $errors['emails'] = 'Email already exist!';
  }

  if(!empty($_FILES['picture']['name'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['picture']['type'];
    $fileName = $_FILES['picture']['name'];
    $fileTmp = $_FILES['picture']['tmp_name'];
    // $uploadDir = 'uploads/';//
    $uploadDir = '../img/uploads/';

    $fileExtension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION); 
    $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension; 

    $filePath = $uploadDir . $uniqueFileName;

    //$filePath = $uploadDir . basename($fileName);

    if(in_array($fileType, $allowedTypes)){
     
      if(move_uploaded_file($fileTmp, $filePath)) {
        $success['picture'] = 'File uploaded successfully!';
      }else{
        $errors['picture'] = 'File upload failed!';
      }
    }else{
      $errors['picture'] = 'Invalid file type! Only JPG, PNG, and GIF are allowed.';
    }
  }else{
    $errors['picture'] = 'Required!';
  }

  if(empty($errors)){
    $stmt = $db->conn->prepare('INSERT INTO student_tbl (Firstname,Surname, Email, Reg_no,`Password`,Faculty,Course_of_study,`level`,picture) VALUES (:fname,:sname,:email,:matric,:pass,:Faculty,:Course_of_study,:level,:picture)');

    $result = $stmt->execute([
      ':fname' => $fname,
      ':sname' => $snam,
      ':email' => $email,
      ':matric' => $matricno,
      ':pass' => $password,
      ':Faculty' => $faculty,
      ':Course_of_study' => $dpt,
      ':level' => $level,
      ':picture' => !empty($uniqueFileName) ? $uniqueFileName : 'default.jpg',
    ]);
    if($result){
      $success['message'] = 'Student registration successfully!';
    }
  }
  
  if(count($errors) > 0){
    echo json_encode([
      'status' => true,
      'errors' => $errors
    ]);
  }else{
    echo json_encode([
      'status' => false,
      'success' => $success,
    ]);
  }


}