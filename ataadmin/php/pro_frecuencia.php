<?php
error_reporting(E_ALL);
session_start();
$usuario = ($_SESSION['at_usuario']);
$rol = ($_SESSION['at_rol']);

if ($usuario == '' || $rol == '') {
    header('location:index.php');
    exit();
}
if (empty($_POST) || $_POST['tabla'] == '' || $_POST['columna'] == '') {
    echo "0#Faltan datos";
    exit();
}
$tabla = $_POST['tabla'];
$columna = $_POST['columna'];

include_once 'conn.php';
$pdo = Connection::getInstance();
try {      
    $sql = "SELECT " . $columna . ", COUNT(*) AS frecuencia FROM " . $tabla . " GROUP BY " . $columna;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($rows)) {
        $data = [];
        if ($columna == 'trimestre') {
            // Orden de trimestres
            $trim = array(
                "" => 16,
                "TID" => 1,
                "2.o" => 2,
                "3.o" => 3,
                "4.o" => 4,
                "5.o" => 5,
                "6.o" => 6,
                "7.o" => 7,
                "8.o" => 8,
                "9.o" => 9,
                "10.o" => 10,
                "11.o" => 11,
                "12.o" => 12,
                "13.o" => 13,
                "14.o" => 14,
                "15.o" => 15
            );
            // Función para ordenar el arreglo
            usort($rows, function ($a, $b) use ($trim) {
                if ($trim[($a['trimestre'])] == $trim[($b['trimestre'])]) {
                    return 0; // Son iguales
                }
                return ($trim[($a['trimestre'])] < $trim[($b['trimestre'])]) ? -1 : 1;
            });
        } 
        foreach ($rows as $row) {
            $data[($row[$columna])] = $row['frecuencia'];
        }
        
        $json = "1#" . json_encode($data);
        echo $json;
    } else {
        echo '0#No se encontraron datos';
    }
} catch (PDOException $e) {
    echo "0#Error BD: " . $e->getMessage();
}