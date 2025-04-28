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
    $sql = "SELECT * FROM at_bitacora WHERE id='$indice' ";
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
<form id="form_bitacora" data-xforma="bitacora" >
    <!-- Campo: Matrícula -->
    <div class="row align-items-center mb-3">
        <label for="matricula" class="col-sm-3 col-form-label text-dark">
            <i class="bi bi-person-badge me-2"></i> Matrícula apoyo<br />
            <i class="bi bi-person me-2"></i> Nombre
        </label>
        <div class="col-sm-9">            
            <h6 class="text-primary"><b><?php echo $row['matricula']; ?></b></h6>
            <h6 class="text-primary"><b><?php echo $row['nombre']; ?></b></h6>            
            <input value="<?php echo $row['id']; ?>" required type="hidden" id="id" name="id">
        </div>
    </div> 
    <!-- Campo: Programa académico -->
    <div class="row align-items-center mb-3">
        <label for="programa" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-book me-2"></i> Programa académico que cursas
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['programa']; ?>" required type="text" class="form-control" id="programa" name="programa" maxlength="255" placeholder="Ingresa programa académico que cursas">
        </div>
    </div>

    <!-- Campo: Trimestre -->
    <div class="row align-items-center mb-3">
        <label for="trimestre" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-calendar2-range me-2"></i> Trimestre que cursas
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

    <!-- Campo: Nombre de la persona apoyada -->
    <div class="row align-items-center mb-3">
        <label for="nombreapoyada" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-people me-2"></i> Nombre de la persona que apoyaste
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['nombreapoyada']; ?>" required type="text" class="form-control" id="nombreapoyada" name="nombreapoyada" maxlength="255" placeholder="Ingresa nombre de la persona que apoyaste">
        </div>
    </div>

    <!-- Campo: Modalidad -->
    <div class="row align-items-center mb-3">
        <label for="modalidad" class="col-sm-3  col-form-label text-dark">
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

    <!-- Campo: Fecha de la sesión -->
    <div class="row align-items-center mb-3">
        <label for="fechasesion" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-calendar me-2"></i> Fecha de la sesión
        </label>
        <div class="col-sm-9">
            <input value="<?php echo $row['fechasesion']; ?>" required type="date" class="form-control" id="fechasesion" name="fechasesion">
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <label for="horainicio" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-clock me-2"></i> Hora de inicio
        </label>
        <div class="col-sm-9">
            <div class="d-flex justify-content-between mt-2 fs-6">
                <span>&nbsp; 9</span>
                <span>10</span>
                <span>11</span>
                <span>12</span>
                <span>13</span>
                <span>14</span>
                <span>15</span>
                <span>16</span>
                <span>17</span>
                <span>18</span>
                <span>19</span>                                    
            </div>
            <!-- Control deslizante -->
            <input required type="range" class="form-range" id="horainicio" name="horainicio" 
                   min="18" max="38" step="1" value="18" oninput="actualizarHora(this.value)">
            <!-- Etiqueta para mostrar la hora -->
            <div class="text-start mt-2">
                <span id="horainicioLabel"><?php echo $row['horainicio']; ?></span>
            </div>
        </div>
    </div>

    <!-- Campo: Duración -->
    <div class="row align-items-center mb-3">
        <label for="duracion" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-stopwatch me-2"></i> Duración de la sesión
        </label>
        <div class="col-sm-9">
            <!-- Mostrar etiquetas de los rangos -->
            <div class="d-flex justify-content-between mt-2">
                <span>30 m</span>
                <span>1 h</span>
                <span>1:30</span>
                <span>2 h</span>
                <span>2:30</span>
                <span>3 h</span>
                <span>3:30</span>
                <span>4 h</span>                                     
            </div>
            <!-- Control deslizante -->
            <input required type="range" class="form-range" id="duracion" name="duracion"  
                   min="30" max="240" step="30" value="120" oninput="actualizarDuracion(this.value)">
            <!-- Etiqueta para mostrar la duración -->
            <div class="text-start mt-2">
                <span id="duracionLabel"><?php echo $row['duracion']; ?></span>
            </div>
        </div>
    </div>

    <!-- Campo: Temas y actividades -->
    <div class="row align-items-center mb-3">
        <label for="temas" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-list-task me-2"></i> Temas y actividades abordados
        </label>
        <div class="col-sm-9">
            <textarea required class="form-control" id="temas" name="temas" rows="3" placeholder="Ingresa temas y actividades abordados"><?php echo $row['temas']; ?></textarea>
        </div>
    </div>

    <!-- Campo: Eventualidades -->
    <div class="row align-items-center mb-3">
        <label for="eventualidades" class="col-sm-3  col-form-label text-dark">
            <i class="bi bi-exclamation-circle me-2"></i> Eventualidades durante la sesión
        </label>
        <div class="col-sm-9">
            <textarea class="form-control" id="eventualidades" name="eventualidades" rows="3" placeholder="Ingresa Eventualidades durante la sesión"><?php echo $row['eventualidades']; ?></textarea>
            <p>(Riesgo de deserción, incumplimiento de acuerdos, faltas a la sesión, etc.)</p>
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
    <div class="row">
        <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="bi bi-x-circle"></i> Cancelar</button> 
            <button id="btn_bitacora" type="submit" class="btn btn-primary ms-3"> <i class="bi bi-arrow-clockwise float-end"></i> Actualizar </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        var horaRange = horaAToRange($('#horainicioLabel').text());
        $('#horainicio').val(horaRange);
                
        var duraRange = duracionAToRange($('#duracionLabel').text());
        $('#duracion').val(duraRange);        
    });
</script>
