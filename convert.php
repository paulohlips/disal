<?php 

require './Classes/vendor/autoload.php'; //autoload do projeto

use PhpOffice\PhpSpreadsheet\Spreadsheet; //Manipulação da planilha
use PhpOffice\PhpSpreadsheet\IOFactory; //Ler uma planilha
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$xls_file = date("Ymd")."041500.xls";

$reader = new Xls();
$spreadsheet = $reader->load($xls_file);

$loadedSheetNames = $spreadsheet->getSheetNames();

$writer = new Xlsx($spreadsheet);

foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $writer->save(date("Ymd").'.xlsx');
}

?>