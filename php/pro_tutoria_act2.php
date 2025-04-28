 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;

  $total_up = 0;
  $valido = false;
  
  include 'pro_input.php';
  
  if (!empty($_POST)) {
    $id_sesion = $_POST['dato'];

    include 'conn.php';
    $connection = Connection::getInstance();

    $fecha = $duracion = $tema = $modalidad = "";
    if (!empty($_POST['fs_1'])){ $fecha= verifica($_POST['fs_1']); }
    if (!empty($_POST['ds_1'])) { $duracion = verifica($_POST['ds_1']); }
    if (!empty($_POST['ts_1'])) { $tema = verifica($_POST['ts_1']); }
    if (!empty($_POST['ms_1'])){ $modalidad= verifica($_POST['ms_1']); } 
        
    if( (!empty($_POST['fs_1'])) && (!empty($_POST['ts_1']))  ){ 
      $query_up = "UPDATE ges_tutoria_grupal_2 SET fecha = ?, horas = ?, temas = ?, modalidad = ? WHERE (idges_tutoria_grupal_2 = ? and num_eco = ?);";
      $stmt_up  = $connection->prepare($query_up);
      $total_up = $stmt_up->execute(array( $fecha, $duracion, $tema, $modalidad, $id_sesion, $usuario));
    }

  }


  if($total_up > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  echo json_encode($response);

?>