<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);
$total_status = 0;

if (!empty($_POST)) {

  include '../conn.php';
  $db = Connection::getInstance();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $opc =$_POST['opc'];

  switch ($opc) {

    case '1':
      $matri =$_POST['matri'];
      $sql = "SELECT est_tutor.trimestre as trimestre,est.matri_alu as matri, est.nombre as nombre, est.ap as ap,  est.am as am, entrevista.sexo as sexo, entrevista.lic as lice, tutor.nombre as ntutor, tutor.ap as aptutor, tutor.am  as amtutor, cat_estatus.descripcion as estatus, tutor.num_eco as numero FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join  ges_registro_tutor tutor on tutor.num_eco=est_tutor.no_eco left join cat_estatus_estudiante cat_estatus on cat_estatus.id_estatus_estudiante = est_tutor.status_estudiante  LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula where est.matri_alu = ? ;";
      $q = $db->prepare($sql);
      $q->execute(array($matri));
      $total=$q->rowCount(); 
      
      ?>

      
      <table class="styled-table mt-5">
          <thead>
              <tr>                  
                <th scope="col" width="30%" class="text-left text-uppercase">Nombre</th>
                <th scope="col" width="10%" class="text-uppercase"> Estatus</th>
                <th scope="col" width="10%" class="text-left text-uppercase">Trimestre</th>
                <th scope="col" width="20%" class="text-uppercase"> Licenciatura</th>
                <th scope="col" width="30%" class="text-left text-uppercase">Tutor</th>
                
              </tr>
          </thead>
          <tbody>
              <?php
              if ($total > 0) {
                  while ($row = $q->fetch()) {
                      $badgeClass = 'badge-success';
                      $matricula = "{$row['matri']}";
                      ///$nombre = utf8_decode("{$row['nombre']}"); 
                      $nombre = "{$row['nombre']}"; 
                      $ap = "{$row['ap']}";
                      $am = "{$row['am']}";
                      $sexo = "{$row['sexo']}";
                      $lic = "{$row['lice']}"; 
                      $estatus = "{$row['estatus']}"; 
                      $trimestre = "{$row['trimestre']}";
                      $numero = "{$row['numero']}";
                      $ntutor = "{$row['ntutor']}";
                      $aptutor = "{$row['aptutor']}";
                      $amtutor = "{$row['amtutor']}";
                      if($estatus != "Activa/o"){ $badgeClass = 'badge-warning'; }
                      ?>
                      <tr>
                        <td class="text-left" data-toggle="tooltip" data-placement="left" title="Matrícula: <?php echo $matricula; ?>" >
                              <!-- <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="ver_info_ini(<?php echo $matricula; ?>);">  </a> -->
                           <u><span onclick="datos_estudiante();" style="cursor: pointer;" > <?php echo $nombre." ".$ap." ".$am; ?> </span></u>
                        </td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $estatus; ?></span> </td>
                        <td><?php echo $trimestre; ?></td>
                        <td><?php echo $lic; ?></td>
                        <td class="text-left" data-toggle="tooltip" data-placement="left" title="No eco: <?php echo $numero; ?>" ><?php echo $ntutor." ".$aptutor." ".$amtutor; ?></td>
                      </tr>
                      <?php
                  }
              }
              ?>
          </tbody>
      </table>


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

    case '3':
      $matri =$_POST['matri'];

      $sql = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap,  est.am as am, entrevista.sexo as sexo, entrevista.lic as lic FROM ges_registro_alu est LEFT join entrevista_alumno entrevista on est.matri_alu = entrevista.matricula where est.matri_alu = ? ;";
      $q = $db->prepare($sql);
      $q->execute(array($matri));
      $total=$q->rowCount(); 

      if ($total > 0) {
        while ($row = $q->fetch()) {
            $nom = "{$row['nombre']}";
            $ap = "{$row['ap']}";
            $am = "{$row['am']}";
            $sexo = "{$row['sexo']}";
            $lic = "{$row['lic']}";
        }

    }


      ?>

      <form id="form_datos_est" class="pb-2 pt-2" >
          <!-- <h3 class="encabezado1 mb-4 text-center"><b>Actualización de información</b></h3> -->

          <div class="form-group row ">
            <label for="nom" class="col-md-4 col-form-label text-dark" ><b>Nombre:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="<?php echo $nom; ?>"  >
            </div>
          </div>
        
          <div class="form-group row ">
            <label for="ap" class="col-md-4 col-form-label text-dark" ><b>Primer apellido:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="<?php echo $ap; ?>"  >
            </div>
          </div>

          <div class="form-group row ">
            <label for="am" class="col-md-4 col-form-label text-dark" ><b>Segundo apellido:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="<?php echo $am; ?>"  >
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-md-4 col-form-label"></label>
            <div class="col-md-8">
              <input type="hidden" id="matri" name="matri" value="<?php echo $matri; ?>">
              <button type="button" class="btn btn-primary btn_02"  onclick="actual_estudiante();" >
                Actualizar datos</span>
               </button>
            </div>
          </div>
          
      </form>
      

      <?php
    break;

    case '4':
      $response = [];
      $matri =$_POST['matri'];
      $nom =$_POST['nom'];
      $ap =$_POST['ap'];
      $am =$_POST['am'];

      $query_status = "UPDATE ges_registro_alu SET nombre = ?, ap = ?, am = ? WHERE (matri_alu = ?);";
      $stmt_status = $db->prepare($query_status);
      $stmt_status->execute(array($nom, $ap, $am, $matri));
      $total_status = $stmt_status->rowCount();

      if ($total_status > 0) {
        //echo "<br><span class='backBlue2 ml-5 mt-4'><b>Los datos se actualizaron correctamente</b></span><br>";
        /*echo "<span class='texto_01 ml-5'><b>¿Necesitas modificar otro trimestre?</b></span><br>";
        echo "<a href='#'><span class=' ml-5 badge badge-success' onclick='cancelar();'>Sí</span></a>";
        echo "<a href='index.php'><span class='ml-2 badge badge-danger'>No</span></a>"; */
        $response['success'] = true;
        $response['message'] = 'Los datos se actualizaron correctamente';

      }else{
        //echo "No fue posible actualizar la información";
        $response['success'] = false;
        $response['message'] = 'No fue posible actualizar la información.';
      }
      echo json_encode($response);

    break;


    default:
      echo "No fue posible cargar la información";
    break;

  }



} ///  if post 

?>