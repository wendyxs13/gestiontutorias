<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$userName="soporte.tie@correo.xoc.uam.mx";

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; 
//$mail->Host = "tls://smtp.gmail.com"; 
//$mail->Host = "SMTP.Office365.com"; 
$mail->Host = "tls://smtp.gmail.com"; 
$mail->Port = "587"; //typically 587 
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAutoTLS = true; 
$mail->SMTPAuth = true;
$mail->Username = $userName;
$mail->Password = "zpsgcgfistrrnhbw"; 
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->setFrom($userName, "Registro Programa de Tutoría UAM-X");
//$mail->addReplyTo('no-reply@gmail.com', 'no-reply@gmail.com');
$mail->addAddress($alu_correo, $alu_nom);
$mail->Subject = $subject;
$mail->msgHTML($text); // remove if you do not want to send HTML email
$mail->AltBody = 'HTML not supported';

$envio=0;
if(!$mail->send()){
	$envio=0;
   //echo "Mailer Error: " . $mail->ErrorInfo;
}else{
   // echo "Message sent!";
    $envio=1;
    //echo "1";
}


?>