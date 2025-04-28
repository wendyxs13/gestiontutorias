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
		      <th scope="col">#</th>
		      <th scope="col">#</th>
		      <th scope="col">Matricula</th>
		      <th scope="col">alu</th>
		      <th scope="col">tutor BD</th>
		      <th scope="col">tutor excel</th>
		      <th scope="col">tutor</th>
		      <th scope="col">Resultado</th>
		      <th scope="col">Reporte</th>
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
		   
			for($x = 1; $x < $lineas;$x++){
				$comienzo=$archivo[$x]; 
				$divide = (explode(';',$comienzo));	
				$ne_excel = mb_convert_encoding(verificaInputVal($divide[0]),"ISO-8859-1", "UTF-8");
				$nom_tutor_excel = mb_convert_encoding(verificaInputVal($divide[1]),"ISO-8859-1", "UTF-8");
				$matricula = mb_convert_encoding(verificaInputVal($divide[2]),"ISO-8859-1", "UTF-8");
				$nom_alu = mb_convert_encoding(verificaInputVal($divide[3]),"ISO-8859-1", "UTF-8");
				
				if($matricula != ""){ // if matricula 
					$total_sel = 0;
					$total_01 = "";
					$total_02 = "";
					$tutor_up = "";

					$query_exi = "SELECT * FROM estudiante_tutor where matricula = ? ;";
					//$query_exi = "SELECT  no_eco, ges_registro_tutor.nombre as tutor, estudiante_tutor.matricula as matri, entrevista_alumno.nombre as alumno FROM estudiante_tutor, ges_registro_tutor, entrevista_alumno where estudiante_tutor.matricula = ? and estudiante_tutor.no_eco = ges_registro_tutor.num_eco and estudiante_tutor.matricula= entrevista_alumno.matricula ;";

		            $stmt_exi = $connection->prepare($query_exi);
		            $stmt_exi->execute(array($matricula));
		            $total_sel = $stmt_exi->rowCount();
		            //echo "total".$total_sel;

		            if($total_sel > 0){

		            	while ($row = $stmt_exi->fetch()){
		            		$no_eco = "{$row['no_eco']}";
		            		//$tutor = "{$row['tutor']}";
		            		$matri = "{$row['matricula']}";
		            		//$alumno = "{$row['alumno']}";
                      	}

                      	if($no_eco != $ne_excel){

		            		$tutor_resp= "BD: ".$no_eco." excel: ".$ne_excel. " Tutor diferente REVISA BD si el tutor ya contesto el informe individual";

		            		$query_01 = "SELECT matri_id FROM tutoria_ind where matri_id= ?  and tutor_id= ? ;";

				            $stmt_01 = $connection->prepare($query_01);
				            $stmt_01->execute(array($matricula, $no_eco));
				            $total_01 = $stmt_01->rowCount();

				            $query_02 = "SELECT num_eco FROM ges_tutoria_grupal_3 where num_eco = ?;";
				            $stmt_02 = $connection->prepare($query_02);
				            $stmt_02->execute(array($no_eco));
				            $total_02 = $stmt_02->rowCount();
				            ///echo "total 01: ".$total_01;

				            echo "UPDATE estudiante_tutor SET no_eco = $ne_excel, tutor_anterior = $no_eco WHERE (matricula = $matricula);";

				           

				            $sql_up = "UPDATE estudiante_tutor SET no_eco = ?, tutor_anterior = ? WHERE (matricula = ?);"; 
				      		$query_up = $connection->prepare($sql_up);
				      		$query_up->execute(array($ne_excel,$no_eco,$matricula));
				      		$total_up = $query_up->rowCount(); 

				      		///if($total_up != 0){

				      		if($query_up->execute(array($ne_excel,$no_eco,$matricula)) == true){ 

			            		$tutor_up = "Actualizado correctamente";
			            	}

				            /* ACTUALIZA */
				            ///if(($total_01 == 0) && ($total_02 == 0)){
				           /* if($total_01 == 0){
				            	$sql_up = "UPDATE estudiante_tutor SET no_eco = ?, tutor_anterior = ? WHERE (matricula = ?);"; 
					      		$query_up = $connection->prepare($sql_up);
					      		$query_up->execute(array($ne_excel,$no_eco,$matricula));
					      		$total_up = $query_up->rowCount();

					      		if($total_up != 0){
				            		$tutor_up = "Actualizado correctamente";
				            	}

				            } */

		            	}else{

		            		$tutor_resp= "ok";
		           		}
		            	
		           	}else{
		           		$total_insert = 0;
		           		$tutor_resp= "Sin registro deberia insertar";
		           		$no_eco = "Sin registro BD";
		            	$tutor = "Sin registro 3";
		            	$matri = "Sin registro 4";
		            	$alumno = "Sin registro 5";
		            	$trimestre = "23-P"; 

		            	$sql_insert = "INSERT INTO estudiante_tutor (matricula, no_eco, trimestre) VALUES (?, ?, ?);"; 
			      		$query_insert = $connection->prepare($sql_insert);
			      		$query_insert->execute(array($matricula,$ne_excel,$trimestre));
			      		$total_insert = $query_insert->rowCount();

			      		if($total_insert != 0){
		            		$tutor_resp= "Inserto correctamente";
		            	}

		           	}
		           	
		           	$total_fila = $total_fila+1;
					
					?>

					<tr>
					  <td><?php echo $x; ?></td>
					  <td><?php echo $total_sel; ?></td>
				      <td><?php echo $matricula; ?></td>
				      <td><?php echo $nom_alu; ?></td>
				      <td><?php echo $no_eco; ?></td>
				      <td><?php echo $ne_excel; ?></td>
				      <td><?php echo $nom_tutor_excel; ?></td>
				      <td><?php echo $tutor_resp; ?></td>
				      <td>
				      	Individual: <?php echo $total_01; ?> /
				      	Grupal: <?php echo $total_02; ?> 
				      	 / 
				      	Cambio: <?php echo $tutor_up; ?> 
				  	  </td>
				    </tr>

			<?php
			} //// if matricula 
		} ////fin for

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