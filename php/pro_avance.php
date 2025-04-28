<?php

session_start();
$usuario = ($_SESSION['us_tutor']);
$_SESSION['us_tutor'] = $usuario;

$total = 0;
$individual = null;

if (!empty($_POST)) { /// 1
    $matriculaError = null;
    $matricula = $_POST['matri'];
    $trim_codi = $_POST['trim_inf'];
    $trim_inf = base64_decode($trim_codi); 
    $trim_inf = htmlspecialchars($trim_inf);
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
                . "est.nombre as alu_nom, "
                . "est.ap as alu_ap, "
                . "est.am as alu_am, "
                . "ges_tutoria_individual.idtutoria_ind as individual "
                . "FROM  estudiante_tutor "
                . "LEFT join  ges_tutoria_individual  on estudiante_tutor.matricula=ges_tutoria_individual.matri_id "
                . "and estudiante_tutor.trimestre = ges_tutoria_individual.trim_informe "
                . "LEFT join  ges_registro_alu as est ON est.matri_alu=estudiante_tutor.matricula "
                . "WHERE estudiante_tutor.no_eco = '$usuario' AND estudiante_tutor.trimestre = '$trim_inf' "
                . "AND estudiante_tutor.matricula = '$matricula' ;";

        $stmt_exi = $connection->prepare($query_exi);
        $stmt_exi->execute(); //array($usuario,$matricula)
        $total_exi = $stmt_exi->rowCount();

        if ($total_exi > 0) {
            while ($row = $stmt_exi->fetch()) {
                $matri = "{$row['matri']}";
                $num = "{$row['num']}";
                $alu_nom = "{$row['alu_nom']}";
                $alu_ap = "{$row['alu_ap']}";
                $alu_am = "{$row['alu_am']}";
                $individual = "{$row['individual']}";
            }
            $alu = $alu_nom." ".$alu_ap." ".$alu_am; 

            $_SESSION["nom_est"] = $alu;
            $_SESSION["matricula"] = $matri;

            if ($individual === NULL || $individual === '') {
                echo 'new';
            } else {
                echo 'view';
            }
        } else {  /// if else total_exi
            echo '<div><h4 class="pl-5 pt-3 pb-4 pr-2"><b> problemas al cargar datos</b></h4></div>';
        } /// else total_exi
    } ////valid
} /// 1
 