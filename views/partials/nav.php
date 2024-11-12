<?php
  require 'model/Database.php';
?>

<div class="container-fluid p-0">
		<nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
				<a href="index.html" class="navbar-brand ml-lg-3">
						<h1 class="m-0 text-uppercase text-primary"><img src="../../images/NOUN-logo.png" width="60px" alt=""></i>e-TimeTable</h1>
				</a>
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
						<div class="navbar-nav mx-auto py-0">
								<a href="/" class="nav-item nav-link active">Home</a>
								<a href="/#about" class="nav-item nav-link">About</a>
								<a href="/#contact" class="nav-item nav-link">Contact</a>
								<a href="" class="nav-item nav-link" data-bs-target="#register" data-bs-toggle="modal">Register</a>
						</div>
						<a href="" class="btn btn-primary py-2 px-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#login">Login</a>
					</div>
		</nav>
  </div>

<!-- The Modal -->
<?php
    //require 'partials/ajax/fajax.php';
    // require './ajax/fajax.php';
    // require '././ajax/fajax.php';
    // require 'ajax/fajax.php';

?>
<div class="modal" id="login">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Student Login</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="loginFormWrapper">
                        <!-- Student Login Form -->
                        <form id="studentLoginForm">
                            <div class="form-group">
                                <label for="studentEmail">Student Email/Phone</label>
                                <input id="studentEmail" class="form-control" type="text" name="studentUsername">
                                <small class="text-danger" id="errorEmail"></small>
                            </div>
                            <div class="form-group">
                                <label for="studentPassword">Password</label>
                                <input id="studentPassword" class="form-control" type="password" name="studentPassword">
                                <small class="text-danger" id="errorPassword"></small>
                            </div>
                            <button class="btn btn-primary mt-3">Login as Student</button>
                        </form>

                        <!-- Admin Login Form (hidden by default) -->
                        <form id="adminLoginForm" class="d-none">
                            <div class="form-group">
                                <label for="adminEmail">Admin Email/Phone</label>
                                <input id="adminEmail" class="form-control" type="text" name="adminUsername">
                                <small class="text-danger" id="adminErrorEmail"></small>
                            </div>
                            <div class="form-group">
                                <label for="adminPassword">Password</label>
                                <input id="adminPassword" class="form-control" type="password" name="adminPassword">
                                <small class="text-danger" id="adminErrorPassword"></small>
                            </div>
                            <button class="btn btn-primary mt-3">Login as Admin</button>
                        </form>
                    </div>

                    <!-- Toggle Links to Switch Forms -->
                    <div class="text-center mt-3">
                        <a href="#" id="switchToAdmin" class="d-block">Switch to Admin Login</a>
                        <a href="#" id="switchToStudent" class="d-none">Switch to Student Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="studentForm">
                
                    <div class="form-group">
                        <label >Firstname</label>
                        <input id="Firstname" class="form-control" type="text" name="fnam">
                        <small class="text-danger" id="errorFirstname"></small>
                    </div>

                    <div class="form-group">
                        <label for="my-input">Surname</label>
                        <input class="form-control" type="text" name="surname">
												<small class="text-danger" id="errorSurname"></small>
                    </div>

                    <div class="form-group">
                        <label for="my-input">Email</label>
                        <input class="form-control" type="text" name="email">
												<small id="errorEmails" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Matric No.</label>
                        <input class="form-control" type="text" name="matricno">
												<small id="errorMatric" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Faculty</label>
                        <select name="faculty" id="school" class="form-control" onchange="changeschool()">
                            <option value="--choose--">--choose--</option>
                            <?php
                                    $stmt = $db->query('SELECT * FROM `faculty_tbl`');
                                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);	
                                    foreach($row as $i => $faculty): ?>
                            <option value="<?= $faculty['FID'] ?>"><?= $faculty['Faculty'] ?></option>
                            <?php endforeach ?>
                        </select>
												<small class="text-danger" id="errorFaculty"></small>
                    </div>
                    <div class="form-group" id="newdepartment">
                        <label for="my-input">Department</label>
                        <select name="dpt" class="form-control" id="">
                            <option value="--choose--">--choose--</option>
                            
                        </select>
						<small class="text-danger" id="errorDPT"></small>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Level</label>
                        <select name="level" id="" class="form-control">
                            <option value="--choose--">--choose--</option>
                            <option>100L</option>
                            <option>200L</option>
                            <option>300L</option>
                            <option>400L</option>
                            <option>500L</option>
                        </select>
						<small id="errorLevel" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="my-input">Passport</label>
                        <img id="previewImg" src="images/img__nopic_avatar6.jpg" alt="Placeholder" style="height: 30%;width:40%" class="form-control">
                        <input type="file" name="picture" onchange="previewFile(this);" style="display: block;" class="form-contro">
                        <small class="text-danger" id="errorPicture"></small>	
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-3.4.1.min.js"></script>


