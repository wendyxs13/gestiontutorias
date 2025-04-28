<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);

$alu_nom = "Dato no encontrado";
$alu_ap = "";
$alu_am = "";
$eco = "Dato no encontrado";
$nuevo_eco = "Dato no encontrado";
$tutor_nom = "Dato no encontrado";
$tutor_ap = "Dato no encontrado";
$tutor_am = "Dato no encontrado";
$reporte = "Dato no encontrado";

if (!empty($_POST)) {
	$matri   =$_POST['matri'];
	$nuevo_eco = $_POST['nuevo_eco'];
	$trimestre =$_POST['trimestre'];

	include 'conn.php';
  $pdo = Connection::getInstance();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT est.nombre as alu_nom, est.ap as alu_ap, est.am as alu_am, est.matri_alu as matri, tutor.num_eco as eco, tutor.nombre as tutor_nom, tutor.ap as tutor_ap, tutor.am as tutor_am, status_estudiante, matri_id as reporte, descripcion from ges_registro_alu est LEFT join estudiante_tutor est_tutor on est.matri_alu=est_tutor.matricula LEFT join ges_registro_tutor tutor on tutor.num_eco=est_tutor.no_eco LEFT join ges_tutoria_individual individual on individual.tutor_id=est_tutor.no_eco and individual.matri_id=est_tutor.matricula  and est_tutor.trimestre=individual.trim_informe LEFT join cat_estatus_estudiante estatus on estatus.id_estatus_estudiante = est_tutor.status_estudiante where est.matri_alu= ? and est_tutor.trimestre= ? ;";

  $q = $pdo->prepare($sql);
  $q->execute(array($matri,$trimestre));
  $total=$q->rowCount(); 
  if($total > 0){
  	$reporte = "";
    while ($row = $q->fetch()){
      $alu_nom = "{$row['alu_nom']}";
      $alu_ap = "{$row['alu_ap']}";
      $alu_am = "{$row['alu_am']}";
      $eco = "{$row['eco']}";
      $tutor_nom = "{$row['tutor_nom']}";
      $tutor_ap = "{$row['tutor_ap']}";
      $tutor_am = "{$row['tutor_am']}";
      //$edo = "{$row['estado']}";
      $reporte = "{$row['reporte']}";
      $estatus_alu = "{$row['descripcion']}";
    }
  
	  if($reporte == NULL){
	  	$reporte = "No realizado";
	  }else{
	  	$reporte = "Realizado";
	  } 

	 	$sql2 = "SELECT nombre, ap, am, num_eco from ges_registro_tutor where num_eco= ?;";
	  $q2 = $pdo->prepare($sql2);
	  $q2->execute(array($nuevo_eco));
	  $total2=$q2->rowCount(); 
	  if($total2 > 0){
	    while ($row2 = $q2->fetch()){
	      $nt_nom = "{$row2['nombre']}";
	      $nt_ap = "{$row2['ap']}";
	      $nt_am = "{$row2['am']}";
	    }
	  }
  
	?>
	  <br>
	  <h5 class="text-center" style="color: #1C499A; text-transform: uppercase; font-weight: bold;" >Estudiante</h5>
	  <table class="table ml-4 mr-4" style="width:80%;">
	    <tbody>
	    	<tr>
	    		<td scope="col" class="" width="20%">
	    			<b>Matrícula</b> 
	    		</td>  
	        <td scope="col" class="" >
	        	<b>Nombre</b>
	        </td>
	        <td scope="col" class="" >
	        	<b>Estatus</b>
	        </td>
	        <td scope="col" class="" >
	        	<b>Trimestre</b>
	        </td>
	      </tr>
	      <tr>
	    		<td class="" width="20%">
	    			<?php echo $matri; ?>
	    		</td>  
	        <td class="">
	        	<?php echo $alu_nom." ".$alu_ap." ".$alu_am; ?>
	        </td>
	        <td class="">
	        	<?php echo $estatus_alu; ?>
	        </td>
	        <td class="">
	        	<?php echo $trimestre; ?>
	        </td>
	      </tr>
	    </tbody>
	  </table>

	 	<h5 class="text-center" style="color: #1C499A; text-transform: uppercase; font-weight: bold;">Tutor(a) actual</h5>
	  <table class="table ml-4 mr-4" style="width:80%;">
	    <tbody>
	    	<tr>
	    		<td scope="col" class="" width="20%">
	    			<b>No. Económico</b> 
	    		</td>  
	        <td scope="col" class="" >
	        	<b>Nombre</b>
	        </td>

	        <td scope="col" class=""  width="25%">
	        	<b>Informe individual</b>
	        </td>
	      </tr>
	      <tr>
	    		<td class="" width="20%">
	    			<?php echo $eco; ?>
	    		</td>  
	        <td class="">
	        	<?php echo $tutor_nom; ?>
	        </td>

	        <td class="" width="25%">
	        	<?php echo $reporte; ?>
	        </td>
	      </tr>
	    </tbody>
	  </table>

	  <h5 class="text-center" style="color: #1C499A; text-transform: uppercase; font-weight: bold;" >Nuevo tutor(a)</h5>
	  <table class="table ml-4 mr-4" style="width:80%;">
	    <tbody>
	    	<tr>
	    		<td scope="col" class="" width="20%">
	    			<b>No. Económico</b> 
	    		</td>  
	        <td scope="col" class="" >
	        	<b>Nombre</b>
	        </td>	        
	      </tr>
	      <tr>
	    		<td class="backBlue2" width="20%">
	    			<?php echo $nuevo_eco; ?>
	    		</td>  
	        <td class="backBlue2">
	        	<?php echo $nt_nom." ".$nt_ap." ".$nt_am; ?>
	        	<input type="hidden" id="matri_01" name="matri_01" value="<?php echo $matri; ?>" >
	        	<input type="hidden" id="actual" name="actual" value="<?php echo $eco; ?>">
	        	<input type="hidden" id="nuevo" name="nuevo" value="<?php echo $nuevo_eco; ?>">
	        	<input type="hidden" id="trimestre" name="trimestre" value="<?php echo $trimestre; ?>">
	        </td>
	      </tr>
	    </tbody>
	  </table>

	  <div class="ml-4 text-center">
	    <button type="button" class="btn btn-primary btn_10" onclick="cambioTutor();">
	    	<img class="img-fluid mr-1 ml-2" src="../../img/buscar.png" alt="">
	      Cambiar tutor 
	    </button>
	    <button type="button" class="btn btn-primary btn_10 ml-3" style="background-color:#97AFB9!important; border-color:#97AFB9!important; text-align: left; min-width: 170px; " onclick="cancelar();" >
	    	<img class="img-fluid mr-1 ml-2" src="../../img/x.png" alt="">
	      Cancelar
	    </button>
	  </div>
	  <br>
  	<?php

		}else{ /// $total > 0
			echo "<br><b class='ml-4'>No encontramos información referente a la matrícula ingresada.</b>";
		}
		
	}

	?>



