<?php
    require 'Database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $errors = [];
      $success = [];

      $session = htmlspecialchars($_POST['session']);
      $semester = htmlspecialchars($_POST['semester']);
      $department = $_POST['department'];

      $stmt = $db->checkExist('SELECT deptID, SID, session FROM semester WHERE deptID=:deptID AND SID=:SID AND session=:session',[
        ':deptID' => $department,
        ':SID' => $semester,
        ':session' => $session
      ]);

      $stmt->fetchAll(PDO::FETCH_ASSOC);
      $exist = $stmt->rowCount();


      if($department == '--choose--'){
        $errors['department'] = 'Required!';
      }

      if(empty(trim($session))){
        $errors['session'] = 'Required!';
      }

      if($semester == '--choose--'){
        $errors['semester'] = 'Required!';
      }elseif($exist > 0){
        $errors['semester'] = 'Already exist!!';
      }

      if(empty($errors)){
        $stmt = $db->conn->prepare('INSERT INTO semester (deptID, `SID`, `session`) VALUES (:deptID, :SID, :session) ');
        $stmt->execute([
          ':deptID' => $department,
          ':SID' => $semester,
          ':session' => $session
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