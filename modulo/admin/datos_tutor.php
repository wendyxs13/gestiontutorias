<?php
session_start();
if (isset($_SESSION['us_tutor'])) {
    $usuario = ($_SESSION['us_tutor']);
    $_SESSION['us_tutor'] = $usuario;


    if (!isset($_GET['x'])) {
        header('Location: index.php');
        exit();
    }else{
        $trim_codi = $_GET['x'];
        $trim = base64_decode($trim_codi); 
        $trim = htmlspecialchars($trim);
    }

    include '../../php/conn.php';
    $connection = Connection::getInstance(); 
    $query_exi = "SELECT * FROM ges_registro_tutor where num_eco = ? ";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute(array($usuario));
    $dir = $stmt_exi->rowCount();

    $sexo_f = $sexo_m = "";

    if ($dir > 0) {
        while ($row = $stmt_exi->fetch()) {
            $nom = "{$row['nombre']}";
            $ap = "{$row['ap']}";
            $am = "{$row['am']}";
            $sexo = "{$row['sexo']}";
            $estudios = "{$row['estudios']}";
            $division = "{$row['division']}";
            $id_depto = "{$row['depto']}";
            $imparte = "{$row['imparte']}";
        }

        if($sexo == "M"){
            $sexo_m = "checked";
        }if($sexo == "F"){
            $sexo_f = "checked";
        }
    }

    ?>
 
    <form id="form_datos_tutor" >
      <!-- <h3 class="encabezado1 mb-4 text-center"><b>Actualización de información</b></h3> -->
      <h5 class="mt-0 mb-5 text-justify">
          Antes de descargar tu constancia, completa el siguiente formulario. Esta información será utilizada para el seguimiento del proyecto, por lo que es importante que esté correcta y actualizada.
      </h5>

      <div class="form-group row ">
        <label for="ap" class="col-md-3 col-form-label text-dark" ><b>Primer apellido:</b></label>
        <div class="col-md-8" >
          <input type="text" required class="form-control" id="ap" name="ap" maxlength="35" placeholder="Primer apellido" value="<?php echo $ap; ?>">
        </div>
      </div>

      <div class="form-group row ">
        <label for="am" class="col-md-3 col-form-label text-dark" ><b>Segundo apellido:</b></label>
        <div class="col-md-8" >
          <input type="text" required class="form-control" id="am" name="am" maxlength="35" placeholder="Segundo apellido" value="<?php echo $am; ?>">
        </div>
      </div>
        

      <div class="form-group row ">
        <label for="nom" class="col-md-3 col-form-label text-dark" ><b>Nombre:</b></label>
        <div class="col-md-8" >
          <input type="text" required class="form-control" id="nom" name="nom" maxlength="35" placeholder="Nombre(s)" value="<?php echo $nom; ?>">
        </div>
      </div>

      <div class="form-group row ">
        <label for="radio5" class="col-md-3 col-form-label text-dark"><b>Sexo asignado al nacer:</b> </label>
        <div class="col-md-8">
          <div class="d-flex align-items-start">    

            <div class="form-check">
              <input class="form-check-input" type="radio" name="radio5" id="radio5-1" value="F" <?php echo $sexo_f; ?> >
              <label class="form-check-label fuente14" for="radio5-1">
                Femenino
              </label>
            </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-check">
               <input class="form-check-input" type="radio" name="radio5" id="radio5-2" value="M" <?php echo $sexo_m; ?>>
              <label class="form-check-label fuente14" for="radio5-2">
                Masculino
              </label>
            </div>
          </div>
        </div>
      </div>



      <div class="form-group row ">
        <label for="division" class="col-md-3 col-form-label text-dark" ><b>División Académica:</b></label>
        <div class="col-md-8" >
          <select name="division" id="division" class="form-control" required  onChange="div_dpto();">
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
          <label for="dpto" class="col-md-3 col-form-label text-dark" ><b>Departamento de Adscripción:</b></label>
          <div class="col-md-8" >
            <select name="dpto" id="dpto" class="custom-select" required >
              <option value="" selected="selected">Elige una opci&oacute;n</option>
                <?php 
                $query_exi1 = "SELECT * FROM cat_div_dpto WHERE division= ?;";
                $stmt_exi1 = $connection->prepare($query_exi1);
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

        <!---- d_dpto  ---->
      </div>
      <div class="form-group row ">
          <label for="nom" class="col-md-12 col-form-label text-dark" ><b>Respecto a su participación en el Programa Institucional de Tutoría:</b></label>
          <div class="col-md-11 ml-5" >
            <div class="mt-2">
              <input class="form-check-input" type="radio" name="continuar" id="continuar-1" value="1">
              <label class="form-check-label" for="continuar-1">
                Deseo seguir participando en el Programa de Tutoría y continuar con mis asignaciones actuales.
              </label>
            </div>
            <div class="mt-2">
              <input class="form-check-input" type="radio" name="continuar" id="continuar-2" value="2">
              <label class="form-check-label" for="continuar-2">
                Deseo seguir participando en el Programa Institucional de Tutoría y aumentar mi número de asignaciones de personas tutoradas.
              </label>
            </div>
            <div class="mt-2">
              <input class="form-check-input" type="radio" name="continuar" id="continuar-3" value="3">
              <label class="form-check-label" for="continuar-3">
                No podré continuar participando en el Programa Institucional de Tutoría debido a que me tomaré un año sabático.
              </label>
            </div>
            <div class="mt-2">
              <input class="form-check-input" type="radio" name="continuar" id="continuar-4" value="4">
              <label class="form-check-label" for="continuar-4">
                No podré continuar participando en el Programa Institucional de Tutoría debido a que tramité mi jubilación o tengo algún tema relacionado con mi contratación. 
              </label>
            </div>
            <div class="mt-2">
              <input class="form-check-input" type="radio" name="continuar" id="continuar-5" value="5">
              <label class="form-check-label" for="continuar-5">
                No podré continuar participando en el Programa Institucional de Tutoría debido a que tengo otros proyectos que me demandan tiempo.
              </label>
            </div>
            <div class="mt-2">
              <div class="d-flex align-items-start">
                <input class="form-check-input" type="radio" name="continuar" id="continuar-6" value="6">
                <label class="form-check-label" for="continuar-6">
                  Otro
                </label>
                <div class="col-md-8" >
                  <input type="text" required class="form-control" id="otro_con" name="otro_con" maxlength="45" placeholder="Mencione otro motivo">
                </div>
              </div>
            </div>
          </div>
        </div>


      <div class="form-group row">
        <label for="" class="col-md-4 col-form-label"></label>
        <div class="col-md-8">
           <input type="hidden" id="trim" name="trim" value="<?php echo $trim; ?>">
           <button type="button" class="btn btn-primary btn_02"  onclick="act_tutor();" >
            <span class="badge text_sup_01 text-light text-uppercase"><i class="material-icons">edit_note</i> Confirmar datos</span>
           </button>
        </div>
      </div>
    </form>
        
<?php
} else {
    header("location:../../login.php");
}
?>