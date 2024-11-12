<?php
include 'Database.php'; 

if(isset($_POST['deptID'])) {
  $deptID = $_POST['deptID'];

	$stmt = $db->conn->prepare('SELECT * FROM `semester` JOIN semester_tbl ON semester_tbl.id = SID WHERE `deptID` = :deptID ');
	$stmt->execute(['deptID' => $deptID]);
	$semesters = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo '<option value="">--choose--</option>';
  foreach ($semesters as $semester) {
    echo '<option value="' . $semester['id'] . '">' . $semester['Semester'] . '</option>';
  }
}

?>
