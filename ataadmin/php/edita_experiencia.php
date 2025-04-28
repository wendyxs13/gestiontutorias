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
    $sql = "SELECT * FROM at_experiencia WHERE id='$indice' ";
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
<form id="form_experiencia" data-xforma="experiencia" >
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula Apoyado<br />
            <i class="bi bi-person me-2"></i> Nombre
        </label>
        <div class="col-sm-9">            
            <h6 class="text-primary"><b><?php echo $row['matricula']; ?></b></h6>
            <h6 class="text-primary"><b><?php echo $row['nombre']; ?></b></h6>            
            <input value="<?php echo $row['id']; ?>" required type="hidden" id="id" name="id">
        </div>
    </div>      
    <!-- Programa académico -->
    <div class="row align-items-center mb-3">
        <label for="programa" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-book me-2"></i> Programa académico
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['programa']; ?>" required type="text" class="form-control" id="programa" name="programa" placeholder="Ingresa programa académico">
        </div>
    </div>

    <!-- Trimestre -->
    <div class="row align-items-center mb-3">
        <label for="trimestre" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-calendar3 me-2"></i> Trimestre
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

    <!-- Nombre del Apoyo Par -->
    <div class="row align-items-center mb-3">
        <label for="nombreapoyo" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Nombre de la persona que te apoyó
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['nombreapoyo']; ?>" required type="text" class="form-control" id="nombreapoyo" name="nombreapoyo" placeholder="Ingresa nombre de la persona que te apoyó">
        </div>
    </div>

    <!-- Modalidad (Presencial o Remota) -->
    <div class="row align-items-center mb-3">
        <label for="modalidad" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-camera-video me-2"></i> Modalidad de reunión
        </label>
        <div class="col-sm-9">
            <?php
            $chkpre = '';
            $chkrem = '';
            if ($row['modalidad'] == 'Presencial') {
                $chkpre = ' CHECKED ';
            } else if ($row['modalidad'] == 'Remota') {
                $chkrem = ' CHECKED ';
            }
            ?>
            <div class="form-check form-check-inline">
                <input <?php echo $chkpre; ?> required class="form-check-input big-radio" type="radio" name="modalidad" value="Presencial" id="presencial"> 
                <label class="form-check-label" for="presencial">Presencial</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkrem; ?> required class="form-check-input big-radio" type="radio" name="modalidad" value="Remota" id="remota"> 
                <label class="form-check-label" for="remota">Remota (Vía Zoom)</label>
            </div> 
        </div>
    </div>

    <!-- Medios de comunicación (checkbox) -->
    <div class="row align-items-center mb-3">
        <label for="medios" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-chat me-2"></i> Medios de comunicación
        </label>
        <div class="col-sm-9">
            <?php
            $chkcorr = '';
            $chkataa = '';
            $chkcelu = '';
            $chkvide = '';
            if (strpos($row['medios'], 'Correo electrónico') !== false) {
                $chkcorr = ' CHECKED ';
            } 
            if (strpos($row['medios'], 'Oficina de ATAA') !== false) {
                $chkataa = ' CHECKED ';
            } 
            if (strpos($row['medios'], 'Celular') !== false) {
                $chkcelu = ' CHECKED ';
            } 
            if (strpos($row['medios'], 'Videoconferencia') !== false) {
                $chkvide = ' CHECKED ';
            }
            ?>
            <div class="form-check form-check-inline">
                <input <?php echo $chkcorr; ?> class="form-check-input big-radio" type="checkbox" id="correo" name="medios" value="Correo electrónico">
                <label class="form-check-label" for="correo">Correo electrónico</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkataa; ?> class="form-check-input big-radio" type="checkbox" id="oficina" name="medios" value="Oficina de ATAA">
                <label class="form-check-label" for="oficina">Oficina de ATAA</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkcelu; ?> class="form-check-input big-radio" type="checkbox" id="celular" name="medios" value="Celular">
                <label class="form-check-label" for="celular">Celular</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkvide; ?> class="form-check-input big-radio" type="checkbox" id="videoconferencia" name="medios" value="Videoconferencia">
                <label class="form-check-label" for="videoconferencia">Videoconferencia</label>
            </div>
        </div>
    </div>

    <!-- Resolución de dudas (radio) -->
    <div class="row align-items-center mb-3">
        <label for="resolucion" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-question-circle me-2"></i> Resolución de dudas
        </label>

        <div class="col-sm-9">
            <?php
            $chkning = '';
            $chkcasn = '';
            $chkalgu = '';
            $chkcast = '';
            $chktoda = '';
            if (strpos($row['resolucion'], 'Ninguna') !== false) {
                $chkning = ' CHECKED ';
            } else if (strpos($row['resolucion'], 'Casi ninguna') !== false) {
                $chkcasn = ' CHECKED ';
            } else if (strpos($row['resolucion'], 'Algunas') !== false) {
                $chkalgu = ' CHECKED ';
            } else if (strpos($row['resolucion'], 'Casi todas') !== false) {
                $chkcast = ' CHECKED ';
            } else if (strpos($row['resolucion'], 'Todas') !== false) {
                $chktoda = ' CHECKED ';
            }
            ?>
            <div class="form-check form-check-inline">
                <input <?php echo $chkning; ?> required class="form-check-input big-radio" type="radio" name="resolucion" value="Ninguna" id="ninguna"> 
                <label class="form-check-label" for="ninguna">Ninguna</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkcasn; ?> required class="form-check-input big-radio" type="radio" name="resolucion" value="Casi ninguna" id="algunas"> 
                <label class="form-check-label" for="casi_ninguna">Casi ninguna</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkalgu; ?> required class="form-check-input big-radio" type="radio" name="resolucion" value="Algunas" id="algunas"> 
                <label class="form-check-label" for="algunas">Algunas</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chkcast; ?> required class="form-check-input big-radio" type="radio" name="resolucion" value="Casi todas" id="algunas"> 
                <label class="form-check-label" for="casi_todas">Casi todas</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo $chktoda; ?> required class="form-check-input big-radio" type="radio" name="resolucion" value="Todas" id="todas"> 
                <label class="form-check-label" for="todas">Todas</label>
            </div>
        </div>
    </div>
    <!-- Comentarios -->
    <div class="row align-items-center mb-3">
        <label for="comentarios" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-chat-dots me-2"></i> Comentarios
        </label>
        <div class="col-sm-9">
            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"><?php echo $row['comentarios']; ?></textarea>
        </div>
    </div>
    <!-- Estado -->
    <div class="row align-items-center mb-3">
        <label class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Estado
        </label>
        <div class="col-sm-9">
            <?php $estados = ['Activo','Inactivo'];  
            foreach ($estados as $estado) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input big-radio" type="radio" id="estado_<?php echo $estado; ?>" name="estado" value="<?php echo $estado; ?>" <?php echo ($row['estado'] == $estado) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="estado_<?php echo $estado; ?>"> <?php echo $estado; ?> </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div> 
    <!-- Botón de Enviar -->
    <div class="row mb-3">
        <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="bi bi-x-circle"></i> Cancelar</button> 
            <button id="btn_experiencia" type="submit" class="btn btn-primary ms-3"> <i class="bi bi-arrow-clockwise"></i> Actualizar</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {

    });
</script>
