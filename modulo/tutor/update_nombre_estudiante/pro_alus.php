<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
	$archivo = file($_FILES['archivo']['tmp_name']); 
	$nom_archivo = $_FILES['archivo']['name'];
	$ext = pathinfo($nom_archivo, PATHINFO_EXTENSION);
	$total_ins = 0;

	function genera_codigo($alu_id){
	    $t_id= $alu_id."";
	    $tam = strlen($t_id); 
	    $t=0;
	    $con_id="";
	    while($t < $tam){  ///se recorre el ID para generar una cadena que remplace los numeros por caracteres                   
	        switch($t_id[$t]){  
	            case '0': $etr="R";
	            break;
	            case '1': $etr="S";
	            break;
	            case '2': $etr="T";
	            break;
	            case '3': $etr="U";
	            break;
	            case '4': $etr="V";
	            break;
	            case '5': $etr="W";
	            break;
	            case '6': $etr="X";
	            break;
	            case '7': $etr="Y";
	            break;
	            case '8': $etr="Z";
	            break;
	            case '9': $etr="A";
	            break;                  
	        }
	        $con_id= $con_id.$etr;
	        $t++;
	    }//fin while

	    return $con_id;
	}


	if($ext == "csv"){
		$lineas=0;
		$lineas = count($archivo);
		$cuenta=0;
		$trimestre = "23-O";
		?>
		<script type="text/javascript">
		    $(document).ready(function() {
		        $('#continuar').click(function() {
		            location.reload();
		        });
		    });
		</script>

		<h3>Datos almancenados</h3>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Matricula</th>
		      <th scope="col">alu</th>
		      <th scope="col">Resultado alumno</th>
		    </tr>
		  </thead>

			<?php
			/////// AGREGAR INSERT A TABLA, DESPUÉS MOSTRAR LA INFO QUE SE ALMACENO
		    include '../../../php/conn.php';
		    include 'pro_input.php';

		    $connection = Connection::getInstance();
		    $total_ins=0;
		    $total_fila=0;
		    $tutor_resp= "";
		    $total_nuevos = 0;
		    $espacio = "";
		   
			for($x = 1; $x < $lineas;$x++){
				
				$comienzo=$archivo[$x]; 
				$divide = (explode(',',$comienzo));	
				$nom_alu = verificaInputVal($divide[0]);
				$matricula = verificaInputVal($divide[1]);
				$correo_alu = verificaInputVal($divide[2]);
				$espacio = $divide[3];

				if($matricula != ""){ // if matricula 
					$total_sel = 0;
					$total_query_insert_alu = 0;
					$total_exi_tutor = 0;
					$total_query_insert_tutor = 0;
					$total_estu_tutor=0;
					$total_insert_alu_tutor=0;
					$alu_tutor_resp = "";
					$alu_resp ="";
					$tutor_resp = "";

					$query_exi = "SELECT * FROM ges_registro_alu where matri_alu = ? ;";
		            $stmt_exi = $connection->prepare($query_exi);
		            $stmt_exi->execute(array($matricula));
		            $total_sel = $stmt_exi->rowCount();

		            if($total_sel == 0){
		            	//$alu_resp= "Solicitar registro"; //// res 01
		            	$insert_alu = "INSERT INTO ges_registro_alu (nombre,matri_alu,correo) VALUES (?,?,?);"; 
			      		$query_insert_alu = $connection->prepare($insert_alu);
			      		$query_insert_alu->execute(array($nom_alu,$matricula,$correo_alu));
			      		$last_id   = $connection->lastInsertId();  ///último id insertado
			      		$total_query_insert_alu = $query_insert_alu->rowCount();
				        $cod =  genera_codigo($last_id);

				        $query_activa = "UPDATE ges_registro_alu SET estado ='1', codigo = ?  WHERE (idges_registro_alu = ? );";
				        $stmt_activa = $connection->prepare($query_activa);
				        $stmt_activa->execute(array($cod, $last_id));
				        $total_act=$stmt_activa->rowCount();

			      		if($total_act != 0){
		            		$alu_resp= "Inserto estudiante"; //// res 01
		            		$total_nuevos = $total_nuevos +1;
		            	}else{
		            		$alu_resp= "Error"; //// res 01
		            	}
		           	}

		           	
		           	$total_fila = $total_fila+1;
					
					?>

					<tr>
					  <td><?php echo $x; ?></td>
					  <td><?php echo $matricula; ?></td>
				      <td><?php echo $nom_alu; ?></td>
				      <td><?php echo $alu_resp; ?></td>
				    </tr>

			<?php
			} //// if matricula 
		} ////fin for

		?>
	 	</tbody>
	</table>

	<?php 
		echo "<br>Nuevos estudiante_tutor: ".$total_nuevos."<br><br>";
		echo '<button id="continuar" type="button" class="btn btn-primary" >Continuar</button>';

	}else{  //if ext
		echo "No fue posible cargar el archivo. Asegúrate de cargar un archivo con extensión CSV";
	}

}else{ // if sesión
	header("location:../../login.php"); 
}
	
?>