<script>
	$(document).ready(function(){
		$('#studentLoginForm').on('submit', function(e){
			e.preventDefault();
			$('.text-danger').text('');
			$.ajax({
				url: 'model/student.login.php',
				dataType: 'JSON',
				data: $(this).serialize(),
				type: 'POST',
				success: function(response){
					if(!response.status){
						$.each(response.errors, function(key, value){
							$('#error' + key.charAt(0).toUpperCase() + key.slice(1) ).text(value || '');
						});
					}else{
						// alert(response.success.messageRe);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 1500,
							timerProgressBar: true,
							didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
							}
							});
							Toast.fire({
							icon: "success",
							title: response.success.messageRe
						});
						$('#studentLoginForm')[0].reset();
						$('#login').modal('hide');
						window.location.href = response.success.redirect
					}
				},
				error: function(xhr, status, error){
					alert('error' + status);
				}
			});
		});
	});
</script>

<script>
  $(document).ready(function (){
    $('#adminLoginForm').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'model/user.login.php',
        dataType: 'JSON',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          if(!response.status){
            $('#adminErrorEmail').text(response.errors.user || '');
            $('#adminErrorPassword').text(response.errors.pass || '')
          }else{
            //alert(response.success.message);
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
								title: response.success.messageRe
						}); 
            $('#adminErrorEmail #adminErrorPassword').text('');
            setTimeout(function(){
							window.location.href = response.success.redirectUser;
						}, 1000)
          }
        },
        error: function(xhr, status, error){
          alert('error' + error);
        }
      });
    });
  });
</script>

<script>
	$(document).ready(function() {
    $('#studentForm').on('submit', function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: 'model/student.form.php',
            data: formdata, //$(this).serialize(),
            dataType: 'JSON',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === true) {
                    
                    if (response.errors) {
                        $('#errorFirstname').text(response.errors.fname || '');
                        $('#errorSurname').text(response.errors.sname || '');
                        $('#errorFaculty').text(response.errors.faculty || '');
                        $('#errorMatric').text(response.errors.matricno || '');
                        $('#errorEmails').text(response.errors.emails || '');
                        $('#errorDPT').text(response.errors.department || '');
                        $('#errorLevel').text(response.errors.level || '');
                        $('#errorPicture').text(response.errors.picture || '');
                    }
                } else {
                    // alert(response.success.message);

                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "success",
                    title: response.success.message
                    });

                    $('#register').modal('hide');
                    $('#errorFirstname, #errorSurname, #errorFaculty, #errorMatric, #errorEmail, #errorDPT, #errorLevel').text('');
                    $('#studentForm')[0].reset();
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });
});
</script>

<script type="text/javascript">
  function changeschool() {
    // ajax/fajax.php
    var xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("GET",ajax/fajax.php"?facultyID="+document.getElementById("school").value,false);
    xmlhttp.open("GET","include/ajax/fajax.php?facultyID="+document.getElementById("school").value,false);
    xmlhttp.send(null);
    alert(xmlhttp.responseText);
    document.getElementById("newdepartment").innerHTML=xmlhttp.responseText;
  }
</script>


<script src="js/jquery-3.4.1.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
            const studentLoginForm = document.getElementById('studentLoginForm');
            const adminLoginForm = document.getElementById('adminLoginForm');
            const switchToAdmin = document.getElementById('switchToAdmin');
            const switchToStudent = document.getElementById('switchToStudent');
            const modalTitle = document.getElementById('modalTitle');

            // Switch to Admin Form
            switchToAdmin.addEventListener('click', function (e) {
                e.preventDefault();

                // Check if event triggers
                console.log("Switching to Admin Login");

                // Hide Student Form, Show Admin Form
                studentLoginForm.classList.add('d-none');
                adminLoginForm.classList.remove('d-none');
                
                // Update Modal Title
                modalTitle.textContent = 'Admin Login';

                // Hide "Switch to Admin" link, Show "Switch to Student" link
                switchToAdmin.classList.add('d-none');
                switchToStudent.classList.remove('d-none');
            });

            // Switch to Student Form
            switchToStudent.addEventListener('click', function (e) {
                e.preventDefault();

                // Check if event triggers
                console.log("Switching to Student Login");

                // Hide Admin Form, Show Student Form
                adminLoginForm.classList.add('d-none');
                studentLoginForm.classList.remove('d-none');
                
                // Update Modal Title
                modalTitle.textContent = 'Student Login';

                // Hide "Switch to Student" link, Show "Switch to Admin" link
                switchToStudent.classList.add('d-none');
                switchToAdmin.classList.remove('d-none');
            });
        });
</script>
<script>
  $(document).ready(function(){
		$('#loginForm').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'model/user.login.php',
				data: $(this).serialize(),
				dataType: 'JSON',
				type: 'POST',
				success: function(response){
					if(!response.status){
						$('#errorEmail').text(response.errors.email || response.errors.emailPhone || '');
						$('#errorPassword').text(response.errors.password || response.errors.invalidpass || '')
					}else{
						 //alert('success:' + response.success.message);
            const Toast = Swal.mixin({
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 1500,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
								}
							});
							Toast.fire({
								icon: "success",
								title: response.success.message
						});

            $('#errorEmail, #errorPassword').text('');
            setTimeout(function(){
              window.location.href = response.success.redirect;
            }, 1000)
					}
				},
				error: function(xhr, status, error){
					alert('error' + xhr + status + error);
				}
			});
		});
	});
</script>

<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>