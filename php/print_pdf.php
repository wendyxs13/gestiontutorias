<?php
session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;


    //require 'dompdf/autoload.inc.php';
    //require 'dompdf/vendor/autoload.php';
    require __DIR__ . '/dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Crear una instancia de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    //$dompdf = new Dompdf();
    $dompdf = new Dompdf($options);
    $dompdf->getOptions()->setChroot(__DIR__ . '../../');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['html_content'])) {

        ///$dompdf->getOptions()->setChroot('../img');
        // Registrar la fuente
        ///$fontDir = __DIR__ . '/fonts'; // Ruta a la carpeta de fuentes
        $fontDir = 'dompdf/fonts'; // Ruta a la carpeta de fuentes
        $dompdf->getOptions()->setChroot($fontDir);
        $fontMetrics = $dompdf->getFontMetrics();
        $fontMetrics->getFont('Roboto', 'normal', $fontDir . '/Roboto-Regular.ttf', $fontDir . '/Roboto-Bold.ttf');

        // Cargar contenido HTML
        //$html = '<h1>Hola, mundo!</h1>';
        //$html = utf8_decode($_POST['html']);
        $html = ($_POST['html_content']);

        $htmlContent  = '
            <html>
                <head>
                    <style>
                        @font-face {
                            font-family: "Roboto";
                            src: url("../../php/dompdf/fonts/Roboto-Regular.ttf") format("truetype");
                            font-weight: normal;
                        }
                        @font-face {
                            font-family: "Roboto";
                            src: url("../../php/dompdf/fonts/Roboto-Bold.ttf") format("truetype");
                            font-weight: bold;
                        }
                        body {
                            font-family: "Roboto", sans-serif!important;
                        }
                        img {
                            max-width: 100%;
                            height: auto;
                        }
                    </style>
                </head>
                <body>'.$html.'</body>
            </html>';

        $dompdf->loadHtml($htmlContent);

        // (Opcional) Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el HTML como PDF
        $dompdf->render();

        // Salida del PDF generado al navegador
        $dompdf->stream('documento.pdf', ['Attachment' => 0]);

    } else {
        echo "No se ha proporcionado contenido HTML.";
    }