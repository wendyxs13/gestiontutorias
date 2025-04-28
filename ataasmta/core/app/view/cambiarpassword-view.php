<?php

///////////////
$base = new Database();
$con = $base->connect();

date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
  $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','CAMBIAR PASSWORD','".$_SESSION['tipo']."',
    'CAMBIAR PASSWORD')";
    $con->query($sql2);
    ////////////
?>
  <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->

                <h2 class="page-title">
                  CAMBIAR CONTRASEÑA
                </h2>
              </div>
              <!-- Page title actions -->

            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
<div class="row">

            	<div class="col-md-6">
            		<form id="getinfoalumno" method="post" action="./?action=changepassword">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Contraseña Nueva</label>
  <input name="password"  type="password" required class="form-control" id="password" placeholder="Contraseña" value="" >
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Confirmar Contraseña</label>
  <input name="confirm_password" type="password" required class="form-control" id="confirm_password" placeholder="Confirmar Contraseña" value="" >
</div>

<div class="mb-3">
<input type="submit" value="ACTUALIZAR CONTRASEÑA" class="btn btn-primary">
</div>

            		</form>


            	</div>

            </div>


            <div class="row">

            	<div class="col-md-12">


            	</div>

            </div>
          </div>
        </div>