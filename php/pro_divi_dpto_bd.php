<?php
  $op_js=$_POST['con'];
//$id_com=$_POST['resp'];
//echo "con1: ".$con1." id:".$id_com;

	if ($op_js=='1'){

  	$div=$_POST['division'];
  	include 'conn.php'; 
    $connection = Connection::getInstance();

    $query_exi = "SELECT * FROM cat_div_dpto WHERE division= ?;";
    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($div));
    $total=$stmt_exi->rowCount();

    if($total > 0){
    ?>
    	<div class="form-group row ">
	      <label for="dpto" class="col-md-3 col-form-label" ><b>Departamento de Adscripción:</b></label>
	      <div class="col-md-8" >
	      	<select name="dpto" id="dpto" class="custom-select" required >
	      		<option value="" selected="selected">Elige una opci&oacute;n</option>
	      		<?php 
	      			while ($row = $stmt_exi->fetch()) {
                $id_depto = "{$row['id_depto']}";
                $depto = "{$row['depto']}";
                echo '<option value="'.$id_depto.'" >'.$depto.'</option>';
              }
	      		?>
		      </select>
	      </div>
	    </div>
    <?php 
    }

	}

?>