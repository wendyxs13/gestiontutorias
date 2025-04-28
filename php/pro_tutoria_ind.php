 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $matricula=($_SESSION['matricula']);
  $_SESSION["matricula"] = $matricula;
  $_SESSION["us_tutor"] = $usuario;

  $total_ins = 0;
  $valido = false;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {
    $desemp = $orientacion = $tiempo = $aspecto = $recomen = "";
    $asistencia = verificaInput($_POST['asistencia']);
    $etapa =    verificaInput($_POST['txt1']);
    $cal  =  verificaInput($_POST['txt2']);
    ///$desemp  =  verificaInput($_POST['radio3']);
    if (isset($_POST['radio3'])) { $desemp = verifica($_POST['radio3']); }
    $desemp_desc  = verificaInput($_POST['txt4']);
    ///$orientacion  = verificaInput($_POST['radio5']);
    if (isset($_POST['radio5'])) { $orientacion = verifica($_POST['radio5']); }
    if (isset($_POST['radio6'])) { $tiempo = verifica($_POST['radio6']); } 
    ///$tiempo  =  verificaInput($_POST['radio6']);

    $tema1 = $tema2 = $tema3 = $tema4 = $tema5 = $tema6 = $tema7 = $tema8 = 0;
    if (isset($_POST['check7-1'])) { $tema1 = verifica($_POST['check7-1']); }
    if (isset($_POST['check7-2'])) { $tema2 = verifica($_POST['check7-2']); }
    if (isset($_POST['check7-3'])) { $tema3 = verifica($_POST['check7-3']); }
    if (isset($_POST['check7-4'])) { $tema4 = verifica($_POST['check7-4']); }
    if (isset($_POST['check7-5'])) { $tema5 = verifica($_POST['check7-5']); }
    if (isset($_POST['check7-6'])) { $tema6 = verifica($_POST['check7-6']); }
    if (isset($_POST['check7-7'])) { $tema7 = verifica($_POST['check7-7']); }
    if (isset($_POST['check7-8'])) { $tema8 = verifica($_POST['check7-8']); }

    $temas_otro = verificaInput($_POST['txt8']);
    //$aspecto    = verificaInput($_POST['radio9']);
    if (isset($_POST['radio9'])) { $aspecto = verifica($_POST['radio9']); } 
    $aspecto_otro = verificaInput($_POST['txt10']);
    //$recomen =  verificaInput($_POST['radio11']);
    if (isset($_POST['radio11'])) { $recomen = verifica($_POST['radio11']); } 
    $recomen_otro = verificaInput($_POST['txt12']);
    $estrategia = verificaInput($_POST['txt13']);
    $acuerdos = verificaInput($_POST['txt14']);
    $logros =   verificaInput($_POST['txt15']);
    $comentarios =   verificaInput($_POST['txt16']);
   
    $trim_inf =   verificaInput($_POST['trim_inf']);
    $valido = true;
  }

  // *** AGREGAR VALIDACIÓN DE CORREO ALUMNO O MATRICULA, VERIFICAR QUE CUMPLA CON CONDICIONES y $valido= FALSE;  ***** ///////

  if ($valido){
    include 'conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT matri_id, tutor_id FROM ges_tutoria_individual WHERE matri_id= ? and trim_informe = ?;";
    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($matricula,$trim_inf));
    $total_exi=$stmt_exi->rowCount();

    if ( ($asistencia == 3) || ($asistencia == 4) ){
      $query_up1 = "UPDATE estudiante_tutor SET status_estudiante = 6 WHERE (matricula= ? and trimestre = ? and no_eco = ? );";
      $stmt_up1  = $connection->prepare($query_up1);
      $total_ins1 = $stmt_up1->execute(array($matricula, $trim_inf, $usuario));
    }

    if($total_exi==0){ /// if no existe tutoria del alumno inserta

       $query_ins = "INSERT INTO ges_tutoria_individual (matri_id, tutor_id, asistencia, etapa, calificacion, desemp, desemp_desc, orientacion, tiempo_orienta, tema1, tema2, tema3, tema4, tema5, tema6, tema7, tema8, tema_otro, aspecto, aspecto_otro, recomen, recomen_otro, estrategia, acuerdos, logros, comentarios, trim_informe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

      $stmt_ins  = $connection->prepare($query_ins);
      $stmt_ins->execute(array($matricula, $usuario, $asistencia, $etapa, $cal, $desemp, $desemp_desc, $orientacion, $tiempo, $tema1, $tema2, $tema3, $tema4, $tema5, $tema6, $tema7, $tema8, $temas_otro, $aspecto, $aspecto_otro, $recomen, $recomen_otro, $estrategia, $acuerdos, $logros, $comentarios, $trim_inf));
      $last_id   = $connection->lastInsertId();  ///último id insertado
      $total_ins = $stmt_ins->rowCount();
      
      if($total_ins > 0){
        include 'pro_correo.php';
        $cod_informe =  genera_codigo($last_id);
        $envio_msj = notificacion_info_ind($usuario,$trim_inf,$matricula,$cod_informe); ////// #### ACTIVAR #### ////
      }

    }else{

      $query_up = "UPDATE ges_tutoria_individual SET asistencia = ?, etapa = ?, calificacion = ?, desemp = ?, desemp_desc = ?, orientacion = ?, tiempo_orienta = ?, tema1 = ?, tema2 = ?, tema3 = ?, tema4 = ?, tema5 = ?, tema6 = ?, tema7 = ?, tema8 = ?, tema_otro = ?, aspecto = ?, aspecto_otro = ?, recomen = ?, recomen_otro = ?, estrategia = ?, acuerdos = ?, logros = ?, comentarios = ?, fecha_edicion = now() WHERE (trim_informe = ? and tutor_id = ? and matri_id = ? );";
      $stmt_up  = $connection->prepare($query_up);
      $total_ins = $stmt_up->execute(array($asistencia, $etapa, $cal, $desemp, $desemp_desc, $orientacion, $tiempo, $tema1, $tema2, $tema3, $tema4, $tema5, $tema6, $tema7, $tema8, $temas_otro, $aspecto, $aspecto_otro, $recomen, $recomen_otro, $estrategia, $acuerdos, $logros, $comentarios, $trim_inf, $usuario,$matricula));

    }

  }

  if($total_ins > 0){

    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);
  
?>