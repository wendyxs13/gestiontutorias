<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/estilo.css" >   
    <script src="../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js"   ></script>
    <script src="../js/jquery-3.5.1.js" ></script>
    <script src="../js/sweetalert.min.js"></script> 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="../js/fun_rtutor.js"></script> 
    
    <link rel="shortcut icon" href="../img/favicon_1.ico" type="image/vnd.microsoft.icon">

    <title>Tutorías UAM-X</title>
  </head>
  <body class="back_portada_1">
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top backBlue1" style="background: transparent!important;">
        <div class="container">
          <a class="navbar-brand" href="">
            <img class="img-fluid" src="../img/logo.png" alt="">
          </a>
        </div>
    </nav>  
    <!-- Navigation -->


    <div class="container"  style="padding-top: 5vh; min-height: 77vh;">
      <div class="row mt-5 justify-content-center " style=" min-height:50vh">
        <div class="col-md-8 shadow-lg pl-5 pr-5 pt-4 pb-3 mb-5 bg-white align-self-center">
          
            <div id="formulario1" style="font-size: 1.1rem!important; text-align: justify; color: #3D414B!important; font-weight: normal!important;"></div>
            <form id="formlogin" >
              <h3 class="encabezado1 mb-4 text-center"><b>Registro a programa de Tutoría</b></h3>

              <div class="form-group row ">
                <label for="ap" class="col-md-4 col-form-label" ><b>Primer apellido:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="">
                </div>
              </div>

              <div class="form-group row ">
                <label for="am" class="col-md-4 col-form-label" ><b>Segundo apellido:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="">
                </div>
              </div>
                

              <div class="form-group row ">
                <label for="nom" class="col-md-4 col-form-label" ><b>Nombre:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="">
                </div>
              </div>

              <div class="form-group row ">
                <label for="radio5" class="col-md-4 col-form-label"><b>Sexo asignado al nacer:</b> </label>
                <div class="col-md-6">
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
                
              </div>

              <div class="form-group row ">
                <label for="economico" class="col-md-4 col-form-label" ><b>Número Económico:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="economico" name="economico" maxlength="35" placeholder="Número Económico" value="">
                </div>
              </div>

              <div class="form-group row ">
                <label for="estudios" class="col-md-4 col-form-label" ><b>Estudios que tiene a nivel licenciatura:</b></label>
                <div class="col-md-7" >

                  <select name="estudios" id="estudios" class="form-control" required >
                    <option value="">Selccione una opción</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Especialidad">Especialidad</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>
                    <option value="Posdoctorado">Posdoctorado</option>
                  </select>
                </div>
              </div>


              <div class="form-group row ">
                <label for="division" class="col-md-4 col-form-label" ><b>División Académica:</b></label>
                <div class="col-md-7" >
                  <select name="division" id="division" class="form-control" required  onChange="div_dpto();">
                    <option value="">Selccione una opción</option>
                    <option value="CBS">CBS</option>
                    <option value="CyAD">CyAD</option>
                    <option value="CSH">CSH</option>
                  </select>
                </div>
              </div>

              <div id="d_dpto">
                <!---- d_dpto  ---->
                <div class="form-group row ">
                  <label for="dpto" class="col-md-4 col-form-label" ><b>Departamento de Adscripción:</b></label>
                  <div class="col-md-7" >
                    <select name="dpto" id="dpto" class="custom-select" required >
                      <option value="" selected="selected">Elige una opci&oacute;n</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row ">
                  <label for="imparte" class="col-md-4 col-form-label" ><b>¿En qué licenciatura imparte docencia?</b></label>
                  <div class="col-md-7" >
                    <select name="imparte" id="imparte" class="custom-select" required >
                      <option value="" selected="selected">Elige una opci&oacute;n</option>
                    </select>
                  </div>
                </div>
                <!---- d_dpto  ---->
              </div>
<!-- 
              <div class="form-group row ">
                <label for="dpto" class="col-md-4 col-form-label" ><b>Departamento de Adscripción:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="dpto" name="dpto" maxlength="35" placeholder="Departamento de Adscripción" value="">
                </div>
              </div>

              <div class="form-group row ">
                <label for="imparte" class="col-md-4 col-form-label" ><b>¿En qué licenciatura imparte docencia?</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="imparte" name="imparte" maxlength="35" placeholder="¿En qué licenciatura imparte docencia?" value="">
                </div>
              </div> -->


              <div class="form-group row ">
                <label for="correo" class="col-md-4 col-form-label" ><b>Correo electrónico institucional:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="correo" name="correo" maxlength="35" placeholder="Correo electrónico institucional" value="">
                </div>
              </div>


              <div class="form-group row ">
                <label for="num_tutoria" class="col-md-4 col-form-label" ><b>Número de tutoradas y tutorados que puede atender por trimestre:</b></label>
                <div class="col-md-7" >
                  <input type="text" required class="form-control" id="num_tutoria" name="num_tutoria" maxlength="35" placeholder="Número de tutoradas y tutorados que puede atender por trimestre" value="">
                </div>
              </div>

              <div  class="form-group row" >
                <div class="col-md-10 text-center" >
                  <div class="g-recaptcha" data-sitekey = "6LdtFtEnAAAAANJer0_f_BNetN41YWf-icVQhN-b" > </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label"></label>
                <div class="col-md-8">
                   <button type="button" class="btn btn-primary btn_02"  onclick="reg_tutor();" >Enviar</button>
                </div>

              </div>
            </form>
        </div>
      </div>

 
    </div>
    <footer class="py-5 bg-primary mt-5 backBlue1" style=" min-height: 13vh; background: transparent!important;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>
</html>