 <?php
 session_start(); 
 $dir=0;

  if (!empty($_POST)) { /// 1

    $matriculaError = null;
    $matricula = $_POST['matricula'];
   // $recaptcha = $_POST['response'];

    $captcha_response = true;
    $recaptcha = $_POST['response'];
 
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
        echo '<p class="alert alert-success">Procesar datos...</p>';
    } else {
        echo '<p class="alert alert-danger">Debes indicar que no eres un robot.';
        echo 're: '.$recaptcha;
        echo 're 2: '.$captcha_response;
    }



/* 
2
    $secretKey  = '6LdtFtEnAAAAAGpSzTlEBiZHcQPleVR74Tw0rc7u';
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
 
      // Verify the reCAPTCHA API response 
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
       
      // Decode JSON data of API response 
      $responseData = json_decode($verifyResponse); 
       
      // If the reCAPTCHA API response is valid 
      if($responseData->success){

        echo "ok*2";
      }else{
        echo "Eres un robot!*2";
      }
    }

*/

    

/*
    if ($valid) {
      
      include 'conn.php'; 
      $connection = Connection::getInstance();

      $query_exi = "SELECT matricula, nombre, correo FROM estudiantes WHERE matricula= ?;";
      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($matricula));
      $dir=$stmt_exi->rowCount();

      //echo $dir;
      

      if($dir > 0){
        while ($row = $stmt_exi->fetch()){
          $nombre =utf8_encode("{$row['nombre']}");
          //$ap =utf8_encode("{$row['ap']}");
          //$am =utf8_encode("{$row['am']}");
          $correo =utf8_encode("{$row['correo']}");
        }

      } 
    }
    */

/*

  if($dir == "0"){ //// NO EXISTE EN EL PADRóN LA MATRíCULA
    //echo '<script>swal("Datos no encontrados en padrón de becas","Manda a formulario", "warning");</script>';
    $_SESSION["matri_tutoria"] = $matricula;
    /// echo "ok";
    echo '<script>location.href = "estudiante/entrevista_2.php"</script>';

  }if($dir > 0){  //// SI EXISTE LA MATRICULA 

    $_SESSION["matri_tutoria"] = $matricula;
    $_SESSION["nombre"] = $nombre;  
    /////$_SESSION["ap"] = $ap;
    /// $_SESSION["am"] = $am;
    $_SESSION["correo"] = $correo; 
    echo '<script>location.href = "estudiante/entrevista_1.php"</script>';

  }if($dir=="matri"){
    echo '<script>swal("","Por favor asegúrate de ingresar correctamente tu matrícula", "error");</script>';
  } 
  */

} /// 1
 

?>