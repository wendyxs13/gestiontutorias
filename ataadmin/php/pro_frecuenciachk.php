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

    $sql = "SELECT " . $columna . " FROM " . $tabla;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($rows)) {
        $frecuencias = [];
        foreach ($rows as $k => $row) {
            //echo "\n <br />$k => " . var_dump($row); 
            $row[$columna] = trim($row[$columna]);
            $row[$columna] = preg_replace("|, |", ",", $row[$columna]);
            // Separar los valores por comas y limpiar los espacios                
            $valores = array_map('trim', explode(',', $row[$columna]));
            //echo "\n" . var_dump($valores); 
            foreach ($valores as $valor) {
                if (!empty($valor)) {
                    if (!isset($frecuencias[$valor])) {
                        $frecuencias[$valor] = 0;
                    }
                    $frecuencias[$valor] ++;
                }
            }
        }
        unset($rows);
        $rows = [];
        $i = 0;
        foreach ($frecuencias as $key => $val) {
            $rows[$i][$columna] = $key;
            $rows[$i]['frecuencia'] = $val;
            $i++;
        }

        if ($columna == 'dias') {
            // Orden de los días de la semana
            $ordenDias = array(
                "" => 0,
                "Lunes" => 1,
                "Martes" => 2,
                "Miércoles" => 3,
                "Jueves" => 4,
                "Viernes" => 5,
                "Sábado" => 6,
                "Domingo" => 7
            );
            // Función para ordenar el arreglo
            usort($rows, function ($a, $b) use ($ordenDias) {
                if ($ordenDias[($a['dias'])] == $ordenDias[($b['dias'])]) {
                    return 0; // Son iguales
                }
                return ($ordenDias[($a['dias'])] < $ordenDias[($b['dias'])]) ? -1 : 1;
            });
        } else if ($columna == 'apoyo_carreras') {
            usort($rows, function ($a, $b) {
                return strcmp($a['apoyo_carreras'], $b['apoyo_carreras']);
            });        
        } else if ($columna == 'horarios') {
            usort($rows, function ($a, $b) {
                return strcmp($a['horarios'], $b['horarios']);
            });
        }
//        echo "<pre>";
//        var_dump($rows);
//        echo "</pre>";
//        exit;
        $data = [];
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




