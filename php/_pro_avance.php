<?php

session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;

$total = 0;
$individual = null;

if (!empty($_POST)) { /// 1
    $matriculaError = null;
    $matricula = $_POST['matri'];

    $valid = true;

    if (empty($matricula)) {
        $valid = false;
        $msj_resp = "Debes ingresar tu matrícula";
    }

    if ($valid) {
        include 'conn.php';
        $connection = Connection::getInstance();

        $query_exi = "SELECT "
                . "estudiante_tutor.matricula as matri, "
                . "estudiante_tutor.no_eco as num, "
                . "est.nombre as alu, "
                . "tutoria_ind.idtutoria_ind as individual "
                . "FROM  estudiante_tutor "
                . "LEFT join  tutoria_ind  on estudiante_tutor.matricula=tutoria_ind.matri_id "
                . "LEFT join  estudiantes as est ON est.matricula=estudiante_tutor.matricula "
                . "WHERE estudiante_tutor.no_eco = '$usuario' AND"
                . "      estudiante_tutor.matricula = '$matricula' ;";

        $stmt_exi = $connection->prepare($query_exi);
        $stmt_exi->execute(); //array($usuario,$matricula)
        $total_exi = $stmt_exi->rowCount();

        if ($total_exi > 0) {
            while ($row = $stmt_exi->fetch()) {
                $matri = "{$row['matri']}";
                $num = "{$row['num']}";
                $alu = "{$row['alu']}";
                $individual = "{$row['individual']}";
            }
            $_SESSION["nom_est"] = $alu;
            $_SESSION["matricula"] = $matri;

            if ($individual === NULL || $individual === '') {
                echo 'new';
            } else {
                echo 'view';
            }
        } else {  /// if else total_exi
            echo '<div><h4 class="pl-5 pt-3 pb-4 pr-2"><b>Problemas al cargar datos</b></h4></div>';
        } /// else total_exi
    } ////valid
} /// 1
 