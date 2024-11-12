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

						<!-- Page Heading -->
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
								<h1 class="h3 mb-0 text-gray-800"></h1>
							<button id="" class="btn btn-primary" type="button" data-target="#modalCourse" data-toggle="modal" onclick='PrintDoc2()'>Print</button>
						</div>
          <style>
            p{font-style: italic;}
            #signature {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
	}

	#signature #left, #signature #right {
    width: 45%;
    text-align: center;
	}
  #header, #header th, #header td {
    border: none;
}

@media print {
    #header, #header th, #header td {
        border: none;
    }
}

  
          </style>
					<div id="printTimeTable">
            <center>
              <img src="../../images/exam.png" alt="" width="80%" style="align-items: center;">
            </center>
            <br>

            <table id="header" style="width: 100%; border-collapse: collapse; border: none;">
    <tr>
        <th style="border: none;">Name:</th>
        <td colspan="2" style="border: none;"><strong><?= $_SESSION['fname'].' '. $_SESSION['sname'] ?></strong></td>
        
        <th style="text-align: center; padding-left: 20px; border: none;">Matric Number:</th>
        <td colspan="2" style="text-align: center; border: none;"><strong><?= $_SESSION['Reg_no']; ?></strong></td>
        
        <td style="text-align: right; border: none;">
          <img src="../../img/uploads/<?= $_SESSION['picture'] ?>" alt="" style="width: 90px;">
        </td>
    </tr>
</table>

            <table class="table table-striped" style="width: 100%; white-space: nowrap;">
              <tr>
                <th>#</th>
                <th>Day/Date</th>   
                <th>Course Title/Code</th>
                <th>Department</th>
                <th>Venue</th>
                <th>Time</th>
                <th>invigilator</th>
              </tr>
              <?php
                $dept_ID = $_SESSION['department'];
                $stmt = $db->conn->prepare('SELECT `timeschedule`.`department` AS newdpt,course_tbl.CourseTitle AS CT, course_tbl.CourseCode AS CC,`date`,course,venue,`time`,Firstname,Surname, `department_tbl`.`department` AS dpt FROM `timeschedule` INNER JOIN users_tbl ON lecturer=userID INNER JOIN department_tbl ON `timeschedule`.`department`=dept_ID INNER JOIN course_tbl ON course = CID WHERE `timeschedule`.`department` = :dept_ID ');
                $stmt->execute([
                  ':dept_ID' => $dept_ID
                ]);
                $timetables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $i = 1;
                foreach($timetables as $table):?>
                <tr>
                  <td><?= $i ++; ?></td>
                  <td><?= $table['date'] ?></td>
                  <td><?= $table['CT'].' '.'('.$table['CC'].')'?></td>
                  <td><?= $table['dpt'] ?></td>
                  <td><?= $table['venue'] ?></td>
                  <td><?= $table['time'] ?></td>
                  <td><?= $table['Firstname'].' '.$table['Surname'] ?></td>

                </tr>
              <?php endforeach ?>
            </table>
            <p>
              <h4 style="text-align: center;"><strong>Examination Rules and Regulations for NOUN Students</strong></h4>
            </p>
            <p>1. ID Verification: Present a valid NOUN student ID and exam slip to enter the exam hall.</p>
            <p>2. Punctuality: Arrive at least 30 minutes early; late entry is permitted up to 30 minutes after the start without extra time.</p>
            <p>3. Allowed Materials: Only specified items are permitted; mobile phones and electronic devices must be switched off and stored outside.</p>
            <p>4. Seating and Behavior: Sit in assigned seats and maintain silence; raise a hand to speak to an invigilator.</p>
            <p>5. No Cheating: Any form of cheating results in disqualification and disciplinary action.</p>
            <p>6. Authorized Papers: Use only provided answer booklets; taking them out of the hall is prohibited.</p>
            <p>7. Leaving the Hall: Only allowed in emergencies with permission; re-entry is not permitted.</p>
            <p>8. Health Issues: Report any medical problems to the invigilator and provide a medical report within 24 hours if unable to continue.</p>
            <p>9. End Time Compliance: Stop writing when instructed; submit answer scripts before leaving.</p>
            <p>10. Consequences: Violations lead to disciplinary actions, ranging from exam cancellation to suspension or expulsion.</p>
          </div>
          <hr/>
          <div id="signature">
					<div id="left">
						<strong>Name/Sign/Date: ....................................................... </strong>
						<p><i>Exam Officer</i></p>
					</div>
					<div id="right">
						<strong>Name/Sign/Date: ....................................................... </strong>
						<p><i>HOD</i></p>
					</div>
				</div>

				</div>
				<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->
