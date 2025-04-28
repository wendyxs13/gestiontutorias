 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;

  $total_ins = 0;
  $valido = false;
  $trim_inf = 0;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {

    include 'conn.php';
    $connection = Connection::getInstance();
    $falta = $faltantes = $tuto_ind = $estudiantes = $req_pq = $tuto_rea = 0;

    $trim_inf  = verifica($_POST['trim_secc_3']);

    if (!empty($_POST['falta'])){ $falta= verifica($_POST['falta']); }
    if (isset($_POST['falta_est'])) {
      $est_Sel_falta = verifica($_POST['falta_est']);
      foreach ($est_Sel_falta as $faltante) {
        $faltantes = $faltante."|".$faltantes;
      }
    }

    if (!empty($_POST['tuto_ind'])){ $tuto_ind= verifica($_POST['tuto_ind']); }

    if (isset($_POST['req_est'])) {
      $est_Seleccionados = verifica($_POST['req_est']);
      foreach ($est_Seleccionados as $est) {
        $estudiantes = $est."|".$estudiantes;
      }
    }

    if (!empty($_POST['req_pq'])) { $req_pq = verifica($_POST['req_pq']); }
    if (!empty($_POST['tuto_rea'])){ $tuto_rea= verifica($_POST['tuto_rea']); }

    $query_exi = "SELECT num_eco FROM ges_tutoria_grupal_3 WHERE num_eco = ? and trim_informe = ?;";
    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($usuario, $trim_inf));
    $total_exi=$stmt_exi->rowCount();

    if($total_exi==0){ /// if no existe inserta

      $query_ins = "INSERT INTO ges_tutoria_grupal_3 (num_eco, tutoria_falta, tutoria_falta_est, tutoria_ind, tutoria_ind_est, tutoria_ind_razon, tutoria_continuar, trim_informe) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
      $stmt_ins  = $connection->prepare($query_ins);
      $stmt_ins->execute(array($usuario, $falta, $faltantes, $tuto_ind, $estudiantes, $req_pq, $tuto_rea, $trim_inf));
      $total_ins = $stmt_ins->rowCount(); 

    }else{

      $query_up = "UPDATE ges_tutoria_grupal_3 SET tutoria_falta = ?, tutoria_falta_est = ?, tutoria_ind = ?, tutoria_ind_est = ?, tutoria_ind_razon = ?, tutoria_continuar = ? WHERE (num_eco = ? and trim_informe = ? );";
      $stmt_up  = $connection->prepare($query_up);
      $stmt_up->execute(array($falta, $faltantes, $tuto_ind, $estudiantes, $req_pq, $tuto_rea, $usuario, $trim_inf));
      $total_ins = $stmt_up->rowCount();
      $total_ins= 1;
    }

  }
  if($total_ins > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);

?>