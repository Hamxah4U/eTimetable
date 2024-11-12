<?php
    require 'Database.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$success = [];
			$errors = [];
			$faculty = $_POST['faculty'];

			$stmt = $db->checkExist('SELECT `faculty` FROM faculty_tbl WHERE `faculty` = :faculty',[
				':faculty' => $faculty,
			]);

			$facultyExist = $stmt->rowCount();

			if(empty(trim($faculty))){
				$errors['faculty'] = 'Faculty name is required!';
			}elseif($facultyExist > 0){
				$errors['faculty'] = 'Faculty already exist!';
			}

			if(empty($errors)){
				session_start();
				$user = $_SESSION['email'];
				$stmt = $db->conn->prepare('INSERT INTO `faculty_tbl` (`faculty`, `RecordBy`) VALUES (:faculty, :RecordBy) ');
				$result = $stmt->execute([
					':faculty' => $faculty,
					':RecordBy' => $user
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
					'success' => $errors
				]);
			}
    }
?>