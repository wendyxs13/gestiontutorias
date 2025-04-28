<?php
session_start();
if(isset($_SESSION['us_tutor_ad'])){
    $usuario=($_SESSION['us_tutor_ad']);
    $nombre_tutor=($_SESSION['nombre_ad']);
    $email =($_SESSION['us_correo_ad']);
    $_SESSION['us_tutor_ad']=$usuario;
    $_SESSION['nombre_ad']=$nombre_tutor;
    $_SESSION["us_correo_ad"] = $email;


    if (!isset($_GET['x'])) {
        header('Location: ../index.php');
        exit();
    }else{
        $trim_codi = $_GET['x'];
        $trim = base64_decode($trim_codi); 
        $trim = htmlspecialchars($trim);
    }
  
    $fecha = date("d-m-Y"); 
    ob_end_clean();
    ob_start();
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment;filename=".$trim."_tutores_informes_capturados_".$fecha.".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $output = "";

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT d.num_eco as cel_01, d.nombre as cel_02, d.ap  as cel_03, d.correo  as cel_04, COUNT(DISTINCT ti.tutor_id) AS cel_05, COUNT(DISTINCT tg.num_eco) AS cel_06 FROM ges_registro_tutor d LEFT JOIN ges_tutoria_individual ti ON ti.tutor_id = d.num_eco AND ti.trim_informe = '$trim' LEFT JOIN ges_tutoria_grupal_3 tg ON tg.num_eco = d.num_eco AND tg.trim_informe = '$trim' WHERE d.num_eco != 1 GROUP BY d.num_eco, d.nombre, d.ap, d.correo HAVING cel_05 > 0 OR cel_06 > 0;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute();
    $total_exi=$stmt_exi->rowCount();

    $output .="<table>";
    $output .="<tr>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF;font-weight: bold; '>Núm Eco</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Tutor</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Correo</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Informe individual</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Informe grupal</td>
                <td style='border: 1px solid #B0CBEF; background-color:#F3FAFF; font-weight: bold;'>Trimestre</td>
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
        
        $output .="<tr>
                <td style='border: 1px solid #B0CBEF;'>".$cel_01."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_02." ".$cel_03."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_04."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_05."</td>
                <td style='border: 1px solid #B0CBEF;'>".$cel_06."</td>
                <td style='border: 1px solid #B0CBEF;'>".$trim."</td>
              </tr>";
    }

  }

  $output .="</table>";
  echo utf8_decode($output);

}else{ 
  header("location:../../login.php"); 
}
?>