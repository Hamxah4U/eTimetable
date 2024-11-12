<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-win"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <img src="../../images/NOUN-logo.png" alt="" width="60px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <strong>Dashboard</strong></a>
    </li>

    <?php if($_SESSION['Role'] == 'Admin'):?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="/users">
            <i class="fas fa-fw fa-user"></i>
            Manage Users</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/faculty">
            <i class="icofont-institution"></i>
            Manage Faculty</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/department">
            <i class="icofont-gears"></i>
            Manage Department</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/course">
            <i class="icofont-address-book"></i>
            Manage Course</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/calendar">
            <i class="icofont-ui-calendar"></i>
            Manage Calendar</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/timetable">
        <i class="icofont-table"></i>
            Manage TimeTable</a>
    </li>
    <?php elseif($_SESSION['Role'] == 'Academic'):?>
        <li class="nav-item active">
        <a class="nav-link" href="/academic/timetable">
        <i class="icofont-table"></i>
             TimeTable</a>
        </li>

        <li class="nav-item active">
        <a class="nav-link" href="#">
        <i class="icofont-user"></i>
             Update Profile</a>
        </li>
    
    <?php endif; ?>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="/destroy">
        <i class="fas fa-sign-out-alt"></i>
        Logout</a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

            <!-- Sidebar Message -->
</ul>