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
		      <th scope="col">tutor excel</th>
		      <th scope="col">Resultado tutor</th>
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
		    $ne_bd = 0;
		   
			for($x = 1; $x < $lineas;$x++){
				$div = $dpto = $estudios = $imparte = $cambio = $correo_tutor = $nom_alu = $sex_alu = "";
				$comienzo=$archivo[$x]; 
				$divide = (explode(',',$comienzo));	
				$nom_tutor = verificaInputVal($divide[0]);
				$sex_tutor = mb_convert_encoding(verificaInputVal($divide[1]),"ISO-8859-1", "UTF-8");
				$ne_excel = mb_convert_encoding(verificaInputVal($divide[2]),"ISO-8859-1", "UTF-8");
				$div = mb_convert_encoding(verificaInputVal($divide[3]),"ISO-8859-1", "UTF-8");
				$dpto = $divide[4];
				$estudios = $divide[5];
				$imparte = $divide[6];
				$correo_tutor = $divide[7];
				
				if($ne_excel != ""){ // if matricula 
					$total_sel = 0;
					$total_query_insert_alu = 0;
					$total_exi_tutor = 0;
					$total_query_insert_tutor = 0;
					$total_estu_tutor=0;
					$total_insert_alu_tutor=0;
					$alu_tutor_resp = "";
					$alu_resp ="";
					$tutor_resp = "";
					$estado = 1;
					
		           	$query_exi_tutor = "SELECT * FROM ges_registro_tutor where num_eco = ? ;";
		            $stmt_exi_tutor = $connection->prepare($query_exi_tutor);
		            $stmt_exi_tutor->execute(array($ne_excel));
		            $total_exi_tutor = $stmt_exi_tutor->rowCount();

		            if($total_exi_tutor == 0){
		            	///$tutor_resp= "Solicitar registro"; //// res 02

		            	$insert_tutor = "INSERT INTO ges_registro_tutor (nombre,sexo,num_eco,estudios,division,depto,imparte,correo,estado_tutor) VALUES (?,?,?,?,?,?,?,?,?);"; 
			      		$query_insert_tutor = $connection->prepare($insert_tutor);
			      		$query_insert_tutor->execute(array($nom_tutor,$sex_tutor,$ne_excel,$estudios,$div,$dpto,$imparte,$correo_tutor,$estado));
			      		$total_query_insert_tutor = $query_insert_tutor->rowCount();
			      		if($total_query_insert_tutor != 0){
		            		$tutor_resp= "Inserto tutor"; //// res 02
		            		$total_nuevos = $total_nuevos +1;
		            	}
		           	}

		           	
		           	$total_fila = $total_fila+1;
					
					?>

					<tr>
					  <td><?php echo $x; ?></td>
				      <td><?php echo $ne_excel; ?></td>
				      <td><?php echo $tutor_resp; ?></td>
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