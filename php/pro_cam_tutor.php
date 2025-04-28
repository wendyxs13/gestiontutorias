<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);
$total_status = 0;

if (!empty($_POST)) {
	$matri   =$_POST['matri'];
  $actual =$_POST['actual'];
	$nuevo  =$_POST['nuevo'];
  $trimestre = $_POST['trimestre'];

	include 'conn.php';
  $pdo = Connection::getInstance();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT matricula, no_eco from estudiante_tutor where matricula= ? and no_eco = ? and trimestre = ?;";
  $q = $pdo->prepare($sql);
  $q->execute(array($matri,$nuevo,$trimestre));
  $total=$q->rowCount(); 

  if($total == 0){
  	$query_status = "UPDATE estudiante_tutor SET no_eco = ?, tutor_anterior = ? WHERE (matricula = ? and trimestre = ?);";
    $stmt_status = $pdo->prepare($query_status);
    $stmt_status->execute(array($nuevo, $actual, $matri, $trimestre));
    $total_status = $stmt_status->rowCount();
  }else{
    $total_status = "1";
  }

  if($total_status > 0){
  	echo "<br><b class='ml-4'>El cambio de tutor se realizo correctamente.</b><br><br><a href='cambio_tutor.php'><b class='ml-4'>Regresar</b>";
  }else{
  	echo "<br><b class='ml-4'>Problemas al guardar la información.</b>";
  }
}
?>