<?php
session_start();
if(isset($_SESSION['matri_tutoria'])){
    $usuario=($_SESSION['matri_tutoria']);
    $_SESSION['matri_tutoria']=$usuario;

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/estilo.css" >
<!--     <link rel="stylesheet" href="css/bootstrap.min.css" >   -->   
    <script src="../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js"   ></script>
    <script src="../js/jquery-3.5.1.js" ></script>
    <script src="../js/sweetalert.min.js"></script> 
    <script type="text/javascript" src="../js/fun_estudiante.js"></script> 
    
    <link rel="shortcut icon" href="../img/favicon_1.ico" type="image/vnd.microsoft.icon">

    <script type="text/javascript">
    </script>

    <title>Tutorías UAM-X</title>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top backBlue1">
        <div class="container">
          <a class="navbar-brand" href="">
            <img class="img-fluid" src="../img/logo.png" alt="">
          </a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto smooth-scroll ">
              <li class="nav-item">
                <a class="nav-link text-white" href=""><b>Inicio</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"  ></a>
              </li>
            </ul>
          </div>
        </div>
    </nav> 
    <!-- Navigation -->

    
    <div class="container"  style="padding-top: 3vh; ">
        <div class="row mt-5">
          <div class="col-md-12 mt-5" ><h3 class="encabezado1"><b>Programa Institucional de Tutorías información inicial (tutorado/a)</b></h3></div>
        </div>
        <div class="col-md-12 mt-4"  >

          <!--- form login --->
          <div class="encabezado1" id="formulario1" style="height: 57vh;" ></div>

          <form id="formulario" >
            <h4 class="encabezado2"><b>Información del/la estudiante</b></h4>
            <div class="form-group row ">
              <label for="txt1" class="col-md-2 col-form-label" ><b>Nombre:</b></label>
              <div class="col-md-6" >
                <input type="text" required class="form-control" id="txt1" name="txt1" maxlength="35" placeholder="Nombre(s)" value="">
              </div>
            </div>

            <div class="form-group row ">
              <label for="txt4" class="col-md-2 col-form-label" ><b>Matrícula:</b> </label>
              <div class="col-md-6" >
                <input type="text" required class="form-control" id="txt2" name="txt2" maxlength="25" placeholder="Matrícula"  value="<?php echo $usuario; ?>" disabled>
              </div>
            </div>


            <div class="form-group row ">
              <label for="txt3" class="col-md-2 col-form-label" ><b>Correo electrónico institucional:</b> </label>
              <div class="col-md-6" >
                <input type="text" required class="form-control" id="txt3" name="txt3" maxlength="30" placeholder="Correo electrónico institucional"  value="">
              </div>
            </div>
            

            <div class="form-group row">
              <label for="txt4" class="col-md-2 col-form-label"><b>Estado Civil:</b> </label>
              <div class="col-md-6">
                <select name="txt4" id="txt4" class="custom-select " required="">
                  <option value="">Seleccione una opción</option>
                  <option value="Soltero(a)">Soltero (a)</option>
                  <option value="Casado(a)">Casado (a)</option>
                  <option value="Divorciado(a)">Divorciado (a)</option>
                  <option value="Unión libre">Unión libre</option>
                </select>
              </div>
            </div>

            <div class="form-group row ">
              <label for="radio5" class="col-md-2 col-form-label" ><b>Sexo asignado al nacer:</b> </label>
              <div class="col-md-2" >
                <div class="d-flex align-items-start">              
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio5" id="radio5-1" value="F">
                    <label class="form-check-label fuente14" for="radio5-1">
                      Femenino
                    </label>
                  </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="radio5" id="radio5-2" value="M">
                    <label class="form-check-label fuente14" for="radio5-2">
                      Masculino
                    </label>
                  </div>
                </div>
              </div>
              <label for="txt6" class="col-md-1 col-form-label text-right"  ><b>Edad:</b></label>
              <div class="col-md-2" >
                <input type="text" required class="form-control" id="txt6" name="txt6" placeholder="" maxlength="2"  >
              </div>
            </div>

            <div class="form-group row ">
              <label for="txt42" class="col-md-2 col-form-label" ><b>¿En qué turno estás inscrito?</b> </label>
              <div class="col-md-6" >
               
                <select name="txt42" id="txt42" class="custom-select" required="" >
                  <option value="">Seleccione una opción</option>
                  <option value="Mat">Matutino</option>
                  <option value="Vesp">Vespertino</option>
                </select>

              </div>
            </div>

            <!---- otra etiqueta 1 ----->
            <div class="form-group row ">
              <label class="col-md-2 col-form-label"><b>¿Tienes hijos?</b></label>
              <div class="col-md-6" >
                <div class="d-flex align-items-start">              
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio7" id="radio7-1" value="si">
                    <label class="form-check-label" for="radio7-1">
                      Sí
                    </label>
                  </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="radio7" id="radio7-2" value="no">
                     <label class="form-check-label" for="radio7-2">
                      No
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!---- otra etiqueta 1 ----->

            <div class="form-group row ">
              <label class="col-md-2 col-form-label" ><b>¿Tienes dependientes económicos?</b></label>
              <div class="col-md-2" >
                <div class="d-flex align-items-start">              
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio8" id="radio8-1" value="si" onclick="s_otro(1);">
                    <label class="form-check-label" for="radio8-1">
                      Sí
                    </label>
                  </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="radio8" id="radio8-2" value="no" onclick="h_otro(1);">
                     <label class="form-check-label" for="radio8-2">
                      No
                    </label>
                  </div>
                </div>
              </div>

              <div id="div1" class="col-md-6" >
                <div class="d-flex align-items-start">
                  <label for="txt9" class="col-md-2 col-form-label" ><b>¿Cuántos?</b></label>
                  <div class="col-md-4" >
                    <input type="text" required class="form-control" id="txt9" name="txt9" placeholder="" maxlength="2"  >
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row ">
              <label class="col-md-2 col-form-label" ><b>¿Actualmente trabajas?</b> </label>
              <div class="col-md-2" >
                <div class="d-flex align-items-start">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio10" id="radio10-1" value="si" onclick="s_otro(2);">
                    <label class="form-check-label" for="radio10-1">Sí</label>
                  </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio10" id="radio10-2" value="no" onclick="h_otro(2);">
                    <label class="form-check-label" for="radio10-2">No</label>
                  </div>
                </div>
              </div>
              <div id="div2" class="col-md-8" >
                <div class="d-flex align-items-start">
                  <label class="col-md-2 col-form-label fuente15" ><b>¿En qué trabajas?</b></label>
                  <div class="col-md-4" >
                    <input type="text" required class="form-control" id="txt11" name="txt11" maxlength="45" placeholder="">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-right" style="max-width: 280px;"><b>¿Cuál es tu promedio académico?</b> </label>
              <div class="col-md-2" >
                <input type="number" required class="form-control decimal" id="txt12" name="txt12" maxlength="5" min="5" max="10" placeholder="5.00" step="0.10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false; if(this.value.length==5) return false;" >
              </div>
            </div>

            <!---- otra etiqueta 2 ----->
            <div class="form-group row ">
              <label class="col-md-2 col-form-label" ><b>¿Eres beneficiario(a) de alguna beca?</b> </label>
              <div class="col-md-2" >
                <div class="d-flex align-items-start">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio13" id="radio13-1" value="si" onclick="s_otro(3);">
                    <label class="form-check-label" for="radio13-1">Sí</label>
                  </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio13" id="radio13-2" value="no" onclick="h_otro(3);">
                    <label class="form-check-label" for="radio13-2">No</label>
                  </div>
                </div>
              </div>
            <!---- otra etiqueta 2 ----->

            <!---- otra etiqueta 3 ----->              
              <div id="div3" class="col-md-8" >
                <div class="d-flex align-items-start">
                  <label for="txt14" class="col-md-2 col-form-label fuente15"><b>¿Cuál?</b></label>
                  <div class="col-md-4" >
                    <input type="text" required class="form-control" id="txt14" name="txt14" maxlength="45" placeholder="">
                  </div>
                </div>
              </div>
            </div>
          <!---- otra etiqueta 3 ----->

            <h4 class="encabezado2 mt-4"><b>Información de los padres</b></h4>
            <p><b>¿Qué escolaridad tienen tus padres?</b></p>
            
            <div class="form-group row"> 
              <label for="txt15" class="col-md-2 col-form-label"><b>Madre:</b> </label>
              <div class="col-md-6">
                <select name="txt15" id="txt15" class="custom-select " required="">
                  <option value="">Seleccione una opción</option>
                  <option value="Sin estudios">Sin estudios</option>
                  <option value="Primaria">Primaria</option>
                  <option value="Secundaria">Secundaria</option>
                  <option value="Carrera Técnica">Carrera Técnica</option>
                  <option value="Preparatoria">Preparatoria</option>
                  <option value="Licenciatura">Licenciatura</option>
                  <option value="Especialidad">Especialidad</option>
                  <option value="Maestría">Maestría</option>
                  <option value="Doctorado">Doctorado</option>
                  <option value="Pos doctorado">Pos doctorado</option>
                  <option value="Lo desconozco">Lo desconozco</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt16" class="col-md-2 col-form-label"><b>Padre:</b> </label>
              <div class="col-md-6">
                <select name="txt16" id="txt16" class="custom-select " required="">
                  <option value="">Seleccione una opción</option>
                  <option value="Sin estudios">Sin estudios</option>
                  <option value="Primaria">Primaria</option>
                  <option value="Secundaria">Secundaria</option>
                  <option value="Carrera Técnica">Carrera Técnica</option>
                  <option value="Preparatoria">Preparatoria</option>
                  <option value="Licenciatura">Licenciatura</option>
                  <option value="Especialidad">Especialidad</option>
                  <option value="Maestría">Maestría</option>
                  <option value="Doctorado">Doctorado</option>
                  <option value="Pos doctorado">Pos doctorado</option>
                  <option value="Lo desconozco">Lo desconozco</option>
                </select>
              </div>
            </div>

            <h4 class="encabezado2 mt-4"><b>Información de la institución</b></h4>
            <p><b>¿Qué te motivó a estudiar en la UAM Xochimilco?</b></p>

            <div class="form-group row">
              <label class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt17" id="txt17" class="custom-select " required=""  onchange="select_otro(17,4,'Otro');">
                  <option value="">Seleccione una opción</option>
                  <option value="Su modelo educativo">Su modelo educativo</option>
                  <option value="La oferta educativa">La oferta educativa</option>
                  <option value="Su prestigio">Su prestigio</option>
                  <option value="Su nivel académico">Su nivel académico</option>
                  <option value="La cercanía a mi hogar">La cercanía a mi hogar</option>                 
                  <option value="Otro">Otro</option>
                </select>
              </div>
            </div>

            <div id="div4" class="form-group row">
              <label for="txt18" class="col-md-2 col-form-label"><b>Especifica:</b> </label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt18" name="txt18" maxlength="45" placeholder="">
              </div>
            </div>

            <p><b>¿Qué licenciatura cursas?</b></p>

            <div class="form-group row">
              <label for="txt19" class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt19" id="txt19" class="custom-select " required="">
                  <option value="">Seleccione una opción</option>
                  <option value="Agronomía">Agronomía</option>
                  <option value="Biología">Biología</option>
                  <option value="Enfermería">Enfermería</option>
                  <option value="Estomatología">Estomatología</option>
                  <option value="Medicina">Medicina</option>
                  <option value="Medicina Veterinaria y Zootecnia">Medicina Veterinaria y Zootecnia</option>
                  <option value="Nutrición Humana">Nutrición Humana</option>
                  <option value="Química Farmacéutica Biológica">Química Farmacéutica Biológica</option>
                  <option value="Arquitectura">Arquitectura</option>
                  <option value="Diseño de la Comunicación Gráfica">Diseño de la Comunicación Gráfica</option>
                  <option value="Diseño Industrial">Diseño Industrial</option>
                  <option value="Planeación Territorial">Planeación Territorial</option>
                  <option value="Administración">Administración</option>
                  <option value="Comunicación Social">Comunicación Social</option>
                  <option value="Economía">Economía</option>
                  <option value="Política y Gestión Social">Política y Gestión Social</option>
                  <option value="Psicología">Psicología</option>
                  <option value="Sociología">Sociología</option>
                </select>
              </div>
            </div>

            <!---- otra etiqueta 4 y 5 ----->
            <p><b>¿Por qué elegiste esa licenciatura?</b></p>
            <div class="form-group row">
              <label for="txt20" class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt20" id="txt20" class="custom-select " required="" onchange="select_otro(20,5,'Otro');">
                  <option value="">Seleccione una opción</option>
                  <option value="Campo laboral">Campo laboral</option>
                  <option value="Temario">Temario</option>
                  <option value="Gusto">Gusto</option>
                  <option value="Influencia familiar">Influencia familiar</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
            </div>
            <div id="div5" class="form-group row">
              <label for="txt21" class="col-md-2 col-form-label"><b>Específica: </b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt21" name="txt21" maxlength="45" placeholder="">
              </div>
            </div>
            <!---- otra etiqueta  4 y 5 ----->   

            <!---- otra etiqueta 6 ----->
            <div class="form-group row ">
              <label class="col-md-2 col-form-label" ><b>¿Conoces el campo laboral de tu carrera?</b> </label>
              <div class="col-md-2" >
                <div class="d-flex align-items-start">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio22" id="radio22-1" value="si" onclick="s_otro(6);">
                    <label class="form-check-label" for="radio22-1">Sí</label>
                  </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio22" id="radio22-2" value="no" onclick="h_otro(6);">
                    <label class="form-check-label" for="radio22-2">No conozco</label>
                  </div>
                </div>
              </div>
            <!---- otra etiqueta 6 ----->
            <!---- otra etiqueta 7 ----->              
              <div id="div6" class="col-md-8" >
                <div class="d-flex align-items-start">
                  <label for="txt23" class="col-md-2 col-form-label fuente15" ><b>Menciona uno:</b></label>
                  <div class="col-md-4" >
                    <input type="text" required class="form-control" id="txt23" name="txt23" maxlength="45" placeholder="">
                  </div>
                </div>
              </div>
            </div>
          <!---- otra etiqueta 7 ----->         

            <p><b>¿Cuántas horas al día fuera de tus clases dedicas a estudiar y a realizar tareas?</b></p>
            <div class="form-group row">
              <label for="txt24" class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt24" id="txt24" class="custom-select " required="">
                  <option value="">Seleccione una opción</option>
                  <option value="Una hora">Una hora</option>
                  <option value="De 1 a 2 horas">De 1 a 2 horas</option>
                  <option value="De 2 a 3 horas">De 2 a 3 horas</option>
                  <option value="Más de 3 horas">Más de 3 horas</option>
                </select>
              </div>
            </div>

            <p><b>Cuando tienes alguna duda sobre las actividades o tareas del módulo que cursas <br>¿De qué manera las resuelves?</b></p>
            <div class="form-group row">
              <label for="txt25" class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt25" id="txt25" class="custom-select " required=""  onchange="lista_duda1();" >
                  <option value="">Seleccione una opción</option>
                  <option value="1">Me acerco con amigos</option>
                  <option value="2">Le pregunto a algún familiar</option>
                  <option value="3">Le pregunto a un maestro o una maestra</option>
                  <option value="4">Les pregunto a mis compañeros/as</option>
                  <option value="5">Investigo por mi cuenta</option>
                  <option value="6">No hago nada al respecto</option>
                </select>
              </div>
            </div>

            <div id="div7" class="form-group row">
              <label for="txt26" class="col-md-2 col-form-label"><b>Especifica en qué medios:</b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt26" name="txt26" maxlength="45" placeholder="">
              </div>
            </div>

            <div id="div8" class="form-group row">
              <label for="txt27" class="col-md-2 col-form-label"><b>¿Por qué?</b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt27" name="txt27" maxlength="45" placeholder="">
              </div>
            </div>

            <p><b>Cuando tienes alguna duda sobre los trámites escolares <br>¿a quién recurres para obtener información y asesoramiento al respecto?</b></p>

            <div class="form-group row">
              <label for="txt28" class="col-md-2 col-form-label"> </label>
              <div class="col-md-6">
                <select name="txt28" id="txt28" class="custom-select" required="" onchange="lista_duda2();" >
                  <option value="">Seleccione una opción</option>
                  <option value="1">Me acerco con amigos</option>
                  <option value="2">Le pregunto a un maestro o una maestra</option>
                  <option value="3">Les pregunto a mis compañeros/as</option>
                  <option value="4">Investigo por mi cuenta</option>
                  <option value="5">No hago nada al respecto</option>
                </select>
              </div>
            </div>

            <div id="div9" class="form-group row">
              <label for="txt29" class="col-md-2 col-form-label"><b>Especifica en qué medios</b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt29" name="txt29" maxlength="45" placeholder="">
              </div>
            </div>

            <div id="div10" class="form-group row">
              <label for="txt30" class="col-md-2 col-form-label"><b>¿Por qué?</b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt30" name="txt30" maxlength="45" placeholder="">
              </div>
            </div>


            <p><b>¿Con cuáles de los siguientes recursos cuentas o tienes acceso para tu estudio?</b></p>

            <div class="form-group row">
              <div class="col-md-10">

                <div class="d-flex flex-wrap align-items-start">  

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-1" value="1">
                    <label class="form-check-label" for="check31-1">
                      Computadora de escritorio
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-2" value="2">
                    <label class="form-check-label" for="check31-2">
                      Computadora portátil
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-3" value="3">
                    <label class="form-check-label" for="check31-3">
                      Internet
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-4" value="4">
                    <label class="form-check-label" for="check31-4">
                      Libros de consulta
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-5" value="5">
                    <label class="form-check-label" for="check31-5">
                      Celular con acceso a internet
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-6" value="6">
                    <label class="form-check-label" for="check31-6">
                      Cuadernos
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-7" value="7">
                    <label class="form-check-label" for="check31-7">
                      Bolígrafos
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-8" value="8">
                    <label class="form-check-label" for="check31-8">
                      Restirador
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-9" value="9">
                    <label class="form-check-label" for="check31-9">
                      Acceso a materiales/instrumentos <br>de acuerdo a tu carrera
                    </label>
                  </div>

                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" name="check31[]" id="check31-10" value="otro" onclick="check_otro('31-10',11);">
                    <label class="form-check-label" for="check31-10">
                      Otros
                    </label>
                  </div>

              </div>
                
              </div>
            </div>

            <div id="div11" class="form-group row">
              <label for="txt32" class="col-md-2 col-form-label"><b>Especifica:</b></label>
              <div class="col-md-6">
                <input type="text" required class="form-control" id="txt32" name="txt32" maxlength="45" placeholder="">
              </div>
            </div>

            <p><b>¿Qué espacio de tu hogar destinas para hacer tus tareas?</b></p>
            <div class="form-group row">
              
              <div class="col-md-8">

                <div class="d-flex flex-wrap align-items-start">  

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-1" value="1">
                    <label class="form-check-label" for="check33-1">
                      Comedor
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-2" value="2">
                    <label class="form-check-label" for="check33-2">
                      Mesa/escritorio
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-3" value="3">
                    <label class="form-check-label" for="check33-3">
                      Sala
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-4" value="4">
                    <label class="form-check-label" for="check33-4">
                      Sillón/Silla
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-5" value="5">
                    <label class="form-check-label" for="check33-5">
                      Habitación
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-6" value="6">
                    <label class="form-check-label" for="check33-6">
                      Cama
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-7" value="7">
                    <label class="form-check-label" for="check33-7">
                      Estudio
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-8" value="8">
                    <label class="form-check-label" for="check33-8">
                      Patio
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-9" value="9">
                    <label class="form-check-label" for="check33-9">
                      Jardín
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-10" value="10">
                    <label class="form-check-label" for="check33-10">
                      Terraza
                    </label>
                  </div>

                
                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check33[]" id="check33-14" value="Otro" onclick="check_otro('33-14',12);">
                    <label class="form-check-label" for="check33-14">
                      Otro
                    </label>
                  </div>
              </div>
                
              </div>
            </div>

            <div id="div12" class="form-group row">
              <label for="txt34" class="col-md-4 col-form-label">Especifica qué espacio de tu <b>hogar</b> destinas para hacer tus tareas:</label>
              <div class="col-md-4 mt-3">
                <input type="text" required class="form-control" id="txt34" name="txt34" maxlength="45" placeholder="">
              </div>
            </div>

            <p><b>¿Qué espacio externo a tu hogar destinas para hacer tus tareas?</b></p>
            <div class="form-group row">
              
              <div class="col-md-8">

                <div class="d-flex flex-wrap align-items-start">  

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check35[]" id="check35-1" value="1">
                    <label class="form-check-label" for="check35-1">
                      En la universidad
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check35[]" id="check35-2" value="2">
                    <label class="form-check-label" for="check35-2">
                      Ciber-café
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check35[]" id="check35-3" value="3">
                    <label class="form-check-label" for="check35-3">
                      Cafetería
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check35[]" id="check35-4" value="4">
                    <label class="form-check-label" for="check35-4">
                      Biblioteca 
                    </label>
                  </div>

                  <div class="form-check col-md-4">
                    <input class="form-check-input" type="checkbox" name="check35[]" id="check35-5" value="Otro" onclick="check_otro('35-5',13);">
                    <label class="form-check-label" for="check35-5">
                      Otro
                    </label>
                  </div>
                </div>
                
              </div>
            </div>

            <div id="div13" class="form-group row">
              <label for="txt36" class="col-md-4 col-form-label">Especifica qué otro espacio externo a tu hogar destinas para hacer tus tareas:</label>
              <div class="col-md-4">
                <input type="text" required class="form-control" id="txt36" name="txt36" maxlength="45" placeholder="" >
              </div>
            </div>

        <!---- etiqueta 8 y 9 ----->

        <div class="form-group row ">
          <label class="col-md-4 col-form-label" ><b>¿Practicas alguna actividad extra escolar?</b></label>
          <div class="col-md-5" >
            <div class="d-flex align-items-start">              
              <div class="form-check">
                <input class="form-check-input" type="radio" name="radio37" id="radio37-1" value="si"  onclick="s_otro(14);">
                <label class="form-check-label" for="radio37-1">
                  Sí
                </label>
              </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="radio37" id="radio37-2" value="no" onclick="h_otro(14);">
                  <label class="form-check-label" for="radio37-2">
                  No
                </label>
              </div>
            </div>
          </div>
        </div>

          <div id="div14"  class="form-group row ">
              <div class="col-md-12" >
                <div class="d-flex align-items-start">
                  <label for="txt38" class="col-md-2 col-form-label" ><b>¿Cuál?</b></label>
                  <div class="col-md-6" >
                    <input type="text" required class="form-control" id="txt38" name="txt38" placeholder="" maxlength="45"  >
                  </div>
                </div>
              </div>

              <div class="col-md-12 mt-3" >
                <div class="d-flex align-items-start">
                  <label class="col-md-2 col-form-label" ><b>¿Dónde?</b></label>
                  <div class="col-md-7" >
                    <div class="d-flex align-items-start">              
                      <div class="form-check">
                        
                        <input class="form-check-input" type="radio" name="radio39" id="radio39-1" value="UAM-X">
                        <label class="form-check-label" for="radio39-1">En la UAM-X</label>
                      </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio39" id="radio39-2" value="Externo">
                        <label class="form-check-label" for="radio39-2">
                          Externo
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <!---- etiqueta 8 y 9 ----->

          <p><b>¿Qué esperas de las sesiones de tutoría? </b></p>

          <div class="form-group row">
            <label class="col-md-2 col-form-label"> </label>
            <div class="col-md-6">
              <select name="txt40" id="txt40" class="custom-select " required=""  onchange="lista_sesion();" >
                <option value="">Seleccione una opción</option>
                <option value="1">Reforzar conocimientos de los módulos </option>
                <option value="2">Adquirir habilidades y aptitudes</option>
                <option value="3">Reforzar habilidades de comunicación</option>
                <option value="4">Conocer a más personas</option>
                <option value="5">Tener una guía para mi trayectoria académica</option>
                <option value="6">Otro</option>
              </select>
            </div>
          </div>

            <div id="div15" class="form-group row ">
              <label  for="txt41" class="col-md-2 col-form-label" ><b>Especifique:</b></label>
              <div class="col-md-6" >
                <input type="text" required class="form-control" id="txt41" name="txt41" maxlength="45" placeholder=""   >
              </div>
            </div>

            <div class="form-group row mt-5">
              <label for="" class="col-md-4 col-form-label"></label>
              <div class="col-md-8">
                <button type="button" class="btn btn-primary btn_03"  onclick="enviarDatos2();" >Enviar</button>
              </div>

            </div>
          <br><br>
          <p class="mt-2"><b></b></p>
        </form>
      </div> 
    </div>
    <footer class="py-5 bg-primary mt-5 backBlue1" style=" min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>
</html>
<?php 
}else{ 
  header("location:../matricula.php"); 
}
?>
