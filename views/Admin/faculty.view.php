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
							<button class="btn btn-primary" type="button" data-target="#modalUser" data-toggle="modal">Add Faculty</button>
						</div>

						<!-- Content Row -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Faculty</th>
									<th>RecordBy</th>
									<th>Status</th>
                  <th>DateRecored</th>
									<th>Action</th>
                 
								</tr>
							</thead>
							<?php
									$stmt = $db->query('SELECT * FROM `faculty_tbl`');
                  $faculties = $stmt->fetchAll(PDO::FETCH_ASSOC);
									$i = 1;
									foreach ($faculties as $faculty): ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= htmlspecialchars($faculty['Faculty']) ?></td>
										<td><?= htmlspecialchars($faculty['RecordBy']) ?></td>
                    <td><?= htmlspecialchars($faculty['Status']) ?></td>
										<td><?= htmlspecialchars($faculty['DateRecored']) ?></td>
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
				<h5 class="modal-title text-primary"><strong>Faculty Registration Window</strong></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-danger"><strong>&times;</strong></span>
					</button>
			</div>
			<div class="modal-body">
				<form id="facultyForm">

					<div class="form-group">
						<label for="my-input">FacultyName</label>
						<input id="fname" class="form-control" type="text" name="faculty">
						<small class="text-danger" id="errorFname"></small>
					</div>

					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
    $('#facultyForm').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'model/faculty.form.php',
				dataType: 'JSON',
				data: $(this).serialize(),
				type: 'POST',
				success: function(response){
					if(!response.status){
						$('#errorFname').text(response.errors.faculty || '');
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

						$('#errorFname, #errorEmail, #errorPhone').text('');
						// $('.table-striped').DataTable().ajax.reload();
						$('#modalUser').modal('hide');
						$('#facultyForm')[0].reset();
					}
				},
					error: function(xhr, status, error){
						alert('Error: ' + xhr.status + ' - ' + error);
					}
			});
    });
});
</script>

