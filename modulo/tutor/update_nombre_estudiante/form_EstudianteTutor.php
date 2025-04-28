<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
    $_SESSION['us_tutor']=$usuario;
    $_SESSION['nombre']=$nombre_tutor;
    $_SESSION["us_correo"] = $email;

    $_SESSION["matricula"] = "0";

    /*include '../../php/conn.php';
    $connection = Connection::getInstance();*/

?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../../../css/bootstrap.min.css" >
<!--     <link rel="stylesheet" href="css/bootstrap.min.css" >   --> 
    <link rel="stylesheet" href="../../../css/estilo.css" >  
    <script src="../../../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../../../js/bootstrap.bundle.min.js"></script>

    <script src="../../../js/jquery-3.5.1.js" ></script>
    <script src="../../../js/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="../../../js/fun_consulta.js"></script> 
    <script src="../../../js/fun_info_inicial.js"></script> 
    <link rel="shortcut icon" href="../../../img/favicon_1.ico" type="image/vnd.microsoft.icon">

    <title>Tutorías UAM-X</title>
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top" style=" background-color: #6681be !important; "  >
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
                <a class="nav-link" href=""  >Coordinación de Docencia</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"  ></a>
              </li>
            </ul>
          </div>
        </div>
    </nav> 
    <!-- Navigation -->
    <div class="container"  style="padding-top: 5vh; min-height: 80vh;color: #002772;">
<!--       <div class="row">
        <div class="col-md-12" ><img class="img-fluid" src="banner.png" width="1025" height="100"></div>
      </div> -->

        <div class="row mt-5">
          <div class="col-md-12 mt-2">
            <h2>Página principal</h2>
          </div>
        </div>
        <div class="row mt-2 p-3 justify-content-center shadow rounded ">
          <div class="col-md-12 mt-2 mb-2 "  >
            <h5>Consulta últimos folios asignados</h5>
          </div>
          <div class="col-md-2 "  >
            <button type="button" onclick="consulta('ATAA');"  class="btn btn-primary btn-lg fondo_dark efecto" >ATAA</button>
          </div>
          <div class="col-md-2 "  >
            <button type="button" onclick="consulta('CD');" class="btn btn-primary btn-lg fondo_dark efecto" >CD</button>
          </div>
          <div class="col-md-2 "  >
            <button type="button" onclick="consulta('TID');" class="btn btn-primary btn-lg fondo_dark efecto" >TID</button>
          </div>
          <div class="col-md-2 "  >
            <button type="button" onclick="consulta('TIE');" class="btn btn-primary btn-lg fondo_dark efecto"  >TIE</button>
          </div>
          <div class="col-md-12 my-3"  >
            <div id="mconsulta" ></div>
          </div>
        </div>

        <!-- <div class="row mt-2 p-3 justify-content-center"> -->
        <div class="row mt-2  justify-content-around">

          <div class="col-md-3 mt-2 mb-2 p-3 shadow  rounded"  >
            Cargar lista de folios &nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-primary fondo_medium efecto" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><span class="material-icons">attach_file</span></button>
          </div>

          <div class="col-md-3 mt-2 mb-2 p-3 shadow  rounded"  >
            Consultar folio &nbsp;&nbsp;&nbsp;
            <a href="../index.php"  target="_blank" ><button type="button" class="btn btn-primary fondo_medium efecto" ><span class="material-icons">search</span></button></a>
          </div>

        </div>

    </div>

    <!--- modal  --->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form id="formulario" name="formulario" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cargar lista de folios <span class="material-icons">attach_file</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="lista_carga" >
             
              <!-- <form id="formulario" name="formulario" enctype="multipart/form-data" method="post" action="../php/pro_carga.php"> -->
                <ol>
                  <li>Genera tu lista de excel con los datos solicitados</li>
                  <li>Guarda tu archivo como tipo CSV UTF-8 (delimitado por comas)</li>
                  <li>Carga tu archivo y presiona el botón <b>Guardar Folios</b></li>
                </ol>
                <p><a href="folioEjemplo.csv"  target="_blank" >Descargar ejemplo</a></p>
            

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Archivo:</label>
                  <!-- <input type="text" class="form-control" id="recipient-name"> -->
                  <input type="file" class="form-control" name="archivo" id="archivo" accept=".csv" />
                </div>
                <div class="form-group">
                  
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary fondo_medium" value="Guardar Folios"/>
                    <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                  </div>
                  
                  <!-- <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="message-text"></textarea> -->
                </div>
              </div> <!-- div lista carga  -->
            </div>
            
          </div>
        </div>
      </form>
    </div>

    <footer class="py-5 bg-primary mt-5 backBlue1" style="min-height: 13vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>
    <script >

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });


    $(function(){
      $("#formulario").on("submit", function(e){
          e.preventDefault();
          var f = $(this);
          var archivo = $("#archivo").val();
          var ext = archivo.substring(archivo.lastIndexOf("."));

          if(archivo == ""){
            //alert("Es necesario adjuntar un archivo.");
            swal("Es necesario adjuntar un archivo.","", "error");
            $("#archivo").focus();       
            return false;

          }else if (ext != ".csv"){
            //alert("No fue posible cargar el archivo. Asegúrate de cargar un archivo con extensión CSV");
            swal("No fue posible cargar el archivo.","Asegúrate de cargar un archivo con extensión CSV.", "error");
            $("#archivo").focus();       
            return false;

          }else{
            var formData = new FormData(document.getElementById("formulario"));
            formData.append("dato", "valor");
            $.ajax({
                url: "pro_EstudianteTutor.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res){
              $("#lista_carga").html(res);
            });

          }
      });
    });

  </script>
</html>
<?php 
}else{ 
  header("location:../../../login.php"); 
}
?>