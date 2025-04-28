<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/estilo.css" >   
    <script src="js/jquery-3.5.1.slim.min.js" ></script>
    <script src="js/bootstrap.bundle.min.js"   ></script>
    <script src="js/jquery-3.5.1.js" ></script>
    <script src="js/sweetalert.min.js"></script> 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="js/fun_matri.js"></script> 
    
    <link rel="shortcut icon" href="img/favicon_1.ico" type="image/vnd.microsoft.icon">

    <title>Tutorías UAM-X</title>
  </head>
  <body class="back_portada_1">
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top backBlue1" style="background: transparent!important;">
        <div class="container">
          <a class="navbar-brand" href="">
            <img class="img-fluid" src="img/logo.png" alt="">
          </a>
          <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
          </div> -->


        </div>
    </nav>  
    <!-- Navigation -->
    <div class="container"  style="padding-top: 5vh; min-height: 77vh;">
      <div class="row mt-5 justify-content-center " style=" min-height:50vh">
        <div class="col-md-7 shadow-lg pl-5 pr-5 pt-4 pb-3 mb-5 bg-white align-self-center" style=" " >
          <h3 class="encabezado1 mb-4 text-left"><b>Completa el formulario de registro </b></h3>
            <div id="formulario1"></div>
            <form id="formlogin" >

              <div class="form-group row ">
                <label for="ap" class="col-md-4 col-form-label" ><b>Primer apellido:</b></label>
                <div class="col-md-6" >
                  <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="">
                </div>
              </div>

              <div class="form-group row ">
                <label for="am" class="col-md-4 col-form-label" ><b>Segundo apellido:</b></label>
                <div class="col-md-6" >
                  <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="">
                </div>
              </div>
                

                <div class="form-group row ">
                  <label for="nom" class="col-md-4 col-form-label" ><b>Nombre:</b></label>
                  <div class="col-md-6" >
                    <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="">
                  </div>
                </div>

                <div class="form-group row ">
                  <label for="matricula" class="col-md-4 col-form-label" ><b>Matrícula:</b></label>
                  <div class="col-md-6" >
                    <input type="text" required class="form-control" id="matricula" name="matricula" maxlength="35" placeholder="Matrícula" value="">
                  </div>
                </div>

                <div class="form-group row ">
                  <label for="correo" class="col-md-4 col-form-label" ><b>Correo electrónico institucional :</b></label>
                  <div class="col-md-6" >
                    <input type="text" required class="form-control" id="correo" name="correo" maxlength="35" placeholder="Correo electrónico institucional" value="">
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
                   <button type="button" class="btn btn-primary btn_02"  onclick="enviar_ri();" >Enviar</button>
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