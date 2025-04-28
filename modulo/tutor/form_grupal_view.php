<?php
session_start();
if (!isset($_SESSION['us_tutor'])) {
    header("location:../../login.php");
}
$usuario = ($_SESSION['us_tutor']);
$nombre_tutor = ($_SESSION['nombre']);
$email = ($_SESSION['us_correo']);
$div = ($_SESSION['div']);
$_SESSION['us_tutor'] = $usuario;
$_SESSION['nombre'] = $nombre_tutor;
$_SESSION["us_correo"] = $email;
$_SESSION["div"] = $div;
$_SESSION["matricula"] = "0";
include '../../php/conn.php';
$connection = Connection::getInstance();
$query_locale = "SET lc_time_names = 'es_MX';";
$stmt_locale = $connection->prepare($query_locale);
$stmt_locale->execute();

$trim_codi = $_POST['trim_inf'];
$trim = base64_decode($trim_codi); 
$trim = htmlspecialchars($trim);

$query_exi = "SELECT est.matri_alu as matri, est.nombre, est.ap, est.am,  entrevista.lic as lice, entrevista.prom as promedio, prom.trimestre as trime, prom.prom_fin as pf, DATE_FORMAT(fecha_g1, '%e de %M de %Y') AS fecha_g1 FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est_tutor.matricula=entrevista.matricula LEFT join ges_tutoria_grupal_1 prom on est_tutor.matricula=prom.matricula and est_tutor.trimestre = prom.trim_informe where status_estudiante = 2 and no_eco = ? and est_tutor.trimestre = ? ;";

$stmt_exi = $connection->prepare($query_exi);
$stmt_exi->execute(array($usuario, $trim));
$total = $stmt_exi->rowCount();

/*
$data = array();
if ($total) {
    $data = $stmt_exi->fetch();
}*/
       
?>
<style type="text/css">
    tbody tr:nth-child(2n+1) {
        background-color: #fff !important;
    }    
    .container {
        padding: 0px 20px !important;
    }
