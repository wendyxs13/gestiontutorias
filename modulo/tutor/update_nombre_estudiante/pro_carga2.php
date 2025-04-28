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
				$matricula = mb_convert_encoding(verificaInputVal($divide[0]),"ISO-8859-1", "UTF-8");
				 
				if($matricula != ""){ // if matricula 
					$total_ins = 0;
					$total_sel = 0;

					$query_exi = "SELECT * FROM entrevista_alumno where correo_alu = ? ;";
		            $stmt_exi = $connection->prepare($query_exi);
		            $stmt_exi->execute(array($matricula));
		            $total_sel = $stmt_exi->rowCount();

		            if($total_sel == 0){

		            	$nombre = "No encontrado";

		            }else{
                      	//////// HACE UPDATE EN LA TABLA ESTUDIANTES 
		            	while ($row = $stmt_exi->fetch()){
		            		$nombre = "{$row['nombre']}";
                      	}
		            	$sql_in = "UPDATE estudiantes SET matricula = ?, nombre = ? where correo = ? ;"; 
			      		$query = $connection->prepare($sql_in);
			      		$query->execute(array($matricula, $nombre, $correo));
			      		$total_ins = $query->rowCount();
		            }

		            /*
		            	while ($row = $stmt_exi->fetch()){
                      		$eco = "{$row['no_eco']}";
                      	}

		            }else{
		            	$sql_in = "INSERT INTO estudiante_tutor (matricula, no_eco, trimestre) VALUES (?, ?, ?);"; 
			      		$query = $connection->prepare($sql_in);
			      		$query->execute(array($matricula,$no_eco,$trimestre));
			      		$total_ins = $query->rowCount();
		            }*/
					
				?>
					<tr>
				      <td><?php echo utf8_encode($nombre); ?></td>
				      <td>
				      	<?php 
			      			if($total_ins > 0 ){ 
			      				echo "Ok";
			      				$total_fila=$total_fila+1;
			      			} else {  
			      				echo "<span class='badge badge-danger'>".$matricula."</span>"; 
			      	   		} 
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