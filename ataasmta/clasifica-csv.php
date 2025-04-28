<?php

//ESTE CÓDIGO GENERA EL ARCHIVO DE EXPORTACIÓN, LO EXPORTA PERO NO LLEVA LA MATRÍCULA Y PARECE QUE NO FILTRA POR
//DIVISÓN Y PROGRAMA SELECCIONADOS
session_start();



include "./core/autoload.php";
include "./core/app/model/AlumnosData.php";
//include "./core/controller/Database.php"; // Asegúrate de tener el archivo de conexión

//$conexion = Database::connect();


// Incluye la conexión a la base de datos


$database = new Database();
$con = $database->connect();

// Inicializa variables para el conteo de registros clasificados
$data_rojo = array();
$data_ambar = array();
$data_verde = array();

// Consultas para la clasificación de los estudiantes (como en clasificacioninicial.php)
$sql_rojo = "SELECT * FROM alumnos WHERE PROM <= 7 AND (1=1)";
$sql_verde = "SELECT * FROM alumnos WHERE PROM >= 9.01 AND PROM <= 10 AND (1=1)";
$sql_ambar = "SELECT * FROM alumnos 
    WHERE NOT ((PROM <= 7) OR (PROM >= 9.01 AND PROM <= 10)) 
    AND (1=1)";

// Filtros según las entradas del usuario
if (isset($_POST['carrera']) && $_POST['carrera'] != '') {
    $sql_rojo .= " AND PLA = " . $_POST["carrera"];
    $sql_verde .= " AND PLA = " . $_POST["carrera"];
    $sql_ambar .= " AND PLA = " . $_POST["carrera"];
}

if (isset($_POST['division']) && $_POST['division'] != '') {
    $sql_rojo .= " AND DIV2 = " . $_POST["division"];
    $sql_verde .= " AND DIV2 = " . $_POST["division"];
    $sql_ambar .= " AND DIV2 = " . $_POST["division"];
}

// Ejecutar consultas y almacenar resultados
$query_rojo = $con->query($sql_rojo);
$query_verde = $con->query($sql_verde);
$query_ambar = $con->query($sql_ambar);

while($r = $query_rojo->fetch_array()) {
    $data_rojo[] = $r;
}

while($r = $query_verde->fetch_array()) {
    $data_verde[] = $r;
}

while($r = $query_ambar->fetch_array()) {
    $data_ambar[] = $r;
}

// Combina todos los datos en un solo array
$data_total = array_merge($data_rojo, $data_verde, $data_ambar);

// Genera el archivo CSV para la exportación
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="clasificacion.csv"');

$output = fopen("php://output", "w");

// Escribe las columnas del archivo CSV
fputcsv($output, array('NOM', 'PATE', 'MATE', 'Clasificacion'));

// Procesa los datos para escribirlos en el CSV
foreach ($data_total as $row) {
    $nombre = $row["NOM"];
    $paterno = $row["PATE"];
    $materno = $row["MATE"];

    // Clasifica al estudiante según los mismos criterios que en clasificacioninicial.php
    if ($row["PROM"] <= 7) {
        $clasificacion = "Alto";
    } elseif ($row["PROM"] >= 9.01 && $row["PROM"] <= 10) {
        $clasificacion = "Bajo";
    } else {
        $clasificacion = "Regular";
    }

    // Escribe la fila al CSV
    fputcsv($output, array($nombre, $paterno, $materno, $clasificacion));
}

fclose($output);
?>
