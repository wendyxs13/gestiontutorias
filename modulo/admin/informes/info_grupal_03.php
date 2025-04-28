<?php
session_start();
if(isset($_SESSION['us_tutor_ad'])){
    $usuario=($_SESSION['us_tutor_ad']);
    $nombre_tutor=($_SESSION['nombre_ad']);
    $email =($_SESSION['us_correo_ad']);
    $_SESSION['us_tutor_ad']=$usuario;
    $_SESSION['nombre_ad']=$nombre_tutor;
    $_SESSION["us_correo_ad"] = $email;
  
    $fecha = date("d-m-Y");
    $cel_04 = ""; 
    ob_end_clean();
    ob_start();
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment;filename=PARTE_03_INFORME_GRUPAL_" .$fecha.".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $output = "";
    

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT ges_tutoria_grupal_3.num_eco as cel_01, nombre as cel_02, ap as cel_02ap, am as cel_02am, tutoria_falta as cel_03, tutoria_falta_est as cel_04, tutoria_ind as cel_05, tutoria_ind_est as cel_06, tutoria_ind_razon as cel_07, tutoria_continuar as cel_08, participa, descripcion as cel_09, otra_participa  as cel_10, DATE_FORMAT(fecha_g3, '%d/%m/%Y') as cel_11, ges_tutoria_grupal_3.trim_informe as cel_12, ges_tutoria_grupal_3.comentarios as cel_13 from ges_registro_tutor, ges_tutoria_grupal_3, cat_participacion where ges_tutoria_grupal_3.num_eco=ges_registro_tutor.num_eco and participa=idcat_participacion;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute();
    $total_exi=$stmt_exi->rowCount();

    $output .="<table>";
    $output .="<tr>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF;font-weight: bold; '>Núm Eco</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Tutor</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Algún alumno o alumna faltó a las sesiones de tutoría?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Quién?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Considera que alguna de las personas tutoradas requiere tutoría individualizada?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Si es el caso, por favor indique el nombre o nombres del estudiantado que la requiere.</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Por qué considera que los estudiantes seleccionados requieren tutoría individualizada?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Usted podría brindar la tutoría personalizada o prefiere que reasignemos al estudiantado?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Respecto a su participación en el Programa Institucional de Tutoría:</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Otra forma de participación en el Programa Institucional de Tutoría</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Fecha</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Trimestre al que corresponde el informe</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Comentarios adicionales:</td>
              </tr>";
          
    if($total_exi > 0){
      while ($row = $stmt_exi->fetch()){
        $cel_01 = "{$row['cel_01']}";
        $cel_02 = "{$row['cel_02']}";
        $cel_02ap = "{$row['cel_02ap']}";
        $cel_02am = "{$row['cel_02am']}";
        $cel_03 = "{$row['cel_03']}";
        $cel_04 = "{$row['cel_04']}";
        $cel_05 = "{$row['cel_05']}";
        $cel_06 = "{$row['cel_06']}";
        $cel_07 = "{$row['cel_07']}";
        $cel_08 = "{$row['cel_08']}";
        $cel_09 = "{$row['cel_09']}";
        $cel_10 = "{$row['cel_10']}";
        $cel_11 = "{$row['cel_11']}";
        $cel_12 = "{$row['cel_12']}";
        $cel_13 = "{$row['cel_13']}";
        
        $output .="<tr>
                <td style='border: 1px solid #B0CBEF;'>".$cel_01."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_02." ".$cel_02ap." ".$cel_02am."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_03."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_04."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_05."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_06."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_07."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_08."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_09."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_10."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_11."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_12."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_13."</td>
              </tr>";
    }
  }

  $output .="</table>";
  echo utf8_decode($output);
}else{ 
  header("location:../../login.php"); 
}
?>