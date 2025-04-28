<?php

error_reporting(E_ALL);
include_once 'conn.php';
$pdo = Connection::getInstance();
$mat = isset($_POST['mat']) ? $_POST['mat'] : '';
if ($mat == '') {
    echo "0#Faltan datos.";
    exit;
}
$sql = "SELECT nombre, carrera, trimestre, temas FROM at_apoyados WHERE matricula = '$mat'";
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        $dat = array();
        while ($row = $stmt->fetch()) {
            $dat['nom'] = ($row['nombre']);
            $dat['car'] = ($row['carrera']);
            $dat['tri'] = ($row['trimestre']);
            $dat['tem'] = ($row['temas']);
        }
        if (!empty($dat)) {
            //********************************************************************
            $sql = "SELECT matricula, nombre, correoins, dias, horarios, carrera, apoyo_carreras 
        FROM at_apoyos 
        WHERE carrera LIKE '" . trim($dat['car']) . "' 
           OR apoyo_carreras LIKE '%" . trim($dat['car']) . "%' 
        ORDER BY 
            CASE 
                WHEN carrera LIKE '" . trim($dat['car']) . "' THEN 1 
                ELSE 2 
            END 
        LIMIT 5;";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute()) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $datapoyo = [];
                foreach ($rows as $row) {
                    $datapoyo[] = [
                        'mat' => ($row['matricula']),
                        'nom' => ($row['nombre']),
                        'coi' => ($row['correoins']),
                        'dia' => ($row['dias']),
                        'hor' => ($row['horarios']),
                        'car' => ($row['carrera']),
                        'aca' => ($row['apoyo_carreras'])
                    ];
                }
                $json = "1#" . json_encode($dat) . "#" . json_encode($datapoyo);
                if (!empty($datapoyo)) {
                    echo $json;
                } else {
                    echo '0#No se encontraron apoyos para ' . $dat['car'];
                }
            } else {
                //"Mensaje del error: " . $errorInfo[2] . "\n";
                $errorInfo = $stmt->errorInfo();
                $msgerr = $errorInfo[2];
                echo "0#" . $msgerr;
            }
            //**********************************************************************
        } else {
            echo '0#No se encontraron datos del alumno apoyado';
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

