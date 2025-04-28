<?php

error_reporting(E_ALL);
include_once 'conn.php';
$pdo = Connection::getInstance();
$mat = isset($_POST['mat']) ? $_POST['mat'] : '';
$xfo = isset($_POST['xforma']) ? $_POST['xforma'] : '';
if ($mat == '' || $xfo == '') {
    echo "0#Faltan datos";
    exit;
}
$field = "matricula_apoyado";
if ($xfo == "consulta2") {
    $field = "matricula_apoyo";
}
$sql = "SELECT id, matricula_apoyado,nombre_apoyado,matricula_apoyo,nombre_apoyo,
       licenciatura,trimestre,temas_apoyo,fecha,estado_sesion
       FROM at_agenda WHERE $field = '$mat'";
//dia,horario,lugar_apoyo,
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datapoyo = [];
        foreach ($rows as $row) {
            $data[] = [
                'fol' => ($row['id']),
                'mat' => ($row['matricula_apoyado']),
                'nom' => ($row['nombre_apoyado']),
                'car' => ($row['licenciatura']),
                'tri' => ($row['trimestre']),
                'tem' => ($row['temas_apoyo']),
                'fec' => ($row['fecha']),
                'matric' => ($row['matricula_apoyo']),
                'nombre' => ($row['nombre_apoyo']),
                'edoses' => ($row['estado_sesion'])
            ];
        }
//        echo "<pre> $xfo =>";
//        var_dump($data);
//        echo "</pre>";
//        exit;
        $json = "1#" . json_encode($data);
        if (!empty($data)) {
            echo $json;
        } else {
            echo '0#No se encontraron datos de consulta';
        }
    } else {
        //"Mensaje del error: " . $errorInfo[2] . "\n";
        $errorInfo = $stmt->errorInfo();
        $msgerr = $errorInfo[2];
        echo "0#" . $msgerr;
    }
} catch (PDOException $e) {
    echo "0#Error BD: " . $e->getMessage();
}

