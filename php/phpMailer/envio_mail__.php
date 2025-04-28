<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$userName="centroayudaprueba2201@gmail.com";
//$userName="registro.mooc@gmail.com";
//$userName="vacunacioncovid19.uamx@gmail.com";


/*
if($tipo==1) {
	$alu_correo=$userName;
	$alu_nom=$userName;
}
*/

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; 
$mail->Host = "tls://smtp.gmail.com"; 
$mail->Port = "587"; // typically 587 
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAutoTLS = true; 
$mail->SMTPAuth = true;
$mail->Username = $userName;
$mail->Password = "lolo.123#"; 
$mail->setFrom($userName, "Registro");
$mail->addReplyTo('no-reply@gmail.com', 'no-reply@gmail.com');
$mail->addAddress($alu_correo, $alu_nom);
$mail->Subject = $subject;
$mail->msgHTML($text); // remove if you do not want to send HTML email
$mail->AltBody = 'HTML not supported';


/*
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
*/
$envio=0;
if(!$mail->send()){
	$envio=0;
   // echo "Mailer Error: " . $mail->ErrorInfo;
}else{
   // echo "Message sent!";
    $envio=1;
    //echo "1";
}


/*
if(($tipo=="1") && ($envio==1)){
	header("location:../index.php?a=a&dec=c&x=cod");
}if(($tipo=="1")  && ($envio==0)){
	header("location:../index.php?a=b&dec=c&x=cod"); 
}
*/







//$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped
 
/*
 no en godaddy
$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = "587"; // typically 587 
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = "climss.prueba@gmail.com";
$mail->Password = "#Fix852#";
$mail->setFrom("climss.prueba@gmail.com", "Wendy Hernandez");
$mail->addAddress("wahaf13@gmail.com", "Wen Dy");
$mail->Subject = 'Asunto de asuntos';
$mail->msgHTML("test body cuerpo del correo"); // remove if you do not want to send HTML email
$mail->AltBody = 'HTML not supported';
//$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped
*/


 
//$mail->send();

?>