</style>
<div id="exportable" class="container">
    <div>
        <p>
            <img class="img-fluid" src="https://gestiontutorias.xoc.uam.mx/img/logo_b.png" alt="UAM-X">
        </p>
        <p style="text-align: right;"><b>Programa Institucional de Tutoría<br>Informe grupal del trimestre: <?php echo $trim; ?></b></p>
        <p style="text-align: right;">Ciudad de México, a <?php echo $data['fecha_g1']; ?>.</p>
 
    </div>

    <div class="row mt-0 ">
        

        <div id="secc_1"><!-- secc_01 -->
            <p><b>I. Persona tutora</b></p>
            <p style="font-size:1em;"  class="ml-4 texto_01">
                <b>Nombre:</b> <?php echo $nombre_tutor; ?> <br>
                <b>Número económico:</b> <?php echo $usuario; ?> <br>
                <b>División académica:</b> <?php echo $div; ?><br>
                <b>Departamento:</b>  <br>
                <b>Estudiantes asignados:</b> <?php echo $total; ?> <br>
            </p>


            <p><b>II. Personas tutoradas</b></p>
            <table class="table " width="99%" >
                <thead class="backBlue2">
                    <tr>
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="2%">#</th>                  
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="28%">Nombre</th>
                        <th scope="col" style="font-size:0.8em; text-align: left; padding-left: 5px;" width="12%">Matrícula</th>
                        <th scope="col" style="font-size:0.8em; text-align: left; padding-left: 10px;" width="25%">Licenciatura</th>
                        <th scope="col" style="font-size:0.8em;" width="10%">Calificación inicial</th>
                        <th scope="col" style="font-size:0.8em;" width="13%">Trimestre cursado</th>
                        <th scope="col" style="font-size:0.8em;" width="10%">Calificación final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($total > 0) {
                        $alu_in = 0;
                        while ($row = $stmt_exi->fetch()) {
                            $trime = "";
                            $pf = "";
                            $matricula = "{$row['matri']}";
                            $nombre = "{$row['nombre']}";
                            $lic = "{$row['lice']}";
                            $promedio = "{$row['promedio']}";
                            $trime = "{$row['trime']}";
                            $pf = "{$row['pf']}";
                            $alu_in = $alu_in + 1;
                            ?>
                            <tr>
                                <td style="font-size:0.8em;"><?php echo $alu_in; ?></td>
                                <td style="font-size:0.7em; padding-left: 5px;"><?php echo $nombre; ?></td>
                                <td style="font-size:0.8em; padding-left: 5px;" ><?php echo $matricula; ?></td>
                                <td style="font-size:0.7em; padding-left: 10px;" ><?php echo $lic; ?></td>
                                <td style="font-size:0.8em; text-align:center;" ><?php echo $promedio; ?></td>
                                <td style="font-size:0.8em; text-align:center;" ><?php echo $trime; ?></td> 
                                <td style="font-size:0.8em; text-align:center;" ><?php echo $pf; ?></td>                                    
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>                
        </div><!-- secc_01 -->

        <!-- *************************************
                  TRAER LOS DATOS DE LAS SESIONES 
        *******************************************-->
        <?php
        $query_ses = "SELECT DATE_FORMAT(fecha, '%d/%m/%Y') as fecha, horas, temas, modalidad FROM ges_tutoria_grupal_2 WHERE num_eco = $usuario and trim_informe = '$trim';"; //AND trim_informe_g2 = ?
        $stmt_ses = $connection->prepare($query_ses);
        $stmt_ses->execute();
        $totalses = $stmt_ses->rowCount();
        $modalidades = Array(
            1 => 'Presencial',
            2 => 'Remota'
        );
        ?>
        <div id="secc_2"><!-- secc_02 -->                
            <p>
                <b>III.  De las sesiones de tutoría </b>
            </p>
            <table id="table_sesion" class="table" style="width:95%;">
                <thead class="backBlue2">
                    <tr>                  
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="2%"># </th>
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="8%">Fecha</th>
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="8%">Duración</th>
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="74%">Temas abordados</th>
                        <th scope="col" style="font-size:0.8em; text-align: left;" width="8%">Modalidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($totalses > 0) {
                        $nses = 0;
                        while ($row = $stmt_ses->fetch()) {
                            $nses++;
                            $fecha = "{$row['fecha']}";
                            $horas = "{$row['horas']}";
                            $temas = "{$row['temas']}";
                            $modal = "{$row['modalidad']}";
                            ?>
                            <tr>
                                <td style="font-size:0.8em; text-align: left;"><?php echo $nses; ?></td>
                                <td style="font-size:0.8em; text-align: left;" ><?php echo $fecha; ?></td>
                                <td style="font-size:0.8em; text-align: left;"><?php
                                    echo $horas;
                                    echo $horas == 1 ? ' hora' : ' horas';
                                    ?></td>
                                <td style="font-size:0.8em; text-align: left;"><?php echo $temas; ?></td> 
                                <td style="font-size:0.8em; text-align: left;"><?php echo $modalidades[$modal]; ?></td>                                    
                            </tr>
                            <?php
                        }
                    } else {
                        //echo "<tr><td colspan='5' class='text-center'><h5> NO HAY SESIONES REGISTRADAS </h5>";
                    }
                    ?>
                </tbody>
            </table>                                              
        </div><!-- secc_02 -->
        <!-- **************************************
            DATOS DE LA TUTORIA INDIVIDUALIZADA
        *******************************************-->
        <?php
        $falta = "";
        $falta_est = "";
        $individual = "";
        $individual_est = "";
        $ind_razon = "";
        $continuar = "";
        $participa = "";
        $otra = "";
        $query_per = "SELECT tutoria_falta as falta, "
                . " tutoria_falta_est as falta_est, tutoria_ind as individual, "
                . " tutoria_ind_est as individual_est, tutoria_ind_razon as ind_razon, "
                . " tutoria_continuar as continuar, participa, otra_participa as otra, comentarios "
                . " FROM ges_tutoria_grupal_3 WHERE num_eco = $usuario and trim_informe = '$trim' ; ";
        //AND trim_informe_g2 = ?
        $stmt_per = $connection->prepare($query_per);
        $stmt_per->execute();
        $totalper = $stmt_per->rowCount();
        if ($totalper > 0) {
            while ($row = $stmt_per->fetch()) {
                $falta = "{$row['falta']}";
                $falta_est = "{$row['falta_est']}";
                $individual = "{$row['individual']}";
                $individual_est = "{$row['individual_est']}";
                $ind_razon = "{$row['ind_razon']}";
                $continuar = "{$row['continuar']}";
                $participa = "{$row['participa']}";
                $otra = "{$row['otra']}"; 
                $comentarios = "{$row['comentarios']}";
            }
        }
        $tutoriacontinuar = array(
            '' => '',
            '0' => '',
            'si' => 'Yo puedo brindar la tutoría personalizada.',
            'no' => 'Reasignen al estudiantado, por favor.'
        );
        $participacion = array(
            '' => '',
            0 => '',
            1 => 'Deseo seguir participando en el Programa de Tutoría y continuar con mis asignaciones actuales.',
            2 => 'Deseo seguir participando en el Programa Institucional de Tutoría y aumentar mi número de asignaciones de personas tutoradas.',
            3 => 'No podré continuar participando en el Programa Institucional de Tutoría debido a que me tomaré un año sabático.',
            4 => 'No podré continuar participando en el Programa Institucional de Tutoría debido a que tramité mi jubilación o tengo algún tema relacionado con mi contratación.',
            5 => 'No podré continuar participando en el Programa Institucional de Tutoría debido a que tengo otros proyectos que me demandan tiempo.'
        );
        ?>
        <!---- IV. De la tutoría individualizada  ----->
        <div id="secc_3"><!-- secc_03 -->
            <p>
                <b>IV. La tutoría individualizada </b>
            </p>              
            <div class="form-group row  ml-4">
                <p class="pre1 col-md-11 pb-2 mb-0 "><b>¿Algún alumno o alumna faltó a las sesiones de tutoría?</b></p>
                <div class="col-md-6 " >
                    <div class="d-flex align-items-start">              
                        <?php echo strtoupper($falta); ?>
                    </div>
                </div>
            </div>
            <?php if ($falta == 'si') { ?>
                <div id="div3" style="color: #212529!important;"><!---- div3 ----->
                    <div class="form-group row  ml-4 pb-1 mb-1">
                        <p class="pre1 col-md-11 pb-2 mb-2"><b>¿Quién?</b></p>
                    </div>
                    <div class="row mt-0 pt-0 ml-3 pl-3 mr-3 pr-3">
                        <?php
                        $temp = str_replace("|0", "", $falta_est);
                        $temp = str_replace("|", " OR matri_alu = ", $temp);
                        $mats = " WHERE matri_alu = " . $temp;

                        $query_alumnos = "SELECT matri_alu, nombre, ap, am FROM ges_registro_alu " . $mats;
                        $stmt_02 = $connection->prepare($query_alumnos);
                        $stmt_02->execute(); //array($usuario)
                        $total_02 = $stmt_02->rowCount();
                        if ($total_02 > 0) {
                            while ($row_02 = $stmt_02->fetch()) {
                                $mtricu_02 = "{$row_02['matri_alu']}";
                                $nom_02 = "{$row_02['nombre']}";
                                $ap_02 = "{$row_02['ap']}";
                                $am_02 = "{$row_02['am']}";
                                $nombre_02 = $nom_02." ".$ap_02." ".$am_02;
                                ?>
                                <div class="col-md-12">
                                    <?php echo $mtricu_02 . " - " . $nombre_02; ?>                                                                           
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div><!---- div3  ----->
            <?php } ?>
            <div class="form-group row  ml-4">
                <p class="pre1 col-md-11 pb-2 mb-0 mt-3"><b>¿Considera que alguna de las personas tutoradas requiere tutoría individualizada?</b></p>
                <div class="col-md-6 " >
                    <div class="d-flex align-items-start">              
                        <?php echo strtoupper($individual); ?>
                    </div>
                </div>
            </div>

            <!---- IV. De la tutoría individualizada  ----->
            <?php if ($individual == 'si') { ?>
                <div id="div1" style="color: #212529!important;"><!---- div1  ----->
                    <div class="form-group row  ml-4 pb-1 mb-1">
                        <p class="pre1 col-md-11 pb-2 mb-2"><b>Si es el caso, por favor indique el nombre o nombres del estudiantado que la requiere.</b></p>
                    </div>
                    <div class="row mt-0 pt-0 ml-3 pl-3 mr-3 pr-3">
                        <?php
                        $temp = str_replace("|0", "", $individual_est);
                        $temp = str_replace("|", " OR matri_alu = ", $temp);
                        $mats = " WHERE matri_alu = " . $temp;

                        $query_alumnos = "SELECT matri_alu, nombre, ap, am FROM ges_registro_alu " . $mats;
                        $stmt_02 = $connection->prepare($query_alumnos);
                        $stmt_02->execute(); //array($usuario)
                        $total_02 = $stmt_02->rowCount();
                        if ($total_02 > 0) {
                            while ($row_02 = $stmt_02->fetch()) {
                                $mtricu_02 = "{$row_02['matri_alu']}";
                                $nom_02 = "{$row_02['nombre']}";
                                $ap_02 = "{$row_02['ap']}";
                                $am_02 = "{$row_02['am']}";
                                $nombre_02 = $nom_02." ".$ap_02." ".$am_02;
                                ?>
                                <div class="col-md-2">
                                    <?php echo $mtricu_02; ?>
                                </div>
                                <div class="col-md-10">
                                    <?php echo $nombre_02; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div> <!---- div1  ----->
            <?php } ?>
            <div class="form-group row mt-3 ml-4">
                <p class="pre1 col-md-11 pb-2 mb-2"><b>¿Por qué considera que los estudiantes seleccionados requieren tutoría individualizada?</b></p>
                <div class="col-md-10" >
                    <div class="d-flex align-items-start">              
                        <?php echo ucfirst($ind_razon == '0' ? '' : $ind_razon); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row  ml-4">
                <p class="pre1 col-md-11 pb-2 mb-1"><b>¿Usted podría brindar la tutoría personalizada o prefiere que reasignemos al estudiantado? </b></p>
                <div class="col-md-10" >
                    <div class="d-flex align-items-start">
                        <?php echo $tutoriacontinuar[$continuar]; ?>
                    </div>                        
                </div>
            </div>
        </div><!-- secc_03 -->

        <div id="secc_4"><!-- secc_04 -->            
            <p class="text-justify ml-2 mr-4">
                <b>V. Participación en el Programa Institucional de Tutoría  </b>
            </p>
            <div class="form-group row mt-0 ml-4">                    
                <p class="pre1 col-md-11 pb-2 mb-2">
                    <b>Respecto a su participación en el Programa Institucional de Tutoría:</b>
                </p>
                <div class="col-md-10" >
                    <div class="d-flex align-items-start">
                        <?php echo $participa != '6' ? $participacion[$participa] : "Otra: " . $otra; ?>
                    </div>                        
                </div>

                <p class="pre1 col-md-11 pb-2 mb-2">
                    <b>Comentarios adicionales:</b>
                </p>
                <div class="col-md-10" >
                    <div class="d-flex align-items-start">
                        <?php echo $comentarios; ?>
                    </div>                        
                </div>

            </div>
        </div><!-- secc_04 -->
    </div>
</div>

<div class="row m-2 p-2 d-flex float-right">
    <button id="exptopdf" type="button" class="btn btn-primary btn_10 pl-3 pr-4 text-justify" style="margin: 20px !important;">
        <img class="img-fluid mr-2" src="../../img/pdf.png" alt="" style="max-width: 18px; height: auto;" >Exportar
    </button>   
    <input type="hidden" name="html_content" id="htmlContent"> 
</div>        
<br/>

<script>

    document.getElementById('exptopdf').addEventListener('click', function() {
    // Obtener el contenido del div
    var content = document.getElementById('exportable').innerHTML;
    // Copiar el contenido del div al campo oculto
    document.getElementById('htmlContent').value = content;

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
        a.download = 'INFORME_GRUPAL'+'<?php echo $trim; ?>'+'.pdf';
        document.body.appendChild(a);
        a.click();
        a.remove();
    })
    .catch(error => console.error('Error:', error));
});



</script>