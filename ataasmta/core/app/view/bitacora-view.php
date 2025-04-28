<?php
$tri = AlumnosData::getLastTrimestre();
$talumnos = AlumnosData::countByTrimestre($tri->TRII);
///////////////
$base = new Database();
$con = $base->connect();
date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
  $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','BITACORA','".$_SESSION['tipo']."',
    'BITACORA')";
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
                  BITACORA
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
            		<form id="getbitacora">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Usuario</label>
  <input name="nombre_usuario"  type="text" class="form-control" id="nombre_alumno" value="" >
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Fecha</label>
<input type="date" id="fecha" name="fecha" class="form-control">
</div>

<div class="mb-3">
<input type="submit" value="BUSCAR" class="btn btn-primary">
</div>

            		</form>


            	</div>

            </div>


            <div class="row">

            	<div class="col-md-12">
<div id="results"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#getbitacora").submit(function(e){
			e.preventDefault();

			$.post("./?action=getbitacora",$("#getbitacora").serialize(), function(data){
				$("#results").html(data);
			});

		});

			});
</script>

            	</div>

            </div>
          </div>
        </div>