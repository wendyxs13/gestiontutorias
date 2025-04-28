<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
    $_SESSION['us_tutor']=$usuario;
    $_SESSION['nombre']=$nombre_tutor;
    $_SESSION["us_correo"] = $email;

    $matricula=($_SESSION['matricula']);
    $_SESSION["matricula"] = $matricula;
    $nom_est =($_SESSION['nom_est']);

    if (!isset($_GET['x'])) {
      header('Location: index.php');
      exit();
    }else{
      $trim_codi = $_GET['x'];
      $trim = base64_decode($trim_codi); 
      $trim = htmlspecialchars($trim);
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
    <link rel="stylesheet" href="../../css/estilo_informe_ind.css" >
    <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>
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

    <div class="container"  style="padding-top: 5vh; ">

      <div class="row mt-5">
        <div class="col-md-12 mt-2">
        </div>
      </div>


      <div class="col-md-12 pt-1 pl-5 pr-5 rounded" style="background-color: #ffffff;">

        <div class="row m-2 p-2 d-flex justify-content-end">
          <span class="badge badge-light text_sup_01"><i class="material-icons">account_box</i> <?php echo $nombre_tutor; ?></span>
          <span class="badge badge-light text_sup_01 ml-4"><a href="../../salir.php" class="text_sup_01"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></span> 
        </div>

        <div class="title mt-2" >
          <h3>
            Informe tutoría individual
          </h3>
          <span class="text_sup_01"><a href="index.php" class="text_sup_01"><i class="material-icons">home</i>Inicio</a></span> / 
          <span class="text_sup_01"><a href="index_trim.php?x=<?php echo $trim_codi; ?>" class="text_sup_01"><i class="material-icons">calendar_month</i>Trimestre <?php echo $trim; ?></a></span> /
          <span class="text_sup_01"><i class="material-icons">recent_actors</i> Informe individual</span>
        </div>
        <hr>

     

        <!--- form login --->
        <div  id="formulario1" class="for_rep_ind" ></div>

        <form class="pl-2" id="formulario" >


          <div class="form-container">
            <h5 class="text-uppercase ml-5"><b>Estudiante:</b> <?php echo $nom_est; ?></h5>
            <hr>
            <?php

              include '../../php/conn.php';
              $connection = Connection::getInstance();
              $query_exi = "SELECT asistencia, etapa, calificacion, desemp, desemp_desc, orientacion, tiempo_orienta, tema1, tema2, tema3, tema4, tema5, tema6, tema7, tema8, tema_otro, aspecto, aspecto_otro, recomen, recomen_otro, estrategia, acuerdos, logros, comentarios, DATE_FORMAT(tutoria_fecha, '%d/%m/%Y') as fecha FROM ges_tutoria_individual WHERE tutor_id = '$usuario' and matri_id = '$matricula' and trim_informe = '$trim';";
              $stmt_exi = $connection->prepare($query_exi);
              $stmt_exi->execute();
              $totregs = $stmt_exi->rowCount();
              $data = array();
              
              if ($totregs) {
                  $data = $stmt_exi->fetch();
              }

            ?>

            <div class="card">
                <div class="card-header">¿Se logró contactar al estudiante para realizar las sesiones de tutoría? </div>
                <div class="card-body">
                  <div class=" align-items-start"> 
                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="asistencia" id="asistencia-1" value="1" onclick="asiste(1);" <?php if($data['asistencia'] == "1" ){  echo "checked"; } ?> >
                      <label class="form-check-label " for="asistencia-1">
                        Sí, asistió a todas las sesiones de tutoría.
                      </label>
                    </div> 

                    <div class="form-check mr-4">
                       <input class="form-check-input" type="radio" name="asistencia" id="asistencia-2" value="2" onclick="asiste(2);" <?php if($data['asistencia'] == "2" ){  echo "checked"; } ?> >
                      <label class="form-check-label" for="asistencia-2">
                        Sí, asistió a algunas sesiones de tutoría.
                      </label>
                    </div>

                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="asistencia" id="asistencia-3" value="3" onclick="asiste(3);" <?php if($data['asistencia'] == "3" ){  echo "checked"; } ?> >
                      <label class="form-check-label" for="asistencia-3">
                        Sí, se logró contactarlo, pero no asistió a las sesiones de tutoría.
                      </label>
                    </div>

                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="asistencia" id="asistencia-4" value="4" onclick="asiste(4);" <?php if($data['asistencia'] == "4" ){  echo "checked"; } ?> >
                      <label class="form-check-label" for="asistencia-4">
                        No, no fue posible contactar al estudiante.
                      </label>
                    </div>
                  </div>

                </div>
            </div>

            <div id="div0">
              <div class="card">
                <div class="card-header">1. Trimestre que cursa el/la estudiante:</div>
                <div class="card-body">
                  <select name="txt1" id="txt1" class="select-control" required>
                    <option value="">Seleccione una opción</option>
                    <?php
                        for ($i = 1; $i <= 15; $i++) {
                          if( $data['etapa'] == $i){
                            echo "<option value=\"$i\" selected >$i</option>";
                          }else{
                            echo "<option value=\"$i\">$i</option>";
                          }
                        }
                    ?>
                  </select>
                </div>
            </div>

           

            <div class="card">
                <div class="card-header">2. ¿Cuál es la calificación que obtuvo en el trimestre?:</div>
                <div class="card-body">
                    <select name="txt2" id="txt2" class="select-control" required="" >
                      <option value="">Seleccione una opción</option>
                      <option value="NA" <?php if($data['calificacion'] == "NA"){ echo "selected"; } ?> >NA</option> 
                      <option value="S" <?php if($data['calificacion'] == "S"){ echo "selected"; } ?> >S</option>
                      <option value="B" <?php if($data['calificacion'] == "B"){ echo "selected"; } ?> >B</option>
                      <option value="MB" <?php if($data['calificacion'] == "MB"){ echo "selected"; } ?> >MB</option>
                    </select>
                </div>
            </div>

            <div class="card">
              <div class="card-header">3. Con base en los resultados del trimestre, evalúe el desempeño de la persona tutorada:</div>
              <div class="card-body">
                <div class="d-flex align-items-start"> 
                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio3" id="radio3-1" value="Nada satisfactorio" <?php if($data['desemp'] == "Nada satisfactorio"){  echo "checked"; } ?> >
                    <label class="form-check-label " for="radio3-1">
                      Nada satisfactorio
                    </label>
                  </div> 

                  <div class="form-check mr-4">
                     <input class="form-check-input" type="radio" name="radio3" id="radio3-2" value="Regular" <?php if($data['desemp'] == "Regular"){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio3-2">
                      Regular
                    </label>
                  </div>

                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio3" id="radio3-3" value="Bueno" <?php if($data['desemp'] == "Bueno"){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio3-3">
                      Bueno
                    </label>
                  </div>

                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio3" id="radio3-4" value="Muy bueno" <?php if($data['desemp'] == "Muy bueno"){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio3-4">
                      Muy bueno
                    </label>
                  </div>
                </div>
              </div>
            </div>


            <div class="card">
                <div class="card-header">4. Justifique brevemente su respuesta:</div>
                <div class="card-body">
                    <textarea class="form-control" id="txt4" name="txt4" rows="3"><?php echo $data['desemp_desc']; ?></textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-header">5. Aproximadamente ¿Cuántos días le brindó tutoría durante el trimestre?</div>
                <div class="card-body">

                  <div class="d-flex align-items-start"> 
                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="radio5" id="radio5-1" value="1-3" <?php if($data['orientacion'] == "1-3"){  echo "checked"; } ?> >
                      <label class="form-check-label " for="radio5-1">
                        De 1 a 3 días
                      </label>
                    </div> 

                    <div class="form-check mr-4">
                       <input class="form-check-input" type="radio" name="radio5" id="radio5-2" value="4-7" <?php if($data['orientacion'] == "4-7"){  echo "checked"; } ?> >
                      <label class="form-check-label" for="radio5-2">
                        De 4 a 7 días
                      </label>
                    </div>

                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="radio5" id="radio5-3" value="8-11" <?php if($data['orientacion'] == "8-11"){  echo "checked"; } ?> >
                      <label class="form-check-label" for="radio5-3">
                        De 8 a 11 días
                      </label>
                    </div>

                    <div class="form-check mr-4">
                      <input class="form-check-input" type="radio" name="radio5" id="radio5-4" value="+12" <?php if($data['orientacion'] == "+12"){  echo "checked"; } ?> >
                      <label class="form-check-label" for="radio5-4">
                        Más de 12 días
                      </label>
                    </div>
                  </div>

                </div>
            </div>

            <div class="card">
              <div class="card-header">6. ¿Cuánto tiempo duró cada sesión?</div>
              <div class="card-body">

                <div class="d-flex align-items-start"> 
                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio6" id="radio6-1" value="15-30" <?php if($data['tiempo_orienta'] == "15-30"){  echo "checked"; } ?> >
                    <label class="form-check-label " for="radio6-1">
                      De 15 a 30 minutos
                    </label>
                  </div> 

                  <div class="form-check mr-4">
                     <input class="form-check-input" type="radio" name="radio6" id="radio6-2" value="30-60" <?php if($data['tiempo_orienta'] == "30-60"){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio6-2">
                      De 30 a 60 minutos    
                    </label>
                  </div>

                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio6" id="radio6-3" value="61-90" <?php if($data['tiempo_orienta'] == "61-90"){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio6-3">
                      De 61 a 90 minutos
                    </label>
                  </div>

                  <div class="form-check mr-4">
                    <input class="form-check-input" type="radio" name="radio6" id="radio6-4" value="+90" <?php if($data['tiempo_orienta'] == "+90" ){  echo "checked"; } ?> >
                    <label class="form-check-label" for="radio6-4">
                      Más de 90 minutos
                    </label>
                  </div>
                </div>
                    
              </div>
            </div>

            <div class="card">
                <div class="card-header">7. De los siguientes temas ¿Cuál identificó que se le dificulta al/la estudiante? Puede elegir más de una opción.</div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-md-3 ml-2 mr-2" style="color: #1C499A; border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: gainsboro; ">
                      Contenidos
                    </div>
                    <div class="col-md-8">                
                      <div class="d-flex flex-wrap align-items-start">  
                        <div class="form-check col-md-10">
                          <input class="form-check-input" type="checkbox" name="check7-1" id="check7-1" value="1" <?php if($data['tema1'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-1">
                          Contenidos específicos de su licenciatura
                          </label>
                        </div>
                      </div>
                      <hr style="width:95%;text-align:left;margin-left:0; margin-bottom: 0px;"> 
                    </div>


                    <div class="col-md-3 mt-3 ml-2 mr-2" style="color: #1C499A; border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: gainsboro; ">
                      Desarrollo y dominio de habilidades cognitivas genérica
                    </div>
                    <div class="col-md-8 mt-1">

                      <div class="d-flex flex-wrap align-items-start">  
                        <div class="form-check col-md-5 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-2" id="check7-2" value="1" <?php if($data['tema2'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-2">
                          Comprensión lectora
                          </label>
                        </div>
                        <div class="form-check col-md-7 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-3" id="check7-3" value="1" <?php if($data['tema3'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-3">
                          Habilidades de conocimiento matemático
                          </label>
                        </div>
                        <div class="form-check col-md-5 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-4" id="check7-4" value="1" <?php if($data['tema4'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-4">
                          Argumentación
                          </label>
                        </div>
                        <div class="form-check col-md-7 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-5" id="check7-5" value="1" <?php if($data['tema5'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-5">
                          Habilidades de investigación
                          </label>
                        </div>
                      </div>
                      <hr style="width:95%;text-align:left;margin-left:0; margin-bottom: 0px;"> 
                    </div>

          
                    <div class="col-md-3 mt-3 ml-2 mr-2" style="color: #1C499A; border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: gainsboro;">Habilidades Socioemocionales</div>
                    <div class="col-md-8 mt-1">

                      <div class="d-flex flex-wrap align-items-start">  
                        <div class="form-check col-md-5 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-6" id="check7-6" value="1" <?php if($data['tema6'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-6">Trabajo en equipo</label>
                        </div>
                        <div class="form-check col-md-6 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-7" id="check7-7" value="1" <?php if($data['tema7'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-7">Hablar en público</label>
                        </div>
                        <div class="form-check col-md-5 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-8" id="check7-8" value="1" <?php if($data['tema8'] == "1" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-8">Integración al medio universitario</label>
                        </div>
                        <div class="form-check col-md-6 mt-2">
                          <input class="form-check-input" type="checkbox" name="check7-9" id="check7-9" value="Otro" onclick="check_otro('7-9',1);" <?php if($data['tema_otro'] != "" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="check7-9">Otro</label>
                        </div>

                      </div>
                      

                    </div>

                    <div id="div1" class="col-md-12 mt-2" >
                      <div class="d-flex align-items-start">
                        <label for="txt8" class="col-md-3 col-form-label text-right" ><b>Especifique:</b></label>
                        <div class="col-md-5 ml-5"  >
                          <input type="text" required class="form-control" id="txt8" name="txt8" maxlength="90" placeholder="" value="<?php echo $data['tema_otro']; ?>" >
                        </div>
                      </div>
                    </div>
                

                  </div>
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">8. ¿En qué aspectos le orientó al/la estudiante?</div>
                <div class="card-body">
                  <div class="form-group row ">
                    <div class="col-md-10" >
                      <div class="d-flex align-items-start"> 

                        <div class="form-check mr-4">
                          <input class="form-check-input" type="radio" name="radio9" id="radio9-1" value="Dudas académicas" onclick="h_otro(2);" <?php if($data['aspecto'] == "Dudas académicas" ){  echo "checked"; } ?> >
                          <label class="form-check-label " for="radio9-1">
                            Dudas académicas  
                          </label>
                        </div> 

                        <div class="form-check mr-4">
                           <input class="form-check-input" type="radio" name="radio9" id="radio9-2" value="Dudas sobre tramites escolares" onclick="h_otro(2);" <?php if($data['aspecto'] == "Dudas sobre tramites escolares" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="radio9-2">
                            Dudas sobre tramites escolares
                          </label>
                        </div>

                        <div class="form-check mr-4">
                          <input class="form-check-input" type="radio" name="radio9" id="radio9-3" value="otro" onclick="s_otro(2);" <?php if($data['aspecto'] == "otro" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="radio9-3">
                            Otro
                          </label>
                        </div>
                      </div>
                    </div>

                    <div id="div2" class="col-md-12 mt-2" >
                      <div class="d-flex align-items-start">
                        <label for="txt10" class="col-md-3 col-form-label ml-5 text-right" ><b>¿Cuál?:</b></label>
                        <div class="col-md-5" >
                          <input type="text" required class="form-control" id="txt10" name="txt10" maxlength="90" placeholder="" value="<?php echo $data['aspecto_otro']; ?>"  >
                        </div>
                      </div>
                    </div>

                  </div>
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">9. ¿Canalizó o recomendó al/la estudiante para atender alguna inquietud, reforzar algún tema específico?</div>
                <div class="card-body">
                  <div class="form-group row ">
                    <div class="col-md-10" >
                      <div class="d-flex align-items-start"> 

                        <div class="form-check mr-4">
                          <input class="form-check-input" type="radio" name="radio11" id="radio11-1" value="Si" onclick="s_otro(3);" <?php if($data['recomen'] == "Si" ){  echo "checked"; } ?> >
                          <label class="form-check-label " for="radio11-1">
                            Sí
                          </label>
                        </div> 

                        <div class="form-check mr-4">
                           <input class="form-check-input" type="radio" name="radio11" id="radio11-2" value="No hubo recomendación" onclick="h_otro(3);" <?php if($data['recomen'] == "No hubo recomendación" ){  echo "checked"; } ?> >
                          <label class="form-check-label" for="radio11-2">
                            No hubo recomendación
                          </label>
                        </div>

                      </div>
                    </div>

                    <div id="div3" class="col-md-12 mt-2" >
                      <div class="d-flex align-items-start">
                        <label for="txt12" class="col-md-3 col-form-label ml-5 text-right" ><b>Especifique:</b></label>
                        <div class="col-md-5" >
                          <input type="text" required class="form-control" id="txt12" name="txt12" maxlength="90" placeholder="" value="<?php echo $data['recomen_otro']; ?>">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">10. ¿Qué estrategias implementó para mejorar el desempeño de la persona tutorada?</div>
                <div class="card-body">
                  <textarea class="form-control" id="txt13" name="txt13" rows="3"><?php echo $data['estrategia']; ?></textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-header">11. ¿Cuáles son los acuerdos y compromisos que se establecieron durante el trimestre?</div>
                <div class="card-body">
                   <textarea class="form-control" id="txt14" name="txt14" rows="3"><?php echo $data['acuerdos']; ?></textarea> 
                </div>
            </div>

            <div class="card">
                <div class="card-header">12. Logro obtenido durante el trimestre:</div>
                <div class="card-body">
                  <textarea class="form-control" id="txt15" name="txt15" rows="3"><?php echo $data['logros']; ?></textarea>
                  <input type="hidden" id="trim_inf" name="trim_inf" value="<?php echo $trim; ?>">  
                </div>
            </div>

            <div class="card">
                <div class="card-header">13. Comentarios adicionales:</div>
                <div class="card-body">
                  <textarea class="form-control" id="txt16" name="txt16" rows="3"><?php echo $data['comentarios']; ?></textarea>
                </div>
            </div>

          </div>

            

            <div class="row mt-0">
              <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-submit"  onclick="enviarTutoria1();" >
                  <b>Enviar</b>
                </button>
              </div>
            </div>

          </div>
        </form>


        
      </div> 
    </div>

    <footer class="py-5 bg-primary mt-5 backBlue1" style=" min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>

  <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
  <script src="../../js/jquery-3.5.1.js" ></script>
  <script src="../../js/bootstrap.bundle.min.js"   ></script>
  <script src="../../js/sweetalert.min.js"></script> 
  <script type="text/javascript" src="../../js/fun_tutoria.js"></script> 
  <script type="text/javascript">
    
    $(document).ready(function(){ 

      if ( ($('input[name="asistencia"]:checked').val() == "1") || ($('input[name="asistencia"]:checked').val() == "2") ) {
          $('#div0').show();
      }

      if ($('input[name="check7-9"]:checked').val() == "Otro") {
          $('#div1').show();
      }

      if ($('input[name="radio9"]:checked').val() == "otro") {
          $('#div2').show();
      }
      if ($('input[name="radio11"]:checked').val() == "Si") {
          $('#div3').show();
      }

    });
  
  </script>

</html>
<?php 
}else{ 
  header("location:../../login.php"); 
}
?>