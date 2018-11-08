<?php 

require './Classes/vendor/autoload.php'; //autoload do projeto

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha
use PhpOffice\PhpSpreadsheet\IOFactory; //classe responsável por ler uma planilha
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$xls_file = "disal.xls";

$reader = new Xls();
$spreadsheet = $reader->load($xls_file);

$loadedSheetNames = $spreadsheet->getSheetNames();

$writer = new Xlsx($spreadsheet);

foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    //$writer->setSheetIndex($sheetIndex);
    $writer->save($loadedSheetName.'.xlsx');
    echo("OK");
    
}

?>