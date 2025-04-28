 <?php
 session_start();
 $total = 0;
 $id=0;
 $tipo = 0;

  if (!empty($_POST)) {

    $emailError = null;
    $passError = null;
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $valid = true;

    if (empty($email)) {
      $emailError = 'Debes ingresar tu cuenta de correo electrónico';
      $valid = false;
      $total="0";
    }

    if (empty($pass)) {
      $passError = 'Debes ingresar tu contraseña';
      $valid = false;
      $total="0";
    }

    if ($valid) {

      $pass_sha = hash('sha256', $pass);
      include 'conn.php';
      $connection = Connection::getInstance();

      $query_exi = "SELECT correo, num_eco, tipo_usuario, nombre, ap, am, division FROM ges_registro_tutor WHERE correo = ? and num_eco = ? ;";
      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($email,$pass));
      $total=$stmt_exi->rowCount();

      if($total > 0){
        while ($row = $stmt_exi->fetch()){
          $tipo = "{$row['tipo_usuario']}";
          $nom = "{$row['nombre']}";
          $ap = "{$row['ap']}";
          $am = "{$row['am']}";
          $eco = "{$row['num_eco']}";
          $div = "{$row['division']}";
        }
        $nombre = $nom." ".$ap." ".$am;
      } 

    }

  }

  if($total == "0"){
    echo '<script>swal("Datos incorrectos","Verifica ingresar correctamente tu correo electrónico y contraseña", "error");</script>';
  }else if($total > 0){

    switch ($tipo) {
    case 1:
        $_SESSION["nombre_ad"] = $nombre;
        $_SESSION["us_tutor_ad"] = $email;
        echo '<script>location.href = "modulo/admin"</script>';
        break;
    case 2:
        $_SESSION["nombre"] = $nombre;
        $_SESSION["us_correo"] = $email;
        $_SESSION["us_tutor"] = $eco;
        $_SESSION["div"] = $div;
        //echo '<script>location.href = "modulo/tutor/grupal.php"</script>';
        echo '<script>location.href = "modulo/tutor/index.php"</script>';
        break;
    case 3:
        $_SESSION["nombre"] = $nombre;
        $_SESSION["us_correo"] = $email;
        $_SESSION["us_tutor"] = $eco;
        $_SESSION["div"] = $div;
        //echo '<script>location.href = "modulo/tutor/individual.php"</script>';
        echo '<script>location.href = "modulo/tutor/index.php"</script>';
        break;
    case 4:
        $_SESSION["nombre"] = $nombre;
        $_SESSION["us_correo"] = $email;
        $_SESSION["us_tutor"] = $eco;
        $_SESSION["div"] = $div;
        //echo '<script>location.href = "modulo/tutor/ig.php"</script>';
        echo '<script>location.href = "modulo/tutor/index.php"</script>';
        break;
    default:
       echo '<script>swal("Datos incorrectos","Verifica ingresar correctamente tu correo electrónico y contraseña", "error");</script>';
    }

  }

?>