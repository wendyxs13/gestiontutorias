<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
    $_SESSION['us_tutor']=$usuario;
    $_SESSION['nombre']=$nombre_tutor;
    $_SESSION["us_correo"] = $email;

    
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../css/estilo.css" >  
    <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.5.1.js" ></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="../../js/fun_consulta.js"></script> 
    <script src="../../js/fun_info_inicial.js"></script> 
    <script src="../../js/fun_avance.js"></script> 
    <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>
  </head>

    <style type="text/css">
      tbody tr:nth-child(2n+1) {
        background-color: #fff !important;
      }
      h1, h2, h3, h4{
        font-family: Roboto,Helvetica,Arial,sans-serif;
        color: #333!important;

      }

      .btn_reporte{
        line-height: 24px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 500;
        min-width: 150px;
        text-align: center;
        color: #555;
        transition: all .3s;
        border-radius: 4px;
        padding: 10px 15px;
      }

      .btn_reporte:hover{
        color: #fff!important;
        background-color: #007FB6;
        box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(0, 127, 182, 1);
      }

      .nav-link:hover{
        color: #fff!important;
      }

      .nav-item:hover{
         color: #fff!important;
      }

      .nav-pills .nav-item i {
        display: block;
        font-size: 30px;
        padding: 15px 0;
      }

      a .material-icons {
          vertical-align: middle;
      }

      .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
      }

      .nav-pills .nav-item .nav-link.active {
        color: #fff;
        background-color: #007FB6;
        box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(0, 127, 182, 1);
      }

      .nav-pills .nav-item .nav-link {
        line-height: 24px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 600;
        min-width: 150px;
        text-align: center;
        color: #555;
        transition: all .3s;
        border-radius: 30px;
        padding: 10px 15px;
      }

      .nav-pills.nav-pills-icons .nav-item .nav-link {
        border-radius: 4px;
      }

      .text_sup_01 {
        color: #424656;
        font-size: 12px;
        
      }

      span .material-icons{
        vertical-align: middle;
      }

    </style>

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
    <div class="container"  style="padding-top: 10vh; color: #002772; ">
        <div class="row mt-1">
          <div class="col-md-12 mt-0">
          </div>
        </div>
        <div class="row mt-0  justify-content-around"style="min-height: 75vh;color: #002772; ">

          <div class="col-md-12 mt-1 mb-0 pl-5 pr-5 pt-2 shadow  rounded">

            <div class="row m-2 p-2 d-flex justify-content-end">
              <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
              <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
            </div>

            <div class="title mt-4" >
              <h3>Programa de tutorías</h3>
            </div>
            <hr>

            <section>
              <ul class="nav nav-pills nav-pills-icons" role="tablist">
              <?php
              $total = 0;

                include '../../php/conn.php';
                $pdo = Connection::getInstance();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "SELECT * from cat_trimestre where disponible = '1' ;";
                $q = $pdo->prepare($sql);
                $q->execute();
                $total=$q->rowCount(); 

           

                if($total > 0){
                  while ($row = $q->fetch()) {
                    $trimestre = "{$row['trimestre']}";
                  
                  ?>
                  <li class="nav-item btn_reporte">
                    <a class="nav-link" href="index_trim.php?x=<?php echo urlencode(base64_encode($trimestre)); ?>" >
                      <i class="material-icons">calendar_month</i>
                      TRIMESTRE <?php echo $trimestre; ?>
                    </a>
                  </li>
                  <?php
                  }
                }
                
              ?>
              </ul>
            </section>

          </div>
        </div>
    </div>
    
    <footer class="py-5 bg-primary mt-3 backBlue1" style="min-height: 10vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2024</p>
      </div>
    </footer> 

  </body>
    <script >
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
</html>
<?php 
}else{ 
  header("location:../../login.php"); 
}
?>