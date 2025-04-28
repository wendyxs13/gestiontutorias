<?php
    session_start();
    $usuario =($_SESSION['us_tutor_ad']);

  	include 'conn.php';
    $pdo = Connection::getInstance();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * from cat_trimestre;";
    $q = $pdo->prepare($sql);
    $q->execute();
    $total=$q->rowCount(); 
  
    echo '<select name="trimestre" id="trimestre" class="custom-select " required="">';
    echo '<option value="">Seleccione una opción</option>';

    if($total > 0){
      while ($row = $q->fetch()) {
        $trimestre = "{$row['trimestre']}";
        echo '<option value="'.$trimestre.'">'.$trimestre.'</option>';
      }
    }
    echo '</select>';

?>