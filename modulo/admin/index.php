<?php
session_start();
if(isset($_SESSION['us_tutor_ad'])){
    $usuario=($_SESSION['us_tutor_ad']);
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

      .breadcrumb{
        padding: 0.25rem 0.1rem!important;
        margin-bottom: .25rem!important;
        background-color: transparent!important;
      }

      .card{
        border:none;
        color: #6c757d !important;
        background-color: #F8F8F8;
      }

      .size_font_16{
        font-size: 16px!important;
        /*color: #00BCD4 !important;*/
        margin-right: 5px;
        line-height: 1.7!important;
      }

      .size_font_52{
        font-size: 52px;
        /* color: #5EC9ED !important; */
        color: #00BCD4 !important;
      }

      .font_total{
        color: #00407F!important;
      }

      body{
        background-color:#F2F5F8 !important;
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
        <div class="row mt-0  justify-content-around"style="min-height: 63vh;color: #002772; ">
          <div class="col-md-12 mt-1 mb-0 pl-5 pr-5 pt-2 pb-5 bg-white  rounded">
            <div class="row mt-3">
              <div class="col-md-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><i class="material-icons size_font_16">home</i>Inicio</li>
                  </ol>
                </nav>
              </div> 
              <div class="col-md-6 text-right">
                <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span>
              </div>
            </div>

            <?php
              $total1 = $total2 = $tutores = $estudiantes = 0;
              include '../../php/conn.php';
              $pdo = Connection::getInstance();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sql1 = "SELECT (SELECT COUNT(*) FROM ges_registro_tutor where num_eco != '1' and num_eco != 'xochito2024') AS tutores, (SELECT COUNT(*) FROM ges_registro_alu) AS estudiantes;";  
              $q1 = $pdo->prepare($sql1);
              $q1->execute();
              $total1=$q1->rowCount(); 

              if($total1 > 0){
                while ($row1 = $q1->fetch()) {
                  $tutores = "{$row1['tutores']}";
                  $estudiantes = "{$row1['estudiantes']}";
                }
              }
                
            ?>

            <div class="row mt-4">
              <div class="col-md-6">
                <div class="card pt-3 pb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2 text-center mt-2">
                        <i class="material-icons size_font_52">people_alt</i>
                      </div>
                      <div class="col-md-8 ml-2">
                        <h3 class="font_total mb-0"><?php echo $tutores; ?></h3><small class="text-uppercase">Tutores</small>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

              <div class="col-md-6">
                <div class="card pt-3 pb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2 text-center mt-2">
                        <i class="material-icons size_font_52">groups</i>
                      </div>
                      <div class="col-md-8 ml-2">
                        <h3 class="font_total mb-0"><?php echo $estudiantes; ?></h3><small class="text-uppercase">Estudiantes</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
      
            </div>

            <div class="row">
              <div class="col-md-12 mt-5">
                <div class="title">
                  <h3>Gestión de tutores y estudiantes</h3>
                  <hr>
                </div>
              </div>              
            </div>

            <br><br>

            <section>
              <ul class="nav nav-pills nav-pills-icons" role="tablist">
                <!-- <li class="nav-item">
                  <a class="nav-link active show" href="#dashboard-1" role="tab" data-toggle="tab" aria-selected="true">
                    <i class="material-icons">contacts</i>
                    Entrevista inicial
                  </a>
                </li> -->
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="cambio_tutor.php" >
                    <i class="material-icons">workspaces_filled</i>
                    Cambio de tutor
                  </a>
                </li>
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="baja.php" >
                    <i class="material-icons">person_remove</i>
                    Actualización estatus <br>de estudiantes
                  </a>
                </li> 

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="add_trimestre.php" >
                    <i class="material-icons">date_range</i>
                     Agregar trimestre
                  </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="edit_trimestre.php" >
                    <i class="material-icons">edit_calendar</i>
                     Editar trimestre
                  </a>
                </li>

              </ul>

              <section>
                <ul class="nav nav-pills nav-pills-icons" role="tablist">

                  <li class="nav-item btn_reporte">
                    <a class="nav-link" href="busca_estudiante.php" >
                      <i class="material-icons">face_3</i>
                       Buscar estudiante
                    </a>
                  </li>

                  <li class="nav-item btn_reporte">
                    <a class="nav-link" href="busca_tutor.php" >
                      <i class="material-icons">face_4</i>
                       Buscar tutor
                    </a>
                  </li>

                </ul>


            </section>

            <div class="title mt-4">
              <h3>Informes</h3>
              <hr>
            </div>

            <section>
              <ul class="nav nav-pills nav-pills-icons" role="tablist">
                <!-- <li class="nav-item">
                  <a class="nav-link active show" href="#dashboard-1" role="tab" data-toggle="tab" aria-selected="true">
                    <i class="material-icons">contacts</i>
                    Entrevista inicial
                  </a>
                </li> -->
     

                <!-- <li class="nav-item">
                  <a class="nav-link" href="informes/info_inicial.php">
                    <i class="material-icons">save_alt</i>
                    Entrevista inicial
                  </a>
                </li>
 -->
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/info_individual.php">
                    <i class="material-icons">save_alt</i>
                    Individual
                  </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/info_grupal_01.php">
                    <i class="material-icons">save_alt</i>
                    Grupal parte 1
                  </a>
                </li>
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/info_grupal_02.php">
                    <i class="material-icons">save_alt</i>
                    Grupal parte 2
                  </a>
                </li>
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/info_grupal_03.php">
                    <i class="material-icons">save_alt</i>
                    Grupal parte 3
                  </a>
                </li>

              </ul>


            </section>

            <div class="title mt-4">
              <h3>Tutores con informes capturados por trimestre</h3>
              <hr>
            </div>

            <section>
              <ul class="nav nav-pills nav-pills-icons" role="tablist">
                
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_con_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('23-O')); ?>" >
                      <i class="material-icons">group</i>
                      Trimestre 23-O
                    </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_con_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-I')); ?>">
                    <i class="material-icons">group</i>
                    Trimestre 24-I
                  </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_con_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-P')); ?>">
                    <i class="material-icons">group</i>
                    Trimestre 24-P
                  </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_con_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-O')); ?>">
                    <i class="material-icons">group</i>
                    Trimestre 24-O
                  </a>
                </li>

              </ul>

            </section>
            <div class="title mt-4">
              <h3>Tutores con informes pendientes por trimestre</h3>
              <hr>
            </div>

            <section>
              <ul class="nav nav-pills nav-pills-icons" role="tablist">

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_sin_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('23-O')); ?>" >
                      <i class="material-icons">group_remove</i>
                      Trimestre 23-O
                    </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_sin_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-I')); ?>">
                    <i class="material-icons">group_remove</i>
                    Trimestre 24-I
                  </a>
                </li>

                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_sin_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-P')); ?>">
                    <i class="material-icons">group_remove</i>
                    Trimestre 24-P
                  </a>
                </li>
                <li class="nav-item btn_reporte">
                  <a class="nav-link" href="informes/tutores_sin_reporte_x_trim.php?x=<?php echo urlencode(base64_encode('24-O')); ?>">
                    <i class="material-icons">group_remove</i>
                    Trimestre 24-O
                  </a>
                </li>

              </ul>

            </section>
          
          </div>

        </div>

    </div>
    <!-- modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
         
          <div id="resp_inf_inicial">
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->

    <!-- modal 2 -->
    <div class="modal fade" tabindex="-1" id="avance_01" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content msj_01">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="resp_avance">
          </div>

        </div>
      </div>
    </div>
    <!-- modal 2 -->

    <footer class="py-5 bg-primary mt-3 backBlue1" style="min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2025</p>
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
