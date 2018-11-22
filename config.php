<?php 

// Require com a classe de importação construída 
require_once 'ImportaPlanilha.php';

// Instância conexão PDO com o banco de dados 
$pdo = new PDO('mysql:host=localhost;dbname=sget', 'root', '');

// Instância o objeto importação e passa como parâmetro o caminho da planilha e a conexão PDO 
$obj = new ImportaPlanilha('./teste.xls', $pdo);

// Chama o método que retorna a quantidade de linhas 
echo 'Quantidade de Linhas na Planilha ' , $obj->getQtdeLinhas(), '<br>';

// Chama o método que retorna a quantidade de colunas 
echo 'Quantidade de Colunas na Planilha ' , $obj->getQtdeColunas(), '<br>';

// Chama o método que insere os dados e captura a quantidade linhas importadas 
$linhasImportadas = $obj->insertDados();

// Imprime a quantidade de linhas importadas 
echo 'Foram importadas ', $linhasImportadas, ' linhas';

?>