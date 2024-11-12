<?php
require 'Database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $success = [];
  $errors = [];
  $fname = trim($_POST['fname']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $role = trim($_POST['role']);
  $role = $_POST['role'];
  //$unit = trim($_POST['unit']);
  $pass = 'password';
  $password = password_hash($pass, PASSWORD_BCRYPT);



  $stmtEmail = $db->checkExist('SELECT `Email` FROM `users_tbl` WHERE `Email` = :email', ['email' => $email]);
  $emailExist = $stmtEmail->rowCount();

  $stmtPhone = $db->checkExist('SELECT `Phone` FROM `users_tbl` WHERE `Phone` = :phone', ['phone' => $phone]);
  $phoneExist = $stmtPhone->rowCount();

  if($role == '--choose--'){
    $errors['role'] = 'Role is required!';
  }
  if($phoneExist > 0){
    $errors['phoneExist'] = 'Phone number already exists!';
  }

  if($emailExist > 0){
    $errors['emailExist'] = 'Email address already exists!';
  }

  if(empty($fname)) {
    $errors['fname'] = 'Fullname is required!';
  }

  if(empty($email)) {
    $errors['email'] = 'Email is required!';
  }

  if(empty($phone)) {
    $errors['phone'] = 'Phone is required!';
  }

  if($role == '--choose--') {
    $errors['role'] = 'Please choose a role!';
  }

  if(empty($errors)){
    $stmt = $db->conn->prepare('INSERT INTO `users_tbl` (`Firstname`,`Email`,`Phone`,`Role`,`Password`) VALUES (:fname,:email,:phone,:userRole,:Password) ');
    $result = $stmt->execute([
      ':fname' => $fname,
      ':email' => $email,
      ':phone' => $phone,
      ':userRole'  => $role,
      ':Password' => $password
    ]);
  }

  if (count($errors) > 0) {
      echo json_encode([
          'status' => false,
          'errors' => $errors,
      ]);
  } else {
      echo json_encode([
        'status' => true,
        'success' => $success,
      ]);
  }
}

?>