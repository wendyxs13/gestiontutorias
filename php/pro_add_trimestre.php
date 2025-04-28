<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);
$total_status = 0;

if (!empty($_POST)) {

  $inicio =$_POST['inicio'];
	$fin  =$_POST['fin'];
  ///$trimestre = '24-O';
  ///$trimestre_actual = '24-P';  // Trimestre actual  ///actual
  ///$trimestre_nuevo = '24-O';   // Trimestre siguiente /// sig

  $trimestre_actual = $_POST['actual']; 
  $trimestre_nuevo = $_POST['sig']; 

	include 'conn.php';
  $db = Connection::getInstance();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
        echo "Los datos se han procesado con éxito. Un total de  <b>" . count($alumnos_tutores) . "</b> estudiantes fueron asignados al trimestre " .$trimestre_nuevo.".";
        echo "<br><br><a href='index.php'><b><span class='ml-2 backBlue2'>Continuar</span></b></a>";

      } catch (Exception $e) {
          $db->rollBack();
          echo "Fallo en la duplicación: " . $e->getMessage();
      }

    }

  } ///$total 0


} ///  if post 

?>