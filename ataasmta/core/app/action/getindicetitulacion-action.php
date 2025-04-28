
<?php

$database = new Database();
$con = $database->connect();
$yeartrim = $_POST['yeartrim'];
$yy="";
$tt="";
if($_POST["yeartrim"]!=""){
$yytt = explode("-", $yeartrim);
$yy = $yytt[0];
$tt = $yytt[1];
}
//echo $sql = "select * from alumnos where 1 = 1 ".($_POST["carrera"]!='' ? " and PLA = '".$_POST["carrera"]."' " : '').($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" )." order by Semaforo ";


$sql= "select * from alumnos where 1 = 1";
if($_POST['carrera']!=""){
	$sql.= " and PLA = ".$_POST["carrera"];
}
if($_POST['division']!=""){
	$sql.= " and DIV2 = ".$_POST["division"];
}
$sql.= "";

//////////////////// MATRICULA ACTIVA
  $sql_matricula_activa="select * from alumnos where 1 = 1 and EDO=5".
  ($_POST["carrera"]!='' ? " and plan_est = '".$_POST["carrera"]."' " : '').
 ($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" ).
 ($_POST["yeartrim"]!='' ? " and AING = '".$yy."' " : '').
 ($_POST["yeartrim"]!='' ? " and TRII = '".$tt."' " : "" )." order by NOM,PATE,MATE ";
$query_ma= $con->query($sql_matricula_activa);
////////////////////

//echo $sql;
//$query =$con->query($sql);

$data_matricula_activa = array();
$menor_18 = 0;
$igual_19 = 0;
$igual_20 = 0;
$entre_21_25 = 0;
$entre_26_30 = 0;
$mayor_30 = 0;

$carreras = AlumnosData::getCarreras();
$array_data = array();

while($r = $query_ma->fetch_array()){ 
	$array_data[$r["plan_est"]][] = $r;


}
$total=0;
//print_r($array_data);	
?>
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
		<br>
		<table class="table table-bordered">
			<thead>
				<th>Clasificacion</th>
				<th>Valor</th>
			</thead>
			<?php foreach($carreras as $car):
				$val=0;
if(isset($array_data[$car->plan_est])){  $val=count($array_data[$car->plan_est]); $total+=count($array_data[$car->plan_est]); }else {  $val=0; }
				?>
				<?php if($val>0):?>
			<tr>
				<td><?php echo $car->plan_est?></td>
				<td><b><?php echo $val; ?></b></td>
			</tr>
		<?php endif; ?>
		<?php endforeach; ?>
		<tr>
			<td>Total</td>
			<td><b><?php echo $total; ?></b></td>
		</tr>
		</table>
	</div>
	<div class="col-md-6"><div id="myapexchart"></div>
</div>

</div>

</div>
</div>
<br>
<script type="text/javascript">
	var options = {
chart: {
height: 380,
type: 'pie' // se puede cambiar por 'area' y 'bar'
},
title: {
text: 'Grafica', // Titulo de la grafica, se muestra en la parte superior
},
xaxis: {
//categories: ['Matricula Activa', 'Inscrito en Blanco', 'No Inscrito'], // son 7 valores, deben coincidir con los valores de los datos en las series.
},
 series: [
			<?php foreach($carreras as $car):?>

 	<?php if(isset($array_data[$car->plan_est])){ echo count($array_data[$car->plan_est]); $total+=count($array_data[$car->plan_est]); }else { echo 0; } ?>,
<?php endforeach; ?>
 	],

    labels: [<?php foreach($carreras as $car):?>"<?php echo $car->plan_est; ?>", <?php endforeach; ?>],
colors:[ '#f1c40f',"#27ae60","#e74c3c","#e67e22","#3498db","#9b59b6","#1abc9c","#3498db","#e67e22","","#f39c12","#c0392b","#2c3e50","#d35400","#1abc9c","#2ecc71","#8e44ad","#e74c3c","#7f8c8d" ] ,
grid: {
row: {
colors: ['#e5e5e5','transparent'], // color de fondo separados por coma para alternarlos
}
}
}

var chart = new ApexCharts( document.querySelector("#myapexchart") , options);

chart.render();
</script>

