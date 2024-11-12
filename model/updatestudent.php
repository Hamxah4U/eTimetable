<?php
    require 'Database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $sname = $_POST['sname'];
        $student_id = $_POST['stdID']; 
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $faculty = $_POST['faculty'];

        $errors = [];
        $success = [];

        if(empty(trim($fname))){
            $errors['fname'] = 'Firstname cannot be empty!';
        }

        if(empty($student_id)){
            $errors['student_id'] = 'Student ID is required!';
        }

        if(empty($errors)){
            $stmt = $db->conn->prepare('UPDATE `student_tbl` SET Faculty=:faculty,dob=:dob,Gender=:gender,`Address`=:adrs,Phone=:phone,Email=:email,`Firstname` = :Firstname, Middlename=:mname,Surname=:sname WHERE `stu_ID` = :id');
            $stmt->execute([
                ':Firstname' => $fname,
                ':mname' => $mname,
                ':sname' => $sname,
                ':id' => $student_id,
                ':email' => $email,
                ':phone' => $phone,
                ':adrs' => $address,
                ':gender' => $gender,
                ':dob' => $dob,
                ':faculty' => $faculty
                
            ]);

            if($stmt->rowCount() > 0){
                $success['update'] = 'Record updated successfully!';
            } else {
                $errors['update'] = 'No record was updated!';
            }
        }

        if (count($errors) > 0) {
          echo json_encode([
              'status' => false,
              'errors' => $errors
          ]);
      } else {
          echo json_encode([
              'status' => true,
              'success' => $success
          ]);
      }

    }
?>
