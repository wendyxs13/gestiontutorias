<script type="text/javascript" src="dist/apexcharts/apexcharts.min.js"></script>

<?php

$database = new Database();
$con = $database->connect();

//echo $sql = "select * from alumnos where 1 = 1 ".($_POST["carrera"]!='' ? " and PLA = '".$_POST["carrera"]."' " : '').($_POST["division"]!='' ? "  and `DIV2` = '".$_POST["division"]."' " : "" )." order by Semaforo ";
// Clasificación en Rojo


$sql_rojo = "SELECT * FROM alumnos 
    WHERE (discapacidad = 'Sí' AND probabilidad > 0.666)";

if ($_POST['carrera'] != "") {
    $sql_rojo .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_rojo .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_rojo .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_verde = "SELECT * FROM alumnos 
    WHERE (discapacidad = 'Sí' AND (probabilidad > 0 AND probabilidad <= 0.333))";

if ($_POST['carrera'] != "") {
    $sql_verde .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_verde .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_verde .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_ambar = "SELECT * FROM alumnos 
    WHERE (discapacidad = 'Sí' AND (probabilidad > 0.333 AND probabilidad <= 0.666))";

if ($_POST['carrera'] != "") {
    $sql_ambar .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_ambar .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_ambar .= " AND TRII = \"" . $_POST['trii'] . "\"";
}





/*
$sql_rojo = "SELECT * FROM alumnos 
    WHERE PROM <= 7 
    AND (1=1)";

if ($_POST['carrera'] != "") {
    $sql_rojo .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_rojo .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_rojo .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_rojo .= "
UNION
SELECT * FROM alumnos 
WHERE (EDAD >= 26 AND EDAD <= 30 OR EDAD > 30) 
AND (1=1)";

if ($_POST['carrera'] != "") {
    $sql_rojo .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_rojo .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_rojo .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_rojo .= "
UNION
SELECT * FROM alumnos 
WHERE puntaje < 600 
AND (1=1)";

if ($_POST['carrera'] != "") {
    $sql_rojo .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_rojo .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_rojo .= " AND TRII = \"" . $_POST['trii'] . "\"";
}


$sql_verde = "SELECT * FROM alumnos 
    WHERE PROM >= 9.01 AND PROM <= 10 
    AND (1=1) 
    AND T NOT IN (SELECT T FROM ($sql_rojo) AS sub_rojo)";

if ($_POST['carrera'] != "") {
    $sql_verde .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_verde .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_verde .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_verde .= "
UNION
SELECT * FROM alumnos 
WHERE (EDAD >= 19 AND EDAD <= 20) 
AND (1=1) 
AND T NOT IN (SELECT T FROM ($sql_rojo) AS sub_rojo)";

if ($_POST['carrera'] != "") {
    $sql_verde .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_verde .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_verde .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_verde .= "
UNION 
SELECT * FROM alumnos 
WHERE puntaje >= 801 AND puntaje <= 1000 
AND (1=1) 
AND T NOT IN (SELECT T FROM ($sql_rojo) AS sub_rojo)";

if ($_POST['carrera'] != "") {
    $sql_verde .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_verde .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_verde .= " AND TRII = \"" . $_POST['trii'] . "\"";
}



$sql_ambar = "SELECT * FROM alumnos 
    WHERE 
        NOT ((PROM <= 7) OR ((EDAD >= 26 AND EDAD <= 30) OR EDAD > 30) OR (puntaje < 600)) 
    AND 
        NOT ((PROM >= 9.01 AND PROM <= 10) OR (EDAD >= 19 AND EDAD <= 20) OR (puntaje >= 801 AND puntaje <= 1000))
    AND T NOT IN (SELECT T FROM ($sql_rojo) AS sub_rojo)
    AND T NOT IN (SELECT T FROM ($sql_verde) AS sub_verde)
    AND (1=1)";

if ($_POST['carrera'] != "") {
    $sql_ambar .= " AND PLA = " . $_POST["carrera"];
}

if ($_POST['division'] != "") {
    $sql_ambar .= " AND DIV2 = " . $_POST["division"];
}

if ($_POST['trii'] != "") {
    $sql_ambar .= " AND TRII = \"" . $_POST['trii'] . "\"";
}
*/

#$sql.= "";

//echo $sql;
$query_rojo =$con->query($sql_rojo);
$query_ambar =$con->query($sql_ambar);
$query_verde =$con->query($sql_verde);

$data_rojo = array();
while($r = $query_rojo->fetch_array()){
	$data_rojo[] = $r;
}

$data_ambar = array();
while($r = $query_ambar->fetch_array()){
	$data_ambar[] = $r;
}

$data_verde = array();
while($r = $query_verde->fetch_array()){
	$data_verde[] = $r;
}

//echo count($data);
//print_r($data);

//print_r($data_ambar);
$array_ambar = $data_ambar;
$array_verde = $data_verde;
$array_rojo = $data_rojo;
$ambar=count($data_ambar);
$verde =count($data_verde);
$rojo=count($data_rojo);
/*foreach($data as $d){
	if(trim($d["Semaforo"])=="Ambar"){ $ambar++; $array_ambar[]=$d; }
	else if(trim($d["Semaforo"])=="Verde"){ $verde++; $array_verde[]=$d;}
	else if(trim($d["Semaforo"])=="Rojo"){ $rojo++; $array_rojo[]=$d; }
}*/
$_SESSION["ambar"] = $array_ambar;
$_SESSION['verde'] = $array_verde;
$_SESSION['rojo'] = $array_rojo;
$maximum = max($ambar, $verde, $rojo);

?>
<div class="card">
<div class="card-body">
<!--	<a href="./clasifica-csv.php" class="btn btn-success">Descargar (.csv)</a>  -->

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
text: 'Riesgo de rezago', // Titulo de la grafica, se muestra en la parte superior
style: {
      fontSize: '18px' // Ajusta el tamaño del título aquí
    }
},
xaxis: {
categories: ['Regular', 'Bajo', 'Alto'], // son 7 valores, deben coincidir con los valores de los datos en las series.
},
 series: [<?php echo $ambar; ?>, <?php echo $verde;?>, <?php echo $rojo; ?>],
    labels: ['Medio', 'Bajo', 'Alto'],
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
<?php if(count($data_rojo)>0 || count($data_ambar)>0 ||count($data_verde)>0 ):?>

	<table class="table">
		<thead>
			<th>Cantidad</th>
			<th>Riesgo de rezago</th>
		</thead>
			<tr>
				<td><?php echo $ambar; ?></td>
				<td>Medio</td>
			</tr>
			<tr>
				<td><?php echo $verde; ?></td>
				<td>Bajo</td>
			</tr>
			<tr>
				<td><?php echo $rojo; ?></td>
				<td>Alto</td>
			</tr>
	</table>
<br>

	<table class="table">
			<thead>
			<th>Medio</th>
			<th>Bajo</th>
			<th>Alto</th>
		</thead>
		<?php for($i=0;$i<$maximum;$i++):?>
			<tr>
				<td><?php if($i<count($array_ambar)){ $px= $array_ambar[$i];  echo $px["T"]; } ?></td>
				<td><?php if($i<count($array_verde)){ $px= $array_verde[$i];  echo $px["T"]; } ?></td>
				<td><?php if($i<count($array_rojo)){ $px= $array_rojo[$i];  echo $px["T"]; } ?></td>
			</tr>
		<?php endfor;?>
	</table>
<?php else:?>
	<p class="alert alert-warning">No hay datos</p>
<?php endif; ?>
</div>
</div>

<?php
/*
Estas líneas son para poner nombre y apellidos, en lugar de la matrícula de las lineas 154 a 156
<td><?php if($i<count($array_ambar)){ $px= $array_ambar[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td>
<td><?php if($i<count($array_verde)){ $px= $array_verde[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td>
<td><?php if($i<count($array_rojo)){ $px= $array_rojo[$i];  echo $px["NOM"]." ".$px["PATE"]." ".$px["MATE"]; } ?></td
?>
*/
