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
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','DATOS ACADEMICOS','".$_SESSION['tipo']."',
    'DATOS ACADEMICOS')";
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
                  DATOS ACADEMICOS
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
            		<form id="getinfoalumno">
<div class="mb-3">
  <!--<label for="exampleFormControlInput1" class="form-label">Apellido paterno, materno y nombres</label>
  <input name="nombre_alumno"  type="text" class="form-control" id="nombre_alumno" value="" 
      onKeyPress="document.getElementById('matricula').value='';"
      onKeyUp='$("#nombre_alumno").autocomplete("./?action=listaalumnos", {
        extraParams: { 
			nombre: function() { 
			return this.value; } ,
            matr:  function() { 
			return document.getElementById("matricula").value; } 
 		},

		width: 420,

		matchContains: true,

		selectFirst: false,

		cacheLength: 0,

		max:150

	});

	$("#nombre_alumno").result(function(event, data, formatted) {

	 

		$("#nombre_alumno").val(data[1]);
		$("#matricula").val(data[2]);
 
	});' >
</div>  -->
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Matricula</label>
<input type="text" id="matricula" name="matricula" class="form-control">
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
		$("#getinfoalumno").submit(function(e){
			e.preventDefault();

			$.post("./?action=getinfoalumno",$("#getinfoalumno").serialize(), function(data){
				$("#results").html(data);
			});

		});

			});
</script>

            	</div>

            </div>
          </div>
        </div>