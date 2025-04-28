<?php

$base = new Database();
$con = $base->connect();
$sql2 = "select * from accesos where 1=1";
if(isset($_POST["nombre_usuario"]) && $_POST['nombre_usuario']!=""){ $sql2.=" and usuario=\"".$_POST["nombre_usuario"]."\""; }
if(isset($_POST["fecha"]) && $_POST['fecha']!=""){ $sql2.=" and fecha=\"".$_POST["fecha"]."\""; }
$sql2.=" order by idaccesos desc";
//echo $sql2;

$query = $con->query($sql2);
$array_data = array();

while($r = $query->fetch_object()){
  $array_data[] = $r;
}
?>

<?php if(count($array_data)>0):?>
  <div class="card">
    <div class="">
  <table class="table table-bordered">
    <thead>
      <th>Acceso</th>
      <th>Usuario</th>
      <th>Tipo</th>
      <th>Fecha</th>
      <th>Hora</th>
    </thead>
    <?php foreach($array_data as $data):?>
      <tr>
        <td><?php echo $data->script; ?></td>
        <td><?php echo $data->usuario; ?></td>
        <td><?php echo $data->tipo; ?></td>
        <td><?php echo $data->fecha; ?></td>
        <td><?php echo $data->hora; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</div>
<?php else:?>
  <p class="alert alert-warning">No hay elemetos</p>
<?php endif; ?>

