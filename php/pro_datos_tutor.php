<?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;
  $total_up2 = 0;

  $ip_nav = $_SERVER['HTTP_USER_AGENT'] ." ip:".$_SERVER['REMOTE_ADDR'];
  if (!empty($_POST)) { /// 1

    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $nombre = $_POST['nom'];
    $sexo = $_POST['radio5'];
    $estudios = $_POST['estudios'];
    $division = $_POST['division'];
    $dpto = $_POST['dpto'];
    $imparte = $_POST['imparte'];
    $trimestre = $_POST['trim'];
    $continuar = $_POST['continuar'];
    $otro_continuar = $_POST['otro_con'];
    $folio  = "";
    $id_constancia = 0;
  
    include 'conn.php'; 
    $connection = Connection::getInstance();
    $query_exi = "SELECT t.nombre, t.num_eco, estado_tutor, IFNULL(c.idges_constancias,'0') AS id_constancia FROM ges_registro_tutor t left join ges_constancia c on t.num_eco = c.num_eco and c.trimestre = ? WHERE t.num_eco = ?;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($trimestre,$usuario));
    $total=$stmt_exi->rowCount();

    if($total > 0){

      while ($row = $stmt_exi->fetch()){
        $id_constancia = "{$row['id_constancia']}";
      }

      $query_up = "UPDATE ges_registro_tutor SET nombre = ?, ap = ?, am = ?, sexo = ?, estudios = ?, division = ?, depto = ?, imparte = ?, ip_nvgdr = ? WHERE (num_eco = ?);";
      $stmt_up  = $connection->prepare($query_up);
      $exe_success = $stmt_up->execute(array($nombre,$ap,$am,$sexo,$estudios,$division,$dpto,$imparte,$ip_nav,$usuario));
      $total_up = $stmt_up->rowCount();


      if(($exe_success > 0) && ($id_constancia == 0) ){ 

        $query_in = "INSERT INTO ges_constancia (num_eco, id_depto, trimestre, continuar,otro_continuar,fecha_constancia) VALUES (?, ?, ?,?,?,now());";
        $stmt_in  = $connection->prepare($query_in);
        $stmt_in->execute(array($usuario,$dpto,$trimestre,$continuar,$otro_continuar));
        $last_id   = $connection->lastInsertId(); 
        $folio = "CODE.ATAA.AT.".$last_id.".".date("Y");
        $total_in = $stmt_in->rowCount();

        $query_up2 = "UPDATE ges_constancia SET folio = ?  WHERE (idges_constancias = ? and num_eco = ?);";
        $stmt_up2  = $connection->prepare($query_up2);
        $stmt_up2->execute(array($folio,$last_id,$usuario));
        $total_up2 = $stmt_up2->rowCount();

        if($total_up2 > 0){
          header('Location: ../modulo/tutor/constancia_trimestral_0.php?x='.$trimestre);

        }else{
          echo "<p class='alert alert-danger'>Problemas al generar tu constancia por favor, intenta nuevamente (1).</p>";
        }

      }elseif(($exe_success > 0) && ($id_constancia > 0) ){
        //// OK redirecciona a CONSTANCIA
        $trim_code = urlencode(base64_encode($trimestre));
        header('Location: ../modulo/tutor/constancia_trimestral_1.php?x='.$trim_code);
      

      }else{  
          ////NO PUDO ACTUALIZAR DATOS REGISTRO TUTOR
          echo "<p class='alert alert-danger'>No fue posible prosesar tu información, intenta nuevamente (2).</p>";
      }

    }else{ ///if total 0
      /// NO ENCONTRO REGISTRO EN TABLA REGISTRO 
      echo "<p class='alert alert-danger'>1. No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos (3).</p>";
    } ///if total 0

  }/// IF POST 1


?>