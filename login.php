<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/estilo.css" >
<!--     <link rel="stylesheet" href="css/bootstrap.min.css" >   -->   
    <script src="js/jquery-3.5.1.slim.min.js" ></script>
    <script src="js/bootstrap.bundle.min.js"   ></script>
    <script src="js/jquery-3.5.1.js" ></script>
    <script src="js/sweetalert.min.js"></script> 
    <script type="text/javascript" src="js/fun_log.js"></script> 
    <link rel="shortcut icon" href="img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>

    <style>

      input::placeholder {
        font-size: 12px;
      }

    </style>

    
  </head>
  <body style=" background-image: url(img/back_azul1.jpg)!important; background-size: cover; background-repeat: no-repeat; background-position-y: 25%;">
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top backBlue1">
        <div class="container">
          <a class="navbar-brand" href="">
            <img class="img-fluid" src="img/logo.png" alt="">
          </a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto smooth-scroll ">
              <li class="nav-item">
                <a class="nav-link text-white" href=""><b>Tutorías</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"  ></a>
              </li>
            </ul>
          </div>
        </div>
    </nav>  
    <!-- Navigation -->
    <div class="container"  style="padding-top: 5vh; min-height: 77vh;">

      <div class="row mt-5 justify-content-center " style=" min-height:50vh">
        <div class="col-md-5 shadow-lg pl-5 pr-5 pt-4 pb-3 mb-5 mt-3 bg-white align-self-center" style=" " >
          <h3 class="encabezado1 mb-5 text-center"><b>¡Bienvenid@!</b></h3>
            <div id="formulario1"></div>
            <form id="formlogin" >

              <div class="form-group row ">
                <label for="email" class="col-md-4 col-form-label" ><b>Usuario: </b></label>
                <div class="col-md-8" >
                  <input type="email" required class="form-control" id="email" name="email" placeholder="Correo electrónico institucional" >
                </div>
              </div>

              <div class="form-group row">
                <label for="pass" class="col-md-4 col-form-label"><b>Contraseña: </b></label>
                <div class="col-md-8">
                  <input type="password" required class="form-control" id="pass" name="pass" placeholder="Contraseña" >
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label"></label>
                <div class="col-md-8">
                   <button type="button" class="btn btn-primary btnGreen1"  onclick="enviarl();" >Enviar</button>
                </div>

                <p class="mt-3">
                  Si aún no concluyes el curso para tutores y tutoras de la UAM Xochimilco, accede <a href="http://envia3.xoc.uam.mx/xcsc/si_eva_omr56/" class="badge badge-secondary btnGreen1" target="_blank">aquí</a>.
                </p>


              </div>
            </form>
        </div>
      </div>

 <!--        <div class="row mt-5">
          <div class="col-md-12 mt-5" ><h3 class="encabezado1">¡Bienvenid@!</h3></div>
        </div>
 -->
 
<!---  
        <div class="col-md-12 mt-5"  >
          
          <?php //echo $msj2; ?>
            <div  id="formulario1" ></div>

            form login 
              <form id="formlogin" >
                <div class="form-group row ">
                  <label for="email" class="col-md-2 col-form-label" ><b>Usuario: </b></label>
                  <div class="col-md-4" >
                    <input type="email" required class="form-control" id="email" name="email" placeholder="Usuario">
                  </div>
                </div>

              <div class="form-group row">
                <label for="pass" class="col-md-2 col-form-label"><b>Contraseña: </b></label>
                <div class="col-md-4">
                  <input type="password" required class="form-control" id="pass" name="pass" placeholder="Contraseña">
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label"></label>
                <div class="col-md-8">
                   <button type="button" class="btn btn-primary btnGreen1"  onclick="enviarl();" >Enviar</button>
                </div>

              </div>
              <br><br>
              <p class="mt-2"><b></b></p>
            </form>
      </div>  --->
    </div>
    <footer class="py-5 bg-primary mt-5 backBlue1" style=" min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>
</html>