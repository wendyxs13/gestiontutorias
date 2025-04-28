<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$userName="soporte.tie@correo.xoc.uam.mx"; ///cuenta de correo del remitente

$tutor = "Vicente Ampudia Rueda";
$correo_tutor = "vampudia@correo.xoc.uam.mx";
$nom_solicitante = "Wendy Hernández";
$correo_solicitante = "wendy.hdzc@gmail.com";

/* ### texto del correo ### */
$texto_correo = "<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>
          .contenido{
             font-family: 'Open Sans', sans-serif;
             color: #5a5a5a;
          }         
        </style>
    </head>
    <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr>           
            <td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
              Programa de Tutoría
            </td>
        </tr>
          <tr>           
            <td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                <p>Hola<b> ".$tutor."</b><br>
                <br>Te informamos que <b>
                ".$nom_solicitante."</b> esta interesad@ en que lo apoyes en el proyecto de tutoría                 
            </td>
        </tr>
     </table>
     <br><br>
    </body>
    </html>";

/* ### texto del correo ### */

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
$mail->setFrom($userName, "Programa de Tutoría UAM-X"); /// Nombre y correo del remitente 

///$mail->addAddress("vampudia@correo.xoc.uam.mx", "Vicente Ampudia Rueda"); /// Nombre y correo del destinatario
$mail->addAddress($correo_tutor, $tutor); /// Nombre y correo del destinatario 
$mail->addCC($correo_solicitante); ///Con copia a...
$mail->addBCC('wendy.rdzcts@gmail.com'); ///Con copia oculta a...

///chenpapo@gmail.com

///$mail->Subject = $subject;
$mail->Subject = "Envío de correo PHPMailer";
$mail->msgHTML($texto_correo); 
//$mail->msgHTML("Hola Vicente!, esta es una prueba con PHPMailer "); 
$mail->AltBody = 'HTML not supported';

if(!$mail->send()){
   echo "Problemas en el envío: " . $mail->ErrorInfo;
}else{
   echo "Mensaje enviado";
    
}

?>