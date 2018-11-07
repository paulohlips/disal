<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

require_once __DIR__ . '/src/Bootstrap.php';

$helper = new Sample();

/*
$inputFileType = 'Xls';
$inputFileName = __DIR__ . '/sampleData/example1.xls';

$reader = IOFactory::createReader($inputFileType);
$helper->log('Turning Formatting off for Load');
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($inputFileName);

$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
var_dump($sheetData);
*/
?>