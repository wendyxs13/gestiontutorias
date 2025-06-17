<?php
session_start();
$usuario =($_SESSION['us_tutor_ad']);
$total_status = 0;

function genera_codigo($id_sc){
  $t_id= $id_sc."";
  $tam = strlen($t_id); 
  $t=0;
  $con_id="";
  while($t < $tam){  ///se recorre el ID para generar una cadena que remplace los numeros por caracteres                   
      switch($t_id[$t]){  
          case '0': $etr="R";
          break;
          case '1': $etr="S";
          break;
          case '2': $etr="T";
          break;
          case '3': $etr="U";
          break;
          case '4': $etr="V";
          break;
          case '5': $etr="W";
          break;
          case '6': $etr="X";
          break;
          case '7': $etr="Y";
          break;
          case '8': $etr="Z";
          break;
          case '9': $etr="A";
          break;                  
      }
      $con_id= $con_id.$etr;
      $t++;
  }//fin while

  return $con_id;
}

if (!empty($_POST)) {

  include '../conn.php';
  $db = Connection::getInstance();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $opc =$_POST['opc'];

  switch ($opc) {

    case '1':
      $num_eco =$_POST['num_eco'];
      $sql = "SELECT tutor.nombre as nom, tutor.ap as ap, tutor.am as am, tutor.correo as correo, count(est_tutor.matricula )as total, est_tutor.trimestre as trimestre FROM estudiante_tutor est_tutor LEFT join  ges_registro_tutor tutor on tutor.num_eco=est_tutor.no_eco where no_eco = ? group by tutor.nombre, tutor.ap, tutor.am, tutor.correo, est_tutor.trimestre;";
      $q = $db->prepare($sql);
      $q->execute(array($num_eco));
      $total=$q->rowCount(); 
      ?>

      <table class="styled-table mt-5">
          <thead>
              <tr>                  
                <th scope="col" width="50%" class="text-left text-uppercase">Tutor</th>
                <th scope="col" width="30%" class="text-uppercase"> Correo</th>
                <th scope="col" width="10%" class="text-left text-uppercase">Trimestre</th>
                <th scope="col" width="10%" class="text-left text-uppercase">Estudiantes</th>
                
              </tr>
          </thead>
          <tbody>
              <?php
              if ($total > 0) {
                  while ($row = $q->fetch()) {
                      $nombre = "{$row['nom']}";
                      $ap = "{$row['ap']}";
                      $am = "{$row['am']}";
                      $correo = "{$row['correo']}";
                      $total_est = "{$row['total']}";
                      $trimestre = "{$row['trimestre']}";
                      ?>
                      <tr>
                        <td class="text-left">
                              <!-- <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="ver_info_ini(<?php echo $matricula; ?>);"> </a> -->
                          <span onclick="datos_tutor();" class="btn-link" style="cursor: pointer;" >
                            <?php echo $nombre." ".$ap." ".$am; ?>
                          </span>
                        </td>
                        <td><?php echo $correo; ?></td>
                        <td><?php echo $trimestre; ?></td>
                        <td>
                          <span onclick="ver_lista('<?php echo $trimestre; ?>');" class="btn-link" style="cursor: pointer;" ><?php echo $total_est; ?></span>
                        </td>
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
      $num_eco =$_POST['num_eco'];

      $query_exi = "SELECT est.matri_alu as matri, est.nombre as nombre, est.ap as ap,  est.am as am, entrevista.lic as lice, cat_estatus.descripcion as estatus FROM estudiante_tutor est_tutor LEFT join  ges_registro_alu est on est.matri_alu=est_tutor.matricula LEFT join entrevista_alumno entrevista on est.matri_alu=entrevista.matricula left join cat_estatus_estudiante cat_estatus on cat_estatus.id_estatus_estudiante = est_tutor.status_estudiante where est_tutor.trimestre = ? and  no_eco = ? ;";

      $stmt_exi = $db->prepare($query_exi);
      $stmt_exi->execute(array($trim,$num_eco));
      $dir = $stmt_exi->rowCount();
      ?>
      <table class="styled-table p-3">
        <thead>
            <tr>                  
                <th scope="col" width="30%" class="text-left text-uppercase">Nombre</th>
                <th scope="col" width="15%" class="text-uppercase">estatus</th>
                <th scope="col" width="30%" class="text-uppercase"> Licenciatura</th>
                <th scope="col" width="10%" class="text-uppercase">Trimestre</th>
                <th scope="col" width="15%" class="text-uppercase">Informe individual</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($dir > 0) {
                while ($row = $stmt_exi->fetch()) {
                    $matricula = "{$row['matri']}";
                    $nombre = "{$row['nombre']}";
                    $ap = "{$row['ap']}";
                    $am = "{$row['am']}";
                    $estatus = "{$row['estatus']}";
                    $lic = "{$row['lice']}";
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $nombre." ".$ap." ".$am; ?></td>
                        <td><?php echo $estatus; ?></td>
                        <td><?php echo $lic; ?></td>
                        <td><?php echo $trim; ?></td>
                        <td>
                            <span class="badge badge-info btn-descargar" onclick="busca_ri('<?php echo $trim; ?>','<?php echo $matricula; ?>');">
                              <i class="material-icons" data-toggle="tooltip" data-placement="top" title="Ver informe individual">sticky_note_2</i> </span>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
    break;

    case '3':
      $trim =$_POST['trim'];
      $num_eco =$_POST['num_eco'];
      $matri =$_POST['matri'];
      $dir = 0;

      $query_exi = "SELECT "
                . "estudiante_tutor.matricula as matri, "
                . "estudiante_tutor.no_eco as num, "
                . "est.nombre as alu_nom, "
                . "est.ap as alu_ap, "
                . "est.am as alu_am, "
                . "ges_tutoria_individual.idtutoria_ind as individual "
                . "FROM  estudiante_tutor "
                . "LEFT join  ges_tutoria_individual  on estudiante_tutor.matricula=ges_tutoria_individual.matri_id "
                . "and estudiante_tutor.trimestre = ges_tutoria_individual.trim_informe "
                . "LEFT join  ges_registro_alu as est ON est.matri_alu=estudiante_tutor.matricula "
                . "WHERE estudiante_tutor.no_eco = ? AND estudiante_tutor.trimestre = ? "
                . "AND estudiante_tutor.matricula = ? ;";

      $stmt_exi = $db->prepare($query_exi);
      $stmt_exi->execute(array($num_eco,$trim,$matri));
      $dir = $stmt_exi->rowCount();
      $response = ['existe' => '0'];

      if ($dir > 0) {
        while ($row = $stmt_exi->fetch()) {
          $individual = "{$row['individual']}";
          $cod_informe =  genera_codigo($individual);
        }

        $url = "informe_individual.php?r=".$cod_informe;
        $response = [
          'existe' => $individual,
          'id_info' => $cod_informe,
          'url'=> $url
        ];
        
      }
      echo json_encode($response);
    break;

    case '4':
      $num_eco =$_POST['num_eco'];

      $sql = "SELECT * FROM ges_registro_tutor where num_eco = ?;";
      $q = $db->prepare($sql);
      $q->execute(array($num_eco));
      $total=$q->rowCount();

      $sexo_f = $sexo_m = "";

      if ($total > 0) {
        while ($row = $q->fetch()) {
          $nom = "{$row['nombre']}";
          $ap = "{$row['ap']}";
          $am = "{$row['am']}";
          $sexo = "{$row['sexo']}";
          $estudios = "{$row['estudios']}";
          $division = "{$row['division']}";
          $id_depto = "{$row['depto']}";
          $imparte = "{$row['imparte']}";
          $correo_tutor = "{$row['correo']}";
          $num_tutorados = "{$row['num_tutorados']}";


          
        }

        if($sexo == "M"){
            $sexo_m = "checked";
        }if($sexo == "F"){
            $sexo_f = "checked";
        }

        ?>

        <form id="form_datos_tutor" class="pb-2 pt-2" >
          <!-- <h3 class="encabezado1 mb-4 text-center"><b>Actualización de información</b></h3> -->
        

          <div class="form-group row ">
            <label for="ap" class="col-md-4 col-form-label text-dark" ><b>Primer apellido:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="<?php echo $ap; ?>" disabled >
            </div>
          </div>

          <div class="form-group row ">
            <label for="am" class="col-md-4 col-form-label text-dark" ><b>Segundo apellido:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="<?php echo $am; ?>" disabled >
            </div>
          </div>
            

          <div class="form-group row ">
            <label for="nom" class="col-md-4 col-form-label text-dark" ><b>Nombre:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="<?php echo $nom; ?>" disabled >
            </div>
          </div>

          <div class="form-group row ">
            <label for="radio5" class="col-md-4 col-form-label text-dark"><b>Sexo asignado al nacer:</b> </label>
            <div class="col-md-8">
              <div class="d-flex align-items-start">    

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="radio5" id="radio5-1" value="F" <?php echo $sexo_f; ?> disabled >
                  <label class="form-check-label fuente14" for="radio5-1">
                    Femenino
                  </label>
                </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check">
                   <input class="form-check-input" type="radio" name="radio5" id="radio5-2" value="M" <?php echo $sexo_m; ?> disabled >
                  <label class="form-check-label fuente14" for="radio5-2">
                    Masculino
                  </label>
                </div>
              </div>
            </div>
          </div>



          <div class="form-group row ">
            <label for="division" class="col-md-4 col-form-label text-dark" ><b>División Académica:</b></label>
            <div class="col-md-8" >
              <select name="division" id="division" class="form-control" required  onChange="div_dpto();" disabled>
                <option value="">Seleccione una opción</option>
                <option value="CBS" <?php if($division == "CBS"){ echo "selected"; } ?> >CBS</option> 
                <option value="CYAD" <?php if($division == "CYAD"){ echo "selected"; } ?> >CyAD</option> 
                <option value="CSH" <?php if($division == "CSH"){ echo "selected"; } ?> >CSH</option> 
              </select>
            </div>
          </div>

          <div id="d_dpto">
            <!---- d_dpto  ---->
            <div class="form-group row ">
              <label for="dpto" class="col-md-4 col-form-label text-dark" ><b>Departamento de Adscripción:</b></label>
              <div class="col-md-8" >
                <select name="dpto" id="dpto" class="custom-select" required disabled>
                  <option value="" selected="selected">Elige una opci&oacute;n</option>
                    <?php 
                    $query_exi1 = "SELECT * FROM cat_div_dpto WHERE division= ?;";
                    $stmt_exi1 = $db->prepare($query_exi1);
                    $stmt_exi1->execute(array($division));
                    $total1=$stmt_exi1->rowCount();

                    if($total1 > 0){
                        while ($row = $stmt_exi1->fetch()) {
                            $id = "{$row['id_depto']}";
                            $depto = "{$row['depto']}";

                            if($id_depto == $id ){
                                echo '<option value="'.$id.'" selected >'.$depto.'</option>';
                            }else{
                                echo '<option value="'.$id.'" >'.$depto.'</option>';
                            }
                        }
                    }
                    ?>
                </select>
              </div>
            </div>

            <div class="form-group row ">
              <label for="imparte" class="col-md-4 col-form-label text-dark" ><b>¿En qué licenciatura imparte docencia?</b></label>
              <div class="col-md-8" >
                <select name="imparte" id="imparte" class="custom-select" required disabled >
                  <option value="" selected="selected">Elige una opci&oacute;n</option>
                  <?php 
                    $query_exi2 = "SELECT * FROM cat_div_lic WHERE division= ?;";
                    $stmt_exi2 = $db->prepare($query_exi2);
                    $stmt_exi2->execute(array($division));
                    $total2=$stmt_exi2->rowCount();

                    while ($row = $stmt_exi2->fetch()) {
                        $id_lic = "{$row['id_lic']}";
                        $licenciatura = "{$row['licenciatura']}";

                        if( ($imparte == $licenciatura) || ($imparte == $id_lic) ){
                            echo '<option value="'.$id_lic.'" selected >'.$licenciatura.'</option>';
                        }else{
                            echo '<option value="'.$id_lic.'" >'.$licenciatura.'</option>';
                        }
                    }
                  ?>
                </select>
              </div>
            </div>

            <!---- d_dpto  ---->
          </div>

          <div class="form-group row ">
            <label for="ap" class="col-md-4 col-form-label text-dark" ><b>Correo electrónico institucional:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="correo" name="correo" maxlength="35" placeholder="correo" value="<?php echo $correo_tutor; ?>" disabled >
            </div>
          </div>

          <div class="form-group row ">
            <label for="ap" class="col-md-4 col-form-label text-dark" ><b>Número de tutoradas y tutorados que puede atender por trimestre:</b></label>
            <div class="col-md-8" >
              <input type="text" required class="form-control" id="num_tutorados" name="num_tutorados" maxlength="35" placeholder="" value="<?php echo $num_tutorados; ?>" disabled>
            </div>
          </div>

        </form>


        <?php

    }


    break;


    default:
      echo "No fue posible cargar la información";
    break;

  }



} ///  if post 

?>