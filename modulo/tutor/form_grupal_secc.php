<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
    $div =($_SESSION['div']);
    $_SESSION['us_tutor']=$usuario;
    $_SESSION['nombre']=$nombre_tutor;
    $_SESSION["us_correo"] = $email;
    $_SESSION["div"] = $div;
    $_SESSION["matricula"] = "0";

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
    
    <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>
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
        </div>
      </div>
      <div class="row mt-0  justify-content-around">
        <?php
        $query_exi = "SELECT est.matri_alu as matri, est.nombre, est.ap, est.am,  entrevista.lic as lice, entrevista.prom as promedio, prom.trimestre as trime, prom.prom_fin as pf FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est_tutor.matricula=entrevista.matricula LEFT join ges_tutoria_grupal_1 prom on est_tutor.matricula=prom.matricula  and est_tutor.trimestre = prom.trim_informe where status_estudiante IN (2,6) and  no_eco = ? and est_tutor.trimestre = ? ;";

          $stmt_exi = $connection->prepare($query_exi);
          $stmt_exi->execute(array($usuario, $trim));
          $total=$stmt_exi->rowCount();
          
        ?>

          <div class="col-md-11 mt-2 mb-2 p-3 pt-2 pl-5 pr-5 shadow rounded" style="min-height: 65vh; ">
            
            <div class="row m-2 p-2 d-flex justify-content-end">
              <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
              <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
            </div>

            <div class="title mt-2" >
              <h3>
                Informe grupal
              </h3>
              <span class="text_sup_01"><a href="index.php" class="text_sup_01"><i class="material-icons">home</i>Inicio</a></span> / 
              <span class="text_sup_01"><a href="index_trim.php?x=<?php echo $trim_codi; ?>" class="text_sup_01"><i class="material-icons">calendar_month</i>Trimestre <?php echo $trim; ?></a></span> /
              <span class="text_sup_01"><i class="material-icons">groups</i> Informe grupal</span>
            </div>
            <hr>

            <div id="secc_1"><!-- secc_01 -->
              <h5><b>I. Persona tutora</b></h5>
              <p class="ml-4 texto_01">
                <b>Nombre:</b> <?php echo $nombre_tutor; ?> <br>
                <b>Número económico:</b> <?php echo $usuario; ?> <br>
                <b>División académica:</b> <?php echo $div; ?><br>
                <b>Departamento:</b>  <br>
                <b>Estudiantes asignados:</b> <?php echo $total; ?> <br>
              </p>

              <h5><b>II. Personas tutoradas</b></h5>

              <form id="formulario_secc1" name="formulario_secc1">
                <table class="table ml-4 mr-4" style="width:90%;">
                  <thead class="backBlue2">
                    <tr>
                      <th scope="col" class="text-center" width="2%">#</th>                  
                      <th scope="col" width="30%">Nombre</th>
                      <th scope="col" class="text-center" width="10%">Matrícula</th>
                      <th scope="col" class="text-center" width="27%">Licenciatura</th>
                      <th scope="col" class="text-center" width="10%">Calificación inicial</th>
                      <th scope="col" class="text-center" width="13%">Trimestre cursado</th>
                      <th scope="col" class="text-center" width="10%">Calificación final</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if($total > 0){
                        $alu_in = 0; 
                        while ($row = $stmt_exi->fetch()){
                          $trime ="";
                          $pf ="";
                          $matricula = "{$row['matri']}";
                          $nom = "{$row['nombre']}";
                          $ap = "{$row['ap']}";
                          $am = "{$row['am']}";
                          $lic = "{$row['lice']}";
                          $promedio = "{$row['promedio']}";
                          $trime = "{$row['trime']}";
                          $pf = "{$row['pf']}";
                          $alu_in = $alu_in + 1;
                          $nombre = $nom." ".$ap." ".$am;
                          ?>
                          <tr>
                            <td><?php echo $alu_in; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td class="text-center"><?php echo $matricula; ?></td>
                            <td class="text-center"><?php echo $lic; ?></td>
                            <td class="text-center"><?php echo $promedio; ?></td>
                            <td class="text-center">
                              <input type="hidden" id="matri_<?php echo $alu_in; ?>" name="matri_<?php echo $alu_in; ?>" value="<?php echo $matricula; ?>">
                              <input type="hidden" id= "prom_<?php echo $alu_in; ?>" name="prom_<?php echo $alu_in; ?>" value="<?php echo $promedio; ?>">

                              <select name="trim_<?php echo $alu_in; ?>" id="trim_<?php echo $alu_in; ?>" class="custom-select " required="">
                                <option value="">Trimestre</option>
                                <?php 
                                for ($i = 1; $i <= 15; $i++) {
                                  $selected1 ="";
                                  if($trime == $i){
                                    $selected1 ="selected";
                                  }
                                  echo "<option value='".$i."' ".$selected1." >".$i."</option>";
                                }
                                ?>
                              </select>
                            </td>
                            <td class="text-center">
                              <!-- <input type="number" required class="form-control decimal" id="final_<?php echo $alu_in; ?>" name="final_<?php echo $alu_in; ?>" maxlength="5" min="5" max="10" placeholder="5.00" step="0.10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false; if(this.value.length==5) return false;" value="<?php echo $pf; ?>" > -->

                              <select name="final_<?php echo $alu_in; ?>" id="final_<?php echo $alu_in; ?>" class="custom-select" required="" >
                                <option value="">Seleccione una opción</option>
                                <option value="NA" <?php if($pf == "NA"){ echo "selected"; } ?> >NA</option> 
                                <option value="S"  <?php if($pf == "S"){ echo "selected"; } ?> >S</option>
                                <option value="B"  <?php if($pf == "B"){ echo "selected"; } ?> >B</option>
                                <option value="MB" <?php if($pf == "MB"){ echo "selected"; } ?> >MB</option>
                              </select>
                            </td>
                          </tr>
                          <?php
                        }
                      } 
                    ?>
                  </tbody>
                </table>
                <input type="hidden" id="trim_secc_1" name="trim_secc_1" value="<?php echo $trim; ?>">
                <input type="hidden" id="est_asig" name="est_asig" value="<?php echo $total; ?>">
              </form>

              <div class="form-group row mt-5">
                <label for="" class="col-md-4 col-form-label"></label>
                <div class="col-md-8">
                  <button type="button" class="btn btn-primary btn_10"  onclick="secc_g01(); t_sesiones();" >
                    Siguiente <img class="img-fluid mr-1 ml-2" src="../../img/sig_01.png" alt="">
                  </button>
                </div>
              </div>
              <br>
            </div><!-- secc_01 -->

            <div id="secc_2"><!-- secc_02 -->
                <form id="formulario_secc2" name="formulario_secc2">
                  <h5>
                    <b>III.  De las sesiones de tutoría </b>
                  </h5>
                  <div id="mconsulta">
                  </div>

                  <div id="div_tabla">
                  </div>
                    
                  <div class="form-group row mt-5">
                    <label for="" class="col-md-4 col-form-label"></label>
                    <div class="col-md-8">
                      <button type="button" class="btn btn-primary btn_10"  onclick="secc_01();" >
                        <img class="img-fluid mr-1 ml-2" src="../../img/atras_01.png" alt=""> 
                        Anterior
                      </button>
                      
                      <button id="btn_seccg2" type="button" class="ml-2 btn btn-primary btn_10"  onclick="secc_03();" >
                        Siguiente <img class="img-fluid mr-1 ml-2" src="../../img/sig_01.png" alt="">
                      </button>

                    </div>
                  </div>
                  <br>
              </form>
            </div><!-- secc_02 -->

            <!---- IV. De la tutoría individualizada  ----->
            <div id="secc_3"><!-- secc_03 -->
              <?php

              $falta = "";
              $falta_est = "";
              $individual = "";
              $individual_est = "";
              $ind_razon = "";
              $continuar = "";
              $participa = "";
              $otra = "";
              $faltaArray = [];

              $query_34 = "SELECT tutoria_falta as falta, tutoria_falta_est as falta_est, tutoria_ind as individual, tutoria_ind_est as individual_est, tutoria_ind_razon as ind_razon, tutoria_continuar as continuar, participa, otra_participa as otra, comentarios  FROM ges_tutoria_grupal_3 WHERE num_eco = ? and trim_informe = ? ";

              $stmt_34 = $connection->prepare($query_34);
              $stmt_34->execute(array($usuario, $trim));
              $total_34=$stmt_34->rowCount();


              if($total_34 > 0){ 
               
                while ($row_34 = $stmt_34->fetch()){
                  $falta = "{$row_34['falta']}";
                  $falta_est_temp = "{$row_34['falta_est']}";
                  $individual = "{$row_34['individual']}";
                  $individual_est_temp = "{$row_34['individual_est']}";
                  $ind_razon = "{$row_34['ind_razon']}";
                  $continuar = "{$row_34['continuar']}";
                  $participa = "{$row_34['participa']}";
                  $otra = "{$row_34['otra']}";
                  $comentarios = "{$row_34['comentarios']}";
                }

                $falta_est = str_replace("|0", "", $falta_est_temp);
                $faltaArray = explode('|', $falta_est);

                $individual_est = str_replace("|0", "", $individual_est_temp);
                $individualArray = explode('|', $individual_est);
              } 

              ?>


              <h5>
                <b>IV. La tutoría individualizada </b>
              </h5>
              <form id="formulario_secc3" name="formulario_secc3">
              <div class="form-group row  ml-4">
                <p class="pre1 col-md-11 pb-2 mb-0 "><b>¿Algún alumno o alumna faltó a las sesiones de tutoría?</b></p>
                <div class="col-md-6 " >
                  <div class="d-flex align-items-start">              
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="falta" id="falta-1" value="si"  onclick="s_otro(3);" <?php if($falta == "si") echo "checked"; ?> >
                      <label class="form-check-label" for="falta-1"  style="color: #424656;">
                        Sí
                      </label>
                    </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="form-check">
                       <input class="form-check-input" type="radio" name="falta" id="falta-2" value="no"  onclick="h_otro(3);" <?php if($falta == "no") echo "checked"; ?> >
                       <label class="form-check-label" for="falta-2" style="color: #424656;">
                        No
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div id="div3" style="color: #212529!important;"><!---- div3 ----->
                <div class="form-group row  ml-4 pb-1 mb-1">
                  <p class="pre1 col-md-11 pb-2 mb-2"><b>¿Quién? </b></p>
                </div>
                <div class="row mt-0 pt-0 ml-3 pl-3 mr-3 pr-3">
                  <?php
                  $query_alumnos = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap, est.am as am FROM ges_registro_alu est LEFT join estudiante_tutor est_tutor on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where status_estudiante IN (2,6) and no_eco = ? and est_tutor.trimestre = ? ;";

                  $stmt_02 = $connection->prepare($query_alumnos);
                  $stmt_02->execute(array($usuario, $trim));
                  $total_02=$stmt_02->rowCount();

                  if($total_02 > 0){ 
                    $check=1;
                    
                    while ($row_02 = $stmt_02->fetch()){
                      $matricula_02 = "{$row_02['matri']}";
                      $nom_02 = "{$row_02['nombre']}";
                      $ap_02 = "{$row_02['ap']}";
                      $am_02 = "{$row_02['am']}";
                      $nombre_02 = $nom_02." ".$ap_02." ".$am_02;
                      $checado = "";
                      foreach ($faltaArray as $value) {
                        if ($value == $matricula_02 ) {
                            $checado = "checked";
                        }
                      }
                      ?>
                      <div class="col-md-4">
                        <input class="form-check-input" type="checkbox" name="falta_est[]" id="falta_est-<?php echo $check; ?>" value="<?php echo $matricula_02; ?>" <?php echo $checado; ?> >
                        <?php echo $nombre_02; ?>
                      </div>
                    <?php
                    $check =$check+1;
                    }
                  } 
                  ?>
                </div>
              </div><!---- div3  ----->
              

              <div class="form-group row  ml-4">
                <p class="pre1 col-md-11 pb-2 mb-0 mt-3"><b>¿Considera que alguna de las personas tutoradas requiere tutoría individualizada?</b></p>
                <div class="col-md-6 " >
                  <div class="d-flex align-items-start">              
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tuto_ind" id="tuto_ind-1" value="si"  onclick="s_otro(1);" <?php if($individual == "si") echo "checked"; ?> >
                      <label class="form-check-label" for="tuto_ind-1"  style="color: #424656;">
                        Sí
                      </label>
                    </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="form-check">
                       <input class="form-check-input" type="radio" name="tuto_ind" id="tuto_ind-2" value="no"  onclick="h_otro(1);" <?php if($individual == "no") echo "checked"; ?> >
                       <label class="form-check-label" for="tuto_ind-2" style="color: #424656;">
                        No
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <!---- IV. De la tutoría individualizada  ----->
              <div id="div1" style="color: #212529!important;"><!---- div1  ----->
                
                <div class="form-group row  ml-4 pb-1 mb-1">
                  <p class="pre1 col-md-11 pb-2 mb-2"><b>Si es el caso, por favor indique el nombre o nombres del estudiantado que la requiere.</b></p>
                </div>

                <div class="row mt-0 pt-0 ml-3 pl-3 mr-3 pr-3">

                  <?php
                  $individualArray =[];
                  $query_alumnos = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap, est.am as am FROM ges_registro_alu est LEFT join estudiante_tutor est_tutor on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where status_estudiante IN (2,6) and no_eco = ? and est_tutor.trimestre = ?  ;";

                  $stmt_02 = $connection->prepare($query_alumnos);
                  $stmt_02->execute(array($usuario, $trim));
                  $total_02=$stmt_02->rowCount();

                  if($total_02 > 0){ 
                    $check=1;
                    
                    while ($row_02 = $stmt_02->fetch()){
                      $matricula_02 = "{$row_02['matri']}";
                      $nom_02 = "{$row_02['nombre']}";
                      $ap_02 = "{$row_02['ap']}";
                      $am_02 = "{$row_02['am']}";
                      $nombre_02 = $nom_02." ".$ap_02." ".$am_02;

                      $checado2 = "";
                      foreach ($individualArray as $value2) {
                        if ($value2 == $matricula_02 ) {
                            $checado2 = "checked";
                        }
                      }

                      ?>
                      <div class="col-md-4">
                        <input class="form-check-input" type="checkbox" name="req_est[]" id="req_est-<?php echo $check; ?>" value="<?php echo $matricula_02; ?>"  <?php echo $checado2; ?> >
                        <?php echo $nombre_02; ?>
                      </div>
                    <?php
                    $check =$check+1;
                    }
                  } 
                  ?>

                </div>

                <div class="form-group row mt-3 ml-4">
                  <p class="pre1 col-md-11 pb-2 mb-2"><b>¿Por qué considera que los estudiantes seleccionados requieren tutoría individualizada?</b></p>
                  <div class="col-md-10" >
                    <div class="d-flex align-items-start">              
                        <input type="text" required class="form-control" id="req_pq" name="req_pq" maxlength="128" placeholder="" value="<?php echo $ind_razon; ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group row  ml-4">
                  <p class="pre1 col-md-11 pb-2 mb-1"><b>¿Usted podría brindar la tutoría personalizada o prefiere que reasignemos al estudiantado? </b></p>

                  <div class="col-md-10" >
                    
                    <div class="form-check col-md-10">
                      <input class="form-check-input" type="radio" name="tuto_rea" id="tuto_rea_01" value="si" <?php if($continuar == "si") echo "checked"; ?> >
                      <label class="form-check-label" for="tuto_rea_01">
                        Yo puedo brindar la tutoría personalizada. 
                      </label>
                    </div>
                   
                    <div class="form-check col-md-10">
                      <input class="form-check-input" type="radio" name="tuto_rea" id="tuto_rea_02" value="no" <?php if($continuar == "no") echo "checked"; ?> >
                      <label class="form-check-label" for="tuto_rea_02">
                        Reasignen al estudiantado, por favor. 
                      </label>
                    </div>

                  </div>
                </div>

              </div><!---- div1  ----->

              <div class="form-group row mt-5">
                <label for="" class="col-md-4 col-form-label"></label>
                <input type="hidden" id="trim_secc_3" name="trim_secc_3" value="<?php echo $trim; ?>">
                <div class="col-md-8">
                  <button type="button" class="btn btn-primary btn_10"  onclick="secc_02();" >
                    <img class="img-fluid mr-1 ml-2" src="../../img/atras_01.png" alt=""> 
                    Anterior
                  </button>

                  <button type="button" class="ml-2 btn btn-primary btn_10"  onclick="secc_g03();" >
                    Siguiente <img class="img-fluid mr-1 ml-2" src="../../img/sig_01.png" alt="">
                  </button>

                </div>

              </div>
            </form>

          </div><!-- secc_03 -->

          <div id="secc_4"><!-- secc_04 -->

            <form id="formulario_secc4" name="formulario_secc4">

              <h5 class="text-justify ml-2 mr-4">
                <b>V. Participación en el Programa Institucional de Tutoría  </b>
              </h5>

              <div class="form-group row mt-0 ml-4">
                <p class="col-md-11 pb-1 mb-1  mt-0 text-justify pt-1" style="color: #00A9CA; font-weight: bold; background-color: #F1FFFF; ">
                  Desde la Coordinación de Desarrollo Educativo y la Oficina de Acompañamiento a Trayectorias Académicas del Alumnado (ATAA) queremos agradecerle por su gran labor y compromiso como persona tutora.
                </p>

                <p class="pre1 col-md-11 pb-2 mb-2">
                  <b>Respecto a su participación en el Programa Institucional de Tutoría:</b>
                </p>

                <div class="col-md-11 text-justify" style="color:#212529; ">
                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_1" value="1" onclick="h_otro(2);" <?php if($participa == "1") echo "checked"; ?>  >
                        <label class="form-check-label" for="participa_1">
                          Deseo seguir participando en el Programa de Tutoría y continuar con mis asignaciones actuales. 
                        </label>
                      </div>
                     
                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_2" value="2" onclick="h_otro(2);" <?php if($participa == "2") echo "checked"; ?> >
                        <label class="form-check-label" for="participa_2">
                          Deseo seguir participando en el Programa Institucional de Tutoría y  aumentar mi número de asignaciones de personas tutoradas.  
                        </label>
                      </div>

                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_3" value="3" onclick="h_otro(2);" <?php if($participa == "3") echo "checked"; ?> >
                        <label class="form-check-label" for="participa_3">
                          No podré continuar participando en el Programa Institucional de Tutoría debido a que me tomaré un año sabático. 
                        </label>
                      </div>

                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_4" value="4" onclick="h_otro(2);" <?php if($participa == "4") echo "checked"; ?> >
                        <label class="form-check-label" for="participa_4">
                          No podré continuar participando en el Programa Institucional de Tutoría debido a que tramité mi jubilación o tengo algún tema relacionado con mi contratación. 
                        </label>
                      </div>

                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_5" value="5" onclick="h_otro(2);" <?php if($participa == "5") echo "checked"; ?> >
                        <label class="form-check-label" for="participa_5">
                          No podré continuar participando en el Programa Institucional de Tutoría debido a que tengo otros proyectos que me demandan tiempo. 
                        </label>
                      </div>

                      <div class="form-check col-md-11">
                        <input class="form-check-input" type="radio" name="participa" id="participa_6" value="6" onclick="s_otro(2);" <?php if($participa == "6") echo "checked"; ?> >
                        <label class="form-check-label" for="participa_6">
                          Otra
                        </label>
                        <div id="div2" >
                          <input type="text" required class="form-control" id="txtOtro" name="txtOtro" maxlength="45" placeholder="" value="<?php echo $otra; ?>" >
                          <input type="hidden" id="trim_secc_4" name="trim_secc_4" value="<?php echo $trim; ?>">
                        </div>
                      </div>
                  </div>
                  <div class="col-md-11 text-justify mt-3" style="color:#212529; ">
                    <p class="pre1 col-md-11 pb-2 mb-2">
                      <b>Comentarios adicionales:</b>
                    </p>
                    <div class="col-md-11 text-justify" style="color:#212529; ">
                      <textarea class="form-control" id="comentarios" name="comentarios" rows="3"><?php echo $comentarios; ?></textarea>
                    </div>
                  </div>

                </div>



                <div class="form-group row mt-5">
                  <label for="" class="col-md-4 col-form-label"></label>
                  <div class="col-md-8">

                    <button type="button" class="btn btn-primary btn_10"  onclick="secc_03();" >
                      <img class="img-fluid mr-1 ml-2" src="../../img/atras_01.png" alt=""> 
                      Anterior
                    </button>

                    <button type="button" class="ml-2 btn btn-primary btn_10" onclick="secc_g04();" >
                      Guardar y terminar <img class="img-fluid mr-1 ml-2" src="../../img/done_01.png" alt="">
                    </button>

                  </div>

                </div>

              </form>

            </div><!-- secc_04 -->

            </div>

          </div>

        </div>

    </div>

    <footer class="py-5 bg-primary mt-5 backBlue1" style="min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2025</p>
      </div>
    </footer> 

  </body>
    
    <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../../js/jquery-3.5.1.js" ></script>
    <script src="../../js/bootstrap.bundle.min.js"></script> 
    <script src="../../js/sweetalert.min.js"></script>
    
    <script src="../../js/fun_consulta.js"></script> 

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
