<?php
    require 'Database.php';
    if (isset($_POST['faculty_id'])) {
      $facultyID = $_POST['faculty_id'];
    
      $stmt = $db->conn->prepare('SELECT dept_ID, Department FROM department_tbl WHERE faculty_ID = :faculty_id');
      $stmt->bindParam(':faculty_id', $facultyID, PDO::PARAM_INT);
      $stmt->execute();
      
      $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($departments);
    }
?>