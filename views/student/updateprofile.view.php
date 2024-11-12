<?php
	require './views/patialsAdmin/header.php';

	require 'classes/Users.class.php';

?>
    <!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <?php require './views/patialsAdmin/sidebar2.php';?>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

				<!-- Topbar -->
			
        <?php require './views/patialsAdmin/nav.php' ?>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
			<div class="container-fluid">
        <?php
        $stdID = $_SESSION['stdID'];
          $stmt = $db->conn->prepare('SELECT * FROM `student_tbl` WHERE `stu_ID` = :stu_ID ');
          $stmt->execute([':stu_ID' => $stdID ]);

          $student = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

          <!-- id="updatestudent" action="/updatestudent" -->

        <form id="updatestudent" method="POST" action="/updatestudent">
          <input type="hidden" name="stdID" id="" value="<?= $_SESSION['stdID'] ?>">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="input1">Firsname</label>
              <input id="input1" class="form-control" type="text" name="fname" value="<?= $student['Firstname'] ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="input2">Middlename</label>
              <input id="input2" class="form-control" type="text" name="mname" value="<?= $student['Middlename'] ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="input3">Surname</label>
              <input id="input3" class="form-control" type="text" name="sname" value="<?= $student['Surname'] ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="my-input">Matric</label>
              <input readonly id="matric" class="form-control" type="text" name="matric" value="<?= $student['Reg_no'] ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="my-input">Email</label>
              <input id="email" class="form-control" type="text" name="email" value="<?= $student['Email'] ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="">Phone</label>
              <input type="number" name="phone" id="" class="form-control" value="<?= $student['Phone'] ?>">
            </div>

          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Gender</label>
              <select name="gender" id="" class="form-control">
                <option value="--choose--">--choose--</option>
                <option value="Male" <?= $student['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $student['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="">DOB</label>
              <input type="date" name="dob" id="" class="form-control" value="<?= $student['DOB'] ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="">Addree</label>
              <textarea name="address" id="" class="form-control"><?= $student['Address'] ?></textarea>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="my-input">Faculty</label>
              <select name="faculty" id="school" class="form-control" onchange="changeschool()">
                <option value="--choose--">--choose--</option>
                <?php
                  $stmt = $db->query('SELECT * FROM `faculty_tbl`');
                  
                  $faculty = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $selectedFaculty = $_POST['faculty'] ?? '';
                  foreach($faculty as $fcty):?>
                  <option value="<?= $fcty['FID'] ?>" <?= ($fcty['FID'] == $selectedFaculty) ? 'selected' : '' ?>> <?= $fcty['Faculty'] ?> </option>
                <?php endforeach ?>
              </select>
            </div>

              <div class="form-group col-md-4" id="newdepartment">
                <label for="my-input">Department</label>
                <select name="dpt" class="form-control" id="dpt">
                  <option value="--choose--">--choose--</option>
                </select>
						    <small class="text-danger" id="errorDPT"></small>
              </div>

              <div class="form-group col-md-4">
                <label for="">Lavel</label>
                <select name="level" id="" class="form-control">--choose--</select>
              </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">State</label>
              <select name="state" onchange="changestate()" id="state" class="form-control">
                <option value="--choose--">--choose--</option>
                <?php
                  $stmt = $db->query('SELECT * FROM state_tbl');
                  $state = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($state as $city):?>
                  <option value="<?= $city['state_ID'] ?>"><?= $city['State'] ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="">LGA</label>
              <select name="lga" id="lga" class="form-control">
                <option value="--choose--">--choose--</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="">NIN</label>
              <input type="number" name="nin" id="" class="form-control">
            </div>

          </div>

          <div class="form-row">
            <div class="form-group">
              <button type="submit" class="btn btn-info">Update</button>
            </div>
          </div>

        </form>

		</div>
		<!-- End of Main Content -->
<?php require './views/patialsAdmin/footer.php' ?>


<script type="text/javascript">
  function changeschool() {
    // ajax/fajax.php
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","include/ajax/fajax.php?facultyID="+document.getElementById("school").value,false);
    xmlhttp.send(null);
    alert(xmlhttp.responseText);
    document.getElementById("newdepartment").innerHTML=xmlhttp.responseText;
  }
</script>


<script type="text/javascript">
  function changestate(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET","include/ajax/get_lga.php?stateID="+document.getElementById("state").value,false);
      xmlhttp.send(null);
      //alert(xmlhttp.responseText);
      document.getElementById("lga").innerHTML = xmlhttp.responseText;
  }
</script>

<script>
  $(document).ready(function(){
    $('#updatestudent').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'model/updatestudent.php',
        dataType: 'JSON',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          if(! response.status){
            alert('no');
          }else{
            const Toast = Swal.mixin({
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 1000,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
								}
							});
							Toast.fire({
								icon: "info",
								title: 'Record updated successfully!'
						});
          }
        },
        error: function(status){
          alert('error' + status);
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function(){
    $('#faculty').change(function (){
      let facultyID = $(this).val();
      if(facultyID === '--choose--'){
        $('#department').html('<option value="--choose--">--choose--</option>').prop('disabled', true);
        return;
      }
      $.ajax({
        url: 'model/course.ajax.php',
        dataType: 'JSON',
        type: 'POST',
        data: { faculty_id: facultyID },
        success: function(data){
          $('#department').prop('disabled', false).html('<option value="--choose--">--choose--</option>');
          $.each(data, function (index, department) {
            $('#department').append(`<option value="${department.dept_ID}">${department.Department}</option>`);
          });
        },
        error: function(){
          alert('Error fetching departments.');
        }
      });
    });
  });
</script>



