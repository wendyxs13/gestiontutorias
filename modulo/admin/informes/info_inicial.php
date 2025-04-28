<?php
session_start();
if(isset($_SESSION['us_tutor'])){
    $usuario=($_SESSION['us_tutor']);
    $nombre_tutor=($_SESSION['nombre']);
    $email =($_SESSION['us_correo']);
    $_SESSION['us_tutor']=$usuario;
    $_SESSION['nombre']=$nombre_tutor;
    $_SESSION["us_correo"] = $email;
    $_SESSION["matricula"] = "0";
    $_SESSION["nom_est"] = "";

    include '../../../php/conn.php';
    $connection = Connection::getInstance();

    $query_exi = "SELECT *,entrevista_alumno.matricula as matri_alu, FORMAT(entrevista_alumno.prom,2,'en_US') as cali, entrevista_alumno.duda, duda1.descripcion as duda_01, entrevista_alumno.duda2, duda2.descripcion as duda_02, sesion.desc_sesion as sesion_tutoria FROM entrevista_alumno INNER JOIN ges_dudas duda1 ON entrevista_alumno.duda = duda1.id_duda INNER JOIN ges_dudas duda2 ON entrevista_alumno.duda2 = duda2.id_duda INNER JOIN ges_sesion sesion ON entrevista_alumno.tutoria = sesion.id_sesion;";

    $stmt_exi = $connection->prepare($query_exi);
    $stmt_exi->execute();
    $total_exi=$stmt_exi->rowCount();
    /// echo "total: ".$total_exi;

    echo utf8_decode("Matrícula,Nombre,Estado Civil,Sexo asignado al nacer,Edad,¿En qué turno estás inscrito?,¿Tienes hijos?,¿Tienes dependientes económicos?,¿Cuántos?,¿Actualmente trabajas?,¿En qué trabajas?,¿Cuál es tu promedio académico?,¿Eres beneficiario(a) de alguna beca?,¿Cuál?,¿Qué escolaridad tiene tu madre?,¿Qué escolaridad tiene tu padre?,¿Qué te motivó a estudiar en la UAM Xochimilco?,Especifica:,¿Qué licenciatura cursas?,¿Por qué elegiste esa licenciatura?,Específica:,¿Conoces el campo laboral de tu carrera?,Menciona uno:,¿Cuántas horas al día fuera de tus clases dedicas a estudiar y a realizar tareas?,Cuando tienes alguna duda sobre las actividades o tareas del módulo que cursas ¿De qué manera las resuelves?,Especifica en qué medios:,¿Por qué?,Cuando tienes alguna duda sobre los trámites escolares ¿a quién recurres para obtener información y asesoramiento al respecto?,Especifica en qué medios,¿Por qué?,¿Con cuáles de los siguientes recursos cuentas o tienes acceso para tu estudio?,Especifica:,¿Qué espacio de tu hogar destinas para hacer tus tareas?,Especifica qué otro espacio externo a tu hogar destinas para hacer tus tareas:,¿Qué espacio externo a tu hogar destinas para hacer tus tareas?,Especifica qué otro espacio externo a tu hogar destinas para hacer tus tareas:,¿Practicas alguna actividad extra escolar?,¿Cuál?,¿Dónde?,¿Qué esperas de las sesiones de tutoría?,Especifique:\n");


          if($total_exi > 0){
            while ($row = $stmt_exi->fetch()){

              $matri_alu = "{$row['matri_alu']}";
              $correo = "{$row['correo_alu']}";
              $nombre = "{$row['nombre']}";
              $edo_civil = "{$row['edo_civil']}";
              $sexo = "{$row['sexo']}";
              $edad = "{$row['edad']}";
              $turno = "{$row['turno']}";
              $hijos = "{$row['hijos']}";
              $dependientes = "{$row['depen']}";
              $num_dep = "{$row['depen_n']}";
              ///$prom = "{$row['prom']}";
              $prom = "{$row['cali']}";
              $trabajo = "{$row['trabajo']}";
              $des_trabajo = "{$row['trabajo_l']}";
              $becario = "{$row['beca']}";
              $beca_01 = "{$row['t_beca']}";
              $beca = str_replace(",", " / ", $beca_01);
              $trabajo = "{$row['trabajo']}";
              $des_trabajo_01 = "{$row['trabajo_l']}";
              $des_trabajo = str_replace(",", " / ", $des_trabajo_01);
              $prom = "{$row['prom']}";
              $estudio_m = "{$row['esc_m']}";
              $estudio_p = "{$row['esc_p']}";
              $motivo = "{$row['motivo']}";
              $otro_motivo_01 = "{$row['motivo_o']}";
              $otro_motivo = str_replace(",", " / ", $otro_motivo_01);
              $lic = "{$row['lic']}";
              $xq_lic = "{$row['xq_lic']}";
              $xq_lic_otro_01 = "{$row['xq_lic_o']}";
              $xq_lic_otro = str_replace(",", " / ", $xq_lic_otro_01);

              $campo = "{$row['c_laboral']}";
              $men_campo_01 = "{$row['m_laboral']}";
              $men_campo = str_replace(",", " / ", $men_campo_01);
              $hrs = "{$row['horas_est']}";
              $duda_1 = "{$row['duda_01']}";
              $duda_1_medios_01 = "{$row['duda_md']}";
              $duda_1_medios = str_replace(",", " / ", $duda_1_medios_01);

              $duda_1_xq_01 = "{$row['duda_pq']}";
              $duda_1_xq = str_replace(",", " / ", $duda_1_xq_01);

              $duda_2 = "{$row['duda_02']}";
              $duda_2_medios_01 = "{$row['duda_md2']}";
              $duda_2_medios = str_replace(",", " / ", $duda_2_medios_01);
              $duda_2_xq_01 = "{$row['duda_pq2']}";
              $duda_2_xq = str_replace(",", " / ", $duda_2_xq_01);

              $recursos_01 = "{$row['recursos']}";
              $rec_01_otro_01 = "{$row['recurso_o']}";
              $rec_01_otro = str_replace(",", " / ", $rec_01_otro_01);

              $espacio = "{$row['espacios']}";
              $espacio_otro = "{$row['espacio_otro1']}";
              $espacio_ext = "{$row['espacios2']}";
              $espacio_ext_otro = "{$row['espacio_otro2']}";
              $actividad = "{$row['acti']}";
              $cual_actividad_01 = "{$row['acti_c']}";
              $cual_actividad = str_replace(",", " / ", $cual_actividad_01);
              $don_actividad_01 = "{$row['acti_d']}";
              $don_actividad = str_replace(",", " / ", $don_actividad_01);
              $espera_sesion = "{$row['sesion_tutoria']}";
              $espera_sesion_otro_01 = "{$row['tutoria_otro']}";
              $espera_sesion_otro = str_replace(",", " / ", $espera_sesion_otro_01);

              $parte_01 = $matri_alu.",".$nombre.",".$edo_civil.",".$sexo.",".$edad.",".$turno.",".$hijos.",".$dependientes.",".$num_dep.",".$trabajo.",".$des_trabajo.",".$prom.",".$becario.",".$beca.",".$estudio_m.",".$estudio_p.",".$motivo.",".$otro_motivo.",".$lic.",".$xq_lic.",".$xq_lic_otro.",".$campo.",".$men_campo.",".$hrs.",".$duda_1.",".$duda_1_medios.",".$duda_1_xq.",".$duda_2.",".$duda_2_medios.",".$duda_2_xq;

              $res_01 = str_replace("|", ",", $recursos_01);
              $array = explode(",", $res_01);
              $rec = "";
              $con_rec = "";
              for($i=0; $i< (count($array)); $i++)
                {
                  $id_recurso = $array[$i]; 
                  if ($array[$i] != "") {
                    $query_sq = "SELECT desc_recu FROM ges_recursos WHERE id_recurso = ? ;";
                    $stmt_sq = $connection->prepare($query_sq);
                    $stmt_sq->execute(array($id_recurso));
                    $total_sq=$stmt_sq->rowCount();
                    if($total_sq > 0){
                      
                      while ($row = $stmt_sq->fetch()){
                        $rec = "{$row['desc_recu']}";
                        $con_rec =  $rec." / ".$con_rec;
                      } /////while
                    } ///if total_sq
                  } ////if
                } ////for

                $parte_02 = $con_rec.",".$rec_01_otro;

                $esp = str_replace("|", ",", $espacio);
                $array = explode(",", $esp);
                $espacio_desc = "";
                $con_espacio = "";

                for($i=0; $i< (count($array)); $i++){
                  $id_espacio = $array[$i]; 
                  if ($array[$i] != "") {
                    $query_sq = "SELECT desc_espacio FROM ges_espacio WHERE id_espacio = ? ;";
                    $stmt_sq = $connection->prepare($query_sq);
                    $stmt_sq->execute(array($id_espacio));
                    $total_sq=$stmt_sq->rowCount();
                    if($total_sq > 0){
                      while ($row = $stmt_sq->fetch()){
                        $espacio_desc = "{$row['desc_espacio']}";
                        ///echo $espacio_desc."<br>";
                        $con_espacio =  $espacio_desc." / ".$con_espacio;
                      } /////while
                    } ///if total_sq
                  } ////if
                } ////for

                $parte_03 = $con_espacio.",".$espacio_otro;
              
                $esp_ex = str_replace("|", ",", $espacio_ext);
                $array = explode(",", $esp_ex);
                $espacio_ex = "";
                $con_espacio_ex = "";
                
                for($i=0; $i< (count($array)); $i++)
                  {
                    $id_esp_ex = $array[$i]; 
                    if ($array[$i] != "") {
                      $query_sq = "SELECT desc_ex FROM ges_espacio_ex WHERE id_externo = ? ;";
                      $stmt_sq = $connection->prepare($query_sq);
                      $stmt_sq->execute(array($id_esp_ex));
                      $total_sq=$stmt_sq->rowCount();
                      if($total_sq > 0){
                        while ($row = $stmt_sq->fetch()){
                          $espacio_ex = "{$row['desc_ex']}";
                          ////echo $espacio_ex." / ";
                          $con_espacio_ex =  $espacio_ex." / ".$con_espacio_ex;
                        } /////while
                      } ///if total_sq
                    } ////if
                  } ////for

                $parte_04 = $con_espacio_ex.",".$espacio_ext_otro.",".$actividad.",".$cual_actividad.",".$don_actividad.",".$espera_sesion.",".$espera_sesion_otro."\n";

                $fecha = date("d-m-Y"); 
                header("Content-Description: File Transfer");
                header("Content-Type: application/force-download; charset='utf-8'");
                header("Content-Disposition: attachment; filename=informacion_inicial_".$fecha.".csv");
                echo utf8_decode($parte_01.",".$parte_02.",".$parte_03.",".$parte_04);

            }

          }

}else{ 
  header("location:../../login.php"); 
}
?>