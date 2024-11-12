
<?php 
  require '../../model/Database.php';
?>
<select name="dpt" id="department" class="form-control">
  
<?php
  $status = 'Active';
  $id = $_GET["facultyID"];

    $stmt = $db->conn->prepare("SELECT * FROM `department_tbl` WHERE `Status` = :st AND `faculty_ID` = :id");
    $stmt->execute([
      ':st' => $status,
      ':id' => $id
    ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $rowf) :?>
      <option value="<?= htmlspecialchars($rowf['dept_ID']) ?>"> <?= htmlspecialchars($rowf['Department']) ?> </option>
    <?php endforeach; ?>
</select> 