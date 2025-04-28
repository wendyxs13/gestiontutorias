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
    header("Content-Disposition: attachment;filename=PARTE_02_INFORME_GRUPAL_" .$fecha.".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $output = "";

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT ges_tutoria_grupal_2.num_eco, nombre as cel_02, COUNT(ges_tutoria_grupal_2.num_eco), temas  as cel_03, modalidad  as cel_04, DATE_FORMAT(fecha, '%d/%m/%Y') as cel_05, ges_tutoria_grupal_2.trim_informe as cel_06 from ges_tutoria_grupal_2, ges_registro_tutor, ges_tutoria_grupal_3 where ges_tutoria_grupal_2.num_eco=ges_registro_tutor.num_eco AND ges_tutoria_grupal_2.num_eco = ges_tutoria_grupal_3.num_eco and ges_tutoria_grupal_2.trim_informe = ges_tutoria_grupal_3.trim_informe GROUP BY num_eco, temas, fecha, nombre, modalidad, cel_06 order by num_eco;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute();
    $total_exi=$stmt_exi->rowCount();

    $output .="<table>";
    $output .="<tr>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Núm Eco</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Tutor</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Temas abordados</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Modalidad</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Fecha de las sesiones de tutoría</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Trimestre al que corresponde el informe</td>
              </tr>";
          
    if($total_exi > 0){
      while ($row = $stmt_exi->fetch()){
        $cel_01 = "{$row['num_eco']}";
        $cel_02 = "{$row['cel_02']}";
        $cel_03 = "{$row['cel_03']}";
        $cel_04_01 = "{$row['cel_04']}";
        if($cel_04_01 == "1"){
          $cel_04 = "Presencial";
        }else if($cel_04_01 == "2"){
          $cel_04 = "Remota";
        }
        $cel_05 = "{$row['cel_05']}";
        $cel_06 = "{$row['cel_06']}";
        
        $output .="<tr>
                <td style='border: 1px solid #B0CBEF;'>".$cel_01."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_02."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_03."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_04."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_05."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_06."</td>
              </tr>";
    }

  }

  $output .="</table>";
  echo utf8_decode($output);
}else{ 
  header("location:../../login.php"); 
}
?>