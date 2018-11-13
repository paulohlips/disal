<?php

// Dados do servidor
$servidor = 'localhost'; // Endereço
$usuario = 'cerradoti'; // Usuário
$senha = 'cerradoti'; // Senha

// Abre a conexão com o servidor FTP
$ftp = ftp_connect($servidor); // Retorno: true ou false


if($ftp == true){
    echo"Conexão estabelecida com servidor FTP.<br>";
}else{
    echo"Falha ao estabelecer conexão.Verifique se o servidor FTP informado está correto.<br>";
}

// Faz o login no servidor FTP
$login = ftp_login($ftp, $usuario, $senha); // Retorno: true ou false
if($login == TRUE){
    echo"Você está logado no servidor ".$servidor." como ".$usuario.".<br>";
}else{
    echo"Erro ao logar, verifique suas credenciais.<br>";
}

ftp_pasv($ftp, true) or die("Não foi possível entrar em modo passivo.");


//echo ftp_pwd($ftp);
/*
// Define variáveis para o envio de arquivo
$local_arquivo = './ftp/'; // Localização (local)
$ftp_pasta = '/home/cerradoti'; // Pasta (externa)
$ftp_arquivo = './disal.xls'; // Nome do arquivo (externo)

// Envia o arquivo pelo FTP em modo ASCII
$envia = ftp_put($ftp, $ftp_arquivo, $ftp_pasta, FTP_ASCII); // Retorno: true / false
if($envia == TRUE){
    echo"Seu arquivo foi enviado com sucesso.";
}else{
    echo"Falha ao enviar arquivo.";
}
*/

// Define variáveis para o recebimento de arquivo
$pasta_download = "./ftp/disal.xls"; // Localização (local)
$arquivo_servidor = "/home/cerradoti/disal.xls"; // Pasta (externa)
//$ftp_arquivo = 'disal.xls'; // Nome do arquivo (externo)

// Recebe o arquivo pelo FTP em modo ASCII
//$recebe = ftp_get($ftp, $pasta_download, $arquivo_servidor, FTP_ASCII);// Retorno: true / false
$recebe = ftp_get($ftp, "./ftp/teste.txt","./home/cerradoti/teste.txt", FTP_ASCII);

if($recebe == TRUE){
    echo"Seu arquivo foi recebido com sucesso.";
}else{
    echo"Falha ao receber arquivo.";
}

ftp_close($ftp);

?>
