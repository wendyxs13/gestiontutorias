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
                           <?php echo $nombre." ".$ap." ".$am; ?>
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


    default:
      echo "No fue posible cargar la información";
    break;

  }



} ///  if post 

?>