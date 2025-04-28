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
		      <th scope="col">tutor BD</th>
		      <th scope="col">tutor excel</th>
		      <th scope="col">Resultado alumno</th>
		      <th scope="col">Resultado tutor</th>
		      <th scope="col">Resultado alu_tutor</th>
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
		   
			for($x = 1; $x < $lineas;$x++){
				$div = $dpto = $estudios = $imparte = $cambio = $correo_tutor = $nom_alu = $sex_alu = "";
				$comienzo=$archivo[$x]; 
				$divide = (explode(',',$comienzo));	
				$nom_tutor = mb_convert_encoding(verificaInputVal($divide[0]),"ISO-8859-1", "UTF-8");
				$ne_excel = mb_convert_encoding(verificaInputVal($divide[1]),"ISO-8859-1", "UTF-8");
				$matricula = verificaInputVal($divide[2]);
				$nom_alu = $divide[3];


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
		            	$alu_resp= "Solicitar registro"; //// res 01
		            	/*
		            	$insert_alu = "INSERT INTO ges_registro_alu (nombre, ap, am, matri_alu, correo, estado, codigo) VALUES (?,?,?,?,?);"; 
			      		$query_insert_alu = $connection->prepare($insert_alu);
			      		$query_insert_alu->execute(array($nom_alu,$ap_alu,$ap_alu,$matricula,$correo_alu));
			      		$total_query_insert_alu = $query_insert_alu->rowCount();
			      		if($total_query_insert_alu != 0){
		            		$alu_resp= "Inserto estudiante"; //// res 01
		            	}*/
		           	}

		           	$query_exi_tutor = "SELECT * FROM ges_registro_tutor where num_eco = ? ;";
		            $stmt_exi_tutor = $connection->prepare($query_exi_tutor);
		            $stmt_exi_tutor->execute(array($ne_excel));
		            $total_exi_tutor = $stmt_exi_tutor->rowCount();

		            if($total_exi_tutor == 0){
		            	$tutor_resp= "Solicitar registro"; //// res 02

		            	/*
		            	$insert_tutor = "INSERT INTO ges_registro_tutor (nombre,num_eco,estudios,division,depto,imparte,correo) VALUES (?,?,?,?,?,?,?);"; 
			      		$query_insert_tutor = $connection->prepare($insert_tutor);
			      		$query_insert_tutor->execute(array($nom_tutor,$ne_excel,$estudios,$div,$dpto,$imparte,$correo_tutor));
			      		$total_query_insert_tutor = $query_insert_tutor->rowCount();
			      		if($total_query_insert_tutor != 0){
		            		$tutor_resp= "Inserto tutor"; //// res 02
		            	}*/
		           	}

		           	$query_estu_tutor = "SELECT * FROM estudiante_tutor where matricula = ? ;";
		            $stmt_estu_tutor = $connection->prepare($query_estu_tutor);
		            $stmt_estu_tutor->execute(array($matricula));
		            $total_estu_tutor = $stmt_estu_tutor->rowCount();

		            if($total_estu_tutor > 0){
		            	while ($row = $stmt_estu_tutor->fetch()){
		            		$ne_bd = "{$row['no_eco']}";
		            		$matri_bd = "{$row['matricula']}";
                      	}
                      	if($ne_bd != $ne_excel){
                      		$alu_tutor_resp = "El tutor es diferente en la BD"; //// res 03
                      	}else{
                      		$alu_tutor_resp = "El tutor es igual"; //// res 03
                      	}
                    }else{
                    	$sql_insert_alu_tutor = "INSERT INTO estudiante_tutor (matricula, no_eco, trimestre) VALUES (?, ?, ?);"; 
			      		$q_insert_alu_tutor   = $connection->prepare($sql_insert_alu_tutor);
			      		$q_insert_alu_tutor->execute(array($matricula,$ne_excel,$trimestre));
			      		$total_insert_alu_tutor = $q_insert_alu_tutor->rowCount();
			      		if($total_insert_alu_tutor != 0){
		            		$alu_tutor_resp= "Inserto tutor y estudiante";
		            		$total_nuevos = $total_nuevos +1;
		            	}
                    }
		           	
		           	$total_fila = $total_fila+1;
					
					?>

					<tr>
					  <td><?php echo $x; ?></td>
					  <td><?php echo $matricula; ?></td>
				      <td><?php echo $nom_alu; ?></td>
				      <td><?php echo $ne_bd; ?></td>
				      <td><?php echo $ne_excel; ?></td>
				      <td><?php echo $alu_resp; ?></td>
				      <td><?php echo $tutor_resp; ?></td>
				      <td><?php echo $alu_tutor_resp; ?></td>
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