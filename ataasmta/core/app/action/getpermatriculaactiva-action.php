
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
//////////////////// INSCRITO EN BLANCO
 $sql_inscrito_blanco="select * from alumnos where 1 = 1 ".
  ($_POST["carrera"]!='' ? " and plan_est = '".$_POST["carrera"]."' " : '').
 ($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" ).
 ($_POST["yeartrim"]!='' ? " and AING = '".$yy."' " : '').
 ($_POST["yeartrim"]!='' ? " and TRII = '".$tt."' " : "" )."
 AND EDO = 10 order by NOM,PATE,MATE ";
$query_ib= $con->query($sql_inscrito_blanco);
////////////////////
//////////////////// INSCRITO EN BLANCO
 $sql_no_inscrito="select * from alumnos where 1 = 1 ".
  ($_POST["carrera"]!='' ? " and plan_est = '".$_POST["carrera"]."' " : '').
 ($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" ).
 ($_POST["yeartrim"]!='' ? " and AING = '".$yy."' " : '').
 ($_POST["yeartrim"]!='' ? " and TRII = '".$tt."' " : "" )."
 AND EDO2 = 25 order by NOM,PATE,MATE ";
$query_ni= $con->query($sql_no_inscrito);
////////////////////


//echo $sql;
$query =$con->query($sql);

$data_matricula_activa = array();
while($r = $query_ma->fetch_array()){ $data_matricula_activa[] = $r; }
$data_inscrito_blanco = array();
while($r = $query_ib->fetch_array()){ $data_inscrito_blanco[] = $r; }
$data_no_inscrito = array();
while($r = $query_ni->fetch_array()){ $data_no_inscrito[] = $r; }

/*
print_r($data_matricula_activa);
print_r($data_inscrito_blanco);
print_r($data_no_inscrito);
*/
//echo count($data);
//print_r($data);
/*
$array_ambar = array();
$array_verde = array();
$array_rojo = array();
$ambar=0;
$verde =0;
$rojo=0;
foreach($data as $d){
	if(trim($d["Semaforo"])=="Ambar"){ $ambar++; $array_ambar[]=$d; }
	else if(trim($d["Semaforo"])=="Verde"){ $verde++; $array_verde[]=$d;}
	else if(trim($d["Semaforo"])=="Rojo"){ $rojo++; $array_rojo[]=$d; }
}
*/

$maximum =0;
$maximum = max(count($data_matricula_activa), count($data_inscrito_blanco), count($data_no_inscrito));

?>
<div class="card">
<div class="card-body">
<div id="myapexchart"></div>
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
categories: ['Matricula Activa', 'Inscrito en Blanco', 'No Inscrito'], // son 7 valores, deben coincidir con los valores de los datos en las series.
},
 series: [<?php echo count($data_matricula_activa); ?>, <?php echo count($data_inscrito_blanco); ?>, <?php echo count($data_no_inscrito); ?>],
    labels: ['Matricula Activa', 'Inscrito en Blanco', 'No Inscrito'],
colors:[ '#f1c40f',"#27ae60","#e74c3c" ] ,
grid: {
row: {
colors: ['#e5e5e5','transparent'], // color de fondo separados por coma para alternarlos
}
}
}

var chart = new ApexCharts( document.querySelector("#myapexchart") , options);

chart.render();
</script>

<div class="card">
	<div class="card-body">
<?php if(($maximum)>0):?>

	<table class="table">
		<thead>
			<th>Cantidad</th>
			<th>Semaforo</th>
		</thead>
			<tr>
				<td><?php echo count($data_matricula_activa); ?></td>
				<td>Matricula Activa</td>
			</tr>
			<tr>
				<td><?php echo count($data_inscrito_blanco); ?></td>
				<td>Inscrito en Blanco</td>
			</tr>
			<tr>
				<td><?php echo count($data_no_inscrito); ?></td>
				<td>No Inscrito</td>
			</tr>
	</table>
<br>

	<table class="table">
		<thead>
			<th>Matricula Activa</th>
			<th>Inscrito en Blanco</th>
			<th>No Inscrito</th>
		</thead>
		<?php for($i=0;$i<$maximum;$i++):?>
			<tr>
				<td><?php if($i<count($data_matricula_activa)){ $px= $data_matricula_activa[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td>
				<td><?php if($i<count($data_inscrito_blanco)){ $px= $data_inscrito_blanco[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td>
				<td><?php if($i<count($data_no_inscrito)){ $px= $data_no_inscrito[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td>
			</tr>
		<?php endfor;?>
	</table>
<?php else:?>
	<p class="alert alert-warning">No hay datos</p>
<?php endif; ?>
</div>
</div>