<?php
session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;

include 'conn.php';
$connection = Connection::getInstance();

$trim_codi = $_POST['trim_inf'];
$trim = base64_decode($trim_codi); 
$trim = htmlspecialchars($trim);


$query_exi = "SELECT est.matri_alu as matri FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where status_estudiante = 2 and est_tutor.trimestre ='$trim' and  no_eco = '$usuario' ;";

$stmt_exi = $connection->prepare($query_exi);
$stmt_exi->execute();
$total_estudiantes = $stmt_exi->rowCount();

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

$query_exi4 = "SELECT tutor_id FROM ges_tutoria_individual WHERE asistencia != 3 and asistencia != 4 and tutor_id = $usuario and trim_informe = '$trim';";       
$stmt_exi4 = $connection->prepare($query_exi4);
$stmt_exi4->execute();
$total_exi4 = $stmt_exi4->rowCount();

$query_exi5 = "SELECT num_eco FROM ges_constancia WHERE num_eco = $usuario and trimestre = '$trim';";       
$stmt_exi5 = $connection->prepare($query_exi5);
$stmt_exi5->execute();
$total_exi5 = $stmt_exi5->rowCount();



if($total_exi5 > 0){
    echo '1';
}else if ($total_exi1 > 0 and $total_exi2 > 0 and $total_exi3 > 0) {
    echo '2';   
//// }else if ($total_exi4 == $total_estudiantes) {   /// 
}else if ($total_exi4 >= $total_estudiantes) { 
    echo '3'; 
} else {  
    echo '0';
    //echo 'Es necesario completar el informe trimestral para poder descargar la constancia';
} 
    

 