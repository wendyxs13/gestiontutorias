<?php
error_reporting(E_ALL);
$total = 0;
if (!empty($_POST)) {
    $usutest = $_POST['usutest'];
    $prueba = $_POST['prueba'];
    if (empty($usutest)) {
        echo 'Debes ingresar tu usuario';
    } else if (empty($usutest)) {
        echo 'Debes ingresar contraseña';
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
        include 'conn.php';
        $connection = Connection::getInstance();
        // VALIDA QUE EXISTA USUARIO        
        $query_exi = "SELECT usuario, tipo, accesos FROM at_usuarios WHERE usuario = ? and prueba = ? ;";
        $stmt_exi = $connection->prepare($query_exi);
        $stmt_exi->execute(array($usutest, $prueba));
        $total = $stmt_exi->rowCount();
        if ($total > 0) {
            while ($row = $stmt_exi->fetch()) {
                $usuario = "{$row['usuario']}";
                $rol = "{$row['tipo']}";             
            }
            $query_upd = "UPDATE at_usuarios SET accesos = accesos+1 WHERE usuario = '$usuario';";
            $stmt_upd = $connection->prepare($query_upd);
            $stmt_upd->execute();
            
            session_start();
            $_SESSION["at_usuario"] = $usuario;
            $_SESSION["at_rol"] = $rol;
            echo 'Ok';
        } else {
            echo "No existe el usuario o la clave es incorrecta. Consulte al administrador del sistema";
        }
    }
}
