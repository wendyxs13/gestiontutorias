
<?php
//print_r($_POST);
$database = new Database();
$con = $database->connect();

if(trim($_POST["matricula"])==''){
	echo 'Ingrese su b&uacute;squeda';
	return;
}

 $sql = "SELECT * FROM alumnos where 1=1 ".
(trim($_POST["matricula"])!='' ? " AND T like '%".trim($_POST["matricula"])."%' " : "")."
order by PATE,MATE,NOM";
$query = $con->query($sql);

$row = $query->fetch_array();
// print_r($row);
?>	
<div class="card">
  <div class="card-body">
<?php if($row):?>
<table  >
  <tr>
    <td  ><div align="right"><strong>
      <?=($row["PATE"])?>
      <?=($row["MATE"])?>,
      <?=($row["NOM"])?>
    </strong></div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["T"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Trimestre en el que se ubica</div></td>
    <td>&nbsp;</td>
    <td><strong>
      <?=($row["TRI_UBICA"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  ><div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>RIESGO INICIAL DE REZAGO</strong></font></div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
<?php 
$prom = $row["PROM"];
 $edad = $row["EDCAL"];
$puntaje = $row["PUNTAJE"];


if($prom <= 7 || (($edad >= 26 && $edad <= 30) || $edad > 30) || ($puntaje >= 0 && $puntaje <= 600)) {
  echo "<b>ALTO</b>";
} 
else if(($prom >= 9 && $prom <= 10) || (($edad >= 19 && $edad <= 20)) || ($puntaje >= 800 && $puntaje <= 1000)) {
  echo "<b>BAJO</b>";
} 
else {
  echo "<b>MEDIO</b>";
}
/*
if($prom <= 7 && (($edad>=26 && $edad <=30) || $edad >30)  ){ echo "<b>REZAGADO</b>"; }
else if(($prom >= 7.01 && $prom<=9) && (($edad>=21 && $edad <=25) || $edad <19)  ){ echo "<b>NORMAL</b>"; }
else if(($prom >= 7.01 && $prom<=9) && (($edad>=19 && $edad <=20)) ){ echo "<b>AVANZADO</b>"; }
*/
?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Cr&eacute;ditos cursados</div></td>
    <td>&nbsp;</td>
    <td><strong>
      <?=($row["CRE_ACUM"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td  ><div align="right">Promedio de bachillerato</div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["PROM"])?>
    </strong></td>
    <td  >&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Cr&eacute;ditos faltantes</div></td>
    <td>&nbsp;</td>
    <td><strong>
      <?=($row["CRE_PLA"]-$row["CRE_ACUM"]);?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  ><div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">CARRERA QUE CURSA</font></div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["plan_est"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Trimestre de ingreso</div></td>
    <td>&nbsp;</td>
    <td><strong><?=($row["TRII"])?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  ><div align="right">Promedio UAM</div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["PROMUAM"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Trimestres que ha cursado</div></td>
    <td>&nbsp;</td>
    <td><strong><?=$row["NTRC"];?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><div align="right">Estado académico</div></td>
    <td>&nbsp;</td>
    <td><strong>
        <?php
        $edo = $row["EDO"];
        $estado_texto = "";

        if ($edo == 1) {
            $estado_texto = "Inscrito a UEA";
        } elseif ($edo == 2) {
            $estado_texto = "No reinscrito";
        } elseif ($edo == 3) {
            $estado_texto = "Suspendido";
        } elseif ($edo == 4) {
            $estado_texto = "Baja definitiva";
        } elseif ($edo == 5) {
            $estado_texto = "Titulado";
        } elseif ($edo == 6) {
            $estado_texto = "Egresado";
        } elseif ($edo == 7) {
            $estado_texto = "Baja reglamentaria";
        } elseif ($edo == 8) {
            $estado_texto = "Créditos en revisión";
        } elseif ($edo == 9) {
            $estado_texto = "Baja por dictamen de órgano colegiado";
        } elseif ($edo == 10) {
            $estado_texto = "Inscrito sin carga académica";
        } elseif ($edo == 11) {
            $estado_texto = "Aceptado nuevo ingreso";
        } elseif ($edo == 12) {
            $estado_texto = "Créditos cubiertos";
        } elseif ($edo == 13) {
            $estado_texto = "Nuevo ingreso no presentado";
        } elseif ($edo == 14) {
            $estado_texto = "Interrupción de estudios por más de seis trimestres consecutivos";
        } elseif ($edo == 17) {
            $estado_texto = "Admitido en lista complementaria";
        } elseif ($edo == 18) {
            $estado_texto = "Estancia terminada (movilidad)";
        } elseif ($edo == 19) {
            $estado_texto = "Cancelación de trámite de registro o de ingreso";
        } else {
            $estado_texto = "Estado desconocido";
        }

        echo $estado_texto;
        ?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Trimestres de rezago</div></td>
    <td>&nbsp;</td>
    <td><strong><?=($row["NTRI"]-$row["TRI_UBICA"]);?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>



    <td><div align="right">Trimestres transcurridos desde su ingreso</div></td>
    <td>&nbsp;</td>
    <td><strong><?=$row["NTRI"];?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  ><div align="right">Edad</div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["EDCAL"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Periodos para concluir la carrera</div></td>
    <td>&nbsp;</td>
    <?php if($row["EDO2"]==22):?>
    <td><strong><?php echo $row["TRII"]."-".$row["UT_AA"];?></strong></td>
  <?php else:?>
    <td><strong>No ha concluido</strong></td>
  <?php endif; ?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  ><div align="right">Puntaje</div></td>
    <td  >&nbsp;</td>
    <td  ><strong>
      <?=($row["PUNTAJE"])?>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Edad al titularse</div></td>
    <td>&nbsp;</td>
    <?php if($row["EDO"]==5):?>
    <td><strong><?php echo $row["ED_AL_TIT"];?></strong></td>
  <?php else:?>
    <td><strong>No se ha titulado</strong></td>
  <?php endif; ?>    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
    <?php if($row["EDO"]==5):?>
    <td><strong></strong></td>
  <?php else:?>
    <td><strong></strong></td>
  <?php endif; ?>    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  <?php else: ?>
    <p class="alert alert-warning">No se encontro el registro</p>
    <?php endif; ?>
  </div>
</div>