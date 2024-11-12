<?php
$now = time();
	if ($now > $_SESSION['expire']) {
		session_destroy();
        header('location:../index.php');
	}