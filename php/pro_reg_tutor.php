<?php
  session_start(); 
  $total=0;
  $ip_nav = $_SERVER['HTTP_USER_AGENT'] ." ip:".$_SERVER['REMOTE_ADDR'];
  $total_ins = 0;
  $cod = "-";
  $envio_msj = 0;
  $msj_resp = "";

  if (!empty($_POST)) { /// 1

    $economicoError = null;
    $economico = $_POST['economico'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $nombre = $_POST['nom'];
    $correo = $_POST['correo'];
    $sexo = $_POST['radio5'];
    $estudios = $_POST['estudios'];
    $division = $_POST['division'];
    $dpto = $_POST['dpto'];
    $imparte = $_POST['imparte'];
    $num_tutoria = $_POST['num_tutoria'];

    ///  INSERT INTO ges_registro_tutor (nombre, ap, am, num_eco, estudios, division, depto, imparte, correo, num_tutorados, ip_nvgdr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    ///  echo $nombre." ".$ap." ".$am." ".$economico." ".$estudios." ".$division." ".$dpto." ".$imparte." ".$correo." ".$num_tutoria." ".$ip_nav;

    $valid = true;

    if (empty($economico)) {
      //$matriculaError = 'Debes ingresar tu matrícula';
      $valid = false;
      $msj_resp="Debes ingresar tu número economico";
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
      $query_exi = "SELECT idges_registro_tutor, nombre, num_eco, correo, estado_tutor FROM ges_registro_tutor WHERE num_eco= ?;";

      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($economico));
      $total=$stmt_exi->rowCount();
      
      //echo 'total: '.$total;
      ///echo 'INSERT INTO ges_registro_tutor (nombre, ap, am, num_eco, estudios, division, depto, imparte, correo, num_tutorados, ip_nvgdr) VALUES ($nombre, $ap, $am, $economico, $estudios, $division, $dpto, $imparte, $correo, $num_tutoria, $ip_nav);';

      if($total == 0){
        $query_ins = "INSERT INTO ges_registro_tutor (nombre, ap, am, sexo, num_eco, estudios, division, depto, imparte, correo, num_tutorados, ip_nvgdr) VALUES (?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt_ins  = $connection->prepare($query_ins);
        $stmt_ins->execute(array($nombre, $ap, $am, $sexo, $economico, $estudios, $division, $dpto, $imparte, $correo, $num_tutoria, $ip_nav));
        $last_id   = $connection->lastInsertId();  ///último id insertado
        $id_tutor  = $last_id;
        $total_ins = $stmt_ins->rowCount();

        /// echo 'total_ins: '.$total_ins;
        $cod =  genera_codigo($last_id);

        $query_activa = "UPDATE ges_registro_tutor SET codigo = ?  WHERE (idges_registro_tutor = ? );";
        $stmt_activa = $connection->prepare($query_activa);
        $stmt_activa->execute(array($cod, $last_id));
        $total_act=$stmt_activa->rowCount();

        if($total_act > 0){ /// if total_act 0 actualizar

          $envio_msj = envia_enlace_tutor($nombre,$correo, $last_id, $cod); ////// #### ACTIVAR #### ////
          /////$envio_msj = '1'; ////// #### QUITAR #### ////
          if ($envio_msj == '1') {
            /////echo "Te informamos que tus datos de registro se han almacenado correctamente. Para  generar el <b>informe de tutoría</b>, por favor, haz clic en <a href='../login.php'>aquí</a> para iniciar sesión<b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";

            ///// ***** susutituir  **** 
            echo "Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
            //$msj_resp="Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
          }else{
            //$msj_resp = "Algo Fallo, por favor asegurate de ingresar correctamente tu matrícula";
            echo "<p class='alert alert-danger'>No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos</p>";
          }

        }else{  ///if total_act 0
           echo "<p class='alert alert-danger'>No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos</p>";

        } ///if total_act 0 actualizar


      }else{ ///if total 0

        while ($row = $stmt_exi->fetch()){
          $id_tutor = utf8_encode("{$row['idges_registro_tutor']}");
          $nombre = utf8_encode("{$row['nombre']}");
          //$ap =utf8_encode("{$row['ap']}");
          //$am =utf8_encode("{$row['am']}");
          $num_eco = utf8_encode("{$row['num_eco']}");
          $cod = utf8_encode("{$row['codigo']}");
          $estado = utf8_encode("{$row['estado_tutor']}");
        }

        if($estado == "0"){
          //// correo enviado con enlace 
          ////### ENVIAR CORREO ####
          $envio_msj = envia_enlace_tutor($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
        }
        else if($estado == "1"){
          ///echo "cuenta activada";
          ////### ENVIAR CORREO CON USUARIO ####
          $envio_msj = envia_enlace_tutor($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para  generar el <b>informe de tutoría</b>, por favor, haz clic en <a href='../login.php'>aquí</a> para iniciar sesión. Utiliza tu correo institucional como usuario y tu número económico como contraseña.  <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus respuestas.</b>";
          
        }else{
          echo "No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos ";
        }


      } ///if total 0


    } ////valid  /* */

  }/// 1




        /* $cod =  genera_codigo($last_id);

        $query_activa = "UPDATE ges_registro_tutor SET codigo = ?  WHERE (idges_registro_tutor = ? );";
        $stmt_activa = $connection->prepare($query_activa);
        $stmt_activa->execute(array($cod, $last_id));
        $total_act=$stmt_activa->rowCount();

        if($total_act > 0){

         ///////// $envio_msj = envia_enlace($nombre,$correo, $last_id, $cod); ////// #### ACTIVAR #### ////
          $envio_msj = '1'; ////// #### QUITAR #### ////
          if ($envio_msj == '1') {
            echo "Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
            //$msj_resp="Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
          }else{
            //$msj_resp = "Algo Fallo, por favor asegurate de ingresar correctamente tu matrícula";
            echo "<p class='alert alert-danger'>No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos</p>";
          }
        
      }else{ ///if total 0

        while ($row = $stmt_exi->fetch()){
          $id_tutor = utf8_encode("{$row['idges_registro_tutor']}");
          $nombre = utf8_encode("{$row['nombre']}");
          //$ap =utf8_encode("{$row['ap']}");
          //$am =utf8_encode("{$row['am']}");
          $num_eco = utf8_encode("{$row['num_eco']}");
          $cod = utf8_encode("{$row['codigo']}");
          $estado = utf8_encode("{$row['estado_tutor']}");
        }

        if($estado == "0"){
          //// correo enviado con enlace 
          ////### ENVIAR CORREO ####
          ///////// $envio_msj = envia_enlace($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para activar tu cuenta, por favor, dirígete a tu correo institucional y haz clic en el enlace que acabamos de enviarte. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus comentarios.</b>";
        }
        else if($estado == "1"){
          ///echo "cuenta activada";
          ////### ENVIAR CORREO CON USUARIO ####
          ///////// $envio_msj = envia_enlace($nombre,$correo, $id_alu, $cod); ////// #### ACTIVAR #### ////
          echo "Te informamos que tus datos de registro se han almacenado correctamente. Para  generar el <b>reporte de tutoría</b>, por favor, haz clic en <a href='../login.php'>aquí</a> para iniciar sesión con los datos que acabamos de enviarte a tu correo institucional. Si no encuentras nuestro mensaje en la bandeja de entrada, te sugerimos revisar la carpeta de Spam. <br><br><b style='text-align: center; color: #007FB6!important;'>Agradecemos tu participación y quedamos atentos a tus respuestas.</b>";
        }else{
          echo "No fue posible prosesar tu información, por favor asegurate de ingresar correctamente tus datos ";
        }

*/

      

?>