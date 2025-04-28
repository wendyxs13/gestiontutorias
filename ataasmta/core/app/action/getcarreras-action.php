<?php

$carreras = array(
array("id"=>63,"name"=>"ADMINISTRACION","division"=>2),
array("id"=>78,"name"=>"AGRONOMIA","division"=>3),
array("id"=>85,"name"=>"ARQUITECTURA","division"=>4),
array("id"=>73,"name"=>"BIOLOGIA","division"=>3),
array("id"=>64,"name"=>"COMUNICACION SOCIAL","division"=>2),
array("id"=>86,"name"=>"DISEÑO DE LA COMUNICACION GRAFICA","division"=>4),
array("id"=>87,"name"=>"DISEÑO INDUSTRIAL","division"=>4),
array("id"=>65,"name"=>"ECONOMIA","division"=>2),
array("id"=>74,"name"=>"ENFERMERIA","division"=>3),
array("id"=>75,"name"=>"ESTOMATOLOGIA","division"=>3),
array("id"=>79,"name"=>"MEDICINA","division"=>3),
array("id"=>77,"name"=>"MEDICINA VETERINARIA Y ZOOTECNIA","division"=>3),
array("id"=>80,"name"=>"NUTRICION HUMANA","division"=>3),
array("id"=>88,"name"=>"PLANEACION TERRITORIAL","division"=>4),
array("id"=>101,"name"=>"POLITICA Y GESTION SOCIAL","division"=>2),
array("id"=>66,"name"=>"PSICOLOGIA","division"=>2),
array("id"=>76,"name"=>"QUIMICA FARMACEUTICA BIOLOGICA","division"=>3),
array("id"=>67,"name"=>"SOCIOLOGIA","division"=>2),
);

?>
<option value="">-- SELECCIONE --</option>
<?php foreach($carreras as $car):?>
	<?php if($_GET['division']==$car["division"]):?>
		<option value="<?php echo $car["id"];?>"><?php echo $car["name"];?></option>
	<?php endif;?>
<?php endforeach; ?>