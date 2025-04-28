<?php
session_start();
//print_r($_SESSION["verde"]);
/** Error reporting */
include "./core/autoload.php";
include "./core/app/model/AlumnosData.php";
//include "./core/app/model/CategoryData.php";

include "./vendor/autoload.php";

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
//require_once '../core/controller/PHPExcel/Classes/PHPExcel.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//require __DIR__ . '/../Header.php';

//$spreadsheet = new Spreadsheet();
// Create new PHPExcel object
$objPHPExcel = new Spreadsheet();

// Set document properties
$objPHPExcel->getProperties()->setCreator("UAM")
							 ->setLastModifiedBy("UAM")
							 ->setTitle("Inventio Max v9.0")
							 ->setSubject("Inventio Max v9.0")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");


// Add some data
$sheet = $objPHPExcel->setActiveSheetIndex(0);

$sheet->setCellValue('A1', 'CLASIFICACION INICIAL')
->setCellValue('A2', 'Matricula')
->setCellValue('B2', 'Nombre')
->setCellValue('C2', 'Apellido Paterno')
->setCellValue('D2', 'Apelldio Materno')
->setCellValue('E2', 'Clasificacion');
$start = 3;
$sheet->setCellValue('A'.$start, "AVANZADO")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");

$start = 4;
foreach($_SESSION["verde"] as $product){
$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Clasific_Ini"]);

$start++;
}
$sheet->setCellValue('A'.$start, "NORMAL")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");
$start++;


foreach($_SESSION["ambar"] as $product){
$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Clasific_Ini"]);

$start++;
}
$sheet->setCellValue('A'.$start, "REZAGADO")
->setCellValue('B'.$start, "")
->setCellValue('C'.$start, "")
->setCellValue('D'.$start, "");
$start++;


foreach($_SESSION["rojo"] as $product){
$sheet->setCellValue('A'.$start, $product["T"])
->setCellValue('B'.$start, $product["NOM"])
->setCellValue('C'.$start, $product["PATE"])
->setCellValue('D'.$start, $product["MATE"])
->setCellValue('E'.$start, $product["Clasific_Ini"]);

$start++;
}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


//$sheet->setCellValue('A5', 'Hello World !');
////////////////////////////////////////////////////
  // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="clasificacion-'.time().'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
//////////////////////////////////////////////////////
$writer = new Xlsx($objPHPExcel);
$writer->save('php://output');

