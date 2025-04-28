<?php

if($_POST['password']!=""){

	if($_POST["password"]==$_POST["confirm_password"]){
		Core::$user->Password = $_POST["password"];
		Core::$user->update_password();
		Core::alert("Contraseña Actualizada Correctamente!");

	}else{
		Core::alert("Error: Las contrañas no coinciden!");
	}
}

Core::redir("./");

?>