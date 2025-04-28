<?php

$database = new Database();
$con = $database->connect();

$sql = "SELECT * FROM alumnos 
			INNER JOIN calificaciones ON alumnos.t = calificaciones.matricula 
			
			WHERE alumnos.PLA = '".$_POST["carrera"]."' GROUP BY calificaciones.matricula  ORDER BY `calificaciones`.`idindicadores` DESC ";

$query =$con->query($sql);


?>

<style>
  div#example1_length {
    margin-bottom: 10px;
}

p.amarillo {
    color: #3a4859;
    font-weight: 700;
    background-color: yellow;
    text-align-last: center;
}
p.rojo {
    color: #3a4859;
    font-weight: 700;
    background-color: #f76a6a;    ;
    text-align-last: center;
}
p.verde {
    color: #3a4859;
    font-weight: 700;
    background-color: #12ed35
    ;
    text-align-last: center;
}
td.center {
    text-align: center;
}
</style>

<div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title">Calificaciones </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					          <th>Acciones</th>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Carrera</th>
                    <th>Prom UAM</th>
                    <th>TRII</th>
                  </tr>
                  </thead>
                  <tbody>

				  <?php
                            
							while ($alumno = $query->fetch_assoc())  {                    
                            // var_dump($alumno);
                ?>
                  <tr>
					<td>
						<button type="button" class="btn btn-info verAlumno" matricula="<?php echo $alumno['T']; ?>" nombre="<?php echo $alumno['NOM'] . ' ' . $alumno['PATE'] . ' '. $alumno['MATE']; ?>" data-toggle="modal" data-target="#modalVerMatricula" title="Ver matricula" id="verMatricula"><i class="bi bi-eye-fill mr-1"></i> &nbsp; Info</button>
						<button type="button" class="btn btn-success verMatricula" matricula="<?php echo $alumno['T']; ?>"  nombre="<?php echo $alumno['NOM'] . ' ' . $alumno['PATE'] . ' '. $alumno['MATE']; ?>" carrera="<?php echo $alumno['plan_est']; ?>" data-toggle="modal" data-target="#modalVerMatricula" title="Ver matricula" id="verMatricula"><i class="bi bi-eye-fill mr-1"></i>&nbsp;Calif</button>
					</td>
                    <td><a  class="verMatricula"  matricula="<?php echo $alumno['T']; ?>"  nombre="<?php echo $alumno['NOM'] . ' ' . $alumno['PATE'] . ' '. $alumno['MATE']; ?>" carrera="<?php echo $alumno['plan_est']; ?>" data-toggle="modal" data-target="#modalVerMatricula"> <?php echo $alumno['T']; ?></a></td>
                    <td><?php echo $alumno['NOM']; ?></td>
                    <td><?php echo $alumno['PATE'] ." ". $alumno['MATE']; ?></td>
                    <td><?php echo $alumno['plan_est']; ?></td>
                    <td class="center"> <p class="<?php 
                    /*if ($alumno['PROMUAM'] > 0) {
                      if ($alumno['NA'] >= 3) { 
                        echo "rojo " . $alumno['NA'];
                      } elseif(($alumno['NA'] >= 1) && ($alumno['NA'] < 3)){
                        echo "amarillo " . $alumno['NA'];
                      } elseif( $alumno['NA'] == 0){
                        echo "verde " . $alumno['NA'];
                      } 
                    } 
                     */

                     $rezago = $alumno['NTRI'] - $alumno['TRI_UBICA'];

                     if ($rezago > 3) { 
                         echo "rojo " . $rezago;
                     } elseif(($rezago >= 1) && ($rezago <= 3)) {
                         echo "amarillo " . $rezago;
                     } elseif($rezago == 0) {
                         echo "verde " . $rezago;
                     }
  

                    ?>"> <?php echo $alumno['PROMUAM']; ?></p> </td>
                    <td><?php echo $alumno['TRII']; ?></td>
                  </tr>
				  <?php
                            
							}
                        ?>
                 
                  </tbody>
                  <tfoot>
					
                  <tr>
					          <th>Acciones</th>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Carrera</th>
                    <th>Prom UAM</th>
                    <th>TRII</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>







			<!-- Modal -->
<div class="modal fade" id="modalVerMatricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>

        <button type="button" class="close btn " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <h5 class="modal-header ml-8" id="carreras"></h5>
	  
      <div class="modal-body" id="informacionAlumno">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">


    $(document).on('click', '.verAlumno', function () {
		var matricula = $(this).attr("matricula");		
		var nombre = $(this).attr("nombre");
		console.log(nombre);
		const title = document.getElementById("exampleModalLongTitle");
		title.textContent = nombre		
		
        getInformacion(matricula);
       
		
    });

	
    $(document).on('click', '.verMatricula', function () {
		var matricula = $(this).attr("matricula");
		var nombre = $(this).attr("nombre");
		var carrera = $(this).attr("carrera");
		console.log(nombre);
		const title = document.getElementById("exampleModalLongTitle");
		title.textContent = nombre	
		const carreras = document.getElementById("carreras");
		carreras.textContent = carrera	

        getCalificaciones(matricula);
       
		
    });

	function getInformacion(matricula) {
		$.post("./?action=getInformacionAlumno","matricula="+matricula, function(data){
					$("#informacionAlumno").html(data);
		});
	}

	function getCalificaciones(matricula) {
		$.post("./?action=getCalificacionesAlumno","matricula="+matricula, function(data){
					$("#informacionAlumno").html(data);
		});
	}
</script>


<script>
  $(function () {
    $("#example1").DataTable({ 
		"paging": true,   
      "pageLength" : 10, 
	"language": {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	} ,   
                             
     
     
  "responsive": true, 
	  "lengthChange": true, 
	  "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]




    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');





    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>