<?php
session_start();
if (!isset($_SESSION['us_tutor'])) {
    header("location:../../login.php");
}
$usuario = ($_SESSION['us_tutor']);
$nombre_tutor = ($_SESSION['nombre']);
$email = ($_SESSION['us_correo']);
$_SESSION['us_tutor'] = $usuario;
$_SESSION['nombre'] = $nombre_tutor;
$_SESSION["us_correo"] = $email;

$matricula = ($_SESSION['matricula']);
$_SESSION["matricula"] = $matricula;
$nom_est = ($_SESSION['nom_est']);

if (!isset($_GET['x'])) {
  header('Location: index.php');
  exit();
}else{
  $trim_codi = $_GET['x'];
  $trim = base64_decode($trim_codi); 
  $trim = htmlspecialchars($trim);
}

include '../../php/conn.php';
$connection = Connection::getInstance();
$query_locale = "SET lc_time_names = 'es_MX';";
$stmt_locale = $connection->prepare($query_locale);
$stmt_locale->execute();

$query_exi = "SELECT cat_asistencia.descripcion as asiste, etapa, calificacion, desemp, desemp_desc, orientacion, tiempo_orienta, tema1, tema2, tema3, tema4, tema5, tema6, tema7, tema8, tema_otro, aspecto, aspecto_otro, recomen, recomen_otro, estrategia, acuerdos, logros, comentarios, DATE_FORMAT(tutoria_fecha, '%e de %M de %Y') AS fecha, DATE_FORMAT(fecha_edicion, '%d/%m/%Y') as edicion FROM ges_tutoria_individual, cat_asistencia WHERE cat_asistencia.id_asistencia=ges_tutoria_individual.asistencia and tutor_id = '$usuario' and matri_id = '$matricula' and trim_informe = '$trim';";
$stmt_exi = $connection->prepare($query_exi);
$stmt_exi->execute();
$totregs = $stmt_exi->rowCount();

$data = array();
if ($totregs) {
    //$data = $stmt_exi->fetch();
    $data = $stmt_exi->fetch(PDO::FETCH_ASSOC) ?: [];
}

?>
<style>
    .pre1 {
        width: 97% !important;
    }
    #resp_avance {
        height:400px;
        overflow: auto;
    }
</style>

<div id="exportable" class="container">
    <div>
        <p>
            <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/logo_b.png" alt="UAM-X">
        </p>
        <p style="text-align: right;"><b>Programa Institucional de Tutoría<br>Informe individual del trimestre: <?php echo $trim; ?></b></p>
        <p style="text-align: right;">Ciudad de México, a <?php echo $data['fecha']; ?>.</p>
 
    </div>
    
    <div class="col-md-12 pt-4 pl-5">               
        <p class="pre1">Estudiante: <b><?php echo $nom_est; ?></b> </p>
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

<div class="row m-2 p-2 d-flex float-right">
    <button id="exptopdf" type="button" class="btn btn-primary btn_10 pl-3 pr-4 text-justify" style="margin: 20px !important;">
        <img class="img-fluid mr-2" src="../../img/pdf.png" alt="" style="max-width: 18px; height: auto;" >Exportar
    </button>
    <input type="hidden" name="html_content" id="htmlContent"> 
</div>        

<br />

<script>

    document.getElementById('exptopdf').addEventListener('click', function() {
    // Obtener el contenido del div
    
    var content_pre = document.getElementById('exportable').innerHTML;
    var content = "";
    content = '<html><head><style>@font-face { font-family: "Roboto"; src: url("../../php/dompdf/fonts/Roboto-Regular.ttf") format("truetype"); font-weight: normal; } @font-face { font-family: "Roboto"; src: url("../../php/dompdf/fonts/Roboto-Bold.ttf") format("truetype"); font-weight: bold; } body { font-family: "Roboto", sans-serif!important; } </style> </head> <body>'+content_pre+ '</body> </html>';
    // Copiar el contenido del div al campo oculto
    document.getElementById('htmlContent').value = content;

    var nom_doc = 'INFORME_INDIVIDUAL_'+'<?php echo $trim; ?>'+'_'+'<?php echo $matricula; ?>'+'.pdf';

    // Crear un objeto FormData y añadir el contenido del campo oculto
    var formData = new FormData();
    formData.append('html_content', document.getElementById('htmlContent').value);


    // Usar fetch para enviar el contenido mediante POST
    fetch('../../php/print_pdf.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(blob => {
        // Crear un enlace para descargar el PDF
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        //a.download = 'informeIndividual.pdf';
        a.download = nom_doc;
        document.body.appendChild(a);
        a.click();
        a.remove();
    })
    .catch(error => console.error('Error:', error));
});
    
</script>
