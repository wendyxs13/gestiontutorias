<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){
	$user = new UsuariosIntData();
	$user->addExtraFieldString("name", htmlentities($_POST["name"]));
	$user->addExtraFieldString("prefijo", htmlentities($_POST["prefijo"]));
	$user->addExtraFieldString("tipo", htmlentities($_POST["tipo"]));
	$user->addExtraFieldString("adscripcion", htmlentities($_POST["adscripcion"]));
	$user->addExtraFieldString("division", htmlentities($_POST["division"]));
	$user->addExtraFieldString("User", htmlentities($_POST["User"]));
	$user->addExtraFieldString("email", htmlentities($_POST["email"]));
	$user->addExtraFieldString("Password", htmlentities($_POST["Password"]));

	$user->add();
	Core::alert("Usuario agregado!");
	Core::redir("./?view=usuarios&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
if(count($_POST)>0){
	$user = UsuariosIntData::getById($_POST["id"]);
	$user->addExtraFieldString("name", htmlentities($_POST["name"]));
	$user->addExtraFieldString("prefijo", htmlentities($_POST["prefijo"]));
	$user->addExtraFieldString("tipo", htmlentities($_POST["tipo"]));
	$user->addExtraFieldString("adscripcion", htmlentities($_POST["adscripcion"]));
	$user->addExtraFieldString("division", htmlentities($_POST["division"]));
	$user->addExtraFieldString("User", htmlentities($_POST["User"]));
	$user->addExtraFieldString("email", htmlentities($_POST["email"]));
	$user->addExtraFieldString("Password", htmlentities($_POST["Password"]));
	$user->update();


	Core::alert("Usuario actualizado!");
	Core::redir("./?view=usuarios&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = UsuariosIntData::getById($_GET["id"]);
    $_SESSION['user_id'];
	if($user->id!=$_SESSION["user_id"]){
		$user->del();
	}
	Core::alert("Usuario eliminado!");
	Core::redir("./?view=usuarios&opt=all");
}



?>