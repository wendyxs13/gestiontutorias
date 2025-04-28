<?php
  $op_js=$_POST['con'];
//$id_com=$_POST['resp'];
//echo "con1: ".$con1." id:".$id_com;



	if ($op_js=='1'){

  	$div=$_POST['division'];
  	include 'conn.php';
    $connection = Connection::getInstance();

    if($div=='CyAD'){
      $div_se1='selected="selected"';
      ?>
	    <div class="form-group row ">
	      <label for="dpto" class="col-md-4 col-form-label" ><b>Departamento de Adscripción:</b></label>
	      <div class="col-md-7" >
	      	<select name="dpto" id="dpto" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="1">Métodos y sistemas</option>
		        <option value="2">Síntesis creativa</option>
		        <option value="3">Tecnología y producción</option>
		        <option value="4">Teoría y análisis</option>
		        <option value="5">Dirección de Ciencias y Artes para el Diseño</option>
		        <option value="6">Secretaria académica CyAD</option>
		      </select>
	        <!-- <input type="text" required class="form-control" id="dpto" name="dpto" maxlength="35" placeholder="Departamento de Adscripción" value=""> -->
	      </div>
	    </div>

	    <div class="form-group row ">
	      <label for="imparte" class="col-md-4 col-form-label" ><b>¿En qué licenciatura imparte docencia?</b></label>
	      <div class="col-md-7" >
	      	<select name="imparte" id="imparte" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="Arquitectura">Arquitectura</option>
		        <option value="Diseño de la Comunicación Gráfica">Diseño de la Comunicación Gráfica</option>
		        <option value="Diseño Industrial">Diseño Industrial</option>
		        <option value="Planeación Territorial">Planeación Territorial</option>
		      </select>
	      </div>
	    </div>

	  <?php
    }

    if($div=='CBS'){
      $div_se1='selected="selected"';
      ?>
	    <div class="form-group row ">
	      <label for="dpto" class="col-md-4 col-form-label" ><b>Departamento de Adscripción:</b></label>
	      <div class="col-md-7" >
	      	<select name="dpto" id="dpto" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="7">Atención a la salud</option>
		        <option value="8">El hombre y su ambiente</option>
		        <option value="9">Producción agrícola y animal</option>
		        <option value="10">Sistemas biológicos</option>
		        <option value="11">Dirección de Ciencias Biológicas y de la Salud</option>
		        <option value="12">Secretaria académica CBS</option>
		      </select>
	        <!-- <input type="text" required class="form-control" id="dpto" name="dpto" maxlength="35" placeholder="Departamento de Adscripción" value=""> -->
	      </div>
	    </div>

	    <div class="form-group row ">
	      <label for="imparte" class="col-md-4 col-form-label" ><b>¿En qué licenciatura imparte docencia?</b></label>
	      <div class="col-md-7" >
	      	<select name="imparte" id="imparte" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="Agronomía">Agronomía</option>
		        <option value="Biología">Biología</option>
		        <option value="Enfermería">Enfermería</option>
		        <option value="Estomatología">Estomatología</option>
		        <option value="Medicina">Medicina</option>
		        <option value="Medicina Veterinaria y Zootecnia">Medicina Veterinaria y Zootecnia</option>
		        <option value="Nutrición Humana">Nutrición Humana</option>
		        <option value="Química Farmacéutica Biológica">Química Farmacéutica Biológica</option>
		      </select>
	      </div>
	    </div>

	  <?php
    }

    if($div=='CSH'){
      $div_se1='selected="selected"';
      ?>
	    <div class="form-group row ">
	      <label for="dpto" class="col-md-4 col-form-label" ><b>Departamento de Adscripción:</b></label>
	      <div class="col-md-7" >
	      	<select name="dpto" id="dpto" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="13">Relaciones sociales</option>
		        <option value="14">Política y cultura</option>
		        <option value="15">Producción económica</option>
		        <option value="16">Educación y comunicación</option>
		        <option value="17">Dirección de Ciencias Sociales y Humanidades</option>
		        <option value="18">Secretaria académica CSH</option>
		      </select>
	        <!-- <input type="text" required class="form-control" id="dpto" name="dpto" maxlength="35" placeholder="Departamento de Adscripción" value=""> -->
	      </div>
	    </div>

	    <div class="form-group row ">
	      <label for="imparte" class="col-md-4 col-form-label" ><b>¿En qué licenciatura imparte docencia?</b></label>
	      <div class="col-md-7" >
	      	<select name="imparte" id="imparte" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
		      	<option value="Administración">Administración</option>
		        <option value="Comunicación Social">Comunicación Social</option>
		        <option value="Economía">Economía</option>
		        <option value="Política y Gestión Social">Política y Gestión Social</option>
		        <option value="Psicología">Psicología</option>
		        <option value="Sociología">Sociología</option>
		      </select>
	      </div>
	    </div>

	  <?php
    }



	}

?>



