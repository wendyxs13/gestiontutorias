<?php
session_start();
  
  $total_act = 0;
  $estado = "";

  $id = $_GET['r'];   
  $tam = strlen($id);
  $t=0;
  $con_id="";
  while($t < $tam){
    switch($id[$t]){
      case 'R': $etr="0";
      break;
      case 'S': $etr="1";
      break;
      case 'T': $etr="2";
      break;
      case 'U': $etr="3";
      break;
      case 'V': $etr="4";
      break;
      case 'W': $etr="5";
      break;
      case 'X': $etr="6";
      break;
      case 'Y': $etr="7";
      break;
      case 'Z': $etr="8";
      break;
      case 'A': $etr="9";
      break;                  
    }
  $con_id= $con_id."".$etr;
  $t++;  

  }

  ?>
  <!DOCTYPE HTML>
    <html lang="en">

      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="../css/bootstrap.min.css" >
        <link rel="stylesheet" href="../css/estilo.css" >   
        <script src="../js/jquery-3.5.1.slim.min.js" ></script>
        <script src="../js/bootstrap.bundle.min.js"   ></script>
        <script src="../js/jquery-3.5.1.js" ></script>
        <script src="../js/sweetalert.min.js"></script> 
        <link rel="shortcut icon" href="../img/favicon_1.ico" type="image/vnd.microsoft.icon">
        <title>Tutorías UAM-X</title>
      </head>
      <body>
      

  <?php

 /// echo '"UPDATE ges_registro_alu SET estado ="2" WHERE (idges_registro_alu = '.$con_id.' );';

  include '../php/conn.php'; 
  $connection = Connection::getInstance();

  $query_exi = "SELECT idges_registro_alu, nombre, ap, am, matri_alu, correo, estado FROM ges_registro_alu WHERE idges_registro_alu= ?;";
  $stmt_exi = $connection->prepare($query_exi);
  $stmt_exi->execute(array($con_id));
  $total=$stmt_exi->rowCount();
      
  if($total > 0){
    while ($row = $stmt_exi->fetch()){
      $id_alu =utf8_encode("{$row['idges_registro_alu']}");
      $nombre =utf8_encode("{$row['nombre']}");
      $ap =utf8_encode("{$row['ap']}");
      $am =utf8_encode("{$row['am']}");
      $correo =utf8_encode("{$row['correo']}");
      $matricula =utf8_encode("{$row['matri_alu']}");
      $estado =utf8_encode("{$row['estado']}");
    }

  }

  if($estado == "1"){
    $query_activa = "UPDATE ges_registro_alu SET estado ='2' WHERE (idges_registro_alu = ? );";
    $stmt_activa = $connection->prepare($query_activa);
    $stmt_activa->execute(array($con_id));
    $total_act=$stmt_activa->rowCount();

    if(($total_act > 0) || ($estado == 2) ){
      $_SESSION["matri_tutoria"] = $matricula;
      $_SESSION["nombre"] = $nombre;
      $_SESSION["ap"] = $ap;
      $_SESSION["am"] = $am;
      $_SESSION["correo"] = $correo;
      ///echo "matri: ".$matricula;
      header("location:../estudiante/entrevista_1.php");
    }

  }elseif( $estado == 2 ){
      $_SESSION["matri_tutoria"] = $matricula;
      $_SESSION["nombre"] = $nombre;
      $_SESSION["ap"] = $ap;
      $_SESSION["am"] = $am;
      $_SESSION["correo"] = $correo;
      ///echo "matri: ".$matricula;
      header("location:../estudiante/entrevista_1.php");
  }elseif ($estado == "3"){
    echo '<script>alert("Te informamos que tus datos de la entrevista inicial se han almacenado correctamente. ¡Muchas gracias por tu participación! ");</script>';
    echo '<script>location.href = "../index.html"</script>';

   /// header("location:../index.html");

  }else{
    echo '<script>alert("Datos no encontrados, asegúrate de ingresar correctamente tus datos");</script>';
    echo '<script>location.href = "../index.html"</script>';

  }

 ?> 
    </body>
  </html>