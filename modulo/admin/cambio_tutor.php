<?php
session_start();
if(isset($_SESSION['us_tutor_ad'])){
    $usuario=($_SESSION['us_tutor_ad']);
    $nombre_tutor=($_SESSION['nombre_ad']);
    $email =($_SESSION['us_correo_ad']);
    $_SESSION['us_tutor_ad']=$usuario;
    $_SESSION['nombre_ad']=$nombre_tutor;
    $_SESSION["us_correo_ad"] = $email;

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../../css/bootstrap.min.css" >
<!--     <link rel="stylesheet" href="css/bootstrap.min.css" >   --> 
    <link rel="stylesheet" href="../../css/estilo.css" >  
    <script src="../../js/jquery-3.5.1.slim.min.js" ></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>

    <script src="../../js/jquery-3.5.1.js" ></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> 
    <link rel="shortcut icon" href="../../img/favicon_1.ico" type="image/vnd.microsoft.icon">
    <title>Tutorías UAM-X</title>

    <style type="text/css">
      tbody tr:nth-child(2n+1) {
        background-color: #fff !important;
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
          <!-- <h2>Página principal</h2> -->
        </div>
      </div>

      <div class="row mt-0  justify-content-around">
          <div class="col-md-11 mt-2 mb-2 p-3 pt-2 pl-5 pr-5 shadow rounded" style="min-height: 75vh; ">
            <div class="row m-2 p-2 d-flex justify-content-between">
              <h3><b style="color: #1C499A; text-transform: uppercase;">Cambio de tutor</b></h3>
              <a href="index.php"><button type="button" class="btn btn-primary btn_10 pl-3 pr-4" ><img class="img-fluid mr-2 mb-1" src="../../img/home_01.png" alt="">Inicio</button></a>
            </div>

            <div class="ml-4">
              <!-- <h5><b>Ingresa la matrícula del estudiante</b></h5> -->
              <h5><b>Instrucciones:</b></h5>
              <ol>
                <li>Ingresa la matrícula del estudiante, trimestre y número economico del nuevo tutor.</li>
                <li>Haz clic en el botón "Buscar".</li>
                <li>Revisa que la información del estudiante y del tutor desplegada sea correcta.</li>
                <li>Haz clic en el botón "Cambiar tutor".</li>
              </ol>
            </div>

            <div id="respuesta">

              <form class="border p-4" style="max-width: 350px; margin: auto;">
                <div class="form-group">
                  <label for="matri"><b>Estudiante:</b></label>
                  <input type="text" class="form-control" id="matri" name="nuevo_eco" placeholder="Matrícula">
                </div>

                <div class="form-group">
                  <label for="trimestre"><b>Trimestre:</b></label>
                  <?php
                      include '../../php/conn.php';
                      $pdo = Connection::getInstance();
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      $sql = "SELECT * from cat_trimestre;";
                      $q = $pdo->prepare($sql);
                      $q->execute();
                      $total=$q->rowCount(); 
                    
                      echo '<select name="trimestre" id="trimestre" class="custom-select " required="">';
                      echo '<option value="">Seleccione una opción</option>';

                      if($total > 0){
                        while ($row = $q->fetch()) {
                          $trimestre = "{$row['trimestre']}";
                          echo '<option value="'.$trimestre.'">'.$trimestre.'</option>';
                        }
                      }
                      echo '</select>'; 
                    ?>
                </div>

                <div class="form-group">
                  <label for="nuevo_eco"><b>Nuevo tutor:</b></label>
                  <input type="text" class="form-control" id="nuevo_eco" name="nuevo_eco" placeholder="Número económico">
                </div>

                <div class="form-group text-center">
                  <button type="button" class="btn btn-primary btn_10 pl-3 pr-4" onclick="buscaTE();" >
                    <img class="img-fluid mr-2 mb-1" src="../../img/buscar.png" alt="">Buscar
                  </button>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

              </form>


<!--               <div class="form-group row ml-4 mt-2 pt-3 pb-3 mb-0" style="margin-right: 7%;">
                <label for="" class="col-md-2 col-form-label"><b>Estudiante:</b> </label>
                <div class="col-md-4" >
                  <input type="text" required class="form-control" id="matri" name="matri" placeholder="Matrícula" maxlength="16"  >
                </div>

                <label for="" class="col-md-2 col-form-label"><b>Nuevo tutor:</b> </label>
                <div class="col-md-4" >
                  <input type="text" required class="form-control" id="nuevo_eco" name="nuevo_eco" maxlength="16" placeholder="Número económico"  >
                </div>

                <button type="button" class="btn btn-primary btn_10 pl-3 pr-4" onclick="buscaEstudiante();" >
                    <img class="img-fluid mr-2 mb-1" src="../../img/buscar.png" alt="">Buscar
                  </button>
              </div> -->


            </div>

            
            </div>

          </div>

        </div>

    </div>

    <footer class="py-5 bg-primary mt-2 backBlue1" style="min-height: 10vh;">
      <div class="container">
        <p class="m-0 text-center text-white ">Universidad Autónoma Metropolitana / Unidad Xochimilco / 2023</p>
      </div>
    </footer> 

  </body>
    <script >
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });

      /////$('#cancelar').click(function() {
      function cancelar(){
          location.reload();
      }


      function buscaTE(){
        var ban=1;
        var matri = document.getElementById("matri").value;
        var nuevo_eco = document.getElementById("nuevo_eco").value;
        var trimestre = document.getElementById("trimestre").value;

        if (matri=="") {
         swal("Falta ingresar datos en el formulario","Por favor, ingresa la matrícula a buscar", "warning");
         ban=0;
        }
        if (trimestre=="") {
         swal("Falta ingresar datos en el formulario","Por favor, selecciona el trimestre", "warning");
         ban=0;
        }

        if(ban==1){

          $.ajax({
            type:"POST",
            url:"../../php/pro_busca02.php",
            data:{matri:matri,nuevo_eco:nuevo_eco,trimestre:trimestre},
            success:function(r){
              $('#respuesta').html(r);
            }
          });
        }
      }

      function bTutor(){
        var ban=1;
        var nuevo_eco = document.getElementById("nuevo_eco").value;
        if (nuevo_eco=="") {
         swal("Falta ingresar datos en el formulario","Por favor, ingresa el número económico a buscar", "warning");
         ban=0;
        }

        if(ban==1){

          $.ajax({
            type:"POST",
            url:"../../php/pro_busca03.php",
            data:{nuevo_eco:nuevo_eco},
            success:function(r){
              $('#respuesta_tutor').html(r);
            }
          });
        }
      }


      function cambioTutor(){
        var ban=1;
        var matri = document.getElementById("matri_01").value;
        var actual = document.getElementById("actual").value;
        var nuevo = document.getElementById("nuevo").value;
        var trimestre = document.getElementById("trimestre").value;

        /*
        if (matri=="") {
         swal("Falta ingresar datos en el formulario","Por favor, ingresa la matrícula", "warning");
         ban=0;
        }
        */

       

        if(ban==1){

          /////////////////////
         
          //////// w
          swal({
            title: "¿Son correctos los datos?",
            text: "Por favor, asegúrate de que los datos del nuevo(a) tutor(a) sea correcto. Haz clic en 'Ok' para cambiar el tutor o en 'Cancelar' para corregir la información.",
            icon: "warning",
            buttons: ["Cancelar", true],
         
          })
          .then((enviarDato) => { 
            if (enviarDato) {  ////// if enviarDato
              
            ////////// w

              $.ajax({
                type:"POST",
                url:"../../php/pro_cam_tutor.php",
                data:{matri:matri,actual:actual,nuevo:nuevo,trimestre:trimestre},
                success:function(r){
                  $('#respuesta').html(r);
                }
              });


        }else {
          return false;
        } //// if enviarDato

      });
    //////////////// w

    } //// if ban 1

  } 


    </script>
</html>

<?php 
}else{ 
  header("location:../../login.php"); 
}
?>
