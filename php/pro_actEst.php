<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);


if (!empty($_POST)) {
	$matri   =$_POST['matri'];
	$estado   =$_POST['edo'];
  $trimestre   =$_POST['trimestre'];
	$total_status = 0;

	include 'conn.php';
  $pdo = Connection::getInstance();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT matricula from estudiante_tutor where matricula= ?;";
  $q = $pdo->prepare($sql);
  $q->execute(array($matri));
  $total=$q->rowCount(); 

  if($total > 0){

  	$query_status = "UPDATE estudiante_tutor SET status_estudiante = ?  WHERE (matricula = ? and trimestre = ?);";
    $stmt_status = $pdo->prepare($query_status);
    $stmt_status->execute(array($estado, $matri, $trimestre));
    $total_status = $stmt_status->rowCount();

  }

  if($total_status > 0){
  	echo "<br><b class='ml-4'>Estatus actualizado correctamente.</b>";
  }else{
  	echo "<br><b class='ml-4'>Problemas al actualizar el estatus.</b><br><br><a href='baja.php'><b class='ml-4'>Regresar</b>";
  }

}



?>