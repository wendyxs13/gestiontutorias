<?php

error_reporting(E_ALL);
include_once 'conn.php';
$pdo = Connection::getInstance();
// Leer el cuerpo de la solicitud (JSON)
$datos = json_decode(file_get_contents("php://input"), true);

// Validar datos
if (!$datos || !isset($datos['tabla'])) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan datos"]);
    exit;
}
// Obtener la tabla y limpiar su valor
$tabla = $datos['tabla'];
//echo"<pre>4=><br />";
//var_dump($datos);
//echo"</pre>";
//exit;

unset($datos['tabla']); // Remueve 'tabla' del arreglo
$fieldVal = '';
$whereVal = '';
$c = 0;
foreach ($datos as $key => $valor) {
    //echo "$key => $valor";
    if ($c == 0 && ($key == 'matricula' || $key == 'id')) { 
        $whereVal = "$key = '$valor'";
        $c++;
        continue;         
    }
    $fieldVal .= $key . "='" . ($valor) . "',";
}
$sql =  "UPDATE $tabla SET " . trim($fieldVal,",") . " WHERE $whereVal;";

try {
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    // Ejecutar la consulta 
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "mensaje" => "Datos actualizados correctamente."]);
    } else {
        //"Mensaje del error: " . $errorInfo[2] . "\n";
        $errorInfo = $stmt->errorInfo();
        $error = $errorInfo[2];           
        echo json_encode(["status" => "error", "mensaje" => $error]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "mensaje" => "Error en la BD: " . $e->getMessage()]);
}

