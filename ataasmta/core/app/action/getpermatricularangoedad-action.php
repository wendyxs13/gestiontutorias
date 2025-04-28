
<?php

$database = new Database();
$con = $database->connect();
$yeartrim = $_POST['yeartrim'];
$yytt = explode("-", $yeartrim);
$yy = $yytt[0];
$tt = $yytt[1];
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
  $sql_matricula_activa="select * from alumnos where 1 = 1 ".
  ($_POST["carrera"]!='' ? " and plan_est = '".$_POST["carrera"]."' " : '').
 ($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" ).
 ($_POST["yeartrim"]!='' ? " and AING = '".$yy."' " : '').
 ($_POST["yeartrim"]!='' ? " and TRII = '".$tt."' " : "" )."
 AND EDO = 1 order by NOM,PATE,MATE ";
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

while($r = $query_ma->fetch_array()){ 

	$data_matricula_activa[] = $r; 
	if($r["rango_edad"]=="<=18"){ $menor_18++; }
	else if($r["rango_edad"]=="19"){ $igual_19++; }
	else if($r["rango_edad"]=="20"){ $igual_20++; }
	else if($r["rango_edad"]=="21-25"){ $entre_21_25++; }
	else if($r["rango_edad"]=="26-30"){ $entre_26_30++; }
	else if($r["rango_edad"]==">30"){ $mayor_30++; }

}

//print_r($data_matricula_activa);	
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
			<tr>
				<td>Menor o Igual a 18</td>
				<td><?php echo $menor_18; ?></td>
			</tr>
			<tr>
				<td>Igual a 19</td>
				<td><?php echo $igual_19; ?></td>
			</tr>
			<tr>
				<td>Igual a 20</td>
				<td><?php echo $igual_20; ?></td>
			</tr>
			<tr>
				<td>Entre 21 y 25</td>
				<td><?php echo $entre_21_25; ?></td>
			</tr>
			<tr>
				<td>Entre 26 y 30</td>
				<td><?php echo $entre_26_30; ?></td>
			</tr>
			<tr>
				<td>Mayor que 38</td>
				<td><?php echo $mayor_30; ?></td>
			</tr>
			<tr>
				<td>Total</td>
				<td><?php echo count($data_matricula_activa); ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6"><div id="myapexchart"></div></div>

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
 series: [<?php echo $menor_18; ?>,<?php echo $igual_19; ?>,<?php echo $igual_20; ?>,<?php echo $entre_21_25; ?>,<?php echo $entre_26_30; ?>,<?php echo $mayor_30; ?>,],
    labels: ['<=18', '19', '20',"21-25","26-30",">30"],
colors:[ '#f1c40f',"#27ae60","#e74c3c","#e67e22","#3498db","#9b59b6" ] ,
grid: {
row: {
colors: ['#e5e5e5','transparent'], // color de fondo separados por coma para alternarlos
}
}
}

var chart = new ApexCharts( document.querySelector("#myapexchart") , options);

chart.render();
</script>

