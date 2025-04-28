<?php
//require_once("../comun/coneximpo.php");

$database = new Database();
$con = $database->connect();

// $link=Conectarse();
$q = strtolower($_GET["q"]);
if (!$q) return;

//$nombre = $_GET["nombre"];
$matricula = "";//$_GET["matr"];

// and international_name like '$txtnombre_del_puerto%'
if($matricula!=''){
$sql = "SELECT * FROM alumnos where  T like '%$matricula%' order by PATE,MATE,NOM";	
}else{
$sql = "SELECT * FROM alumnos where   (PATE like '%$q%' OR MATE like '%$q%' OR NOM like '%$q%'  ) 
order by PATE,MATE,NOM";
}
$rsd = $con->query($sql);
 
while($rs = $rsd->fetch_array()) {
	$mostrar = strtoupper($rs['T']).' - '.($rs['PATE']).' '.(($rs['MATE'])!='' ? ($rs['MATE']) : '').', '.($rs['NOM']) ;
	$matricula = strtoupper($rs['T']);
    $cname =  ($rs['PATE']).' '.(($rs['MATE'])!='' ? ($rs['MATE']) : '').', '.($rs['NOM']) ;
 	print "$mostrar|$cname|$matricula\n";
}

?>

