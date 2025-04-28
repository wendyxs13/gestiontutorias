 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;
  //echo "us: ".$usuario." matricula:".$matricula."<br>";
  $total_ins = 0;
  $valido = false;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {

    include 'conn.php';
    $connection = Connection::getInstance();
    $participa = $otra_participa = $comentarios = 0;

    if (!empty($_POST['participa'])){ $participa = verifica($_POST['participa']); }
    if (!empty($_POST['txtOtro'])) { $otra_participa = verifica($_POST['txtOtro']); }
    if (!empty($_POST['comentarios'])) { $comentarios = verifica($_POST['comentarios']); }
    
    $trim_inf  = verifica($_POST['trim_secc_4']);
    $rev_participa = "";

    $query_exi = "SELECT num_eco, participa FROM ges_tutoria_grupal_3 WHERE num_eco = ? and trim_informe = ?;";
    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($usuario, $trim_inf));
    $total_exi=$stmt_exi->rowCount();

    if($total_exi==0){ /// if no existe regresa a sección 1
      $response = 0; 
    }else{
      
      while ($row = $stmt_exi->fetch()) {
        $rev_participa = "{$row['participa']}";
      }

      if($rev_participa == NULL){
        include 'pro_correo.php';
        $envio_msj = notificacion_info_grupal($usuario,$trim_inf); 
      }

      $query_up = "UPDATE ges_tutoria_grupal_3 SET participa = ?, otra_participa = ?, comentarios = ? WHERE (num_eco = ? and trim_informe = ?);";
      $stmt_up  = $connection->prepare($query_up);
      $stmt_up->execute(array($participa, $otra_participa, $comentarios, $usuario, $trim_inf));
      $response = $stmt_up->rowCount();
    }

  }
  /*if($total_ins > 0){
    $response = 1; 
  }else{
    $response = 0; 
  } */
  echo json_encode($response);

?>