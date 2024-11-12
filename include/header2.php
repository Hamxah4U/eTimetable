<?php require_once 'conn.php'; require_once 'function.php' ?>
<!doctype html>
<html lang="en">
<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title>FCE Jama'are</title>
    
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="img/logo__.png" type="image/png">
    <link rel="stylesheet" href="css/icofont/icofont.min.css">
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="css/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="css/animate.css">
    
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="css/nice-select.css">
    
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="css/jquery.nice-number.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="css/default.css">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="css/responsive.css">
		<script src="css/jquery.js"></script>
		<script src="css/jquery.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
		<style>
			.text-danger{
				font-size: 9pt;
			}
		</style>
  
</head>

<body>  

<!-- <div class="preloader">
    <div class="loader rubix-cube">
        <div class="layer layer-1"></div>
        <div class="layer layer-2"></div>
        <div class="layer layer-3 color-1"></div>
        <div class="layer layer-4"></div>
        <div class="layer layer-5"></div>
        <div class="layer layer-6"></div>
        <div class="layer layer-7"></div>
        <div class="layer layer-8"></div>
    </div>
</div> -->

<header id="header-part">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact text-lg-left text-center">
                        <ul>
                            <li><img src="img/map.png" alt="icon"><span>PMB 012 Jama'are, Bauchi State</span></li>
                            <li><img src="img/email.png" alt="icon"><span>info@coej.com</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-opening-time text-lg-right text-center">
                        <p>Opening Hours : Monday to Saturday - 8 Am to 5 Pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="header-logo-support pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="logo">
                        <a href="index.php">
                            <img src="img/logo__.png" alt="Logo" style="height: 10%; width:30%">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="support-button float-right d-none d-md-block">
                        <div class="support float-left">
                            <div class="icon">
                                <img src="img/support.png" alt="icon">
                            </div>
                            <div class="cont">
                                <p>Need Help? call us</p>
                                <span class="icofont-phone">+2348 037 856 962</span>
                            </div>
                        </div>
                        <div class="button float-left">
                            <!-- <a onclick="confirm('Sorry Application was Closed')" href="#" class="main-btn">Apply Now</a> -->
                             <button class="main-btn" data-target="#studentModa" data-toggle="modal" type="button">Apply Now</button>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header logo support -->

        
    <div class="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto" style="float: left;">
                                <li class="nav-item">
                                    <a class="active" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.php">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="courses.php">Courses</a>
                                    <ul class="sub-menu">
                                        <li><a href="courses.php">Courses</a></li>
                                    </ul>
                                </li>                               
                                <li class="nav-item">
                                    <a href="contact.php">Contact</a>
                                    <ul class="sub-menu">
                                        <li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="login.php">Login</a>
                                    <ul class="sub-menu">
                                        <li><a href="login.php">Staff Login</a></li>
                                        <li><a href="student.php">Student Login</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                  <li><a href="" data-target="#studentModa" data-toggle="modal">Student Registration</a></li>
                                </li>
                            </ul>
                        </div>
                    </nav> <!-- nav -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                    <div class="right-icon text-right">
                        <ul>
                            <li><a href="#" id="search"><i class="icofont-search icofont-2x"></i></a></li>
                        </ul>
                    </div> <!-- right icon -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
        
    </header>


		<div id="studentModa" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Student Registration Window</h5>
								<button type="button" class="close text-warning" data-dismiss="modal">&times;</button>	
							</div>
							<div class="modal-body">
              <form action="" method="post" id="stdForm">
                <div class="form-group">
                  <label for="fname">Firstname</label>
                  <input type="text" name="fname" id="fname" class="form-control">
                  <i id="fnameError" class="text-danger"></i>
                </div>

                <div class="form-group">
                  <label for="mname">Middlename</label>
                  <input type="text" name="mname" id="mname" class="form-control">
                  <i id="mnameError" class="text-danger"></i>
                </div>

                <div class="form-group">
                  <label for="surname">Surname</label>
                  <input type="text" name="surname" id="surname" class="form-control">
                  <i id="surnameError" class="text-danger"></i>
                </div>

                <div class="form-group">
                  <label for="regNo">Registration No.</label>
                  <input type="text" name="regNo" id="regNo" class="form-control" placeholder="e.g 24/0008/xyz">
                  <i id="regNoError" class="text-danger"></i>
                </div>

                <div class="form-group">
                  <label for="jambNo">Jamb No.</label>
                  <input type="text" name="jambNo" id="jambNo" class="form-control">
                  <i id="jambNoError" class="text-danger"></i>
                </div>

                <div class="form-group">
                  <label for="ninNo">NIN No.</label>
                  <input type="int" name="ninNo" id="ninNo" class="form-control">
                  <i id="ninNoError" class="text-danger"></i>
                </div>      

                <div class="form-row">
                  <div class="col-md-4 mb-3">
                  <label for="school">School</label>
                    <select name="school" id="school" class="form-control" onchange="changeschool()">
                      <option value="--choose--">--choose--</option>
                      <?php facultyList() ?>
                    </select>
                    <i id="schoolError" class="text-danger"></i>               
                  </div>

                  <div class="col-md-4 mb-3" id="state">
                    <label for="department">Department</label>
                    <div id="newdepartment">
                    <select name="department" id="department" class="form-control">
                      <option value="--choose--">--choose--</option>
                    </select>
                    </div>
                    <i id="departmentError" class="text-danger"></i>
                  </div>

                  <div class="col-md-4 mb-3" id="state">
                    <label for="Lvel">Level</label>
                    <select name="level" id="level" class="form-control">
                      <option value="--choose--">--choose--</option>
                      <?= studentLevel() ?>
                    </select>
                    <i id="levelError" class="text-danger"></i>
                  </div>               
                </div>

                <button type="submit" class="btn btn-primary">Submit</button> 
							</form>
							</div>
            </div>
        </div>
    </div>

<script>
  $(document).ready(function(){
  $('#stdForm').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url: 'include/ajax/student.val.php',
      dataType: 'json',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response){
        if(!response.status){
          $('i.text-danger').text('');
          $.each(response.errors, function(key, value){
            $('#' + key + 'Error').text(value);
          });
        }else{
          //alert('success');
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "success",
            title: response.message.success
          });
          $('#stdForm')[0].reset();
          $('#studentModa').modal('hide');
          $('i.text-danger').text('');
        }
      },
      error: function(xhr, status, error){
        alert('errors:' + xhr + status + error);
      }
    });
  });
});

</script>

<script type="text/javascript">
  function changeschool() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","include/ajax/fajax.php?facultyID="+document.getElementById("school").value,false);
    xmlhttp.send(null);
    //alert(xmlhttp.responseText);
    document.getElementById("newdepartment").innerHTML=xmlhttp.responseText;
  }
</script>



