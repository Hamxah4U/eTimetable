<?php

  session_start();

  $uri = $_SERVER['REQUEST_URI'];

    if(!isset($_SESSION['email']) && $uri != '/' && $uri != '/login') {
      header('Location: /');
      exit();
    }

    // if(!isset($_SESSION['email']) && $uri != '/' && $uri != '/login') {
    //   header('Location: /');
    //   exit();
    // }
    
    require 'function.php';

    $uri = $_SERVER['REQUEST_URI'];

    if($uri == '/'){
      require 'controllers/index.php';
    }elseif($uri == '/destroy'){
      require 'controllers/logout.php';
    }elseif($uri == '/academic/timetable'){
      require 'controllers/academic.calendar.php';
    }elseif($uri == '/faculty'){
      require 'controllers/faculty.php';
    }elseif($uri == '/department'){
      require 'controllers/department.php';
    }elseif($uri == '/course'){
      require 'controllers/course.php';
    }elseif($uri == '/contact'){
      require 'controllers/contact.php';
    }elseif($uri == '/dashboard'){
      require 'controllers/admindashboard.php';
    }elseif($uri == '/users'){
      require 'controllers/manageusers.php';
    }elseif($uri == '/calendar'){
      require 'controllers/calendar.php';
    }elseif($uri == '/timetable'){
      require 'controllers/timetable.php';
    }elseif($uri == '/student/dashboard'){
      require 'controllers/dashboard.student.php';
    }elseif($uri == '/student/calendar'){
      require 'controllers/student.calendar.php';
    }elseif('student/updateprofile'){
      require 'controllers/updateprofile.php';
    }
?>