 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;

  $total_ins = 0;
  $valido = false;
  $trim_inf = 0;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {

    $trim_codi = $_POST['trim_inf'];
    $trim = base64_decode($trim_codi); 
    $trim = htmlspecialchars($trim);
    include 'conn.php';
    $connection = Connection::getInstance();

    $fecha = $duracion = $tema = $modalidad = "";
    if (!empty($_POST['fs_1'])){ $fecha= verifica($_POST['fs_1']); }
    if (!empty($_POST['ds_1'])) { $duracion = verifica($_POST['ds_1']); }
    if (!empty($_POST['ts_1'])) { $tema = verifica($_POST['ts_1']); }
    if (!empty($_POST['ms_1'])){ $modalidad= verifica($_POST['ms_1']); } 
        
    if( (!empty($_POST['fs_1'])) && (!empty($_POST['ts_1']))  ){ 

      $query_ins = "INSERT INTO ges_tutoria_grupal_2 (num_eco, fecha, horas, temas, modalidad, trim_informe) VALUES (?, ?, ?, ?, ?, ?);";
      $stmt_ins  = $connection->prepare($query_ins);
      $stmt_ins->execute(array($usuario, $fecha, $duracion, $tema, $modalidad, $trim));
      $last_id   = $connection->lastInsertId();  ///último id insertado
      $total_ins = $stmt_ins->rowCount(); 



    }

    /////echo ("datos: ".$usuario." ".$fecha." ".$duracion." ".$tema." ".$modalidad." ".$trim);



    /* for ($i = 1; $i <= $total_alu; $i++) {

      $fecha = $duracion = $tema = $modalidad = "";
      if (!empty($_POST['fs_'.$i])){ $fecha= verifica($_POST['fs_'.$i]); }
      if (!empty($_POST['ds_'.$i])) { $duracion = verifica($_POST['ds_'.$i]); }
      if (!empty($_POST['ts_'.$i])) { $tema = verifica($_POST['ts_'.$i]); }
      if (!empty($_POST['ms_'.$i])){ $modalidad= verifica($_POST['ms_'.$i]); } 
          
      if( (!empty($_POST['fs_'.$i])) && (!empty($_POST['ts_'.$i]))  ){ 

        $query_ins = "INSERT INTO ges_tutoria_grupal_2 (num_eco, fecha, horas, temas, modalidad, trim_informe) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt_ins  = $connection->prepare($query_ins);
        $stmt_ins->execute(array($usuario, $fecha, $duracion, $tema, $modalidad, $trim_inf));
        $last_id   = $connection->lastInsertId();  ///último id insertado
        $total_ins = $stmt_ins->rowCount(); 

      }

    } */

  }


  if($total_ins > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);

?>