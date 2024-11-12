<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "coe_db";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors = [];
  $success = [];

  $fname = htmlspecialchars($_POST['fname']);
  $mname = htmlspecialchars($_POST['mname']);
  $surname = htmlspecialchars($_POST['surname']);
  $regNo = htmlspecialchars($_POST['regNo']);
  $jambNo = htmlspecialchars($_POST['jambNo']);
  $ninNo = htmlspecialchars($_POST['ninNo']);
  $school = htmlspecialchars($_POST['school']);
  $department = htmlspecialchars($_POST['department']);
  $level = htmlspecialchars($_POST['level']);

  $sqlreg = mysqli_query($conn, "SELECT `Reg_no` FROM `student_tbl` WHERE `Reg_no` = '$regNo' ") or die();
  $regExist = mysqli_num_rows($sqlreg);

  if(empty(trim($fname))) {
    $errors['fname'] = 'Firstname is required!';
  }
  if($regExist > 0){
    $errors['regNo'] = 'Registration number already exists!';
  }
  if(empty(trim($surname))) {
    $errors['surname'] = 'Surname is required!';
  }
  if(empty(trim($regNo))) {
    $errors['regNo'] = 'Registration number is required!';
  }
  // if(empty(trim($jambNo))) {
  //   $errors['jambNo'] = 'Jamb number is required!';
  // }
  // if(empty(trim($ninNo))) {
  //   $errors['ninNo'] = 'NIN number is required!';
  // }
  if($school == '--choose--') {
    $errors['school'] = 'School is required!';
  }
  if($department == '--choose--'){
    $errors['department'] = 'Department is required!';
  }
  if($level == '--choose--') {
    $errors['level'] = 'Required!';
  }

  if(empty($errors)){
    $sql = "INSERT INTO `student_tbl` (`Firstname`,`Middlename`,`Surname`,`Reg_no`,`JambNo`,`NIN`,`Faculty`,`Course_of_study`,`Session`,`Semester`,`Level`) VALUES ('$fname', '$mname', '$surname', '$regNo', '$jambNo', '$ninNo', '$school','$department','1','1','$level')";
    $result = mysqli_query($conn, $sql) or die();

    if($result){
      $success['success'] = 'Registration successfully!';
    }
  }

  if (count($errors) > 0) {
      echo json_encode([
          "status" => false,
          "errors" => $errors,
      ]);
  } else {
      echo json_encode([
          "status" => true,
          "message" => $success,
      ]);
  }
}