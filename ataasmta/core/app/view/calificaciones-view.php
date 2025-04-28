

<?php

$base = new Database();
$con = $base->connect();

date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
  $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','CALIFICACIONES','".$_SESSION['tipo']."',
    'CALIFICACIONES')";
    $con->query($sql2);

?>

     <!--  DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<style>
  .circulo {
    width: 30px;
    height: 30px;
    background-color: #90b5e2;
    -webkit-user-modify: read-write-plaintext-only;
    border-radius: 16px;
}
.leyendas {
    display: flex;
    padding: 5px;
    margin: 5px;
    justify-content: flex-end;
    align-items: center;
}
.circulo.rojo {
    background-color: #f76a6a;
}
.circulo.amarillo {
    background-color: yellow;
}
.circulo.verde {
    background-color: #12ed35;
}

.leyendas p {
    margin: 0px 5px;
}


</style>
  <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->

                <h2 class="page-title">
                  ALERTAS
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
            		<form id="getcalificaciones" >


                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Division</label>
                    <select name="division" required class="form-control" id="division_control">
                      <option value="">-- SELECCIONE --</option>
                      <?php foreach(AlumnosData::getDivisiones() as $div):?>
                  <?php if(Core::$user->tipo==3):?>
                    <?php if(Core::$user->division==$div->DIV2):?>
                        <option value="<?php echo $div->DIV2; ?>"><?php echo ($div->division); ?></option>
                      <?php break; endif; ?>
                  <?php else:?>
                        <option value="<?php echo $div->DIV2; ?>"><?php echo ($div->division); ?></option>
                  <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Carrera</label>
                  <select name="carrera" class="form-control" id="carrera_control">
                    <option value="">-- SELECCIONE --</option>

                  </select>


                </div>

                  <div class="mb-3">
                  <!-- <input type="submit" value="BUSCAR" class="btn btn-primary"> -->
                  </div>

            		</form>


            	</div>
              <!--
              <div class="col-6">
                       
                <div class="leyenda">
                  <div class="leyendas"><p class="text-sm-left"> Más de 3 UEA reprobadas</p><div class="circulo rojo"></div></div>
                  <div class="leyendas"><p class="text-sm-left"> entre 1 y 3 UEA reprobadas</p><div class="circulo amarillo"></div></div>
                  <div class="leyendas"><p class="text-sm-left"> 0 UEA reprobadas</p><div class="circulo verde"></div></div>
                </div>
              </div>

            </div>-->

            <div class="col-6">
                       
                <div class="leyenda">
                <div class="leyendas"><p class="text-sm-left"> REZAGO EN TRIMESTRES</p></div></div>
                  <div class="leyendas"><p class="text-sm-left"> Más de 3 trimestres</p><div class="circulo rojo"></div></div>
                  <div class="leyendas"><p class="text-sm-left"> entre 1 y 3 trimestres</p><div class="circulo amarillo"></div></div>
                  <div class="leyendas"><p class="text-sm-left"> Regular </p><div class="circulo verde"></div></div>
                </div>
              </div>

            </div>


            <div class="row">

            	<div class="col-md-12">
              <div id="results"></div>
            	</div>

            </div>
          </div>
        </div>

<script>
  $("#division_control").change(function(){
    $.get("./?action=getcarrerasDB","division="+$("#division_control").val(),function(data){
      // console.log(data);
      $("#carrera_control").html(data);
    });
  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#carrera_control").change(function(e){
			e.preventDefault();

			// $.post("./?action=getcalificaciones",$("#getcalificaciones").serialize(), function(data){
			// 	$("#results").html(data);
			// });

      $.post("./?action=getcalificaciones","carrera="+$("#carrera_control").val(), function(data){
        $("#results").html(data);
		  });

		});

	});
</script>
                <!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
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
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>