<?php
error_reporting(E_ALL);
set_time_limit(0);
session_start();
$usuario = ($_SESSION['at_usuario']);
$rol = ($_SESSION['at_rol']);

if ($usuario == '' || $rol == '') {
    header('location:index.php');
    exit();
}
if (empty($_POST) || $_POST['tabla'] == '') {
    echo "0#Faltan datos";
    exit();
}
$tabla = $_POST['tabla'];

include_once 'conn.php';
$pdo = Connection::getInstance();
try {
    // Obtener los nombres de las columnas
    $sqlColumns = "SELECT COLUMN_NAME 
                   FROM INFORMATION_SCHEMA.COLUMNS 
                   WHERE TABLE_NAME = :tabla
                   ORDER BY ORDINAL_POSITION";

    $stmt = $pdo->prepare($sqlColumns);
    $stmt->bindParam(':tabla', $tabla, PDO::PARAM_STR);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($columns)) {
        echo '0#No se encontraron columnas';
        exit();
    }
    // Construir la consulta SELECT dinámica    
    $columnList = implode(",", $columns);
    $sql = "SELECT * FROM $tabla";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $data = [];
        $i = -1;
        foreach ($rows as $row) {
            $i++;
            foreach ($columns as $col) {                
                $data[$i][$col] = $row[$col];
            }
        }
        
        $json = "1#" . json_encode($data) . "#" . $columnList;
        echo $json;
    } else {
        echo '0#No se encontraron datos';
    }
} catch (PDOException $e) {
    echo "0#Error BD: " . $e->getMessage();
}




