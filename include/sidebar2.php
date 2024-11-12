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
            <li id="sidebar" class="app-sidebar__heading"><a style="font-size: 17pt;" href="dashboard">Dashboards</a></li>
            <li>
            <li class="app-sidebar__heading">
                <a href="">
                    <i style="font-size:20pt; color:silver" class="icofont-gears"></i>
                    <span style="font-size: 17pt;">Student</span>
                </a>
            </li>
            </li>

            <!-- <li class="app-sidebar__heading">MANAGE STUDENT</li> -->
            <li class="app-sidebar__heading">
                <a href="dashboard.php?page=courseregistration">
                    <span style="font-size: 20pt; color:black" class="icofont-hat"></span>
                    <span style="font-size: 17pt; color:#fff;">Course Reg.</span>
                </a>
            </li> 

            <li class="app-sidebar__heading">
                <a href="dashboard.php?page=viewresult">
                    <span style="font-size: 20pt; color:silver" class="fa fa-eye"></span>
                    <span style="font-size: 17pt; color:#fff;">View Result</span>
                </a>
            </li> 

            <!--<li class="app-sidebar__heading">
                <a href="#">
                    <i class="icofont-building-alt" style="font-size: 20pt; color:aquamarine"></i>
                    <span style="font-size: 17pt;color:#fff;">Department</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul id="sidebar">
                    <li><a href="dashboard?page=course"><i class="metismenu-icon"></i>Add Department</a></li>
                    <li><a href="dashboard?page=newcouse">Add Course</a></li>
                    <li><a href="dashboard?page=managecourse"><i class="metismenu-icon"></i>Manage Department</a></li>
                    <li><a href="dashboard?page=coursetitleandcode">Manage Course</a></li>
                </ul>
            </li>
            <li class="app-sidebar__heading">
                <a href="#">
                    <span style="color: smoke;font-size:20pt" class="icofont-tasks-alt"></span>
                    <span style="font-size: 17pt;color:#fff;">Test/Exam</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul id="sidebar">
                    <li><a href="dashboard?page=testandexam">Test/Exam</a></li>
                    <li><a href="dashboard?page=assigncourse">Assign Course</a></li>
                    <li><a href="">Test/Exam Template</a></li>
                    <li><a href="dashboard?page=attendancesheet">Attendance</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>

<!-- icofont-4x -->
                