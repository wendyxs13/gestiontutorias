<?php
session_start();
if (isset($_SESSION['us_tutor'])) {
    $usuario = ($_SESSION['us_tutor']);
    $nombre_tutor = ($_SESSION['nombre']);
    $email = ($_SESSION['us_correo']);
    $_SESSION['us_tutor'] = $usuario;
    $_SESSION['nombre'] = $nombre_tutor;
    $_SESSION["us_correo"] = $email;

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
    $query_exi = "SELECT * FROM ges_registro_tutor where num_eco = ? ";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($usuario));
    $dir = $stmt_exi->rowCount();

    $sexo_f = $sexo_m = "";

    if ($dir > 0) {
        while ($row = $stmt_exi->fetch()) {
            $nom = "{$row['nombre']}";
            $ap = "{$row['ap']}";
            $am = "{$row['am']}";
            $sexo = "{$row['sexo']}";
            $estudios = "{$row['estudios']}";
            $division = "{$row['division']}";
            $id_depto = "{$row['depto']}";
            $imparte = "{$row['imparte']}";
        }

        if($sexo == "M"){
            $sexo_m = "checked";
        }if($sexo == "F"){
            $sexo_f = "checked";
        }
    }

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
            <script src="../../js/fun_datos_tutor.js"></script> 
           
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
            <div class="container"  style="padding-top: 10vh; min-height: 82vh;color: #002772; ">
                <div class="row mt-1">
                    <div class="col-md-12 mt-0">
                    </div>
                </div>
                <div class="row mt-2  justify-content-around">
                    
                    <div class="col-md-11 mt-1 mb-2 pl-5 pr-5 pt-2 pb-5 bg-white rounded">
                        <div class="row m-2 p-2 d-flex justify-content-end">
                          <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
                          <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
                        </div>

                        <div class="title mt-2" >
                          <h3>
                            Programa de tutorías
                          </h3>
                          <span class="text_sup_01"><a href="index.php" class="text_sup_01"><i class="material-icons">home</i>Inicio</a></span> / 
                          <span class="text_sup_01"><a href="index_trim.php?x=<?php echo $trim_codi; ?>" class="text_sup_01"><i class="material-icons">calendar_month</i>Trimestre <?php echo $trim; ?></a></span> / <span class="text_sup_01"><i class="material-icons">workspace_premium</i>Constancia</span>
                        </div>
                        <hr>

                        <div id="formulario1">
                            
                        </div>

                        <form id="form_datos_tutor" >
                          <!-- <h3 class="encabezado1 mb-4 text-center"><b>Actualización de información</b></h3> -->
                          <h5 class="mt-5 mb-5">
                              Antes de descargar tu constancia, completa el siguiente formulario. Esta información será utilizada para el seguimiento del proyecto, por lo que es importante que esté correcta y actualizada.
                          </h5>

                          <div class="form-group row ">
                            <label for="ap" class="col-md-3 col-form-label text-dark" ><b>Primer apellido:</b></label>
                            <div class="col-md-5" >
                              <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="<?php echo $ap; ?>">
                            </div>
                          </div>

                          <div class="form-group row ">
                            <label for="am" class="col-md-3 col-form-label text-dark" ><b>Segundo apellido:</b></label>
                            <div class="col-md-5" >
                              <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="<?php echo $am; ?>">
                            </div>
                          </div>
                            

                          <div class="form-group row ">
                            <label for="nom" class="col-md-3 col-form-label text-dark" ><b>Nombre:</b></label>
                            <div class="col-md-5" >
                              <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="<?php echo $nom; ?>">
                            </div>
                          </div>

                          <div class="form-group row ">
                            <label for="radio5" class="col-md-3 col-form-label text-dark"><b>Sexo asignado al nacer:</b> </label>
                            <div class="col-md-5">
                              <div class="d-flex align-items-start">    

                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="radio5" id="radio5-1" value="F" <?php echo $sexo_f; ?> >
                                  <label class="form-check-label fuente14" for="radio5-1">
                                    Femenino
                                  </label>
                                </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                   <input class="form-check-input" type="radio" name="radio5" id="radio5-2" value="M" <?php echo $sexo_m; ?>>
                                  <label class="form-check-label fuente14" for="radio5-2">
                                    Masculino
                                  </label>
                                </div>
                              </div>

                            </div>
                            
                          </div>

                          <div class="form-group row ">
                            <label for="estudios" class="col-md-3 col-form-label text-dark" ><b>Estudios que tiene a nivel superior:</b></label>
                            <div class="col-md-5" >
                              <select name="estudios" id="estudios" class="form-control" required >
                                <option value="">Seleccione una opción</option>
                                <option value="Licenciatura" <?php if($estudios == "Licenciatura"){ echo "selected"; } ?> >Licenciatura</option> 
                                <option value="Especialidad" <?php if($estudios == "Especialidad"){ echo "selected"; } ?> >Especialidad</option> 
                                <option value="Mtr" <?php if($estudios == "Mtr"){ echo "selected"; } ?> >Maestría</option> 
                                <option value="Doctorado" <?php if($estudios == "Doctorado"){ echo "selected"; } ?> >Doctorado</option> 
                                <option value="Posdoctorado" <?php if($estudios == "Posdoctorado"){ echo "selected"; } ?> >Posdoctorado</option> 
                              </select>
                            </div>
                          </div>


                          <div class="form-group row ">
                            <label for="division" class="col-md-3 col-form-label text-dark" ><b>División Académica:</b></label>
                            <div class="col-md-5" >
                              <select name="division" id="division" class="form-control" required  onChange="div_dpto();">
                                <option value="">Seleccione una opción</option>
                                <option value="CBS" <?php if($division == "CBS"){ echo "selected"; } ?> >CBS</option> 
                                <option value="CYAD" <?php if($division == "CYAD"){ echo "selected"; } ?> >CyAD</option> 
                                <option value="CSH" <?php if($division == "CSH"){ echo "selected"; } ?> >CSH</option> 
                              </select>
                            </div>
                          </div>

                          <div id="d_dpto">
                            <!---- d_dpto  ---->
                            <div class="form-group row ">
                              <label for="dpto" class="col-md-3 col-form-label text-dark" ><b>Departamento de Adscripción:</b></label>
                              <div class="col-md-5" >
                                <select name="dpto" id="dpto" class="custom-select" required >
                                  <option value="" selected="selected">Elige una opci&oacute;n</option>
                                    <?php 
                                    $query_exi1 = "SELECT * FROM cat_div_dpto WHERE division= ?;";
                                    $stmt_exi1 = $connection->prepare($query_exi1);
                                    $stmt_exi1->execute(array($division));
                                    $total1=$stmt_exi1->rowCount();
                                    if($total1 > 0){
                                        while ($row = $stmt_exi1->fetch()) {
                                            $id = "{$row['id_depto']}";
                                            $depto = "{$row['depto']}";

                                            if($id_depto == $id ){
                                                echo '<option value="'.$id.'" selected >'.$depto.'</option>';
                                            }else{
                                                echo '<option value="'.$id.'" >'.$depto.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row ">
                              <label for="imparte" class="col-md-3 col-form-label text-dark" ><b>¿En qué licenciatura imparte docencia?</b></label>
                              <div class="col-md-5" >
                                <select name="imparte" id="imparte" class="custom-select" required >
                                  <option value="" selected="selected">Elige una opci&oacute;n</option>
                                  <?php 
                                    $query_exi2 = "SELECT * FROM cat_div_lic WHERE division= ?;";
                                    $stmt_exi2 = $connection->prepare($query_exi2);
                                    $stmt_exi2->execute(array($division));
                                    $total2=$stmt_exi2->rowCount();

                                    while ($row = $stmt_exi2->fetch()) {
                                        $id_lic = "{$row['id_lic']}";
                                        $licenciatura = "{$row['licenciatura']}";

                                        if( ($imparte == $licenciatura) || ($imparte == $id_lic) ){
                                            echo '<option value="'.$id_lic.'" selected >'.$licenciatura.'</option>';
                                        }else{
                                            echo '<option value="'.$id_lic.'" >'.$licenciatura.'</option>';
                                        }
                                    }

                                  ?>
                                </select>
                              </div>
                            </div>
                            <!---- d_dpto  ---->
                          </div>

                          <div class="form-group row ">
                            <label for="nom" class="col-md-3 col-form-label text-dark" ><b>Respecto a su participación en el Programa Institucional de Tutoría:</b></label>
                            <div class="col-md-5" >
                              <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="<?php echo $nom; ?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                               <input type="hidden" id="trim" name="trim" value="<?php echo $trim; ?>">
                               <button type="button" class="btn btn-primary btn_02"  onclick="act_tutor();" >
                                <span class="badge text_sup_01 text-light text-uppercase"><i class="material-icons">edit_note</i> Confirmar datos</span>
                               </button>
                            </div>

                          </div>
                        </form>

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
            <footer class="py-5 bg-primary mt-0 backBlue1" style="min-height: 13vh;">
                <div class="container">
                    <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / <?php echo date("Y"); ?></p>
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