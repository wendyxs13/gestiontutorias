<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 0);
error_reporting(E_ALL);

include_once 'conn.php';
$pdo = Connection::getInstance();
// Leer el cuerpo de la solicitud (JSON)
$mat = isset($_POST['mat']) ? $_POST['mat'] : '';
$xfo = isset($_POST['xforma']) ? $_POST['xforma'] : '';
$fol = isset($_POST['folio']) ? $_POST['folio'] : '';

// Validar datos
if ($mat == '' || $xfo == '' || $fol == '') {
    echo "0, Faltan datos";    
    exit;
} 

// Crear consulta SQL
if ($xfo == "experiencia") {
    $fieldmat = "matricula_apoyado";    
}
if ($xfo == "bitacora") {
    $fieldmat = "matricula_apoyo";  
}
$sql = "SELECT nombre_apoyado, trimestre, nombre_apoyo
       FROM at_agenda WHERE $fieldmat = '$mat' AND id = '$fol'";
try {  
    $aluer = '';
    if ($xfo == "experiencia") {
        $aluer = 'del alumno apoyado';
    } else if ($xfo == "bitacora") {
        $aluer = 'del alumno de apoyo';
    }
    $nombre = '';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
                $nombre_apoyado = "{$row['nombre_apoyado']}"; 
                $nombre_apoyo = "{$row['nombre_apoyo']}";
        }
        if ($nombre_apoyado != '' && $nombre_apoyo != '') {           
            echo "1," . $nombre_apoyado . "," . $nombre_apoyo;           
        } else {
            echo "0,No se encontró el folio ni la matrícula $aluer";           
        }
    } else {
        //"Mensaje del error: " . $errorInfo[2] . "\n";
        $errorInfo = $stmt->errorInfo();
        $msgerr = $errorInfo[2] ;  
        echo "0,$msgerr";
    }
} catch (PDOException $e) {
    echo "0,Error ". $e->getMessage();
}

