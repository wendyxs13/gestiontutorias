<?php
$tri = AlumnosData::getLastTrimestre();
$talumnos = AlumnosData::countByTrimestre($tri->TRII);
///////////////
$base = new Database();
$con = $base->connect();
  $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','MATRICULA ACTIVA, INSCRITA EN BLANCO, NO INSCRITA','".$_SESSION['tipo']."',
    'MATRICULA ACTIVA, INSCRITA EN BLANCO, NO INSCRITA')";
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
                  % MATRICULA ACTIVA, INSCRITA EN BLANCO, NO INSCRITA
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
            		<form id="getsemaforo" >
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">A&Ntilde;O - Trimestre</label>
  <select name="yeartrim" class="form-control">
    <option value="">-- SELECCIONE --</option>
    <?php foreach(AlumnosData::getTrimestres() as $div):?>
      <option value="<?php echo ($div->AING."-".$div->TRII); ?>"><?php echo ($div->AING."-".$div->TRII); ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Division</label>
  <select name="division" class="form-control" id="division_control">
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
    <option value="">-- SELECCIONE DIVISION --</option>
  </select>


</div>
<script>
  $("#division_control").change(function(){
    $.get("./?action=getcarreras","division="+$("#division_control").val(),function(data){
      console.log(data);
      $("#carrera_control").html(data);
    });
  });
</script>
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
		$("#getsemaforo").submit(function(e){
			e.preventDefault();

			$.post("./?action=getpermatriculaactiva",$("#getsemaforo").serialize(), function(data){
				$("#results").html(data);
			});

		});

			});
</script>

            	</div>

            </div>
          </div>
        </div>