<?php
if (!isset($_GET['r'])) {
  header('Location: https://gestiontutorias.xoc.uam.mx');
  exit();
}else{
  $id = $_GET['r'];   
  $tam = strlen($id);
  $t=0;
  $con_id="";
  while($t < $tam){
    switch($id[$t]){
      case 'R': $etr="0";
      break;
      case 'S': $etr="1";
      break;
      case 'T': $etr="2";
      break;
      case 'U': $etr="3";
      break;
      case 'V': $etr="4";
      break;
      case 'W': $etr="5";
      break;
      case 'X': $etr="6";
      break;
      case 'Y': $etr="7";
      break;
      case 'Z': $etr="8";
      break;
      case 'A': $etr="9";
      break;                  
    }
  $con_id= $con_id."".$etr;
  $t++;  

  }
}

include '../../php/conn.php';
$connection = Connection::getInstance();
$query_locale = "SET lc_time_names = 'es_MX';";
$stmt_locale = $connection->prepare($query_locale);
$stmt_locale->execute();

$query_exi = "SELECT ges_registro_tutor.nombre as tutor1, ges_registro_tutor.ap as tutor2, ges_registro_tutor.am as tutor3, ges_registro_alu.nombre as alu1, ges_registro_alu.ap as alu2, ges_registro_alu.am  as alu3, cat_asistencia.descripcion as asiste, etapa, calificacion, desemp, desemp_desc, orientacion, tiempo_orienta, tema1, tema2, tema3, tema4, tema5, tema6, tema7, tema8, tema_otro, aspecto, aspecto_otro, recomen, recomen_otro, estrategia, acuerdos, logros, comentarios, DATE_FORMAT(tutoria_fecha, '%e de %M de %Y') AS fecha, DATE_FORMAT(fecha_edicion, '%d/%m/%Y') as edicion, trim_informe, num_eco FROM ges_tutoria_individual individual LEFT join cat_asistencia on cat_asistencia.id_asistencia=individual.asistencia LEFT join ges_registro_alu on ges_registro_alu.matri_alu = individual.matri_id LEFT join ges_registro_tutor on ges_registro_tutor.num_eco = individual.tutor_id  WHERE   idtutoria_ind = '$con_id';";

$stmt_exi = $connection->prepare($query_exi);
$stmt_exi->execute();
$totregs = $stmt_exi->rowCount();

$data = array();
if ($totregs) {
    //$data = $stmt_exi->fetch();
    $data = $stmt_exi->fetch(PDO::FETCH_ASSOC) ?: [];
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Informe Individual</title>
    <style>
    .pre1 {
        width: 97% !important;
    }
    #resp_avance {
        height:400px;
        overflow: auto;
    }
