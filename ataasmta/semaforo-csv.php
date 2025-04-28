<?php
session_start();
//print_r($_SESSION["verde"]);
/** Error reporting */
include "./core/autoload.php";
include "./core/app/model/AlumnosData.php";
//include "./core/app/model/CategoryData.php";

    header('Content-Type: text/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="semaforo.csv";');
$fp = fopen('php://output', 'w'); 


//print "Matricula, Nombre, Apellido Paterno, Apellido Materno, Semaforo\n";
/*
$sheet->setCellValue('A1', 'SEMAFORO')
->setCellValue('A2', 'Matricula')
->setCellValue('B2', 'Nombre')
->setCellValue('C2', 'Apellido Paterno')
->setCellValue('D2', 'Apelldio Materno')
->setCellValue('E2', 'Semaforo');
$start = 3;
$sheet->setCellValue('A'.$start, "VERDE")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");

$start = 4;
*/
$line= "Matricula, Nombre, Apellido Paterno, Apellido Materno, Semaforo\n";
fwrite($fp, $line);

foreach($_SESSION["verde"] as $product){
//print $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
$line = $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
//$line = array($product["T"], $product["NOM"], $product["PATE"], $product["MATE"], $product["Semaforo"]);
//fputcsv($fp, $line);
fwrite($fp, $line);
      //  fputcsv($f, $line, $delimiter); 
/*
$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Semaforo"]);

$start++;
*/
}
/*
$sheet->setCellValue('A'.$start, "AMBAR")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");
$start++;
*/

foreach($_SESSION["ambar"] as $product){
//print $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
$line = $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
fwrite($fp, $line);
/*$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Semaforo"]);

$start++;
*/
}
/*
$sheet->setCellValue('A'.$start, "ROJO")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");
$start++;
*/

foreach($_SESSION["rojo"] as $product){
//print $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
$line = $product["T"].",".$product["NOM"].",".$product["PATE"].",".$product["MATE"].",".$product["Semaforo"]."\n";
fwrite($fp, $line);
/*
$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Semaforo"]);

$start++;
*/
}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);



    // make php send the generated csv lines to the browser
//    fpassthru($f);
//fclose($fp);
    ?>
