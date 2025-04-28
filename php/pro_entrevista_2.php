 <?php
  session_start();
  $matricula=($_SESSION['matri_tutoria']);
  $_SESSION['matri_tutoria']=$matricula;
  $total_ins = 0;
  $valido = false;
  
  include 'pro_input.php';

  if (!empty($_POST)) {
    $nom = verificaInput($_POST['txt1']);
    $correo  = verificaInput($_POST['txt3']);
    $edo_civ  = verificaInput($_POST['txt4']);
    $sexo  = verificaInput($_POST['radio5']);
    $edad  = verificaInput($_POST['txt6']);
    $hijos   = verificaInput($_POST['radio7']); //////
    $depen   = verificaInput($_POST['radio8']);
    $depen_n = verificaInput($_POST['txt9']);
    $trabajo = verificaInput($_POST['radio10']);
    $trabajo_l = verificaInput($_POST['txt11']);
    $prom = verificaInput($_POST['txt12']);
    $beca   = verificaInput($_POST['radio13']); ////////
    $t_beca   = verificaInput($_POST['txt14']); /////

    $esc_m   = verificaInput($_POST['txt15']);
    $esc_p   = verificaInput($_POST['txt16']);
    $motivo  = verificaInput($_POST['txt17']);
    $motivo_o = verificaInput($_POST['txt18']);
    $lic = verificaInput($_POST['txt19']);

    $xq_lic     = verificaInput($_POST['txt20']); ////
    $xq_lic_o   = verificaInput($_POST['txt21']); ////
    $c_laboral   = verificaInput($_POST['radio22']); ////
    $m_laboral   = verificaInput($_POST['txt23']); ////

    $horas_est = verificaInput($_POST['txt24']);

    $duda    = verificaInput($_POST['txt25']);
    $duda_md = verificaInput($_POST['txt26']);
    $duda_pq = verificaInput($_POST['txt27']);

    $duda2 = verificaInput($_POST['txt28']);
    $duda_md2 = verificaInput($_POST['txt29']);
    $duda_pq2 = verificaInput($_POST['txt30']);
    $turno = verificaInput($_POST['txt42']);

    $recursos = "";
    if (isset($_POST['check31'])) {
      $recursosSeleccionados = verifica($_POST['check31']);
      foreach ($recursosSeleccionados as $recurso) {
        //echo $recurso . '<br>';
        $recursos = $recurso."|".$recursos;
      }
    }
    $recurso_o = $_POST['txt32'];

    $espacios = "";
    if (isset($_POST['check33'])){
      $espaciosSeleccionados = $_POST['check33'];
      foreach ($espaciosSeleccionados as $espacio) {
        $espacios = $espacio."|".$espacios;
      }
    }
    $espacio_otro1 = $_POST['txt34'];

    $espacios2 = "";
    if (isset($_POST['check35'])){
      $espaciosSeleccionados2 = $_POST['check35'];
      foreach ($espaciosSeleccionados2 as $espacio2) {
        $espacios2 = $espacio2."|".$espacios2;
      }
    }
    $espacio_otro2 = $_POST['txt36'];

    $acti = $_POST['radio37'];

    $acti_c = $_POST['txt38']; /////
    $acti_d = $_POST['radio39']; //////


    $tutoria  = $_POST['txt40'];
    $tutoria_otro  = $_POST['txt41'];
    $valido = true;
  }
  

  if ($valido){
    include 'conn.php';
    $connection = Connection::getInstance();

    $query_1 = "SELECT matri_alu FROM ges_registro_alu WHERE matri_alu= ?;";
    $stmt_1 = $connection->prepare($query_1);
    $stmt_1->execute(array($matricula));
    $total_1 = $stmt_1->rowCount();

    if($total_1==0){ 

      $query_ins_1 = "INSERT INTO ges_registro_alu (matri_alu, nombre, correo) VALUES (?, ?, ?);";
      $stmt_in_1 = $connection->prepare($query_ins_1);
      $stmt_in_1->execute(array($matricula, $nombre, $correo));
      $total_ins_1 = $stmt_in_1->rowCount();

      /* ------> */
      $query_exi = "SELECT * FROM entrevista_alumno WHERE matricula= ?;";
      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($matricula));
      $total_exi=$stmt_exi->rowCount();

     // echo "total: ".$total_exi;

      if($total_exi==0){ /// if no existe entrevista del alumno inserta

          $query_ins = "INSERT INTO entrevista_alumno (matricula, correo_alu, nombre, edo_civil, sexo, edad, hijos, depen, depen_n, trabajo, trabajo_l, prom, beca, t_beca, esc_m, esc_p, motivo, motivo_o, lic, xq_lic, xq_lic_o, c_laboral, m_laboral, horas_est, duda, duda_md, duda_pq, duda2, duda_md2, duda_pq2, recursos, recurso_o, espacios, espacio_otro1, espacios2, espacio_otro2, acti, acti_c, acti_d, tutoria, tutoria_otro, turno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

          $stmt_ins  = $connection->prepare($query_ins);
          $stmt_ins->execute(array($matricula, $correo, $nom, $edo_civ, $sexo, $edad, $hijos, $depen, $depen_n, $trabajo, $trabajo_l, $prom, $beca, $t_beca, $esc_m, $esc_p, $motivo, $motivo_o, $lic, $xq_lic, $xq_lic_o, $c_laboral, $m_laboral, $horas_est, $duda, $duda_md, $duda_pq, $duda2, $duda_md2, $duda_pq2, $recursos, $recurso_o, $espacios, $espacio_otro1, $espacios2, $espacio_otro2, $acti, $acti_c, $acti_d, $tutoria, $tutoria_otro, $turno));
          //$last_id   = $connection->lastInsertId();  ///último id insertado
          $total_ins = $stmt_ins->rowCount();

      }else if($total_exi > 0){
        $total_ins = 1;
      }
    }

  } /// valido

  if( ($total_ins > 0) || ($total_1 > 0)  ){
    $response = 1; 

  }else{
    $response = 0; 
    
  }
  echo json_encode($response);

/*
  if($total_ins > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);
*/

?>