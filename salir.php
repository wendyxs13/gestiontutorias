<?php
	session_start();
	$usuario=($_SESSION['us_tutor']);
	$email =($_SESSION['us_correo']);
	session_unset();
	session_destroy();
	header("location:login.php");
?>