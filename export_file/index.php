<?php 
require_once $_SERVER["DOCUMENT_ROOT"].'/excel/PHPExcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'IMEI')
->setCellValue('B1', 'Status')
->setCellValue('C1', 'Model')
->setCellValue('D1', 'Customer-code')
->setCellValue('E1', 'Customer-name')
->setCellValue('F1', 'Date-export')
->setCellValue('G1', 'Date-active')
->setCellValue('H1', 'Date-guarantee');

$i=1;
foreach ($data as $row)
{
    $i++;
    $date_1 =date_create($row['date-ex']);
    $date_3 =date_create($row['date-guarantee']);
    $date_ex = date_format($date_1,"d-m-Y");
    $date_gua = date_format($date_3,"d-m-Y");
    
    if($row['status']=='yes') {
        $date_2 =date_create($row['date-active']);
        $date_act = date_format($date_2,"d-m-Y");
    } else {
        $date_act = '';
    }
    
    $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i, $row['imei'])
	->setCellValue('B'.$i, $row['status'])
	->setCellValue('C'.$i, $row['model'])
    ->setCellValue('D'.$i, $row['customer-code'])
    ->setCellValue('E'.$i, $row['customer-name'])
    ->setCellValue('F'.$i, $date_ex)    
    ->setCellValue('G'.$i, $date_act)
    ->setCellValue('H'.$i, $date_gua);
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$full_path = 'data-export.xlsx';	
$objWriter->save($full_path);

$file_url = 'http://klain-portal.com/export/data-export.xlsx';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url);
?>