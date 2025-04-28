 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;

  $total_ins = 0;
  $valido = false;
  $trim_inf = 0;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {

    $total_alu  = verificaInput($_POST['est_asig']);
    $trim_inf  = verificaInput($_POST['trim_secc_1']);
    include 'conn.php';
    $connection = Connection::getInstance();

    for ($i = 1; $i <= $total_alu; $i++) {

      $matri = $prom = $trim = $final = 0;
      if (!empty($_POST['matri_'.$i])){ $matri= verifica($_POST['matri_'.$i]); }
      if (!empty($_POST['prom_'.$i])) { $prom = verifica($_POST['prom_'.$i]); }
      if (!empty($_POST['trim_'.$i])) { $trim = verifica($_POST['trim_'.$i]); }
      if (!empty($_POST['final_'.$i])){ $final= verifica($_POST['final_'.$i]); } 

      $query_exi = "SELECT num_eco, matricula FROM ges_tutoria_grupal_1 WHERE matricula = ? and num_eco = ? and trim_informe = ?;";
      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($matri,$usuario, $trim_inf));
      $total_exi=$stmt_exi->rowCount();
      
      if($total_exi==0){ /// if no existe tutoria del alumno inserta

        $query_ins = "INSERT INTO ges_tutoria_grupal_1 (num_eco, matricula, trimestre, prom_ini, prom_fin, trim_informe) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt_ins  = $connection->prepare($query_ins);
        $stmt_ins->execute(array($usuario, $matri, $trim, $prom, $final, $trim_inf));
        $last_id   = $connection->lastInsertId();  ///último id insertado
        $total_ins = $stmt_ins->rowCount(); 

      }else{

        $query_up = "UPDATE ges_tutoria_grupal_1 SET trimestre = ?, prom_fin = ? WHERE (num_eco = ? and matricula = ? and trim_informe = ? );";
        $stmt_up  = $connection->prepare($query_up);
        $stmt_up->execute(array($trim, $final, $usuario, $matri, $trim_inf));
        $total_ins = $stmt_up->rowCount();
        $total_ins= 1;
      }  

    }

  }

  //echo $total_exi."*** ";

  if($total_ins > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);

?>