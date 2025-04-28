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
            <link rel="stylesheet" href="../../css/estilo_tabla.css" >   
            <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
            <title>Tutorías UAM-X</title>
        </head>

        <style type="text/css">
           /* tbody tr:nth-child(2n+1) {
                background-color: #fff !important;
            } */
            .text_sup_01 {
                color: #424656;
                font-size: 12px;
                
            }

            span .material-icons{
                vertical-align: middle;
            }

            /*tbody tr:nth-child(2n+1) {
                background-color: #fff !important;
            }*/
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
            <div class="container"   style="padding-top: 10vh; color: #002772; ">
                <div class="row mt-0">
                    <div class="col-md-12 mt-2">
                    </div>
                </div>
                <div class="row mt-0  justify-content-around"style="min-height: 63vh;color: #002772; ">

                    <?php
                    
                    $query_exi = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap,  est.am as am, entrevista.sexo as sexo, entrevista.lic as lice,status_estudiante, cat_estatus.descripcion as estatus FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula left join cat_estatus_estudiante cat_estatus on cat_estatus.id_estatus_estudiante = est_tutor.status_estudiante where status_estudiante IN (2,6) and est_tutor.trimestre =? and  no_eco = ? ;";

                    $stmt_exi = $connection->prepare($query_exi);
                    $stmt_exi->execute(array($trim,$usuario));
                    $dir = $stmt_exi->rowCount();
                    ?>
                    
                    <div class="col-md-12 mt-0 mb-0 pl-5 pr-5 pt-2 pb-5 bg-white  rounded">
                        <div class="row m-2 p-2 d-flex justify-content-end">
                          <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
                          <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
                        </div>

                        <div class="title mt-2" >
                          <h3>
                            Programa de tutorías
                          </h3>
                          <span class="text_sup_01"><a href="index.php" class="text_sup_01"><i class="material-icons">home</i>Inicio</a></span> / 
                          <span class="text_sup_01"><i class="material-icons">calendar_month</i>Trimestre <?php echo $trim; ?></span>
                        </div>
                        <hr>


                        <div class="row mt-4">

                            <div class="col-md-4">
                                <div class="card pt-3 pb-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-md-2 text-center mt-2">
                                        <i class="material-icons size_font_52">groups</i>
                                      </div>
                                      <div class="col-md-8 ml-2 mt-3">
                                        <small class="text-uppercase" style="font-size:120%;"><b><?php echo $dir; ?> </b></small><br>
                                        <small class="text-uppercase"> Estudiante(s) asignado(s) </small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div> 

                            
                            

                            <div class="col-md-4" >

                               <!-- <button type="button" class="btn btn-primary btn_12"  style="font-size: 14px!important;" data-toggle="modal" data-target="#avance_01" onclick="avance_grupal();" >
                                <img class="img-fluid mr-2" style="max-width: 36px; height: auto;" src="../../img/icono_grupo.png" alt="">Informe grupal
                            </button>  --> 


                                <div class="card pt-3 pb-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-md-2 text-center mt-2">
                                        <i class="material-icons size_font_52">assessment</i>
                                      </div>
                                      <div class="col-md-8 ml-2">
                                        <small class="text-uppercase"><b>INFORME GRUPAL</b></small><br>
                                        <small class="ml-3" ><a href="form_grupal_secc.php?x=<?php echo $trim_codi; ?>" class=" text-primary" >Generar/Editar</a></small><br>
                                        <small class="ml-3 text-primary btn-link" style="cursor:pointer;" onclick="avance_grupal();" >Descargar</small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div> 

                            <div class="col-md-4" onclick="busca_constancia();" style="cursor: pointer;">
                                <div class="card pt-3 pb-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-md-2 text-center mt-2">
                                        <i class="material-icons size_font_52">workspace_premium</i>
                                      </div>
                                      <div class="col-md-8 ml-2 mt-3">
                                        <small class="text-uppercase"><b>OBTENER CONSTANCIA</b></small>
                                        <h3 class="font_total mb-0"></h3><small></small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div> 

                        </div>

                        <div class="row m-2 pt-2 pb-2 pr-5 d-flex justify-content-between">
                            <!-- <span class="texto_01">
                                <b>Total de estudiantes: <?php echo $dir; ?></b>
                            </span> -->
                            <!-- <button type="button" class="btn btn-primary btn_12"  style="font-size: 14px!important;" data-toggle="modal" data-target="#avance_01" onclick="avance_grupal();" >
                                <img class="img-fluid mr-2" style="max-width: 36px; height: auto;" src="../../img/icono_grupo.png" alt="">Informe grupal
                            </button>   -->   

                        </div>

                        
                        <div id="listaEstudiantes" class="table-container">
                            <table class="styled-table">
                                <thead>
                                    <tr>                  
                                        <th scope="col" width="30%" class="text-left text-uppercase">Nombre</th>
                                        
                                        <th scope="col" width="5%" class="text-uppercase" data-toggle="tooltip" data-placement="top" title="Sexo asignado al nacer">
                                            Sexo al nacer
                                        </th>
                                        <th scope="col" width="30%" class="text-uppercase"> Licenciatura</th>
                                        <th scope="col" width="25%" class="text-uppercase">Informe individual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($dir > 0) {
                                        while ($row = $stmt_exi->fetch()) {
                                            $badgeClass = 'badge-success';
                                            $matricula = "{$row['matri']}";
                                            $nombre = "{$row['nombre']}";
                                            $ap = "{$row['ap']}";
                                            $am = "{$row['am']}";
                                            $estatus = "{$row['estatus']}";
                                            $sexo = "{$row['sexo']}";
                                            $lic = "{$row['lice']}";
                                            if($estatus != "Activa/o"){ $badgeClass = 'badge-warning'; }
                                            ?>
                                            <tr>
                                                <td class="text-left">
                                                    

                                                    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="ver_info_ini(<?php echo $matricula; ?>);">
                                                        <?php echo $nombre." ".$ap." ".$am; ?>
                                                    </a><br>
                                                    
                                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo $estatus; ?></span>
                                                </td>
                                                
                                                <td><?php echo $sexo; ?></td>
                                                <td><?php echo $lic; ?></td>
                                                <td>
                                                    <span class="badge badge-info btn-generar" onclick="avance_ind(<?php echo $matricula; ?>);"><i class="material-icons" style="font-size:25px; " data-toggle="tooltip" data-placement="top" title="Generar o editar el informe individual" >edit_note</i> </span>

                                                    <!-- <span class="badge badge-info btn-editar" onclick="avance_ind(<?php echo $matricula; ?>);"><i class="material-icons" style="font-size:25px;" data-toggle="tooltip" data-placement="top" title="Editar informe individual">edit_note</i> </span> -->

                                                    <span class="badge badge-info btn-descargar" onclick="descargar_ind(<?php echo $matricula; ?>);"><i class="material-icons" style="font-size:25px;" data-toggle="tooltip" data-placement="top" title="Descargar informe individual">assignment_returned</i> </span>
                                                   
                                                    <!-- <button type="button" class="btn btn-primary btn-action" data-toggle="modal" data-target="#avance_01" onclick="avance_ind(<?php /// echo $matricula; ?>);" >
                                                        <span><i class="material-icons">assignment</i>
                                                        Informe individual</span>
                                                    </button> -->
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
                        <div class="modal-body pl-4 pr-4">
                            <div class="pl-4 pr-4" id="resp_avance">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 2 -->

            <!-- modal 3 -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="constancia" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="material-icons size_font_52">workspace_premium</i> <span class="encabezado1 text-uppercase" style="margin-top: 10px;"><b>Descargar constancia</b></span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-4 pr-4">
                            <div class="pl-4 pr-4" id="resp_constancia">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 3 -->

            <!-- modal 4 -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_quita" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="material-icons size_font_52">group_remove</i> <span class="encabezado1 text-uppercase" style="margin-top: 10px;">&nbsp;&nbsp;<b>Quitar estudiante</b></span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-4 pr-4">
                            
                            <div class="p-4" id="resp_quitar">
                                <p>¿Estás seguro que deseas quitar a <b id="nombreEstudiante"></b> de la lista de estudiantes asignados?</p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info text-uppercase" id="confirmarQuitar"><small> <b>Quitar</b></small></button>
                            <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal"><small><b>Cancelar</b></small></button>
                          </div>
                    </div>
                </div>
            </div>
            <!-- modal 4 -->


            <footer class="py-5 bg-primary mt-4 backBlue1" style="min-height: 13vh;">
                <div class="container">
                    <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / <?php echo date("Y"); ?></p>
                </div>
            </footer> 

        </body>
        
        <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
        <script src="../../js/jquery-3.5.1.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>
        <script src="../../js/sweetalert.min.js"></script>
        
        <script src="../../js/fun_consulta.js"></script> 
        <script src="../../js/fun_info_inicial.js"></script> 
        <script src="../../js/fun_avance.js"></script> 
        <script >
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        
    </html>
    <?php
} else {
    header("location:../../login.php");
}