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
    $sql = "SELECT * FROM at_apoyados WHERE matricula='$matricula' ";
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
<form id="form_apoyados" data-xforma="apoyados" >
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula Apoyado<br />
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
                   placeholder="Ingresa teléfono" >
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
            if ($row['division1'] == 'CBS') {
                $chkcbs = ' CHECKED ';
            } else if ($row['division1'] == 'CSH') {
                $chkcsh = ' CHECKED ';
            } else if ($row['division1'] == 'CAD') {
                $chkcad = ' CHECKED ';
            }
            ?>
            <div class="form-check form-check-inline mr-5 ">
                <input <?php echo $chkcbs; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CBS" id="cbs" onclick="mostrarCarreras2()"> 
                &nbsp; <label class="form-check-label" for="cbs">
                    CBS
                </label>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; 
            <div class="form-check form-check-inline mr-5 ">
                <input <?php echo $chkcsh; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CSH" id="csh" onclick="mostrarCarreras2()"> 
                &nbsp; <label class="form-check-label" for="csh">
                    CSH
                </label>
            </div>   
            &nbsp; &nbsp; &nbsp; &nbsp; 
            <div class="form-check form-check-inline mr-10 ">
                <input <?php echo $chkcad; ?> required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CyAD" id="cyad" onclick="mostrarCarreras2()"> 
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
            <div id="carreras" class="carreras">
                <select required id="listaCarreras1" name="carrera" class="form-select" disabled>
                    <option value="">Selecciona una división primero</option>
                </select>
            </div>
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
    <!-- Campo: temas -->
    <div class="row align-items-center mb-3">
        <label for="temas" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-journal-text me-2"></i> Especifica en qué temas requieres el apoyo
        </label>
        <div class="col-sm-9">
            <textarea required class="form-control" id="temas" name="temas" rows="4" placeholder="Especifica en qué temas requieres el apoyo"><?php echo $row['temas']; ?></textarea>
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
            <button id="btn_apoyados" type="submit" class="btn btn-primary ms-3"> <i class="bi bi-arrow-clockwise"></i> Actualizar</button>                        
        </div>
    </div> 
</form>
<script>
    $(document).ready(function () {
        var divSel = "<?php echo $row['division1']; ?>";
        var carSel = "<?php echo $row['carrera']; ?>";
        $('#' + divSel.toLowerCase()).trigger('click');
        if ($("#listaCarreras1 option[value='" + carSel + "']").length > 0) {
            $("#listaCarreras1").val(carSel).change(); // Selecciona y dispara el evento change
        }                
    });
</script>
