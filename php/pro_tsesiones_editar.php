 <?php
  session_start();
  $usuario=($_SESSION['us_tutor']);
  $_SESSION["us_tutor"] = $usuario;
  $total_exi = 0;
  $cel_01 = "";
  $cel_02 = "";
  $cel_03 = "";
  $cel_04 = "";
  $output = "";
  $trim_codi = $_POST['trim_inf'];
  $trim = base64_decode($trim_codi); 
  $trim = htmlspecialchars($trim);
  $id_sesion = $_POST['datos'];
 
  include 'conn.php';
  $connection = Connection::getInstance();

  $query_exi = "SELECT fecha as cel_01, horas as cel_02, temas as cel_03, modalidad as cel_04 from ges_tutoria_grupal_2 where ges_tutoria_grupal_2.num_eco =  ? and ges_tutoria_grupal_2.trim_informe = ? AND idges_tutoria_grupal_2 = ? ;";

  $stmt_exi = $connection->prepare($query_exi);
  $stmt_exi->execute(array($usuario,$trim,$id_sesion));
  $total_exi = $stmt_exi->rowCount();

  if($total_exi > 0){ /// $total_exi
    while ($row = $stmt_exi->fetch()){
      $cel_01 = "{$row['cel_01']}";
      $cel_02 = "{$row['cel_02']}";
      $cel_03 = "{$row['cel_03']}";
      $cel_04 = "{$row['cel_04']}";
      
    }
  ?>
  
  <form>
      <div class="modal-body">
        <div class="form-group">
          <label for="fs" class="col-form-label" style="color: #1C499A; font-weight: bold;">Fecha:</label>
          <input type="date" class="form-control" id="fs" name="fs" placeholder="" value="<?php echo $cel_01; ?>">
        </div>
        <div class="form-group">
          <label for="ds" class="col-form-label" style="color: #1C499A; font-weight: bold;">Duración:</label>
          <select name="ds" id="ds" class="custom-select " >
            <option value=""></option>
            <option value="1" <?php if($cel_02 == "1"){ echo "selected"; } ?> >1 hora</option>
            <option value="2" <?php if($cel_02 == "2"){ echo "selected"; } ?> >2 horas</option>
            <option value="3" <?php if($cel_02 == "3"){ echo "selected"; } ?> >3 horas</option>
            <option value="4" <?php if($cel_02 == "4"){ echo "selected"; } ?> >4 horas</option>
            <option value="5" <?php if($cel_02 == "5"){ echo "selected"; } ?> >5 horas</option>
            <option value="6" <?php if($cel_02 == "6"){ echo "selected"; } ?> >6 horas</option>
          </select>
        </div>

        <div class="form-group">
          <label for="ts" class="col-form-label" style="color: #1C499A; font-weight: bold;">Temas abordados:</label>
          <textarea class="form-control" id="ts" name="ts"><?php echo $cel_03; ?></textarea>
        </div>
        <div class="form-group">
          <label for="ms" class="col-form-label" style="color: #1C499A; font-weight: bold;">Modalidad:</label>
          <select name="ms" id="ms" class="custom-select " >
            <option value=""></option>
            <option value="1" <?php if($cel_04 == "1"){ echo "selected"; } ?> >Presencial</option>
            <option value="2" <?php if($cel_04 == "2"){ echo "selected"; } ?> >Remota</option>
          </select>
          <input type="hidden" id="dato" name="dato" value="<?php echo $id_sesion; ?>">
        </div>
      </div>
      <!-- <p>
        <button type="button" class="btn btn-info text-uppercase" id="aSesion" onclick="actSesion();"><small><b>Editar</b></small></button>
        <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal"><small><b>Cancelar</b></small></button>
      </p> -->
    </form>


  <?php
  }else{ /// if $total_exi
    echo "Sesión no encontrada";
  }

  ?>

