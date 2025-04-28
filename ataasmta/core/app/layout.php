<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>UAMX - Monitoreo Trayectorias Alumnado</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>

    
     <!-- DataTables
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="./dist/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="dist/apexcharts/apexcharts.css">
<script type="text/javascript" src="dist/apexcharts/apexcharts.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->



<link rel="stylesheet" type="text/css" href="./dist/jquery.autocomplete.css" media="all" />
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <?php if( isset($_SESSION["user_id"])):?>
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="./logo.png" style="height: 50px; " alt="Tabler" class="navbar-brand-image">             
            </a>
              <span class="mt-3 ms-7 text-primary"> Monitoreo de Trayectorias Académicas Alumnado</span>
          </h1>
          <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <div class="d-none d-xl-block ps-2">
                  <div><u><?php echo $_SESSION['name'];?>(<?php  if(Core::$user->tipo==1){ echo "ADMIN";}else if(Core::$user->tipo==2){ echo "RECTORIA";}else if(Core::$user->tipo==3){ echo "DIRECTOR";}  ?>)</u></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="./?view=cambiarpassword" class="dropdown-item">Cambiar contraseña</a>
                <div class="dropdown-divider"></div>
                <a href="./?action=access&opt=logout" class="dropdown-item">Salir</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="./" >

                    <span class="nav-link-title">
                      INICIO
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                   
                    <span class="nav-link-title">
                      ALUMNOS
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="./?view=datosacademicos" >
                      Datos Academicos
                    </a>

                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?view=clasificacioninicial" >

                    <span class="nav-link-title">
                      CLASIFICACION INICIAL
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?view=semaforo" >

                    <span class="nav-link-title">
                      SEMAFORO
                    </span>
                  </a>
                </li>
                  
                 <li class="nav-item">
                  <a class="nav-link" href="./?view=calificaciones" >

                    <span class="nav-link-title">
                      ALERTAS
                    </span>
                  </a>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                   
                    <span class="nav-link-title">
                      INDICADORES
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="./?view=permatriculaactiva" >
                      % Matricula Activa, inscrita en Blanco, No Inscrita
                    </a>
                    <a class="dropdown-item" href="./?view=permatricularangoedad" >
                      % Matricula Activa por Rango de Edad
                    </a>
                    <a class="dropdown-item" href="./?view=indicetitulacion" >
                      Indice de Titulacion Aparente
                    </a>
                    <a class="dropdown-item" href="./?view=promediopuntajes" >
                      Promedio de Puntajes
                    </a>

                  </div>
                </li>


                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                   
                    <span class="nav-link-title">
                      DIVERSIDAD
                    </span>
                  </a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="./?view=discapacidad" >
                      Personas con discapacidad
                    </a>
                    <a class="dropdown-item" href="./?view=gruposindigenas" >
                      Personas hablantes de lenguas indígenas
                    </a>
                    <a class="dropdown-item" href="./?view=afrodescendientes" >
                      Personas afrodescendientes
                    </a>
                                                      
                    
                  </div>
                </li>


                <?php if(Core::$user->tipo==1):?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                   
                    <span class="nav-link-title">
                      ADMINISTRACION
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="./?view=bitacora" >
                      Bitacora
                    </a>
                    <a class="dropdown-item" href="./?view=usuarios&opt=all" >
                      Usuarios
                    </a>

                  </div>
                </li>
              <?php endif;?>
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">

              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="page-wrapper">
      <?php View::load("index");?>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <!--
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary" rel="noopener">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
                  <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                  <li class="list-inline-item">
                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                      Sponsor
                    </a>
                  </li>
                </ul>
              -->
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="." class="link-secondary">CTS</a>.
                    
                  </li>
                  <li class="list-inline-item">
                    <a href="#" class="link-secondary" rel="noopener">
                      v1.0
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->

<?php else:?>
  <br><br><br>
<div class="page">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="./logo.png" height="60" >
          </a>
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Monitoreo de Trayectorias Académicas Alumnado</h2>
            <form action="./?action=access&opt=login" method="post" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Nombre de usuario</label>
                <input type="text" required name="User" class="form-control" placeholder="Tu nombre de usuario" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                  <span class="form-label-description">
<!--                    <a href="./forgot-password.html">Ol</a> -->
                  </span>
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control"  placeholder="Tu Password" name="Password"  autocomplete="off">
                </div>
              </div>
              <div class="mb-2">
                <!--
                <label class="form-check">
                  <input type="checkbox" class="form-check-input"/>
                  <span class="form-check-label">Remember me on this device</span>
                </label>
                <-->
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesion</button>
                <!-- Button trigger modal --><br><br>
<button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Recuperar Contraseña
</button>


              </div>
            </form>
          </div>

        </div>

      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperar Contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<p>Ingresa tu correo electronico para recuperar tu contraseña.</p>
<form method="post" action="./?action=recoverpassword">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Correo Electronico">
  </div>

<br>
  <button type="submit" class="btn btn-primary">Recuperar Contraseña</button>
</form>

      </div>

    </div>
  </div>
</div>
<?php endif; ?>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>

                    <!-- jQuery -->
<!-- <script src="./plugins/jquery/jquery.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- jQuery -->
<!-- <script src="./plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<!-- <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

  </body>
</html>

<?php
if(isset($_GET['exito']) AND $_GET['exito'] == 'ok'){
  echo '<script>
         Swal.fire({
  title: "Contrasena recuperada!",
  text: "Se envio un mensaje a tu correo con las instrucciones para recuperar tu password!",
  icon: "success"
});
    </script>';
}

if(isset($_GET['exito']) AND $_GET['exito'] == 'no'){
  echo '<script>
         Swal.fire({
  title: "Correo erroneo!",
  text: "Este correo no se encuentra registrado!",
  icon: "error"
});
    </script>';
}

?>