<?php
  session_start(); 
  $total=0;

  if (!empty($_POST)) { /// 1

    $matriculaError = null;
    $matricula = $_POST['matri'];

    /*
    $correo = $_POST['correo'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $nombre = $_POST['nom'];
    */


    $valid = true;

    if (empty($matricula)) {
      $valid = false;
      $msj_resp="Debes ingresar tu matrícula";
    }


    if ($valid) {
      include 'conn.php'; 

      $connection = Connection::getInstance();
      ///$query_exi = "SELECT * FROM entrevista_alumno WHERE matricula= ?;";

      $query_exi = "SELECT *, entrevista_alumno.duda, duda1.descripcion as duda_01, entrevista_alumno.duda2, duda2.descripcion as duda_02, sesion.desc_sesion as sesion_tutoria FROM entrevista_alumno INNER JOIN ges_dudas duda1 ON entrevista_alumno.duda = duda1.id_duda INNER JOIN ges_dudas duda2 ON entrevista_alumno.duda2 = duda2.id_duda INNER JOIN ges_sesion sesion ON entrevista_alumno.tutoria = sesion.id_sesion where matricula = ?;";

      $stmt_exi = $connection->prepare($query_exi);
      $stmt_exi->execute(array($matricula));
      $total_exi=$stmt_exi->rowCount();

      if($total_exi > 0){
        while ($row = $stmt_exi->fetch()){
          $correo = "{$row['correo_alu']}";
          $nombre = "{$row['nombre']}";
          $edo_civil = "{$row['edo_civil']}";
          $sexo = "{$row['sexo']}";
          $edad = "{$row['edad']}";
          $turno = "{$row['turno']}";
          $hijos = "{$row['hijos']}";
          $dependientes = "{$row['depen']}";
          $num_dep = "{$row['depen_n']}";
          $trabajo = "{$row['trabajo']}";
          $des_trabajo = "{$row['trabajo_l']}";
          $becario = "{$row['beca']}";
          $beca = "{$row['t_beca']}";
          $trabajo = "{$row['trabajo']}";
          $des_trabajo = "{$row['trabajo_l']}";
          $prom = "{$row['prom']}";
          $becario = "{$row['beca']}";
          $beca = "{$row['t_beca']}";
          $estudio_m = "{$row['esc_m']}";
          $estudio_p = "{$row['esc_p']}";
          $motivo = "{$row['motivo']}";
          $otro_motivo = "{$row['motivo_o']}";
          $lic = "{$row['lic']}";
          $xq_lic = "{$row['xq_lic']}";
          $xq_lic_otro = "{$row['xq_lic_o']}";
          $campo = "{$row['c_laboral']}";
          $men_campo = "{$row['m_laboral']}";
          $hrs = "{$row['horas_est']}";
          $duda_1 = "{$row['duda_01']}";
          $duda_1_medios = "{$row['duda_md']}";
          $duda_1_xq = "{$row['duda_pq']}";
          $duda_2 = "{$row['duda_02']}";
          $duda_2_medios = "{$row['duda_md2']}";
          $duda_2_xq = "{$row['duda_pq2']}";

          $recursos_01 = "{$row['recursos']}";
          $rec_01_otro = "{$row['recurso_o']}";
          $espacio = "{$row['espacios']}";
          $espacio_otro = "{$row['espacio_otro1']}";
          $espacio_ext = "{$row['espacios2']}";
          $espacio_ext_otro = "{$row['espacio_otro2']}";
          $actividad = "{$row['acti']}";

          $cual_actividad = "{$row['acti_c']}";
          $don_actividad = "{$row['acti_d']}";
          $espera_sesion = "{$row['sesion_tutoria']}";
          $espera_sesion_otro = "{$row['tutoria_otro']}";
        }


    ?>

    <div class="col-md-12 m-5 p-2">
      <h4 class="encabezado5"><b>Información de <?php echo $nombre; ?></b></h4>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">Nombre:</b></label>
        <div class="col-md-6">
          <?php echo $nombre; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">Matrícula:</b> </label>
        <div class="col-md-6" >
          <?php echo $matricula; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">Correo electrónico:</b> </label>
        <div class="col-md-6" >
          <?php echo $correo; ?>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label"><b class="eti">Estado Civil:</b> </label>
        <div class="col-md-6">
          <?php echo $edo_civil; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">Sexo asignado al nacer:</b> </label>
        <div class="col-md-2" >
          <?php echo $sexo; ?>              
        </div>
        <div class="col-md-3" >
          <b class="eti">Edad:</b> <?php echo $edad; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" >
          <b class="eti">¿En qué turno estás inscrito?</b> 
        </label>
        <div class="col-md-6" >
          <?php echo $turno; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label"><b class="eti">¿Tienes hijos?</b></label>
        <div class="col-md-6" >
          <?php echo $hijos; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">¿Tienes dependientes económicos?</b></label>
        <div class="col-md-6" >
          <?php echo $dependientes; ?>
        </div>

        <div class="col-md-6" >
          <b class="eti">Si tu respuesta anterior fue “sí”, por favor indica cuántos(as)</b> <?php echo $num_dep; ?>
        </div>
      </div>

      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">¿Actualmente trabajas?</b> </label>
        <div class="col-md-2" >
          <?php echo $trabajo; ?>
        </div>
        <div class="col-md-8" >
          <b class="eti">Si tu respuesta anterior fue “sí” indica en qué trabajas</b> <?php echo $des_trabajo; ?>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label"><b class="eti">¿Cuál es tu promedio académico?</b> </label>
        <div class="col-md-3" >
          <?php echo $prom; ?>
        </div>
      </div>

      <!---- otra etiqueta 2 ----->
      <div class="form-group row ">
        <label class="col-md-3 col-form-label" ><b class="eti">¿Eres beneficiario(a) de alguna beca?</b> </label>
        <div class="col-md-2" >
            <?php echo $becario; ?>
        </div>
      </div>
      <!---- otra etiqueta 2 ----->

      <!---- otra etiqueta 3 ----->   
      <div class="form-group row">
        <label class="col-md-3 col-form-label"><b class="eti">¿Cuál?</b> </label>
        <div class="col-md-6" >
          <?php echo $beca; ?>
        </div>
      </div>
      <!---- otra etiqueta 3 ----->

        <h4 class="encabezado5 mt-4"><b>Información de los padres</b></h4>
        <p><b class="eti">¿Qué escolaridad tienen tus padres?</b></p>
        
        <div class="form-group row"> 

          <label class="col-md-3 col-form-label"><b class="eti" class="eti">Madre:</b> </label>
          <div class="col-md-6">
            <?php echo $estudio_m; ?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label"><b class="eti">Padre:</b> </label>
          <div class="col-md-6">
            <?php echo $estudio_p; ?>
          </div>
        </div>

        <h4 class="encabezado5 mt-4"><b>Información de la institución</b></h4>

        <p><b class="eti">¿Qué te motivó a estudiar en la UAM Xochimilco?</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $motivo; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta anterior fue “otro”, por favor especifica</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $otro_motivo; ?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label"><b class="eti">¿Qué licenciatura cursas?</b> </label>
          <div class="col-md-6">
            <?php echo $lic; ?>              
          </div>
        </div>

        <p><b class="eti">¿Por qué elegiste esa licenciatura?</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $xq_lic; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta anterior fue “otro”, por favor especifica </b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $xq_lic_otro; ?>
          </div>
        </div>
        <!---- otra etiqueta  4 y 5 ----->   

        <!---- otra etiqueta 6 ----->

        <div class="form-group row ">
          <label class="col-md-5 col-form-label" ><b class="eti">¿Conoces el campo laboral de tu carrera?</b> </label>
          <div class="col-md-6" >
            <div class="d-flex align-items-start">
              <?php echo $campo; ?>
            </div>
          </div>
        </div>
        <!---- otra etiqueta 6 ----->

        <!---- otra etiqueta 7 -----> 
        <div class="form-group row ">
          <label class="col-md-3 col-form-label" ><b class="eti">Menciona uno:</b> </label>
          <div class="col-md-6" >
            <div class="d-flex align-items-start">
              <?php echo $men_campo; ?>
            </div>
          </div>
        </div>
        <!---- otra etiqueta 7 ----->         

        <p><b class="eti">¿Cuántas horas al día fuera de tus clases dedicas a estudiar y a realizar tareas?</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $hrs; ?>
          </div>
        </div>

        <p><b class="eti">Cuando tienes alguna duda sobre las actividades o tareas del módulo que cursas <br>¿De qué manera las resuelves?</b></p>

        <div class="form-group row">
          <label class="col-md-3 col-form-label"> </label>
          <div class="col-md-6">
            <?php echo $duda_1; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta anterior fue “investigo por mi cuenta”, especifica en qué medios</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $duda_1_medios; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta fue “no hago nada al respecto”, especifica el por qué</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $duda_1_xq; ?>
          </div>
        </div>


        <p><b class="eti">Cuando tienes alguna duda sobre los trámites escolares <br>¿a quién recurres para obtener información y asesoramiento al respecto?</b></p>

        <div class="form-group row">
          <label class="col-md-3 col-form-label"> </label>
          <div class="col-md-6">
            <?php echo $duda_2; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta anterior fue “investigo por mi cuenta”, especifica en qué medios</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $duda_2_medios; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta fue “no hago nada al respecto”, especifica el por qué</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $duda_2_xq; ?>
          </div>
        </div>
        
        <p><b class="eti">¿Con cuáles de los siguientes recursos cuentas o tienes acceso para tu estudio?</b></p>
        <div class="form-group row">
          <div class="col-md-10 ml-4">
            <?php
            $res_01 = str_replace("|", ",", $recursos_01);
            $array = explode(",", $res_01);
            for($i=0; $i< (count($array)); $i++)
              {
                $id_recurso = $array[$i]; 
                if ($array[$i] != "") {
                  $query_sq = "SELECT desc_recu FROM ges_recursos WHERE id_recurso = ? ;";
                  $stmt_sq = $connection->prepare($query_sq);
                  $stmt_sq->execute(array($id_recurso));
                  $total_sq=$stmt_sq->rowCount();
                  if($total_sq > 0){
                    $rec = "";
                    while ($row = $stmt_sq->fetch()){
                      $rec = "{$row['desc_recu']}";
                      echo $rec."<br>";
                    } /////while
                  } ///if total_sq
                } ////if
              } ////for
              
            ?>

          </div>
        </div>

        <p><b class="eti">Si en tu respuesta anterior seleccionaste la opción “otro”, especifica</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $rec_01_otro; ?>
          </div>
        </div>

        <p><b class="eti">¿Qué espacio de tu hogar destinas para hacer tus tareas?</b></p>
        <div class="form-group row">
          <div class="col-md-10">
            <?php
            $esp = str_replace("|", ",", $espacio);
            $array = explode(",", $esp);
            for($i=0; $i< (count($array)); $i++)
              {
                $id_espacio = $array[$i]; 
                if ($array[$i] != "") {
                  $query_sq = "SELECT desc_espacio FROM ges_espacio WHERE id_espacio = ? ;";
                  $stmt_sq = $connection->prepare($query_sq);
                  $stmt_sq->execute(array($id_espacio));
                  $total_sq=$stmt_sq->rowCount();
                  if($total_sq > 0){
                    $espacio_desc = "";
                    while ($row = $stmt_sq->fetch()){
                      $espacio_desc = "{$row['desc_espacio']}";
                      echo $espacio_desc."<br>";
                    } /////while
                  } ///if total_sq
                } ////if
              } ////for
            ?>


          </div>
        </div>

        <p><b class="eti">Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $espacio_otro; ?>
          </div>
        </div>

        <p><b class="eti">¿Qué espacio externo a tu hogar destinas para hacer tus tareas?</b></p>
        <div class="form-group row">
          <div class="col-md-10">
            <?php
            $esp_ex = str_replace("|", ",", $espacio_ext);
            $array = explode(",", $esp_ex);
            for($i=0; $i< (count($array)); $i++)
              {
                $id_esp_ex = $array[$i]; 
                if ($array[$i] != "") {
                  $query_sq = "SELECT desc_ex FROM ges_espacio_ex WHERE id_externo = ? ;";
                  $stmt_sq = $connection->prepare($query_sq);
                  $stmt_sq->execute(array($id_esp_ex));
                  $total_sq=$stmt_sq->rowCount();
                  if($total_sq > 0){
                    $espacio_ex = "";
                    while ($row = $stmt_sq->fetch()){
                      $espacio_ex = "{$row['desc_ex']}";
                      echo $espacio_ex."<br>";
                    } /////while
                  } ///if total_sq
                } ////if
              } ////for
            ?>

          </div>
        </div>

        <p><b class="eti">Especifica qué otro espacio externo a tu hogar destinas para hacer tus tareas:</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $espacio_ext_otro; ?>
          </div>
        </div>

        <p><b class="eti">¿Practicas alguna actividad extra escolar?</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $actividad; ?>
          </div>
        </div>

        <div class="form-group row ">
          <div class="col-md-12" >
            <div class="d-flex align-items-start">
              <label for="txt38" class="col-md-2 col-form-label" ><b class="eti">¿Cuál?</b></label>
              <div class="col-md-6" >
                <?php echo $cual_actividad; ?>
                <!-- <input type="text" required class="form-control" id="txt38" name="txt38" placeholder="" maxlength="45"  > -->
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-3" >
            <div class="d-flex align-items-start">
              <label class="col-md-2 col-form-label" ><b class="eti">¿Dónde?</b></label>
              <div class="col-md-7" >
                <?php echo $don_actividad; ?>
              </div>
            </div>
          </div>
        </div>

        <p><b class="eti">¿Qué esperas de las sesiones de tutoría? </b></p>

        <div class="form-group row">
          <label class="col-md-2 col-form-label"> </label>
          <div class="col-md-6">
            <?php echo $espera_sesion; ?>
          </div>
        </div>

        <p><b class="eti">Si tu respuesta anterior fue “Otro”, especifica:</b></p>
        <div class="form-group row">
          <label class="col-md-3 col-form-label"></label>
          <div class="col-md-6">
            <?php echo $espera_sesion_otro; ?>
          </div>
        </div>


    </div>

      
    <?php

    }else{  /// if else total_exi

    ?>
    
    <div class="col-md-12 m-5 p-2">
      <h4 class="encabezado5"><b>La persona tutorada seleccionada tiene pendiente responder el formulario de entrevista inicial.</b></h4>
      <div class="form-group row ">
       
      </div>
    </div>


    <?php


    } /// else total_exi
    
    } ////valid



} /// 1
 

?>