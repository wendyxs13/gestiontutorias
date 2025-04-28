
<?php
//print_r($_POST);
$database = new Database();
$con = $database->connect();

if(trim($_POST["matricula"])==''){
	echo 'Ingrese su b&uacute;squeda';
	return;
}

 $sql = "SELECT * FROM calificaciones 
          INNER JOIN uea ON uea.cve_uea = calificaciones.cve_uea 
            WHERE calificaciones.matricula = '".$_POST["matricula"]."' GROUP BY calificaciones.cve_uea";
$query = $con->query($sql);

// print_r($row);
?>	
<div class="card">
  

<table>
        <tr>
            <th>Clave</th>
            <th>UEA</th>
            <th>Calificacion</th>
            <th>Periodo</th>
        </tr>
<?php
                            
  while ($alumno = $query->fetch_assoc())  {                    
              // var_dump($alumno);
?>

     

    
            <tr>    
              <td>      <?php echo $alumno['cve_uea']; ?></td>
              <td>        <?php echo $alumno['uea']; ?></td>
              <td>        <?php echo $alumno['calificacion']; ?></td>
              <td>        <?php echo $alumno['periodo']; ?></td>
            </tr>
   
                              
<?php
  }
?>
 </table>
</div>