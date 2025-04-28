<?php
session_start();
if (!isset($_SESSION['us_tutor'])) {
    header("location:../../login.php");
}
$usuario = ($_SESSION['us_tutor']);

if (!isset($_GET['x'])) {
    header('Location: index.php');
    exit();
}else{
    //$trimestre = $_GET['x'];

    $trim_codi = $_GET['x'];
    $trimestre = base64_decode($trim_codi); 
    $trimestre = htmlspecialchars($trimestre);
}

include '../../php/conn.php';
$connection = Connection::getInstance();

$query_locale = "SET lc_time_names = 'es_MX';";
$stmt_locale = $connection->prepare($query_locale);
$stmt_locale->execute();

$query_exi = "SELECT constancia.folio as col1, DATE_FORMAT(constancia.fecha_constancia, '%e de %M de %Y') AS col2, tutor.nombre as col3, tutor.ap as col4, tutor.am as col5, div_dpto.depto as col6, div_dpto.nom_div as col7, DATE_FORMAT(trimestre.inicio, '%e de %M de %Y') AS col8, DATE_FORMAT(trimestre.fin, '%e de %M de %Y') AS col9, CASE WHEN tutor.sexo = 'F' THEN 'la profesora' WHEN sexo = 'M' THEN 'el profesor'  ELSE 'el profesor' END AS profe FROM ges_constancia constancia LEFT join ges_registro_tutor tutor on tutor.num_eco=constancia.num_eco LEFT join cat_trimestre trimestre on trimestre.trimestre=constancia.trimestre LEFT join cat_div_dpto div_dpto on div_dpto.id_depto =tutor.depto where constancia.num_eco= ? and constancia.trimestre= ?;";

$stmt_exi = $connection->prepare($query_exi);
$stmt_exi->execute(array($usuario,$trimestre));
$total = $stmt_exi->rowCount();
//$data = array();
if ($total > 0) {
            while ($row = $stmt_exi->fetch()) {
                $folio = "{$row['col1']}";
                $f_constancia = "{$row['col2']}";
                $nom = "{$row['col3']}";
                $ap = "{$row['col4']}";
                $am = "{$row['col5']}";
                $depa = "{$row['col6']}";
                $divi = "{$row['col7']}";
                $inicio = "{$row['col8']}";
                $fin = "{$row['col9']}";
                $profe = "{$row['profe']}";
                
            }
        }

        /*  
            4. LISTA ESTUDIANTES */

?>
<style>
    .pre1 {
        width: 97% !important;
    }
    .texto {
       text-align: justify;
    }
    #resp_avance {
        height:400px;
        overflow: auto;
    }
    tbody tr:nth-child(2n+1) {
        background-color: #fff !important;
        border-color: #000;
    } 