<?php require './views/patialsAdmin/footer.php' ?>

<script type="text/javascript">
  function PrintDoc2() {
    var dynamicTitle = "StudentTimeTAble'sCopy_<?= $_SESSION['Reg_no'] ?>";
    var prtContent = document.getElementById("printTimeTable").innerHTML;
    var WinPrint = window.open('', '', 'left=300,top=100,width=1000,height=700,toolbar=0,scrollbars=0,status=0');
    
    WinPrint.document.write('<html><head><title>' + dynamicTitle + '</title>');
    WinPrint.document.write('<style>');
    WinPrint.document.write('@page { size: A4; margin: 1mm; }');
    WinPrint.document.write('body { font-family: Arial, sans-serif; margin: 20px; text-align: justify; }');
    WinPrint.document.write('table, th, td { border: 1px solid #000; border-collapse: collapse; font-size: 14pt; }');
    WinPrint.document.write('ul, li { font-size: 14pt; }');
    WinPrint.document.write('th, td { padding: 10px; text-align: left; }');
    WinPrint.document.write('img { display: block; margin-left: auto; margin-right: auto; max-width: 100%; height: auto; }');
    WinPrint.document.write('div img { display: block; }');
    WinPrint.document.write('.passport-image { float: left; margin-right: 10px; margin-top: 10px; }');

    // Applying striping for even and odd rows
    WinPrint.document.write('table tr:nth-child(even) { background-color: #f2f2f2; }');
    WinPrint.document.write('table tr:nth-child(odd) { background-color: #ffffff; }');

    // Ensuring striping effect during printing with a media query
    WinPrint.document.write('@media print {');
    WinPrint.document.write('table tr:nth-child(even) { background-color: #f2f2f2; }');
    WinPrint.document.write('table tr:nth-child(odd) { background-color: #ffffff; }');
    WinPrint.document.write('}');
    
    WinPrint.document.write('</style>');
    WinPrint.document.write('</head><body>');
    WinPrint.document.write(prtContent);
    WinPrint.document.write('</body></html>');
    
    WinPrint.document.close();
  
    WinPrint.focus();
    setTimeout(function() {
        WinPrint.print();
        WinPrint.close();
    }, 1000); 
}

   
	// function PrintDoc2() {
	// 	var dynamicTitle = "<?php //echo 'ddddddd' ?>";
	// 	var prtContent = document.getElementById("printTimeTable");
	// 	var WinPrint = window.open('', '', 'left=300,top=100,width=1000,height=700,toolbar=0,scrollbars=0,status=0');
	// 	WinPrint.document.write('<html><head><title>' + dynamicTitle + '</title>');
	// 	WinPrint.document.write('<style>');
	// 	WinPrint.document.write('@page { size: portrait; margin: 1px; }'); 
	// 	WinPrint.document.write('body { margin: 20px; }'); 
	// 	WinPrint.document.write('table, th, td { border: 1px solid black; border-collapse: collapse; }');
	// 	WinPrint.document.write('th, td { padding: 5px; }'); 
	// 	WinPrint.document.write('tr:nth-child(even) { background-color: #f2f2f2; }'); 
	// 	WinPrint.document.write('tr:nth-child(odd) { background-color: #ffffff; }');
	// 	WinPrint.document.write('#signature { display: flex; justify-content: space-between; margin-top: 20px; }');
	// 	WinPrint.document.write('#signature #left, #signature #right { width: 45%; text-align: center; }');
	// 	WinPrint.document.write('</style>');
	// 	WinPrint.document.write('</head><body>');
	// 	WinPrint.document.write(prtContent.innerHTML);
	// 	WinPrint.document.write('</body></html>');
	// 	WinPrint.document.close();
	// 	WinPrint.focus();
	// 	WinPrint.print();
	// 	WinPrint.close();
	// 	return false;
	//}
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

<script>
  $(document).ready(function(){
    $('#courseForm').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'model/course.form.php',
        dataType: 'JSON',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          if(! response.status){
            $('#errorCourse').text(response.errors.course || '');
            $('#errorCode').text(response.errors.code || '');
            $('#errorDepartment').text(response.errors.department || '');
            $('#errorFaculty').text(response.errors.faculty || '');
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
								icon: "success",
								title: 'Record save successfully!'
						});
            $('#errorCourse, #errorCode, #errorDepartment, #errorFaculty').text('');
            $('#modalCourse').modal('hide');
            $('#courseForm')[0].reset();
          }
        },
        error: function(xhr, status, error){
          alert('error');
        }
      });
    })
  });

</script>

