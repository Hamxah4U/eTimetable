<?php
	require './views/patialsAdmin/header.php';

	require 'classes/Users.class.php';

?>
    <!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <?php require './views/patialsAdmin/sidebar.php';?>

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
							<button class="btn btn-primary" type="button" data-target="#modalCourse" data-toggle="modal">Add Course</button>
						</div>

						<!-- Content Row -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Faculty</th>
                  <th>Department</th>
									<th>CourseTitle</th>
                  <th>CourseCode</th>
									<th>Status</th>
                  <th>DateRecored</th>
									<th>Action</th>
                 
								</tr>
							</thead>
							<?php
									$stmt = $db->query('SELECT `course_tbl`.`DateRegister`, `course_tbl`.`Status`, `faculty_tbl`.`Faculty`, `department_tbl`.`Department`, `course_tbl`.`CourseTitle`, `course_tbl`.`CourseCode` FROM `course_tbl` INNER JOIN `faculty_tbl` ON `faculty_tbl`.`FID` = `course_tbl`.`faculty` INNER JOIN `department_tbl` ON `department_tbl`.`dept_ID` = `course_tbl`.`dpt`');
                  $faculties = $stmt->fetchAll(PDO::FETCH_ASSOC);
									$i = 1;
									foreach ($faculties as $faculty): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= htmlspecialchars($faculty['Faculty']) ?></td>
										<td><?= htmlspecialchars($faculty['Department']) ?></td>
										<td><?= htmlspecialchars($faculty['CourseTitle']) ?></td>
										<td><?= htmlspecialchars($faculty['CourseCode']) ?></td>
                    <td><?= htmlspecialchars($faculty['Status']) ?></td>
										<td><?= htmlspecialchars($faculty['DateRegister']) ?></td>
										<td>
											<button type="button" class="btn btn-info"><span class="fas fa-fw fa-edit"></span></button>
											<button type="button" class="btn btn-danger"><span class="fas fa-fw fa-trash"></span></button>
										</td>
									</tr>
							<?php endforeach ?>
						</table>
						<!-- Content Row -->
				</div>
				<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->
<?php require './views/patialsAdmin/footer.php' ?>

<!-- Modal -->
<div class="modal fade" id="modalCourse" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary"><strong>Course Registration Window</strong></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-danger"><strong>&times;</strong></span>
					</button>
			</div>
			<div class="modal-body">
				<form id="courseForm">

          <div class="form-group">
            <label for="">Faculty</label>
            <select name="faculty" id="faculty" class="form-control">
              <option value="--choose--">--choose--</option>
              <?php
                $stmt = $db->query('SELECT * FROM `faculty_tbl`');
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $i => $faculty):?>
                <option value="<?= $faculty['FID'] ?>"><?= $faculty['Faculty'] ?></option>
              <?php endforeach ?>
            </select>
            <small class="text-danger" id="errorFaculty"></small>
          </div>

					<div class="form-group">
						<label for="my-input">Department</label>
						<select name="department" id="department" class="form-control">
              <option value="--choose--">--choose--</option>
              
            </select>
						<small class="text-danger" id="errorDepartment"></small>
					</div>

          <div class="form-group">
            <label for="">Course Title</label>
            <input type="text" name="course" id="" class="form-control" placeholder="e.g Introduction to Computer Science">
            <small class="text-danger" id="errorCourse"></small>
          </div>

          <div class="form-group">
            <label for="">Course Code</label>
            <input type="text" name="code" id="" class="form-control" placeholder="e.g CS232">
            <small class="text-danger" id="errorCode"></small>
          </div>

					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

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

