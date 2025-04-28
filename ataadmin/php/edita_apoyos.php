<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
set_time_limit(0);
session_start();
$usuario = ($_SESSION['at_usuario']);
$rol = ($_SESSION['at_rol']);
if ($usuario == '' || $rol == '') {
    header('location:index.php');
    exit();
}
if (empty($_GET) || $_GET['indice'] == '') {
    echo "0#Faltan datos";
    exit();
}
$matricula = $_GET['indice'];

include_once 'conn.php';
$pdo = Connection::getInstance();
try {
    $sql = "SELECT * FROM at_apoyos WHERE matricula='$matricula' ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    if (!empty($row)) {
        
    } else {
        echo '0#No se encontraron datos';
        exit;
    }
} catch (PDOException $e) {
    echo "0#Error BD: " . $e->getMessage();
    exit;
}
$trimes = ["TID" => "TID", "2.o" => "2.º", "3.o" => "3.º", "4.o" => "4.º", "5.o" => "5.º", "6.o" => "6.º", "7.o" => "7.º", "8.o" => "8.º", "9.o" => "9.º", "10.o" => "10.º", "11.o" => "11.º", "12.o" => "12.º", "13.o" => "13.º", "14.o" => "14.º", "15.o" => "15.º"];
?>
<form id="form_apoyos" data-xforma="apoyos" >
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula apoyo<br />
            <i class="bi bi-person me-2"></i> Nombre
        </label>
        <div class="col-sm-9">            
            <h6 class="text-primary"><b><?php echo $row['matricula']; ?></b></h6>
            <h6 class="text-primary"><b><?php echo $row['nombre']; ?></b></h6>            
            <input value="<?php echo $row['matricula']; ?>" required type="hidden" id="matricula" name="matricula">
        </div>
    </div>
    <!-- Campo: Teléfono -->
    <div class="row align-items-center mb-3">
        <label for="telefono" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-telephone me-2"></i> Teléfono
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['telefono']; ?>" required type="tel" class="form-control" id="telefono" name="telefono" maxlength="20" 
                   placeholder="Ingresa teléfono">
        </div>
    </div>

    <!-- Campo: Correo Institucional -->
    <div class="row align-items-center mb-3">
        <label for="correoins" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-envelope me-2"></i> Correo Institucional
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['correoins']; ?>" required type="email" class="form-control correo" id="correoins" name="correoins" maxlength="50" placeholder="Ingresa correo institucional">
        </div>
    </div>

    <!-- Campo: Correo Personal -->
    <div class="row align-items-center mb-3">
        <label for="correoper" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-envelope-open me-2"></i> Correo Personal
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['correoper']; ?>" required type="email" class="form-control correo" id="correoper" name="correoper" maxlength="50" placeholder="Ingresa correo personal">
        </div>
    </div>

    <!-- Campo: División -->
    <div class="row align-items-center mb-3">
        <label for="division" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-diagram-3 me-2"></i> División
        </label>
        <div class="col-sm-9">                                
            <?php
            $chkcbs = '';
            $chkcsh = '';
            $chkcad = '';
            if ($row['division2'] == 'CBS') {
                $chkcbs = ' CHECKED ';
            } else if ($row['division2'] == 'CSH') {
                $chkcsh = ' CHECKED ';
            } else if ($row['division2'] == 'CAD') {
                $chkcad = ' CHECKED ';
            }
            ?>
            <div class="form-check form-check-inline mr-5 ">
                <input <?php echo $chkcbs; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CBS" id="cbs" onclick="mostrarCarreras()"> 
                &nbsp; <label class="form-check-label" for="cbs">
                    CBS
                </label>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; 
            <div class="form-check form-check-inline mr-5 ">
                <input <?php echo $chkcsh; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CSH" id="csh" onclick="mostrarCarreras()"> 
                &nbsp; <label class="form-check-label" for="csh">
                    CSH
                </label>
            </div>   
            &nbsp; &nbsp; &nbsp; &nbsp; 
            <div class="form-check form-check-inline mr-10 ">
                <input <?php echo $chkcad; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CyAD" id="cyad" onclick="mostrarCarreras()"> 
                &nbsp; <label class="form-check-label" for="cyad">
                    CyAD
                </label>
            </div>

        </div>
    </div>
    <!-- Campo: Carrera -->
    <div class="row align-items-center mb-3">
        <label for="carreras" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-briefcase me-2"></i> Carrera
        </label>
        <div class="col-sm-9">
            <div id="carreras">
                <select required id="listaCarreras2" name="carrera" class="form-select" disabled>
                    <option value="">Selecciona una división primero</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Campo: Especialidad -->
    <div class="row align-items-center mb-3">
        <label for="especialidad" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-tools me-2"></i> Especialidad
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['especialidad']; ?>" type="text" class="form-control" id="especialidad" name="especialidad" maxlength="255" placeholder="Ingresa especialidad">
        </div>
    </div>

    <!-- Campo: Trimestre -->
    <div class="row align-items-center mb-3">
        <label for="trimestre" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-calendar me-2"></i> Trimestre
        </label>
        <div class="col-sm-9">
            <select required id="trimestre" name="trimestre" class="form-select">
                <option value="">Selecciona trimestre</option>
                <?php
                foreach ($trimes as $value => $text) {
                    $sel = '';
                    if ($row['trimestre'] == $value) {
                        $sel = ' SELECTED ';
                    }
                    echo "<option $sel value=\"$value\">$text</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Campo: carreras -->
    <div class="row align-items-center mb-3">
        <label for="apoyo_carreras" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-mortarboard me-2"></i> En qué carreras puedes brindar el apoyo
        </label>
        <div class="col-sm-9">
            <fieldset>                                                                        
                <?php
                $carreras = [
                    ["Agronomía", "Biología", "Enfermería", "Estomatología", "Medicina", "MVZ", "Nutrición Humana", "QFB"],
                    ["Administración", "Comunicación Social", "Economía", "Política y Gestión Social", "Psicología", "Sociología"],
                    ["Arquitectura", "Diseño de la Comunicación Gráfica", "Diseño Industrial", "Planeación Territorial"]
                ];
                $seleccionadas = $row['apoyo_carreras'];
                $seleccionadasArray = explode(",", $seleccionadas);
                foreach ($carreras as $grupo) {
                    echo '<div class="checkbox-group">';
                    foreach ($grupo as $carrera) {
                        // Verificar si la carrera está seleccionada
                        $checked = in_array($carrera, $seleccionadasArray) ? 'checked' : '';
                        echo "<label><input class='form-check-input mr-5 big-check' type='checkbox' name='apoyo_carreras' value='$carrera' $checked> $carrera</label>";
                    }
                    echo '</div><br />';
                }
                ?>
            </fieldset>
        </div>
    </div>
    <!-- Campo: días -->
    <div class="row align-items-center mb-3">
        <label for="dias" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-mortarboard me-2"></i> Que días puedes brindar el apoyo
        </label>
        <div class="col-sm-9">
            <fieldset>                                                                        
                <?php
                $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
                $diasSeleccionados = $row['dias'];
                $diasMarcados = explode(",", $diasSeleccionados);
                ?>
                <div class="checkbox-group">
                    <?php foreach ($dias as $dia): ?>
                        <label>
                            <input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="<?= $dia; ?>" 
                                   <?= in_array($dia, $diasMarcados) ? 'checked' : ''; ?>>
                                   <?= $dia; ?>
                        </label>
                    <?php endforeach; ?>
                </div>                                    
            </fieldset>
        </div>
    </div>
    <!-- Campo: horarios -->
    <div class="row align-items-center mb-3">
        <label for="horarios" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-camera-video me-2"></i> Horario
        </label>
        <div class="col-sm-9">
            <?php
            $horarios = [
                "Matutino" => "Matutino (De 8:00 a 12:00 PM)",
                "Vespertino" => "Vespertino (De 12:00 a 19:00 PM)"
            ];
            $horariosSeleccionados = $row['horarios'];
            $horariosMarcados = explode(",", $horariosSeleccionados);
            ?>
            <?php foreach ($horarios as $valor => $descripcion): ?>
                <div class="form-check form-check-inline mr-5">
                    <input class="form-check-input mr-5 big-radio" type="checkbox" name="horarios" value="<?= $valor; ?>" id="<?= strtolower($valor); ?>"
                           <?= in_array($valor, $horariosMarcados) ? 'checked' : ''; ?>>
                    &nbsp; <label class="form-check-label" for="<?= strtolower($valor); ?>">
                        <?= $descripcion; ?>
                    </label>
                </div>
                &nbsp; &nbsp; &nbsp; &nbsp;
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Campo: observaciones -->
    <div class="row align-items-center mb-3">
        <label for="temas" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-list-task me-2"></i> Observaciones
        </label>
        <div class="col-sm-9">
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Ingresa observaciones"><?php echo $row['observaciones']; ?></textarea>
        </div>
    </div>
    <!-- Estado -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Estado
        </label>
        <div class="col-sm-9">
            <?php $estados = ['Activo','Baja temporal','Baja definitiva'];  
            foreach ($estados as $estado) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input big-radio" type="radio" id="estado_<?php echo $estado; ?>" name="estado" value="<?php echo $estado; ?>" <?php echo ($row['estado'] == $estado) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="estado_<?php echo $estado; ?>"> <?php echo $estado; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div> 
    <!-- Botón de Enviar -->
    <div class="row">
        <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="bi bi-x-circle"></i> Cancelar</button> 
            <button id="btn_apoyos" type="submit" class="btn btn-primary ms-3"> <i class="bi bi-arrow-clockwise float-end"></i> Actualizar </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        var divSel = "<?php echo $row['division2']; ?>";
        var carSel = "<?php echo $row['carrera']; ?>";
        $('#' + divSel.toLowerCase()).trigger('click');
        if ($("#listaCarreras2 option[value='" + carSel + "']").length > 0) {
            $("#listaCarreras2").val(carSel).change(); // Selecciona y dispara el evento change
        }
    });
</script>
