<?php 
ini_set('max_execution_time','-1');
require 'Classes/simplexlsx.class.php';

class ImportaPlanilha{

	// Atributo recebe a instância da conexão PDO
	private $conexao  = null;

     // Atributo recebe uma instância da classe SimpleXLSX
	private $planilha = null;

	// Atributo recebe a quantidade de linhas da planilha
	private $linhas   = null;

	// Atributo recebe a quantidade de colunas da planilha
	private $colunas  = null;

	/*
	 * Método Construtor da classe
	 * @param $path - Caminho e nome da planilha do Excel xlsx
	 * @param $conexao - Instância da conexão PDO
	 */
	public function __construct($path=null, $conexao=null){

		if(!empty($path) && file_exists($path)):
			$this->planilha = new SimpleXLSX($path);
			list($this->colunas, $this->linhas) = $this->planilha->dimension();
		else:
			echo 'Arquivo não encontrado!';
			exit();
		endif;

		if(!empty($conexao)):
			$this->conexao = $conexao;
		else:
			echo 'Conexão não informada!';
			exit();
		endif;

	}

	/*
	 * Método que retorna o valor do atributo $linhas
	 * @return Valor inteiro contendo a quantidade de linhas na planilha
	 */
	public function getQtdeLinhas(){
		return $this->linhas;
	}

	/*
	 * Método que retorna o valor do atributo $colunas
	 * @return Valor inteiro contendo a quantidade de colunas na planilha
	 */
	public function getQtdeColunas(){
		return $this->colunas;
	}

	/*
	 * Método que verifica se o registro ISBN da planilha já existe na tabela de estoque
	 * @return Valor Booleano TRUE para duplicado e FALSE caso não 
	 */
	private function isRegistroDuplicado($isbn=null){
		$retorno = false;
		try{
			if(!empty($isbn)):
				$sql = 'SELECT id FROM disal_estoque WHERE isbn = ?';
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $isbn);
				$stm->execute();
				$dados = $stm->fetchAll();

				if(!empty($dados)):
					$retorno = true;
				else:
					$retorno = false;
				endif;
			endif;

			
		}catch(Exception $erro){
			echo 'Erro: ' . $erro->getMessage();
			$retorno = false;
		}

		return $retorno;
	}

	/*
	 * Método para ler os dados da planilha e inserir no banco de dados
	 * @return Valor Inteiro contendo a quantidade de linhas importadas
	 */
	public function insertDados(){

		try{
			$sql = 'INSERT INTO disal_estoque(isbn, qtd_estoque, data_atualizacao)VALUES(?, ?, now())';
			$stm = $this->conexao->prepare($sql);
			
			$linha = 0;
			foreach($this->planilha->rows() as $chave => $valor):
				if ($chave >= 1 && !$this->isRegistroDuplicado(trim($valor[0]))):		
					$isbn  = trim($valor[0]);
					$qtd_estoque    = trim($valor[7]);
				
					$stm->bindValue(1, $isbn);
					$stm->bindValue(2, $qtd_estoque);

					$retorno = $stm->execute();
					
					if($retorno == true) $linha++;
				 endif;
			endforeach;

			return $linha;
		}catch(Exception $erro){
			echo 'Erro: ' . $erro->getMessage();
		}

	}
}

?>