<?php

/* 
 * Esta função verifica um diretório e retona o último arquivo modificado
 * @author Paulo <paulo.mendes@cerradoti.com.br> 
*/ 

function lastUpdate(){  

//A classe DirectoryIterator recebe o path da pasta com os arquivos a serem pesquisados
$filesFolder = new DirectoryIterator('/opt/lampp/htdocs/ftpdate/teste'); 

//A variável $filesDate é criada como um array() para armazenar o nome dos arquivos e as datas de modificação
$filesDate = array();
foreach($filesFolder as $folder) {
    if($folder->isDot()) continue;
    $filesDate[$folder->getCTime()] = $folder->__toString();
}

//A função krsort ordena os nomes dentro do vetor de acordo com a ordem de atualização (Mais atual ---> Mais antigo)
krsort($filesDate);

//O nome do arquivo atualizado por último é retornado pela função através de $lastUpdated.
$lastUpdated = current($filesDate);
return $lastUpdated;
}
?>