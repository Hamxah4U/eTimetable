<style>
    .app-sidebar__heading{
        text-transform:capitalize;
        margin:.75rem 0;        
        white-space:nowrap;
        position:relative;
        margin-bottom: 40px;
        float:none;
    }
    .vertical-nav-menu li a{
        color: #fff;
    }
    a:hover {
        color: red;
    }
    #sidebar li{
        background-color: #fff;
        font-size: 12pt;
        color: #07294d;
    }

</style>

<div class="scrollbar-sidebar" style="background-color: #07294d;overflow:auto;">
	<div class="app-sidebar__inner">
	<ul class="vertical-nav-menu">

	<?php
		$listofRole = ['Admin', 'Dean', 'Exam', 'Exam Office', 'Lecturer', 'Level Coordinator'];
		if(in_array('Admin', $_SESSION['userRole'])):?>
	
		<li id="sidebar" class="app-sidebar__heading"><a href="dashboard.php" style="font-size: 17pt;">Dashboards</a></li>
	<?php endif; ?>

  <?php if(in_array('Admin', $_SESSION['userRole'])): ?>
    <li class="app-sidebar__heading">
			<a href="#">
				<i style="font-size:20pt; color:silver" class="icofont-gears"></i>
				<span style="font-size: 17pt;">Admin </span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul id="sidebar">
				<li><a href="dashboard.php?page=addstaff">New Staff</a></li>
				<li><a href="dashboard.php?page=managestaff">Manage Staff</a></li>
				<li><a href="dashboard.php?page=card">Generate Scratch Card</a></li>
			</ul>
    </li>
  <?php endif; ?>

	<?php if (in_array('Admin', $_SESSION['userRole'])): ?>
    <li class="app-sidebar__heading">
        <a href="#">
            <span style="font-size: 20pt; color:lightgreen" class="icofont-ui-calendar"></span>
            <span style="font-size: 17pt; color:#fff;">Calendar</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul id="sidebar">
            <li>
            <a href="dashboard.php?page=session"><i class="metismenu-icon"></i>Manage Session</a>
            </li>
            <li>
                <a href="#"><i class="metismenu-icon"></i>Manage Semester</a>
            </li>
        </ul>
    </li> 
  <?php endif; ?>

	<?php if(in_array('Admin', $_SESSION['userRole']) || in_array('Dean', $_SESSION['userRole']) || in_array('HOD', $_SESSION['userRole'])):?>
		<li class="app-sidebar__heading">
			<a href="#">
				<span style="font-size: 20pt; color:black" class="icofont-hat"></span>
				<span style="font-size: 17pt; color:#fff;">Student</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul id="sidebar">
					<li>
					<a href="dashboard.php?page=newstudent"><i class="metismenu-icon"></i>New Student</a>
					</li>
					<li>
							<a href="#"><i class="metismenu-icon"></i>Applicant</a>
					</li>
					<li>
							<a href="dashboard.php?page=managestudent">Manage Student</a>
					</li>
			</ul>
    </li> 
	<?php endif; ?>
	
	<?php if(in_array('Admin', $_SESSION['userRole'])):?>
		<li class="app-sidebar__heading">
			<a href="#">
					<span style="font-size: 20pt; color:bisque" class="icofont-building"></span>
					<span style="font-size: 17pt;color:#fff">School</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul id="sidebar">
					<li>
							<a href="dashboard.php?page=addfaculty"><i class="metismenu-icon"></i>Add School</a>
					</li>
					<li>
							<a href="dashboard.php?page=school"><i class="metismenu-icon"></i>Manage School</a>
					</li>
			</ul>
    </li>
	<?php endif; ?>

	<?php if(in_array('Admin', $_SESSION['userRole']) || in_array('Dean', $_SESSION['userRole']) || in_array('HOD', $_SESSION['userRole'])):?>
		<li class="app-sidebar__heading">
			<a href="#">
					<i class="icofont-building-alt" style="font-size: 20pt; color:aquamarine"></i>
					<span style="font-size: 17pt;color:#fff;">Department</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul id="sidebar">
					<li><a href="dashboard.php?page=course"><i class="metismenu-icon"></i>Add Department</a></li>
					<li><a href="dashboard.php?page=newcouse">Add Course</a></li>
					<li><a href="dashboard.php?page=department"><i class="metismenu-icon"></i>Manage Department</a></li>
					<li><a href="dashboard.php?page=coursetitleandcode">Manage Course</a></li>
					<!-- <li><a href="dashboard.php?page=managelecturers">Manage Lecturers</a></li> -->
					<li><a href="dashboard.php?page=userrole">Assign Role</a></li>
			</ul>
    </li>
	<?php endif; ?>
	<?php if(in_array('Exam Office', $_SESSION['userRole']) || in_array('Admin', $_SESSION['userRole']) || in_array('HOD', $_SESSION['userRole']) || in_array('Dean', $_SESSION['userRole']) || in_array('Lecturer', $_SESSION['userRole'])):?>
		<li class="app-sidebar__heading">
			<a href="#">
					<span style="color: smoke;font-size:20pt" class="icofont-tasks-alt"></span>
					<span style="font-size: 17pt;color:#fff;">Examination</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul id="sidebar">
					<li><a href="dashboard.php?page=lecturercourse">Your Semester Course</a></li>
					<li><a href="dashboard.php?page=testandexam">Test/Exam</a></li>
					<li><a href="dashboard.php?page=scourse">View assign course</a></li>
				<?php if(in_array('Admin', $_SESSION['userRole']) || in_array('HOD', $_SESSION['userRole']) || in_array('Dean', $_SESSION['userRole']) || in_array('Exam Office', $_SESSION['userRole']) ):?>
					<li><a href="dashboard.php?page=assigncourse">Course Allocation</a></li>
					<li><a href="dashboard.php?page=viewresult">Semester Result</a></li>
				<?php endif; ?>
					<li><a href="">Test/Exam Template</a></li>
					<li><a href="dashboard.php?page=attendancesheet">Attendance</a></li>
			</ul>
    </li>
	<?php endif; ?>
</ul>
	</div>
</div>

<!-- icofont-4x -->
                