<?php

session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;

include 'conn.php';
$connection = Connection::getInstance();

$trim_codi = $_POST['trim_inf'];
$trim = base64_decode($trim_codi); 
$trim = htmlspecialchars($trim);

$query_exi1 = "SELECT matricula FROM ges_tutoria_grupal_1 WHERE num_eco = $usuario and trim_informe = '$trim';";       
$stmt_exi1 = $connection->prepare($query_exi1);
$stmt_exi1->execute();
$total_exi1 = $stmt_exi1->rowCount();

$query_exi2 = "SELECT num_eco FROM ges_tutoria_grupal_2 WHERE num_eco = $usuario and trim_informe = '$trim';";       
$stmt_exi2 = $connection->prepare($query_exi2);
$stmt_exi2->execute();
$total_exi2 = $stmt_exi2->rowCount();

$query_exi3 = "SELECT num_eco FROM ges_tutoria_grupal_3 WHERE num_eco = $usuario and trim_informe = '$trim';";       
$stmt_exi3 = $connection->prepare($query_exi3);
$stmt_exi3->execute();
$total_exi3 = $stmt_exi3->rowCount();

if ($total_exi1 > 0 and $total_exi2 > 0 and $total_exi3 > 0) {
    echo 'view';   
} else {  
    echo 'new';
} 
    

 