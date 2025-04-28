<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);
$total_status = 0;

if (!empty($_POST)) {

  include 'conn.php';
  $db = Connection::getInstance();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $opc =$_POST['opc'];

  switch ($opc) {

    case '1':
      $trim =$_POST['trim'];
      $sql = "SELECT * from cat_trimestre where trimestre= ? ;";
      $q = $db->prepare($sql);
      $q->execute(array($trim));
      $total=$q->rowCount(); 
      $check_disponible = "";
      if($total > 0){
        while ($row = $q->fetch()) {
          $inicio = "{$row['inicio']}";
          $fin = "{$row['fin']}";
          $disponible = "{$row['disponible']}";
        }
      }
      if($disponible == "1"){
        $check_disponible = "checked";
      }
      ?>
        <div class="form-group">
            <label for="inicio"><b>Inicia:</b></label>
            <input type="date" class="form-control" id="inicio" name="inicio" placeholder="Fecha de inicio" value="<?php echo $inicio; ?>">
        </div>
        <div class="form-group">
            <label for="fin"><b>Termina:</b></label>
            <input type="date" class="form-control" id="fin" name="fin" placeholder="Fecha de termino" value="<?php echo $fin; ?>">
            <input type="hidden"  id="actual" name="actual" value="<?php echo $trim_actual; ?>" >
        </div>
        <div class="form-check mt-3 mb-3">
          <input type="checkbox" class="form-check-input" id="habilita" value="1"  <?php echo $check_disponible; ?>   >
          <label class="form-check-label" for="habilita">Habilitar trimestre en módulo de tutores</label>
        </div>

        <div class="form-group text-center">
          <button type="button" class="btn btn-primary btn_10 pl-3 pr-4 mt-2" onclick="edit_trim();" >
            <img class="img-fluid mr-2 mb-1" src="../../img/buscar.png" alt="">Enviar
          </button>
        </div>

      <?php
    break;

    case '2':

      $trim =$_POST['trim'];
      $inicio =$_POST['inicio'];
      $fin =$_POST['fin'];
      $disponible =$_POST['habilita'];

      //////////////////////

      $query_status = "UPDATE cat_trimestre SET inicio = ?, fin = ?, disponible = ? WHERE (trimestre = ?);";
      $stmt_status = $db->prepare($query_status);
      $stmt_status->execute(array($inicio, $fin, $disponible, $trim));
      $total_status = $stmt_status->rowCount();

      if ($total_status > 0) {
        echo "<br><span class='backBlue2 ml-5 mt-4'><b>Los datos se actualizaron correctamente</b></span><br>";
        echo "<span class='texto_01 ml-5'><b>¿Necesitas modificar otro trimestre?</b></span><br>";
        echo "<a href='#'><span class=' ml-5 badge badge-success' onclick='cancelar();'>Sí</span></a>";
        echo "<a href='index.php'><span class='ml-2 badge badge-danger'>No</span></a>";

      }else{
        echo "No fue posible actualizar la información";
      }

    break;


    default:
      echo "No fue posible cargar la información";
    break;

  }




	
/*

  $sql = "SELECT trimestre from cat_trimestre where trimestre= ? ;";
  $q = $db->prepare($sql);
  $q->execute(array($trimestre_nuevo));
  $total=$q->rowCount(); 

  if($total == 0){ ///$total 0

    $query_ins = "INSERT INTO cat_trimestre (trimestre,inicio,fin) VALUES (?, ?, ?);";
    $stmt_ins  = $db->prepare($query_ins);
    $stmt_ins->execute(array($trimestre_nuevo, $inicio, $fin));
    $last_id   = $db->lastInsertId();  ///último id insertado
    $total_ins = $stmt_ins->rowCount(); 

    if($total_ins > 0){
      try {
        $db->beginTransaction();

        $query = "SELECT * FROM estudiante_tutor WHERE trimestre = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$trimestre_actual]);

        $alumnos_tutores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($alumnos_tutores as $alumno_tutor) {
            $alumno_tutor['trimestre'] = $trimestre_nuevo;
            $query_insert = "INSERT INTO estudiante_tutor (matricula, no_eco, trimestre, status_estudiante, tutor_anterior) 
                             VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $db->prepare($query_insert);

            $stmt_insert->execute([
                $alumno_tutor['matricula'],
                $alumno_tutor['no_eco'],
                $alumno_tutor['trimestre'],
                $alumno_tutor['status_estudiante'],
                $alumno_tutor['tutor_anterior']
            ]);
        }

        $db->commit();
        echo "Los datos se han procesado con éxito. Un total de  " . count($alumnos_tutores) . " estudiantes fueron asignados al trimestre " .$trimestre_nuevo.".";

      } catch (Exception $e) {
          $db->rollBack();
          echo "Fallo en la duplicación: " . $e->getMessage();
      }

    }

  } ///$total 0

  */


} ///  if post 

?>