<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="login"){

if(!isset($_SESSION["user_id"])) {

$user_var = htmlentities($_POST["User"]);
$password_var = htmlentities($_POST['Password']);


$user = $user_var;
$pass = (($password_var));
$base = new Database();
$con = $base->connect();

 $sql = "select * from usuarios_int where (User=\"".$user."\" ) and Password= \"".$pass."\" ";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
$user_name = null;
$usertipo = "";
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
	$usertipo = $r['tipo'];
	$user_name = $r['name'];
}

if($found==true) {
	$_SESSION['user_id']=$userid ;
	$_SESSION['user']=$user ;
	$_SESSION['name']=$user_name ;
	$_SESSION['tipo']=$usertipo ;
	// Si todo sale bien
	print "Cargando ... $user";

	date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

	$sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
		('" . date("Y-m-d")  . "','" . date("H:i:s")  . "','".strtoupper($user)."','','LOGIN','".$usertipo."',
		'KARDEX DEL ALUMNO')";
		$con->query($sql2);


	Core::redir("./");
}else {
	// Si la contrase~a es incorrecta
	Core::alert("Contraseña Incorrecta!");
	Core::redir("./?view=login");
}
}else{
	// si ya esta logeado
	Core::redir("./");	
}

}
if(isset($_GET["opt"]) && $_GET["opt"]=="logout"){
	unset($_SESSION);
	session_destroy();
	Core::redir("./");
}

?>