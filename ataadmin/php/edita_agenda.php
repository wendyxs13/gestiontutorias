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
$indice = $_GET['indice'];

include_once 'conn.php';
$pdo = Connection::getInstance();
try {
    $sql = "SELECT * FROM at_agenda WHERE id='$indice' ";
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
$valores = ['FALSO', 'VERDADERO'];
?>
<form id="form_agenda" data-xforma="agenda" >
    <!-- Folio -->
    <div class="row align-items-center mb-3">
        <label for="horario" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-tag"></i> FOLIO
        </label>
        <div class="col-sm-9">
            <h5 class='text-primary'><b><?php echo $row['id']; ?></b></h5>
            <input value="<?php echo $row['id']; ?>" required type="hidden" id="id" name="id">
        </div>
    </div>
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula Apoyado<br />
            <i class="bi bi-person me-2"></i> Nombre
        </label>
        <div class="col-sm-9">            
            <h6 class="text-primary"><?php echo $row['matricula_apoyado']; ?></h6>
            <h6 class="text-primary"><?php echo $row['nombre_apoyado']; ?></h6>                        
        </div>
    </div> 
    <!-- Licenciatura -->
    <div class="row align-items-center mb-3">
        <label for="licenciatura" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-mortarboard me-2"></i> Licenciatura
        </label>
        <div class="col-sm-9">
            <h6 class="text-primary"><?php echo $row['licenciatura']; ?></h6>
            <!--<input required type="text" class="form-control" id="licenciatura" name="licenciatura" value="<?php //echo $row['licenciatura']; ?>">-->
        </div>
    </div>
    <!-- Trimestre -->
    <div class="row align-items-center mb-3">
        <label for="trimestre" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-calendar3 me-2"></i> Trimestre
        </label>
        <div class="col-sm-9">
            <h6 class="text-primary"><?php echo $row['trimestre']; ?></h6>
<!--            <select required id="trimestre" name="trimestre" class="form-select">
                <option value="">Selecciona trimestre</option>-->
                <?php
//                foreach ($trimes as $value => $text) {
//                    $sel = '';
//                    if ($row['trimestre'] == $value) {
//                        $sel = ' SELECTED ';
//                    }
//                    echo "<option $sel value=\"$value\">$text</option>";
//                }
                ?>
<!--            </select>-->
        </div>
    </div>
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula apoyo<br />
            <i class="bi bi-person me-2"></i> Nombre
        </label>
        <div class="col-sm-9">            
            <h6 class="text-primary"><?php echo $row['matricula_apoyo']; ?></h6>
            <h6 class="text-primary"><?php echo $row['nombre_apoyo']; ?></h6>                        
        </div>
    </div>     
    <!-- Día -->
    <div class="row align-items-center mb-3">
        <label for="dia" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-calendar-check me-2"></i> Día
        </label>
        <div class="col-sm-9">
            <input required type="date" class="form-control" id="dia" name="dia" value="<?php echo $row['dia']; ?>">
        </div>
    </div>
    <!-- Horario -->
    <div class="row align-items-center mb-3">
        <label for="horario" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-clock me-2"></i> Hora
        </label>
        <div class="col-sm-9">
            <input required type="time" class="form-control" id="horario" name="horario" value="<?php echo $row['horario']; ?>">
        </div>
    </div>
    <!-- Lugar de apoyo -->
    <div class="row align-items-center mb-3">
        <label for="lugar_apoyo" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-geo-alt me-2"></i> Lugar de sesión
        </label>
        <div class="col-sm-9" style="line-height: 35px;">
            <?php
            $lugares = ['Oficina de ATAA', 'Sala de la CDE', 'Salón de la UAM', 'Espacio abierto', 'En línea'];
            foreach ($lugares as $lugar) :
                ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="lugar_<?php echo $lugar; ?>" name="lugar" value="<?php echo $lugar; ?>" <?php echo ($row['lugar'] == $lugar) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="lugar_<?php echo $lugar; ?>"> <?php echo $lugar; ?> </label>
                </div>
            <?php endforeach; ?>            
        </div>
    </div>
    <!-- Temas de apoyo -->
    <div class="row align-items-center mb-3">
        <label for="temas_apoyo" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-chat-left-text me-2"></i> Temas de apoyo
        </label>
        <div class="col-sm-9">
            <textarea class="form-control" id="temas_apoyo" name="temas_apoyo" rows="3"><?php echo $row['temas_apoyo']; ?></textarea>
        </div>
    </div>
    <!-- Observaciones -->
    <div class="row align-items-center mb-3">
        <label for="observaciones" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-journal-text me-2"></i> Observaciones
        </label>
        <div class="col-sm-9">
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?php echo $row['observaciones']; ?></textarea>
        </div>
    </div>    
    <!-- Estado de la sesión -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-check-circle me-2"></i> Estado de la sesión
        </label>
        <div class="col-sm-9">
            <?php
            $estados_sesion = ['Pendiente', 'Completada', 'Reagendada', 'Cancelada'];
            foreach ($estados_sesion as $estadoses) :
                ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="estado_<?php echo $estadoses; ?>" name="estado_sesion" value="<?php echo $estadoses; ?>" <?php echo ($row['estado_sesion'] == $estadoses) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="estado_<?php echo $estadoses; ?>"> <?php echo $estadoses; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Apoyo de integración -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Apoyo de integración
        </label>
        <div class="col-sm-9">
            <?php
            $integracion = ['Integración', 'Permanencia'];
            foreach ($integracion as $integra) :
                ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="apoyo_<?php echo $integra; ?>" name="apoyo_integracion" value="<?php echo $integra; ?>" <?php echo ($row['apoyo_integracion'] == $integra) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="apoyo_<?php echo $integra; ?>"> <?php echo $integra; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Retribución social -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Retribución social
        </label>
        <div class="col-sm-9">
            <?php foreach ($valores as $valor) : ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="retribucion_<?php echo $valor; ?>" name="retribucion_social" value="<?php echo $valor; ?>" <?php echo ($row['retribucion_social'] == $valor) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="retribucion_<?php echo $valor; ?>"> <?php echo $valor; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>    
    <!-- Bitácora de apoyo -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-journal-check me-2"></i> Bitácora de apoyo
        </label>
        <div class="col-sm-9">
            <?php foreach ($valores as $valor) : ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="bitacora_apoyo_<?php echo $valor; ?>" name="bitacora_apoyo" value="<?php echo $valor; ?>" <?php echo ($row['bitacora_apoyo'] == $valor) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="bitacora_apoyo_<?php echo $valor; ?>"> <?php echo $valor; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bitácora apoyado -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-journal-check me-2"></i> Bitácora apoyado
        </label>
        <div class="col-sm-9">
            <?php foreach ($valores as $valor) : ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="bitacora_apoyado_<?php echo $valor; ?>" name="bitacora_apoyado" value="<?php echo $valor; ?>" <?php echo ($row['bitacora_apoyado'] == $valor) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="bitacora_apoyado_<?php echo $valor; ?>"> <?php echo $valor; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Lista de espera -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-hourglass-split me-2"></i> Lista de espera
        </label>
        <div class="col-sm-9">
            <?php foreach ($valores as $valor) : ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="lista_espera_<?php echo $valor; ?>" name="lista_espera" value="<?php echo $valor; ?>" <?php echo ($row['lista_espera'] == $valor) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="lista_espera_<?php echo $valor; ?>"> <?php echo $valor; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Estado -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Estado
        </label>
        <div class="col-sm-9">
            <?php
            $estados = ['Activo', 'Inactivo'];
            foreach ($estados as $estado) :
                ?>
                <div class="form-check form-check-inline">
                    <input required class="form-check-input big-radio" type="radio" id="estado_<?php echo $estado; ?>" name="estado" value="<?php echo $estado; ?>" <?php echo ($row['estado'] == $estado) ? 'checked' : ''; ?>>
                    <label required class="form-check-label" for="estado_<?php echo $estado; ?>"> <?php echo $estado; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>  
    <!-- Botón de Enviar -->
    <div class="row">
        <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="bi bi-x-circle"></i> Cancelar</button> 
            <button id="btn_agenda" type="submit" class="btn btn-primary ms-3"> <i class="bi bi-arrow-clockwise"></i> Actualizar </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {

    });
</script>
