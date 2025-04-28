<?php
session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;

   $filename = $_POST['data'];
   $exporhtml = utf8_decode($_POST['html']);
   
    $ruta = "../uploads/tmpdf/$filename";
    require_once('dom_pdf/dompdf_config.inc.php');
    $dompdf = new DOMPDF();
    
    $dompdf->load_html($exporhtml);
    $dompdf->render();
    $dompdf->stream();
    $pdf = $dompdf->output();
    
    if (file_put_contents($ruta, $pdf) != false) {
        echo 'Registro generado en PDF.';
    } else {
        echo 'Error al generar el PDF.';
    }