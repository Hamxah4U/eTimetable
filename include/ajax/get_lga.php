<?php 
if (isset($_GET['stateID'])) {
  require '../../model/Database.php';
  $stateID = $_GET['stateID'];
  
  $stmt = $db->conn->prepare("SELECT * FROM lga_tbl WHERE stateID = :stateID");
  $stmt->execute(['stateID' => $stateID]);
  $lgas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($lgas as $lga) {
      echo '<option value="' . htmlspecialchars($lga['lga_ID']) . '">' . htmlspecialchars($lga['LGA']) . '</option>';
  }
}
?>
