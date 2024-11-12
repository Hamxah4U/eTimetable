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
							<button class="btn btn-primary" type="button" data-target="#modalUser" data-toggle="modal">Add TimeTable</button>
						</div>

						<!-- Content Row -->
						<table class="table table-striped" style="white-space: nowrap;">
							<thead>
								<tr>
									<th>#</th>
									<th>Day/Date</th>
									<th>Semester</th>
									<th>Department</th>
									<th>Course Title/Code</th>
                  <th>Venue</th>
                  <th>Time</th>
                  <th>Lecturer</th>
                  <th>Action</th>
								</tr>
							</thead>
							<?php
									$stmt = $db->query('SELECT Email,`date`,`time`,venue, semester_tbl.semester AS sem, department_tbl.department AS dpt, CourseTitle  FROM `timeschedule` INNER JOIN `semester_tbl`ON semester_tbl.id = timeschedule.semester INNER JOIN `department_tbl` ON `department_tbl`.`dept_ID` = timeschedule.department INNER JOIN course_tbl ON timeschedule.course = course_tbl.CID INNER JOIN users_tbl ON userID = lecturer');
                  $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
									$i = 1;
									foreach ($all as $user): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= htmlspecialchars($user['date']) ?></td>
										<td><?= htmlspecialchars($user['sem']) ?></td>
										<td><?= htmlspecialchars($user['dpt']) ?></td>
										<td><?= htmlspecialchars($user['CourseTitle']) ?></td>
										<td><?= htmlspecialchars($user['venue']) ?></td>
										<td><?= htmlspecialchars($user['time']) ?></td>
										<td><?= htmlspecialchars($user['Email']) ?></td>

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
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary"><strong>Timetable Registration Window</strong></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-danger"><strong>&times;</strong></span>
					</button>
			</div>
			<div class="modal-body">
				<form id="timetableForm">

          <div class="form-group">
            <label for="">Department</label>
            <select name="department" id="department" class="form-control">
              <option value="--choose--">--choose--</option>
              <?php
                $stmt = $db->query('SELECT * FROM `department_tbl`');
                $dpts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($dpts as $dpt):?>
                <option value="<?= $dpt['dept_ID'] ?>"><?= $dpt['Department'] ?></option>
              <?php endforeach ?>
            </select>
            <small class="text-danger" id="errorDepartment"></small>
          </div>

          <div class="form-group">
            <label for="">Semester</label>
            <select name="semester" id="semester" class="form-control">
              <option value="--choose--">--choose--</option>
            </select>
            <small class="text-danger" id="errorSemester"></small>
          </div>
 
          <div class="form-group">
            <label for="">Course Title</label>
            <select name="course" id="" class="form-control">
              <option value="--choose--">--choose--</option>
            <?php
              $stmt = $db->query('select * from course_tbl');
              $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($courses as $course):?>
              <option value="<?= $course['CID'] ?>"><?= $course['CourseTitle']?></option>
            <?php endforeach ?>
            </select>
            <small class="text-danger" id="errorCourse"></small>
          </div>

          <div class="form-group">
            <label for="">Lecturer</label>
            <select name="lecturer" id="" class="form-control">
              <option value="--choose--">--choose--</option>
              <?php
                $stmt = $db->query('SELECT * FROM `users_tbl`');
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($users as $key => $user): ?>
                  <option value="<?= $user['userID'] ?>"><?= $user['Email'] ?></option>
              <?php endforeach ?>
            </select>
            <small class="text-danger" id="errorLecturer"></small>
          </div>

					<div class="form-group">
						<label for="my-input">Venue</label>
						<input id="venue" class="form-control" type="text" name="venue" placeholder="e.g KSLT">
						<small class="text-danger" id="errorVenue"></small>
					</div>

          <div class="form-group">
            <label for="Date">Date</label>
            <input type="date" name="date" id="" class="form-control">
            <small class="text-danger" id="errorDate"></small>
          </div>

          <div class="form-group">
            <label for="">Time</label>
            <input type="time" name="time" id="" class="form-control">
            <small class="text-danger" id="errorTime"></small>
          </div>
					

					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
  $('#timetableForm').on('submit', function(e){
    e.preventDefault();
    $('.text-danger').text('');
    $.ajax({
      url: 'model/timetable.form.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'JSON',
      success: function(response){
        if(! response.status){
          $.each(response.errors, function(key, value){
            $('#error' + key.charAt(0).toUpperCase() + key.slice(1)).text(value || '');
          });
          
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
            $('#modalUser').modal('hide');
            $('#timetableForm')[0].reset();
            $('.text-danger').text('');
        }
      },
      error: function(xhrxhr){
        alert('error' + xhrxhr);
      }
    });
  });

  $('#department').change(function(){
    var deptID = $(this).val();
    if(deptID){
      $.ajax({
        url: 'model/semester.ajax.php',
        type: 'POST',
        data: {deptID: deptID},
        success: function(data){
          $('#semester').html(data);
        }
      });
    }else{
      alert('error');
    }
  });


});






</script>


