<?php

$database = new Database();
$con = $database->connect();

$sql = "SELECT * FROM `carreras` ORDER BY `carreras`.`cve_plan` ASC";

$query =$con->query($sql);

?>
<option value="">-- SELECCIONE --</option>
<?php while ($car = $query->fetch_assoc()) { ?>
	<?php if($_GET['division']==$car["cve_div"]):?>
		<option value="<?php echo $car["cve_plan"];?>"><?php echo $car["plan"];?></option>
	<?php endif;?>
<?php } ?>