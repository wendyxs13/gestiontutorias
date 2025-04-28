
<script src="./plugins/sweetalert2.all.js"></script>
<?php

$email_user = "uam.atencion@gmail.com";
$email_password = "qbaajoguuklrxjdk";
if($_POST["email"]!=""){
$user = UsuariosIntData::getBy("email",$_POST['email']);
if($user!=null){ // Usuario existe
$the_subject = "Recuperacion de Password";
$address_to = $_POST["email"];
$from_name = "Sistema UAM";
$phpmailer = new PHPMailer();

// ———- datos de la cuenta de Gmail ——————————-
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//———————————————————————–
// $phpmailer->SMTPDebug = 1;
//$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "smtp.gmail.com"; // GMail
$phpmailer->SMTPSecure='STARTTLS';
$phpmailer->Port=587;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;

$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email


$basepass = "aBcDeFgHiJkLmNoPqRsTuVwXyZ12345678900";

//echo rand(0,strlen($basepass));
$password ="";
for($i=0;$i<=8;$i++){
$r = rand(0,strlen($basepass)-1);
	$password.=$basepass[$r];
}
$user->Password = $password;
$user->update_password();

$phpmailer->Subject = $the_subject;	
$phpmailer->Body .="<h1 style='color:navy;'>Universidad Autonoma Metropolitana</h1>";
$phpmailer->Body .= "<p>Se ha enviado este correo por que usted ha intentado recuperar su password.</p>";
$phpmailer->Body .= "<p>Se le envia la siguiente password temporal para que pueda acceder al sistema y cambiar su password por una nueva.</p>";
$phpmailer->Body .= "<p>Email: <b>$user->email<b></p>";
$phpmailer->Body .= "<p>Nombre de usuario: <b>$user->User<b></p>";
$phpmailer->Body .= "<p>Password temporal: <b>$password<b></p>";
$phpmailer->Body .= "<br><br><p>Esta informacion es privada, por favor no la comparta con nadie.</p><p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
$phpmailer->IsHTML(true);

if($phpmailer->Send()){
	// var_dump($phpmailer);
	// return;
	header( 'Location: ./?exito=ok' ) ;
		// return $exito="ok";
}
}  else {
	header( 'Location: ./?exito=no' ) ;
}
}
// email vacio
// Core::redir("./");
?>