</style>
  </head>
  <body>
    <div id="exportable" class="container">
        <div>
            <p>
                <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/logo_b.png" alt="UAM-X">
            </p>
            <p style="text-align: right;"><b>Programa Institucional de Tutoría<br>Informe individual del trimestre: <?php echo $data['trim_informe']; ?></b></p>
            <p style="text-align: right;">Ciudad de México, a <?php echo $data['fecha']; ?>.</p>
     
        </div>
        
        <div class="col-md-12 pt-4 pl-5">
            <p class="pre1">Tutor: <b><?php echo $data['tutor1']." ".$data['tutor2']." ".$data['tutor3']; ?></b> </p>   
            <p class="pre1">Número Económico: <b><?php echo $data['num_eco']; ?></b> </p>               
            <p class="pre1">Estudiante: <b><?php echo $data['alu1']." ".$data['alu2']." ".$data['alu3']; ?></b> </p>
             <p class="pre1">¿Se logró contactar al estudiante para realizar las sesiones de tutoría?  
                <br /> <b><?php echo $data['asiste']; ?></b></p>
            <p class="pre1">1. Trimestre que cursa el/la estudiante: 
                <br /> <b><?php echo $data['etapa']; ?>o.</b></p>
            <p class="pre1">2. ¿Cuál es la calificación que obtuvo en el trimestre?:
                <br /> <b><?php echo $data['calificacion']; ?></b></p>
            <p class="pre1">3. Con base en los resultados del trimestre, evalúe el desempeño de la persona tutorada:</b>
                <br /> <b><?php echo $data['desemp']; ?></b></p>
            <p class="pre1">4. Justifique brevemente su respuesta:</b>
                <br />  <b><?php echo $data['desemp_desc']; ?></b></p>
            <p class="pre1">5. Aproximadamente ¿Cuántos días le brindó tutoría durante el trimestre?
                <br /> <?php
                $dias = preg_replace('/-/', ' a ', $data['orientacion']);
    //                    $dias = preg_replace('/+/', ' más de ', $dias);                    
                echo "<b>De " . $dias . " días</b>";
                ?></p>
            <p class="pre1">6. ¿Cuánto tiempo duró cada sesión?
                <br /> <?php
                $mins = preg_replace('/-/', ' a ', $data['tiempo_orienta']);
    //                    $mins = preg_replace('/+/', ' más de ', $mins);                                        
                echo "<b>De " . $mins . " minutos</b>";
                ?></p>
            <p class="pre1">7. De los siguientes temas ¿Cuál identificó que se le dificulta al/la estudiante?</p>
            <ul>
                <li><b>Contenidos</b> <br />
                    <?php
                    if ($data['tema1']) {
                        echo "<b> - Contenidos específicos de su licenciatura</b>";
                    }
                    ?>
                </li>
                <li><b>Desarrollo y dominio de habilidades cognitivas genérica</b> <br />
                    <?php
                    if ($data['tema2']) {
                        echo "<b> - Comprensión lectora</b><br />";
                    }
                    if ($data['tema3']) {
                        echo "<b> - Habilidades de conocimiento matemático</b><br />";
                    }
                    if ($data['tema4']) {
                        echo "<b> - Argumentación</b><br />";
                    }
                    if ($data['tema5']) {
                        echo "<b> - Habilidades de investigación</b><br />";
                    }
                    ?>   
                </li>
                <li><b>Habilidades Socioemocionales</b><br />
                    <?php
                    if ($data['tema6']) {
                        echo "<b> - Trabajo en equipo</b><br />";
                    }
                    if ($data['tema7']) {
                        echo "<b> - Hablar en público</b><br />";
                    }
                    if ($data['tema8']) {
                        echo "<b> - Integración al medio universitario</b><br />";
                    }
                    ?>   
                </li>
                <li><b>Otro</b><br />
                    <?php
                    if ($data['tema_otro'] != '') {
                        echo "<b> - " . ucfirst($data['tema_otro']), "</b><br />";
                    }
                    ?>
                </li>
            </ul>        
            <p class="pre1">8. ¿En qué aspectos le orientó al/la estudiante?
                <b>
                    <br />     <?php
                    echo $data['aspecto'];
                    if (strtolower($data['aspecto']) == 'otro') {
                        echo " - " . $data['aspecto_otro'];
                    }
                    ?>
                </b>
            </p>
            <p class="pre1">9. ¿Canalizó o recomendó al/la estudiante para atender alguna inquietud, reforzar algún tema específico?
                <b>
                    <br />     <?php
                    echo $data['recomen'];
                    if (strtolower($data['recomen']) == 'si') {
                        echo " - " . $data['recomen_otro'];
                    }
                    ?>
                </b>
            </p>
            <p class="pre1">10. ¿Qué estrategias implementó para mejorar el desempeño de la persona tutorada?
                <br /><b><?php echo $data['estrategia']; ?></b></p>
            <p class="pre1">11. ¿Cuáles son los acuerdos y compromisos que se establecieron durante el trimestre?
                <br /><b><?php echo $data['acuerdos']; ?></b></p>
            <p class="pre1">12. Logro obtenido durante el trimestre:
                <br /><b><?php echo $data['logros']; ?></b></p>
            <p class="pre1">13. Comentarios adicionales:
                <br /><b><?php echo $data['comentarios']; ?></b></p>
            <!-- <p style="font-size: 10px;">Fecha de elaboración: <?php echo $data['edicion']; ?></p> -->
        </div>     
    </div>

      




    
  </body>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>