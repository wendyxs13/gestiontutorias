<?php
  session_start(); 
  $total=0;
  $ip_nav = $_SERVER['HTTP_USER_AGENT'] ." ip:".$_SERVER['REMOTE_ADDR'];
  $total_ins = 0;
  $cod = "-";
  $envio_msj = 0;
  $msj_resp = "";
  $estudiante_tutor = '0';

  if (!empty($_POST)) { /// 1

    $matriculaError = null;
    $matricula = $_POST['matricula'];
    $correo = $_POST['correo'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $nombre = $_POST['nom'];
    $trim = "24-P";
    $valid = true;
    

    if (empty($matricula)) {
      //$matriculaError = 'Debes ingresar tu matrícula';
      $valid = false;
      $msj_resp="Debes ingresar tu matrícula";
    }
    
    $captcha_response = true;
    $recaptcha = $_POST['g-recaptcha-response'];
 
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6LdtFtEnAAAAAGpSzTlEBiZHcQPleVR74Tw0rc7u',
        'response' => $recaptcha
    );
    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);
    $captcha_response = $captcha_success->success;
 
    if ($captcha_response) {
        ///echo '<p class="alert alert-success">ok</p>'; ////// #### ACTIVAR #### ////
    } else {
       // echo '<p class="alert alert-danger">Eres un robot.';  ////// #### ACTIVAR #### ////
    }

    if ($valid) {
      include 'conn.php'; 
      include 'pro_correo.php'; 
      $connection = Connection::getInstance();
      
      /////$query_exi = "SELECT idges_registro_alu, nombre, matri_alu, correo, estado, codigo FROM ges_registro_alu WHERE matri_alu= ?;";

      $sql_trim = " select * from cat_trimestre ORDER BY idcat_trimestre DESC LIMIT 1;";
      $q = $connection->prepare($sql_trim);
      $q->execute();
      $total_trim=$q->rowCount();
      if($total_trim > 0){
        while ($row = $q->fetch()) {
          $trim = "{$row['trimestre']}";
        }
      }


      $query_exi = "SELECT idges_registro_alu, nombre, matri_alu, correo, estado, codigo, matricula as est_tut FROM ges_registro_alu LEFT join estudiante_tutor on ges_registro_alu.matri_alu=estudiante_tutor.matricula WHERE matri_alu= ?;";

      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($matricula));
      $total=$stmt_exi->rowCount();

      if ( ($total == 0 ) || ($estudiante_tutor == NULL) ){
        $query_ins2 = "INSERT INTO estudiante_tutor (matricula, trimestre, no_eco, status_estudiante) VALUES (?, ?, '1', '2');";
        $stmt_ins2  = $connection->prepare($query_ins2);
        $stmt_ins2->execute(array($matricula, $trim));
        $total_ins2 = $stmt_ins2->rowCount();
      }

      if($total > 0){
        while ($row = $stmt_exi->fetch()){
          $id_alu =utf8_encode("{$row['idges_registro_alu']}");
          $nombre =utf8_encode("{$row['nombre']}");
          //$ap =utf8_encode("{$row['ap']}");
          //$am =utf8_encode("{$row['am']}");
          $matricula =utf8_encode("{$row['matricula']}");
          $cod = ("{$row['codigo']}");
          $estado =utf8_encode("{$row['estado']}");
          $estudiante_tutor = ("{$row['est_tut']}");
        }

        if($estado == "1"){
          //// correo enviado con enlace 
          ////### ENVIAR CORREO ####
          $envio_msj = envia_enlace($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para contestar el formulario de información inicial, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus respuestas.</b>";
        }

        else if($estado == "2"){
          ////### ENVIAR CORREO ####
          $envio_msj = envia_enlace($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para contestar el formulario de información inicial, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus respuestas.</b>";
        }
        else if($estado == "3"){
          echo "Te informamos que tus datos de la entrevista inicial se han almacenado correctamente. <br><br><b style='text-align: center; color: #007FB6!important;'>¡Muchas gracias por tu participación!</b>";
        }

      }else if($total == 0){

        $query_ins = "INSERT INTO ges_registro_alu (nombre, ap, am, matri_alu, correo, ip_nvgdr) VALUES (?, ?, ?, ?, ?, ?);";

        $stmt_ins  = $connection->prepare($query_ins);
        $stmt_ins->execute(array($nombre, $ap, $am, $matricula, $correo, $ip_nav));
        $last_id   = $connection->lastInsertId();  ///último id insertado
        $total_ins = $stmt_ins->rowCount();
        $cod =  genera_codigo($last_id);

        $query_activa = "UPDATE ges_registro_alu SET estado ='1', codigo = ?  WHERE (idges_registro_alu = ? );";
        $stmt_activa = $connection->prepare($query_activa);
        $stmt_activa->execute(array($cod, $last_id));
        $total_act=$stmt_activa->rowCount();

        if($total_act > 0){
          $envio_msj = envia_enlace($nombre,$correo, $last_id, $cod); ////// #### ACTIVAR #### ////
          
          if ($envio_msj == '1') {

            echo "Te informamos que tus datos de registro se han almacenado correctamente. Para contestar el formulario de información inicial, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus respuestas.</b><br><br>";
            
          }else{
            
            echo "<p class='alert alert-danger'>No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tu matrícula</p>";
          }
        }
      } 
    }


} /// 1
 

?>