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
		      <th scope="col">Nombre</th>
		      <th scope="col">Resultado</th>
		    </tr>
		  </thead>

			<?php
			/////// AGREGAR INSERT A TABLA, DESPUÉS MOSTRAR LA INFO QUE SE ALMACENO
		    include '../../../php/conn.php';
		    include 'pro_input.php';

		    $connection = Connection::getInstance();
		    $total_ins=0;
		    $total_fila=0;

			for($x = 1; $x < $lineas;$x++){
				$comienzo=$archivo[$x]; 
				$divide = (explode(',',$comienzo));	
				$nombre = mb_convert_encoding(verificaInputVal($divide[0]),"ISO-8859-1", "UTF-8");
				$correo = mb_convert_encoding(verificaInputVal($divide[1]),"ISO-8859-1", "UTF-8");
				$eco = mb_convert_encoding(verificaInputVal($divide[2]),"ISO-8859-1", "UTF-8");
				$sexo = mb_convert_encoding(verificaInputVal($divide[3]),"ISO-8859-1", "UTF-8");
				$div = mb_convert_encoding(verificaInputVal($divide[4]),"ISO-8859-1", "UTF-8");
				$dpto = mb_convert_encoding(verificaInputVal($divide[5]),"ISO-8859-1", "UTF-8");
				$estudios = mb_convert_encoding(verificaInputVal($divide[6]),"ISO-8859-1", "UTF-8");
				$lic = mb_convert_encoding(verificaInputVal($divide[7]),"ISO-8859-1", "UTF-8");
				 
				if($eco != ""){ // if matricula 
					$total_ins = 0;
					$total_sel = 0;

					$query_exi = "SELECT * FROM ges_registro_tutor where num_eco = ? ;";
		            $stmt_exi = $connection->prepare($query_exi);
		            $stmt_exi->execute(array($eco));
		            $total_sel = $stmt_exi->rowCount();
		            $edo_tutor = '1';
		            $tipo = '2';

		            if($total_sel == 0){

		            	/////$nombre = "No encontrado";
		            	///INSERT
		            	///$sql_in = "INSERT INTO ges_registro_tutor (matricula, no_eco, trimestre) VALUES (?, ?, ?);"; 
		            	$sql_in = "INSERT INTO ges_registro_tutor (nombre, num_eco, estudios, division, depto, imparte, correo, estado_tutor, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);"; 

		            
		            	///INSERT INTO ges_registro_tutor (nombre, num_eco, estudios, division, depto, imparte, correo, estado_tutor, tipo_usuario) VALUES ('nombre', 'eco', 'estudios', 'div', 'depto', 'lic', 'correo', '1', '2');

			      		$query = $connection->prepare($sql_in);
			      		$query->execute(array($nombre,$eco,$estudios,$div,$dpto,$lic,$correo,$edo_tutor,$tipo));
			      		$total_ins = $query->rowCount();

		            }else{

		            	$total_ins="Ya Existe";

		            }

					
				?>
					<tr>
				      <td><?php echo utf8_encode($nombre); ?></td>
				      <td>
				      	<?php
				      		echo $total_ins; 
				      	?>
				      </td>
				    </tr>

			<?php

				}// if matricula 
			} ///fin for

			?>
		 	</tbody>
		</table>


	<?php 
		echo "<br>Total de folios almacenados: ".($total_fila)."<br><br>";
		echo '<button id="continuar" type="button" class="btn btn-primary" >Continuar</button>';

	}else{  //if ext
		echo "No fue posible cargar el archivo. Asegúrate de cargar un archivo con extensión CSV";
	}

}else{ // if sesión
	header("location:../../login.php"); 
}
	
?>