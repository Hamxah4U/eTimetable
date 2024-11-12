<?php
  require 'Database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $adminUsername = $_POST['adminUsername'];
      $adminPassword = $_POST['adminPassword'];
      $errors = [];
      $success = [];

      if(empty(trim($adminUsername))){
        $errors['user'] = 'Required!';
      }

      if(empty(trim($adminPassword))){
        $errors['pass'] = 'Required!';
      }

      if(empty($errors)){
        $status = 'Active';
        $stmt = $db->conn->prepare('SELECT `Role`, `Email`, `Phone`, `Password`, `userID`, `Firstname` FROM `users_tbl` WHERE `Status` = :userstatus AND `Email` = :email OR `Phone` = :phone');
        $stmt->execute(['email' => $adminUsername, 'phone' => $adminUsername, 'userstatus' => $status]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
          $fullname = $user['Firstname'];
          $Role = $user['Role'];
          $userID = $user['userID'];
          $email = $user['Email'];
          $phone = $user['Phone'];
          $userpass = $user['Password'];
          if(password_verify($adminPassword, $userpass)){
            session_start();
            $_SESSION['fullname'] = $fullname;
            $_SESSION['Role'] = $Role;
            $_SESSION['email'] = $email; 
            $_SESSION['userID'] = $userID;
            $success['messageRe'] = 'Login successful, please wait...';
            $success['redirectUser'] = '/dashboard';
          }else{
            $errors['pass'] = 'Invalid password!';
          }
        }else{
          $errors['pass'] = 'Email or Phone does not exist!';
        }
      }

      if(count($errors) > 0){
        echo json_encode([
          'status' => false,
          'errors' => $errors,
        ]);
      }else{
        echo json_encode([
          'status' => true,
          'success' => $success,
        ]);
      }


    }
?>