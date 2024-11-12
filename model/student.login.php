<?php
    require 'Database.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $errors = [];
      $success = [];
      $studentUsername = htmlspecialchars($_POST['studentUsername']);
      $studentPassword = htmlspecialchars($_POST['studentPassword']);

      if(empty(trim($studentPassword))){
        $errors['password'] = 'Required!';
      }

      if(empty(trim($studentUsername))){
        $errors['email'] = 'Required!';
      }

      if(empty($errors)){        
        $stmt = $db->conn->prepare('SELECT Course_of_study,Faculty, picture,stu_ID,Reg_no,Firstname,Surname,`Password`, `Email`, `Phone`, `Reg_no` FROM `student_tbl` WHERE :student IN (Email, Phone, Reg_no)');
        $stmt->execute([
          ':student' => $studentUsername,
          ':student' => $studentUsername,
          ':student' => $studentUsername,
          
        ]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if($student){
          $picture = $student['picture'];
          $email = $student['Email'];
          $Reg_no = $student['Reg_no'];
          $Phone = $student['Phone'];
          $Firstname = $student['Firstname'];
          $Surname = $student['Surname'];
          $Reg_no = $student['Reg_no'];
          $userpass = $student['Password'];
          $stdID = $student['stu_ID'];
          $faculty = $student['Faculty'];
          $department = $student['Course_of_study'];

          if(password_verify($studentPassword, $userpass)){
            session_start();
            $_SESSION['department'] = $department;
            $_SESSION['faculty'] = $faculty;
            $_SESSION['picture'] = $picture;
            $_SESSION['stdID'] = $stdID;
            $_SESSION['Reg_no'] = $Reg_no;
            $_SESSION['fname'] = $Firstname;
            $_SESSION['sname'] = $Surname;
            $_SESSION['email'] = $email;
            $success['messageRe'] = 'Login successful, please wait...';
            $success['redirect'] = '/student/dashboard';
          }
        }else{
          $errors['password'] = 'Invalid Email or Password!';
        }
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