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
    ob_end_clean();
    ob_start();
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment;filename=PARTE_01_INFORME_GRUPAL_" .$fecha.".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $output = "";

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT ges_registro_tutor.num_eco as cel_01, ges_registro_tutor.nombre  as cel_02, ges_tutoria_grupal_1.matricula  as cel_03, ges_registro_alu.nombre  as cel_04, ges_tutoria_grupal_1.trimestre  as cel_05, prom_ini as cel_06, prom_fin  as cel_07, DATE_FORMAT(fecha_g1, '%d/%m/%Y') as cel_08, ges_tutoria_grupal_1.trim_informe as cel_09 FROM ges_tutoria_grupal_1, ges_tutoria_grupal_3, ges_registro_tutor, estudiante_tutor, ges_registro_alu where ges_tutoria_grupal_1.num_eco=ges_tutoria_grupal_3.num_eco and estudiante_tutor.no_eco = ges_tutoria_grupal_1.num_eco and estudiante_tutor.matricula = ges_tutoria_grupal_1.matricula and ges_registro_tutor.num_eco = ges_tutoria_grupal_1.num_eco and ges_registro_alu.matri_alu = estudiante_tutor.matricula and estudiante_tutor.trimestre= ges_tutoria_grupal_1.trim_informe and ges_tutoria_grupal_1.trim_informe = ges_tutoria_grupal_3.trim_informe /*and ges_tutoria_grupal_1.trim_informe = ? */ ;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute();
    $total_exi=$stmt_exi->rowCount();

    $output .="<table>";
    $output .="<tr>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF;font-weight: bold; '>Núm Eco</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Tutor</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Matrícula</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Estudiante</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Trimestre que cursa el/la estudiante</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Promedio inicial</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Promedio final</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Fecha de elaboración del informe</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Trimestre al que corresponde el informe</td>
              </tr>";
          
    if($total_exi > 0){
      while ($row = $stmt_exi->fetch()){
        $cel_09="";
        $cel_08="";
        $cel_01 = "{$row['cel_01']}";
        $cel_02 = "{$row['cel_02']}";
        $cel_03 = "{$row['cel_03']}";
        $cel_04 = "{$row['cel_04']}";
        $cel_05 = "{$row['cel_05']}";
        $cel_06 = "{$row['cel_06']}";
        $cel_07 = "{$row['cel_07']}";
        $cel_08 = "{$row['cel_08']}";
        $cel_09 = "{$row['cel_09']}";
        
        $output .="<tr>
                <td style='border: 1px solid #B0CBEF;'>".$cel_01."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_02."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_03."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_04."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_05."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_06."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_07."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_08."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_09."</td>
              </tr>";
    }

  }

  $output .="</table>";
  echo utf8_decode($output);

}else{ 
  header("location:../../login.php"); 
}
?>