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
 
  include 'conn.php';
  $connection = Connection::getInstance();

  $query_exi = "SELECT idges_tutoria_grupal_2 as id, DATE_FORMAT(fecha, '%d/%m/%Y') as cel_01, horas as cel_02, temas as cel_03, modalidad as cel_04 from ges_tutoria_grupal_2, ges_registro_tutor where ges_tutoria_grupal_2.num_eco=ges_registro_tutor.num_eco AND ges_tutoria_grupal_2.num_eco =  ? and ges_tutoria_grupal_2.trim_informe = ? GROUP BY idges_tutoria_grupal_2, ges_registro_tutor.num_eco, temas, fecha, nombre, modalidad order by fecha;";

  $stmt_exi = $connection->prepare($query_exi);
  $stmt_exi->execute(array($usuario,$trim));
  $total_exi = $stmt_exi->rowCount();

  ?>
    <table id="table_con_sesiones" class="table ml-4 mr-4" style="width:90%;">
      <thead class="backBlue2">
        <tr>                  
          <th scope="col" class="" width="15%">Fecha</th>
          <th scope="col" class="" width="15%">Duración</th>
          <th scope="col" class="" width="50%">Temas abordados</th>
          <th scope="col" class="" width="25%">Modalidad</th>
          <th scope="col" class="" width="5%"></th>
        </tr>
      </thead>
      <tbody>

        <?php
        if($total_exi > 0){

          while ($row = $stmt_exi->fetch()){
            $idsesion = "{$row['id']}";
            $cel_01 = "{$row['cel_01']}";
            $cel_02 = "{$row['cel_02']}";
            $cel_03 = "{$row['cel_03']}";
            $cel_04_01 = "{$row['cel_04']}";
            if($cel_04_01 == "1"){  $cel_04 = "Presencial";
            }else if($cel_04_01 == "2"){
              $cel_04 = "Remota";
            }

            echo "<tr>
                    <td>".$cel_01."</td>
                    <td>".$cel_02." hr(s)</td>
                    <td>".$cel_03."</td>
                    <td>".$cel_04."</td>
                    <td><span class='badge badge-pill badge-info' data-toggle='modal' data-target='#mod_sesiones' style='cursor:pointer;' onclick='muestra_sesion(".$idsesion.");' >Editar</span></td>
                  </tr>";
          }
        }
        ?>
      </tbody>
    </table>

    <!-- <input type="hidden" name="n_sesion" id="n_sesion" value="1"> -->
    <p class="text-right mr-5 pr-3">
      <button id="btn_asesion2" type="button" class="btn btn-info" data-toggle='modal' data-target='#mod_sesiones2' >
        <!-- <img class="img-fluid ml-1 mr-2" src="../../img/add_02.png" alt=""> --><b>Agregar sesión</b>
      </button>
    </p>


    <!-- Modal editar-->
    <div class="modal fade" id="mod_sesiones" tabindex="-1" aria-labelledby="sesionesModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <span class="modal-title encabezado1 text-uppercase" id="sesionesModalLabel"><i class="material-icons size_font_52" style="color:#00BCD4;">edit_note</i><b>&nbsp;Editar sesión</b></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal_editar"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info text-uppercase" id="btn_actualiza" onclick="actSesion();"><small><b>Actualizar</b></small></button>
            <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal"><small><b>Cancelar</b></small></button>
          </div>
        </div>
      </div>
    </div> 


    <!-- Modal agregar-->
    <div class="modal fade" id="mod_sesiones2" tabindex="-1" aria-labelledby="sesionesModalLabel2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <span class="modal-title encabezado1 text-uppercase" id="sesionesModalLabel2"><i class="material-icons size_font_52" style="color:#00BCD4;">edit_note</i><b>&nbsp;Agregar sesión</b></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
                <div class="form-group">
                  <label for="fs_1" class="col-form-label" style="color: #1C499A; font-weight: bold;">Fecha:</label>
                  <input type="date" class="form-control" id="fs_1" name="fs_1" placeholder="">
                </div>
                <div class="form-group">
                  <label for="ds_1" class="col-form-label" style="color: #1C499A; font-weight: bold;">Duración:</label>
                  <select name="ds_1" id="ds_1" class="custom-select " >
                    <option value=""></option>
                    <option value="1">1 hora</option>
                    <option value="2">2 horas</option>
                    <option value="3">3 horas</option>
                    <option value="4">4 horas</option>
                    <option value="5">5 horas</option>
                    <option value="6">6 horas</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ts_1" class="col-form-label" style="color: #1C499A; font-weight: bold;">Temas abordados:</label>
                  <textarea class="form-control" id="ts_1" name="ts_1"></textarea>
                </div>
                <div class="form-group">
                  <label for="ms_1" class="col-form-label" style="color: #1C499A; font-weight: bold;">Modalidad:</label>
                  <select name="ms_1" id="ms_1" class="custom-select " >
                    <option value=""></option>
                    <option value="1">Presencial</option>
                    <option value="2">Remota</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info text-uppercase" id="gSesion" onclick="guardarSesion();"><small><b>Guardar</b></small></button>
                <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal"><small><b>Cancelar</b></small></button>
              </div>
            </form>
          </div>
        
      </div>
    </div>


   <?php 

  /*  }else{
    echo 0;
  } */

  
  if($total_exi > 0){
    $response = 1; 
  }else{
    $response = 0; 
  }
  //echo json_encode($output);
  ///echo $output;

?>