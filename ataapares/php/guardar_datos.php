<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 0);
error_reporting(E_ALL);

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  

include_once 'conn.php';
$pdo = Connection::getInstance();
// Leer el cuerpo de la solicitud (JSON)
$datos = json_decode(file_get_contents("php://input"), true);
if (!$datos || !isset($datos['tabla'])) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan datos (input)"]);
    exit;
}
$tipoalum = Array();
$tipoalum['at_apoyados'] = "APOYADO";
$tipoalum['at_apoyos'] = "de APOYO";

$tabla = $datos['tabla'];
if ($tabla == 'at_agenda') {
    if (!isset($datos['matri_nombre_apoyo'])) {
        echo json_encode(["status" => "error", "mensaje" => "Faltan datos (agenda)"]);
        exit;
    } else {
        $tmp = explode("-", $datos['matri_nombre_apoyo']);
        $datos['matricula_apoyo'] = $tmp[0];
        $datos['nombre_apoyo'] = $tmp[1];
        unset($datos['matri_nombre_apoyo']);
    }
}
//echo"<pre>ENTRE 3 <br />";
//var_dump($datos);
//echo"</pre>";
//exit;

unset($datos['tabla']); // Remueve 'tabla' del arreglo
// Preparar la consulta SQL dinámica
$campos = array_keys($datos);
$valores = array_map(function($value) {
    return ($value);
}, array_values($datos));
$placeholders = implode(", ", array_fill(0, count($campos), "?"));

// Crear consulta SQL
$sql = "INSERT INTO $tabla (" . implode(", ", $campos) . ") VALUES ($placeholders)";
//$query = $sql; // ver consulta completa
//foreach ($valores as $key => $valor) {
//    $query = preg_replace('/\?/', is_numeric($valor) ? $valor : "'$valor'", $query, 1);
//}
//echo $query;
//exit;
try {
// Preparar la consulta
    $stmt = $pdo->prepare($sql);
// Ejecutar la consulta con los valores
    if ($stmt->execute($valores)) {
        $id_insertado = 0;
        if ($tabla == 'at_bitacora') {
            $id_insertado = $pdo->lastInsertId();
            $sql2 = "UPDATE at_agenda 
            SET dia = '{$datos["fechasesion"]}', 
            horario = '{$datos["horainicio"]}', 
            lugar = '{$datos["lugar"]}', 
            estado_sesion = '{$datos["estado"]}' 
            WHERE id = {$datos["folio"]}";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute();
//            if ($stmt2->affected_rows > 0) {
//                echo "Registro actualizado correctamente.";
//            } else {
//                echo "No se realizaron cambios.";
//            }           
        }
        if ($tabla == 'at_agenda') {
            $id_insertado = $pdo->lastInsertId();
            $nom_apoyado = $datos['nombre_apoyado'];
            $cor_apoyado = $datos['matricula_apoyado'] . "@alumnos.xoc.uam.mx";
            $nom_apoyo = $datos['nombre_apoyo'];
            $cor_apoyo = $datos['matricula_apoyo'] . "@alumnos.xoc.uam.mx";
            $temas = $datos['temas_apoyo'];
            $correo_ataa = "ataa@correo.xoc.uam.mx";            
            $asunto = "Contacto de Apoyo entre Pares";  
            // temporalmente
//            $cor_apoyado = "envia3@correo.xoc.uam.mx";
//            $cor_apoyo = "vampudia@correo.xoc.uam.mx";                       

            $userName = "soporte.tie@correo.xoc.uam.mx"; ///cuenta de correo del remitente

            /* ### texto del correo ### */
            $texto_correo = "<html><head><title></title><link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>.contenido{ font-family: 'Open Sans', sans-serif; color: #5a5a5a; } </style> </head>
        <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr><td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
             Jornada Permanente de Apoyo entre Pares </td></tr>
        <tr><td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                <h3 style='width:100%;text-align:center;'>Folio de la cita: " . $id_insertado . "</h3>
                <p>Hola<b> " . $nom_apoyo . "</b><br>
                <br>Te informamos que <b>
                " . $nom_apoyado . "</b> esta interesad@ en que l@ apoyes con algunos temas de estudio: <br>
                " . $temas . "</p>
                    <p>Es importante que se contacten para fijar el día, la hora y el lugar de la cita</p>
            </td></tr></table><br><br></body></html>";
         
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = "tls://smtp.gmail.com";
            $mail->Port = "587"; //typically 587 
            $mail->SMTPSecure = 'tls'; // ssl is depracated
            $mail->SMTPAutoTLS = true;
            $mail->SMTPAuth = true;
            $mail->Username = $userName;
            $mail->Password = "zpsgcgfistrrnhbw";
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom($userName, "Jornada Permanente de Apoyo entre Pares"); /// Nombre y correo del remitente 
            $mail->addAddress($cor_apoyado, $nom_apoyado); /// Nombre y correo del destinatario 
            $mail->addAddress($cor_apoyo, $nom_apoyo); /// Nombre y correo del destinatario 
            $mail->addCC($correo_ataa); ///Con copia a...
            //$mail->addBCC('alguien@correo.mx'); ///Con copia oculta a...

            $mail->Subject = $asunto;
            $mail->msgHTML($texto_correo);
            $mail->AltBody = 'HTML not supported';
            $mail->send();
//            if (!$mail->send()) {
//                echo "Problemas en el envío: " . $mail->ErrorInfo;
//            } else {
//                echo "Mensaje enviado";
//            }
        
        }
        echo json_encode(["status" => "success", "folio" => $id_insertado, "mensaje" => "Datos guardados correctamente."]);
    } else {
        //"Mensaje del error: " . $errorInfo[2] . "\n";
        $errorInfo = $stmt->errorInfo();
        $error = $errorInfo[2];
        $msgerr = "Error desconocido";
        // Buscar palabras clave en el error y personalizar el mensaje
        if (($tabla == 'at_apoyados' || $tabla == 'at_apoyos') &&
                strpos($error, 'Duplicate entry') != false) {
            $msgerr = "El alumno $tipoalum[$tabla] ya está registrado (" . $datos['matricula'] . ")";
        }
        echo json_encode(["status" => "error", "mensaje" => $msgerr]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "mensaje" => "Error en la BD: " . $e->getMessage()]);
}

