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

// Validar datos
if ($mat == '' || $xfo == '') {
    echo "0, $mat Faltan datos $xfo";    
    exit;
} 

// Crear consulta SQL
$tabla = "at_";
if ($xfo == "consulta") {
        $tabla .= "apoyados";        
} else if ($xfo == "consulta2") {
        $tabla .= "apoyos";       
}
$sql = "SELECT nombre FROM $tabla WHERE matricula = '$mat'";
try {
    $aluer = '';
    if ($xfo == "consulta") {
        $aluer = 'del alumno apoyado';
    } else if ($xfo == "consulta2") {
        $aluer = 'del alumno de apoyo';
    }
    $nombre = '';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
                $nombre = "{$row['nombre']}";                
        }
        if ($nombre != '') {
            // se codifican los datos de utf8
            echo "1," . ($nombre);           
        } else {
            echo "0,No se encontró el nombre $aluer";           
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

