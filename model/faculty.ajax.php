
<?php 
   
   require 'Database.php'
?>
<select name="department" id="department" class="form-control">
   <option value="--choose--">--choose--</option>
    <?php

   $status = 'Active';
    $stmt = $conn->prepare("SELECT * FROM `department_tbl` WHERE `Status` = ? AND `faculty_ID` = ?");
    $stmt->bind_param("si", $status, $_GET["facultyID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    while($rowf = $result->fetch_assoc()):?>
      <option value="<?= htmlspecialchars($rowf['dept_ID']) ?>"> <?= htmlspecialchars($rowf['CourseofStudy']) ?> </option>
    <?php endwhile; ?>
</select> 