</style>
<body>

    <main>
        <div style="display: none;">
            <div id="exportable" class="container">
                <div>
                    <p>
                        <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/logo_b.png" alt="UAM-X">
                    </p>
                    <p style="text-align: right;"><b><i>Programa Institucional de Tutoría</i></b></p>
                    <p style="text-align: right;"><b><?php echo $folio; ?></b></p>
                    <p style="text-align: right;">Ciudad de México, a <?php echo $f_constancia; ?>.</p>
                </div>
                
                <div class="col-md-12 pt-4 pl-5"> 
                    <p><b>A QUIEN CORRESPONDA: </b></p>

                    <p style="text-align: justify;">La Coordinación de Desarrollo Educativo, a través de la Oficina de Acompañamiento a Trayectorias Académicas del Alumnado, hace constar que <?php echo $profe; ?><b> <?php echo $nom." ".$ap." ".$am.","; ?></b> con No. Eco. <b><?php echo $usuario; ?></b>  adscrito al Departamento de <b> <?php echo $depa.","; ?></b> de la División de <b> <?php echo $divi.","; ?></b> realizó las actividades correspondientes al Programa Institucional de Tutoría, con los siguientes estudiantes, durante el trimestre <b> <?php echo $trimestre; ?> </b> <b>(<?php echo $inicio." al ".$fin; ?>)</b>. </p>
                                        
                    <table style="border-collapse: collapse; margin: auto;" bordercolor="#111111"  width="90%" >
                        <thead>
                             <tr>
                              <td colspan="4" style="font-size:0.8em; text-align: center; padding: 5px; border: solid; border-width: 1px;" ><b>PERSONAS TUTORADAS TRIMESTRE <?php echo $trimestre; ?> </b></td>
                             </tr>
                            <tr>
                                <th scope="col" style="font-size:0.8em; text-align: center; padding: 5px; border: solid; border-width: 1px;" width="25%">MATRÍCULA</th>                  
                                <th scope="col" style="font-size:0.8em; text-align: center; padding: 5px; border: solid; border-width: 1px;" width="25%">APELLIDO</th>
                                <th scope="col" style="font-size:0.8em; text-align: center; padding: 5px; border: solid; border-width: 1px;" width="25%">NOMBRE</th>
                                <th scope="col" style="font-size:0.8em; text-align: center; padding: 5px; border: solid; border-width: 1px;" width="25%">LICENCIATURA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query_est = "SELECT est.matri_alu as matri, UPPER(est.nombre) as nombre, UPPER(est.ap) as ap,  UPPER(est.am) as am, UPPER(entrevista.lic) as lice FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where status_estudiante = 2 and est_tutor.trimestre =? and  no_eco = ? ;";

                                $stmt_est = $connection->prepare($query_est);
                                $stmt_est->execute(array($trimestre,$usuario));
                                $dir = $stmt_est->rowCount();
                                if ($dir > 0) {
                                    while ($row1 = $stmt_est->fetch()) {
                                        $matri = "{$row1['matri']}";
                                        $nom_alu = "{$row1['nombre']}";
                                        $ap_alu = "{$row1['ap']}";
                                        $am_alu = "{$row1['am']}";
                                        $lic = "{$row1['lice']}";
                                        ?>
                                        <tr>
                                            <td style="font-size:0.7em; padding: 5px; text-align: center; border: solid; border-width: 1px;">
                                                <?php echo $matri; ?>
                                            </td>
                                            <td style="font-size:0.7em; padding: 5px; text-align: center; border: solid; border-width: 1px;">
                                                <?php echo $ap_alu." ".$am_alu; ?>
                                            </td>
                                            <td style="font-size:0.7em; padding: 5px; text-align: center; border: solid; border-width: 1px;" >
                                                <?php echo $nom_alu; ?>
                                            </td>
                                            <td style="font-size:0.7em; padding: 5px; text-align: center; border: solid; border-width: 1px;" >
                                                <?php echo $lic; ?>
                                            </td>
                                        </tr> 

                                        <?php
                                    }
                                }

                            ?>
                            
                        </tbody>
                    </table>

                    <p style="text-align: justify;">Se expide la presente constancia a solicitud de la parte interesada y para los fines que a la misma convengan.<br><br></p>

                    <p><b>Atentamente<br>Casa abierta al Tiempo</b></p>

                    <p>
                        <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/signa.png" alt="ATAA" style="max-width:55px; height: auto;">
                        <br>
                        <b>Mtra. Nancy Camacho Arroyo</b><br>
                        Jefa de la Oficina de Acompañamiento<br>
                        a Trayectorias Académicas del Alumnado (ATAA)<br><br>
                    </p>

                    <table width="95%" >
                        <tbody>
                            <tr>
                                <td style="font-size:0.8em; text-align: left; " width="15%">
                                    <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/logo_ATAA_01.png" style="max-width:60px; height: auto;" alt="ATAA">
                                </td>
                                <td style="font-size:0.6em; padding: 5px; text-align: left; " width="85%">
                                    Coordinación de Desarrollo Educativo - ATAA<br>
                                    Calzada del Hueso 1100, Col. Villa Quietud, Alcaldía Coyoacán, C.P.04960, Ciudad de
                                    México Edificio “B”<br>
                                    Planta Baja, Tel.- 55 5483-7183.<br>
                                    ataa@correo.xoc.uam.mx / www.xoc.uam.mx<br>
                                </td>
                            </tr> 
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <div class="row m-2 p-2">
            <div class="col-md-12">
                <h5 class="text-dark mt-5">Agradecemos tu participación en el Programa de Tutoría del trimestre <?php echo $trimestre; ?>. Haz clic en el siguiente botón para obtener tu constancia. <br><br></h5>
                <p class="text-center">
                    <button id="exptopdf" type="button" class="btn btn-primary btn_02">
                    <span class="badge text_sup_01 text-light text-uppercase"><i class="material-icons">file_download</i> Descargar</span>
                    </button>
                </p>
                <input type="hidden" name="html_content" id="htmlContent"> 
            </div>
        </div>    

    </main>
</body>



<script>
    (function() {
        // Obtener el contenido del div
        var content_pre = document.getElementById('exportable').innerHTML;
        var content = '<html><head><style>@font-face { font-family: "Roboto"; src: url("../../php/dompdf/fonts/Roboto-Regular.ttf") format("truetype"); font-weight: normal; } @font-face { font-family: "Roboto"; src: url("../../php/dompdf/fonts/Roboto-Bold.ttf") format("truetype"); font-weight: bold; } body { font-family: "Roboto", sans-serif!important; } </style> </head> <body>' + content_pre + '</body> </html>';
        
        // Copiar el contenido del div al campo oculto
        document.getElementById('htmlContent').value = content;

        var nom_doc = 'INFORME_INDIVIDUAL.pdf';

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
            a.download = nom_doc;
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => console.error('Error:', error));
    })();
</script>
</script>
