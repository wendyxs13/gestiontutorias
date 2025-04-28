<?php

session_start();
if(isset($_SESSION['us_tutor_ad'])){
    $usuario=($_SESSION['us_tutor_ad']);
    $nombre_tutor=($_SESSION['nombre_ad']);
    $email =($_SESSION['us_correo_ad']);
    $_SESSION['us_tutor_ad']=$usuario;
    $_SESSION['nombre_ad']=$nombre_tutor;
    $_SESSION["us_correo_ad"] = $email;

    ///consultar a la BD trimestre actual
    ///$trim_actual = "24-O";

    include '../../php/conn.php';
    $pdo = Connection::getInstance();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = " select * from cat_trimestre ORDER BY idcat_trimestre DESC LIMIT 1;;";
    $q = $pdo->prepare($sql);
    $q->execute();
    $total=$q->rowCount();
    if($total > 0){
      while ($row = $q->fetch()) {
        $trim_actual = "{$row['trimestre']}";
      }
    }
    $anio = date("y"); //$anio_sig = date("y")+1; 
    $parts = explode("-", $trim_actual);
    $trim_part = $parts[1]; 
    $trim_sig = "";

    if ($trim_part === "I") {
      $trim_sig = $anio."-P";
    } elseif ($trim_part === "P") {
      $trim_sig = $anio."-O";
    } elseif ($trim_part === "O") {
        ///$trim_sig = $anio_sig."-I";
      $trim_sig = $anio."-I";
    } else {
      $trim_sig = "No es posible definir nuevo trimestre"; 
    }

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../../css/bootstrap.min.css" >
<!--     <link rel="stylesheet" href="css/bootstrap.min.css" >   --> 
    <link rel="stylesheet" href="../../css/estilo.css" >  
    <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>

    <script src="../../js/jquery-3.5.1.js" ></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="../../js/fun_consulta.js"></script> 
    <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>

    <style type="text/css">
      tbody tr:nth-child(2n+1) {
        background-color: #fff !important;
      }
    </style>

  </head>
  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top backBlue1" >
        <div class="container">
          <a class="navbar-brand" href="">
            <img class="img-fluid" src="../../img/logo.png" alt="">
          </a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto smooth-scroll ">
              <li class="nav-item">
                <a class="nav-link" href="">Coordinación de Desarrollo Educativo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
            </ul>
          </div>
        </div>
    </nav> 
    <!-- Navigation -->

    <div class="container"  style="padding-top: 5vh; min-height: 82vh; ">

      <div class="row mt-5">
        <div class="col-md-12 mt-2">
          <!-- <h2>Página principal</h2> -->
        </div>
      </div>

      <div class="row mt-0  justify-content-around">
          <div class="col-md-11 mt-2 mb-2 p-3 pt-2 pl-5 pr-5 shadow rounded" style="min-height: 75vh;">
            <div class="row m-2 p-2 d-flex justify-content-between">
              <h3><b style="color: #1C499A; text-transform: uppercase;">Nuevo trimestre</b></h3>
              <a href="index.php"><button type="button" class="btn btn-primary btn_10 pl-3 pr-4" ><img class="img-fluid mr-2 mb-1" src="../../img/home_01.png" alt="">Inicio</button></a>
            </div>

            <div class="ml-4">
              <h5><b>Instrucciones:</b></h5>
              <ol>
                <li>Selecciona el nuevo trimestre</li>
                <li>Ingresa la fecha de inicio y finalización</li>
                <li>Verifica que la información ingresada sea correcta</li>
                <li>Haz clic en el botón "Enviar"</li>
              </ol>

            </div>

            <div id="respuesta">
              <form class="border p-4" style="max-width: 400px; margin: auto;">
                <div class="form-group">
                    <label for="sig"><b>Trimestre:</b></label>
                      <select name="sig" id="sig" class="custom-select " required="">
                        <option value="">Seleccione una opción</option>
                        <option value="<?php echo $trim_sig ?>"><?php echo $trim_sig; ?></option>
                      </select>
                </div>

                <div class="form-group">
                    <label for="matri"><b>Inicia:</b></label>
                    <input type="date" class="form-control" id="inicio" name="inicio" placeholder="Fecha de inicio">
                </div>
                <div class="form-group">
                    <label for="matri"><b>Termina:</b></label>
                    <input type="date" class="form-control" id="fin" name="fin" placeholder="Fecha de termino">
                    <input type="hidden"  id="actual" name="actual" value="<?php echo $trim_actual; ?>" >
                </div>

                <div class="form-group text-center">
                  <button type="button" class="btn btn-primary btn_10 pl-3 pr-4" onclick="add_trim();" >
                    <img class="img-fluid mr-2 mb-1" src="../../img/buscar.png" alt="">Enviar
                  </button>
                </div>

                <p class="text-justify"><b>Nota:</b> El trimestre estará disponible únicamente en el módulo de administración. Para habilitarlo en el módulo de tutores, es necesario activarlo a través de la opción "Editar trimestre". </p>

              </form>
            </div>

          </div>
        </div>
      </div>
    </div>

    <footer class="py-5 bg-primary mt-2 backBlue1" style="min-height: 10vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>

  <script src="../../js/add_trim.js"></script>
    
</html>

<?php 
}else{ 
  header("location:../../login.php"); 
}
?>
