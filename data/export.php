<?php 
include('../include/config.php');
include('../include/library/class/class.php');
$db= new db(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once '../excel2/PHPExcel/PHPExcel.php';
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

$type = $_GET['z'];
$f = $_GET['x'];
$t = $_GET['y'];
if($type=='export') {
    $sql="select * from `imei` WHERE `date-ex` >= '$f' AND `date-ex` <= '$t' ";
    $result=$db->query($sql);
    $data=$db->fetchdata($result);
}

if($type=='active') {
    $sql="select * from `imei` WHERE `date-active` >= '$f' AND `date-active` <= '$t' ";
    $result=$db->query($sql);
    $data=$db->fetchdata($result);
}

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
$full_path = 'imei-export.xlsx';	
$objWriter->save($full_path);

$file_url = 'http://wmobile.com.vn/imei-mange/export/imei-export.xlsx';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url);

?>