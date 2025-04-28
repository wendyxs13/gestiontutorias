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
    header("Content-Disposition: attachment;filename=informe_individual_" .$fecha.".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $output = "";

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT ges_registro_tutor.num_eco as cel_01, ges_registro_tutor.nombre as cel_02, ges_registro_alu.matri_alu as cel_03, ges_registro_alu.nombre as cel_04, etapa as cel_05, desemp as cel_06, desemp_desc as cel_07, orientacion as cel_08, tiempo_orienta as cel_09, tema1 as cel_10, tema2 as cel_11, tema3 as cel_12, tema4 as cel_13, tema5 as cel_14, tema6 as cel_15, tema7 as cel_16, tema8 as cel_17, tema_otro as cel_18, aspecto as cel_19, aspecto_otro as cel_20, recomen as cel_21, recomen_otro as cel_22, estrategia as cel_23, acuerdos as cel_24, logros as cel_25, DATE_FORMAT(tutoria_fecha, '%d/%m/%Y') as cel_26, estudiante_tutor.trimestre as cel_27 FROM ges_tutoria_individual, ges_registro_tutor, ges_registro_alu, estudiante_tutor where ges_tutoria_individual.tutor_id =ges_registro_tutor.num_eco and ges_tutoria_individual.matri_id =ges_registro_alu.matri_alu and estudiante_tutor.matricula=ges_tutoria_individual.matri_id and ges_tutoria_individual.tutor_id= estudiante_tutor.no_eco and estudiante_tutor.trimestre = ges_tutoria_individual.trim_informe;";

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
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Con base en los resultados del trimestre evalúe el desempeño de la persona tutorada:</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Justifique brevemente su respuesta:</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Aproximadamente ¿Cuántos días le brindó tutoría durante el trimestre?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Cuánto tiempo duró cada sesión?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante los contenidos específicos de su licenciatura</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante la comprensión lectora</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante las habilidades de conocimiento matemático</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante la argumentación</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante las habilidades de investigación</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante el trabajo en equipo</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante hablar en público</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó que se le dificulta al/la estudiante la integración al medio universitario</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Identificó otro tema que se le dificulta al/la estudiante</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿En qué aspectos le orientó al/la estudiante?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Cuál?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Canalizó o recomendó al/la estudiante para atender alguna inquietud reforzar algún tema específico?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Especifique:</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Qué estrategias implementó para mejorar el desempeño de la persona tutorada?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>¿Cuáles son los acuerdos y compromisos que se establecieron durante el trimestre?</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Logro obtenido durante el trimestre:</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Fecha</td>
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
        $cel_10 = "{$row['cel_10']}";
        $cel_11 = "{$row['cel_11']}";
        $cel_12 = "{$row['cel_12']}";
        $cel_13 = "{$row['cel_13']}";
        $cel_14 = "{$row['cel_14']}";
        $cel_15 = "{$row['cel_15']}";
        $cel_16 = "{$row['cel_16']}";
        $cel_17 = "{$row['cel_17']}";
        $cel_18 = "{$row['cel_18']}";
        $cel_19 = "{$row['cel_19']}";
        $cel_20 = "{$row['cel_20']}";
        $cel_21 = "{$row['cel_21']}";
        $cel_22 = "{$row['cel_22']}";
        $cel_23 = "{$row['cel_23']}";
        $cel_24 = "{$row['cel_24']}";
        $cel_25 = "{$row['cel_25']}";
        $cel_26 = "{$row['cel_26']}";
        $cel_27 = "{$row['cel_27']}";
        
        $output .="<tr>
                <td style='border: 1px solid #B0CBEF;'>".$cel_01."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_02."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_03."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_04."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_05."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_06."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_07."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_08." días</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_09." (min)</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_10."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_11."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_12."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_13."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_14."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_15."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_16."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_17."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_18."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_19."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_20."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_21."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_22."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_23."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_24."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_25."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_26."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_27."</td>
              </tr>";
    }

  }

  $output .="</table>";
  echo utf8_decode($output);

}else{ 
  header("location:../../login.php"); 
}
?>