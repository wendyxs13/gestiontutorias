<?php
//$user = UsuariosIntData::getById($_SESSION['user_id']);


///////////////
$base = new Database();
$con = $base->connect();

date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
  $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($_SESSION['user'])."','','GENERO','".$_SESSION['tipo']."',
    'GENERO')";
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
                  GÉNERO
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
  <select name="trii" class="form-control">
    <option value="">-- SELECCIONE --</option>
    <?php foreach(AlumnosData::getTrimestres() as $div):?>
      <option value="<?php echo ($div->TRII); ?>"><?php echo ($div->AING."-".$div->TRII); ?></option>
    <?php endforeach; ?>
  </select>
</div>

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

			$.post("./?action=getgenero",$("#getsemaforo").serialize(), function(data){
				$("#results").html(data);
			});

		});

			});
</script>

            	</div>

            </div>
          </div>
        </div>