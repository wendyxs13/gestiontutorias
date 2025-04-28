<?php
session_start();
if (isset($_SESSION['us_tutor'])) {
    $usuario = ($_SESSION['us_tutor']);
    $nombre_tutor = ($_SESSION['nombre']);
    $email = ($_SESSION['us_correo']);
    $_SESSION['us_tutor'] = $usuario;
    $_SESSION['nombre'] = $nombre_tutor;
    $_SESSION["us_correo"] = $email;
    $_SESSION["matricula"] = "0";
    $_SESSION["nom_est"] = "";

    if (!isset($_GET['x'])) {
        header('Location: index.php');
        exit();
    }else{
        $trim_codi = $_GET['x'];
        $trim = base64_decode($trim_codi); 
        $trim = htmlspecialchars($trim);
    }


    include '../../php/conn.php';
    $connection = Connection::getInstance();
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
            <div class="container"  style="padding-top: 5vh; min-height: 82vh;color: #002772; ">
                <div class="row mt-5">
                    <div class="col-md-12 mt-2">
                    </div>
                </div>
                <div class="row mt-2  justify-content-around">

                    <?php
                    ///$query_exi = "SELECT id_estudiante as id_est, est.matricula as matri, est.nombre as nombre, entrevista.sexo as sexo,  entrevista.lic as lice FROM estudiante_tutor est_tutor LEFT join  estudiantes est on est.matricula=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matricula=entrevista.matricula where status_estudiante = 2 and est_tutor.trimestre =? and  no_eco = ? ;";

                    $query_exi = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap,  est.am as am, entrevista.sexo as sexo, entrevista.lic as lice FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where status_estudiante = 2 and est_tutor.trimestre =? and  no_eco = ? ;";

                    $stmt_exi = $connection->prepare($query_exi);
                    $stmt_exi->execute(array($trim,$usuario));
                    $dir = $stmt_exi->rowCount();
                    ?>
                    
                    <div class="col-md-11 mt-1 mb-2 pl-5 pr-5 pt-2 shadow  rounded">
                        <div class="row m-2 p-2 d-flex justify-content-end">
                          <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
                          <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
                        </div>

                        <div class="title mt-2" >
                          <h3>
                            Programa de tutorías
                          </h3>
                          <span class="text_sup_01"><a href="index.php" class="text_sup_01"><i class="material-icons">home</i>Inicio</a></span> / 
                          <span class="text_sup_01"><i class="material-icons">calendar_month</i>Trimestre 23-O</span>
                        </div>
                        <hr>

                        <div class="row m-2 pt-4 pb-2 pr-5 d-flex justify-content-between">
                            <span class="texto_01">
                                <b>Total de estudiantes: <?php echo $dir; ?></b>
                            </span>
                            <button type="button" class="btn btn-primary btn_12"  style="font-size: 14px!important;" data-toggle="modal" data-target="#avance_01" onclick="avance_grupal();" >
                                <img class="img-fluid mr-2" style="max-width: 36px; height: auto;" src="../../img/icono_grupo.png" alt="">Informe grupal
                            </button>                           
                        </div>
                        <table class="table" style="width:95%;">
                            <thead class="backBlue2">
                                <tr>                  
                                    <th scope="col" width="30%">Nombre</th>
                                    <th scope="col" width="15%" class="text-center">Sexo asignado al nacer</th>
                                    <th scope="col" width="30%"> Licenciatura</th>
                                    <th scope="col" width="25%" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($dir > 0) {
                                    while ($row = $stmt_exi->fetch()) {
                                        $matricula = "{$row['matri']}";
                                        $nombre = "{$row['nombre']}";
                                        $ap = "{$row['ap']}";
                                        $am = "{$row['am']}";
                                        $sexo = "{$row['sexo']}";
                                        $lic = "{$row['lice']}";
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="ver_info_ini(<?php echo $matricula; ?>);">
                                                    <?php echo $nombre." ".$ap." ".$am; ?>
                                                </a>
                                            </td>
                                            <td class="text-center"><?php echo $sexo; ?></td>
                                            <td><?php echo $lic; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn_11"  style="font-size: 12px!important;" data-toggle="modal" data-target="#avance_01" onclick="avance_ind(<?php echo $matricula; ?>);" >
                                                    <img class="img-fluid mr-2" style="max-width: 18px; height: auto;" src="../../img/icono_individual.png" alt="">Informe individual
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="avance_01" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
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
            <footer class="py-5 bg-primary mt-5 backBlue1" style="min-height: 13vh;">
                <div class="container">
                    <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
                </div>
            </footer> 

        </body>
        <script >
            $(document).ready(function () {
                //        $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </html>
    <?php
} else {
    header("location:../../login.php");
}