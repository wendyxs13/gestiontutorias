<?php
session_start();
$usuario = ($_SESSION['at_usuario']);
$nombre = ($_SESSION['at_rol']);
session_unset();
session_destroy();
header("location:index.php");
