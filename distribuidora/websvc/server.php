<?php
//criação de uma instância do servidor (coloque o endereço na sua máquina local)
$server = new SoapServer(null, array('uri' => "http://localhost/websvc"));
	  
	  function pegaCliente() {
				$vetor = array();
				
				include '../include/conexao.php';
				$sql = "SELECT 
					\"CLIENTE_ID\",
					\"CLIENTE_Nome\",
					\"CLIENTE_CNPJ\", 
					\"CLIENTE_Email\",
					\"CLIENTE_Ativo\",
					\"CLIENTE_ENDERECO\",
					\"CLIENTE_BAIRRO\", 
					\"CLIENTE_CEP\"
					\"CLIENTE_CONTATO\",
					\"CLIENTE_FONE1\",
					\"CLIENTE_ULT_COMPRA\", 
					\"CLIENTE_COTACAO\"
					\"CLIENTE_PRECOESP\",
					\"CLIENTE_DTNASC\",
					\"CLIENTE_MUNIC\", 
					\"CLIENTE_UF\"
					\"CLIENTE_CIDADE\",
					\"CLIENTE_REPR\"	
						 FROM \"CLIENTE\"";

				$result = pg_query($conn,$sql);
				if (pg_num_rows($result) > 0){
					$tam = pg_num_rows($result);		
						for($i=0; $i < $tam; $i++){
							$row = pg_fetch_array($result);	
							$vetor[$i] = $row['CLIENTE_ID'].'@@'
										.$row['CLIENTE_Nome'].'@@'
										.$row['CLIENTE_CNPJ'].'@@'
										.$row['CLIENTE_Email'].'@@'
										.$row['CLIENTE_Ativo'].'@@'
										.$row['CLIENTE_ENDERECO'].'@@'
										.$row['CLIENTE_BAIRRO'].'@@'
										.$row['CLIENTE_CEP'].'@@'
										.$row['CLIENTE_CONTATO'].'@@'
										.$row['CLIENTE_FONE1'].'@@'
										.$row['CLIENTE_ULT_COMPRA'].'@@'
										.$row['CLIENTE_COTACAO'].'@@'
										.$row['CLIENTE_PRECOESP'].'@@'
										.$row['CLIENTE_DTNASC'].'@@'
										.$row['CLIENTE_MUNIC'].'@@'
										.$row['CLIENTE_UF'].'@@'
										.$row['CLIENTE_CIDADE'].'@@'
										.$row['CLIENTE_REPR'];
						}
				}
		return $vetor;
		pg_close($conn);
	  }
	  
	  function pegaProduto() {
				$vetor = array();
				
				include '../include/conexao.php';
				$sql = "SELECT 
					\"ID_FORNECEDOR\",
					\"ID_PRODUTO\",
					\"Referencia\", 
					\"Aplicacao\",
					\"Unidade\",
					\"Preco_cmp\",
					\"Qtd_Emb\", 
					\"Qtd_Estoque\",
					\"Ativo\",
					\"Similar\",
					\"Valor_Cotacao\", 
					\"Cod_Barra\",
					\"MaxDesc\",
					\"Preco_vda\"	
						 FROM \"PRODUTO\"";

				$result = pg_query($conn,$sql);
				if (pg_num_rows($result) > 0){
					$tam = pg_num_rows($result);		
						for($i=0; $i < $tam; $i++){
							$row = pg_fetch_array($result);	
							$vetor[$i] = $row['ID_FORNECEDOR'].'@@'
										.$row['ID_PRODUTO'].'@@'
										.$row['Referencia'].'@@'
										.$row['Aplicacao'].'@@'
										.$row['Unidade'].'@@'
										.$row['Preco_cmp'].'@@'
										.$row['Qtd_Emb'].'@@'
										.$row['Qtd_Estoque'].'@@'
										.$row['Ativo'].'@@'
										.$row['Similar'].'@@'
										.$row['Valor_Cotacao'].'@@'
										.$row['Cod_Barra'].'@@'
										.$row['MaxDesc'].'@@'
										.$row['Preco_vda'];
						}
				}
		return $vetor;
		pg_close($conn);
	  }	
	  
	  function pegaFornecedor() {
				$vetor = array();
				
				include '../include/conexao.php';
				$sql = "SELECT 
					\"FORNECEDOR_ID\",
					\"FORNECEDOR_NOME\",
					\"FORNECEDOR_ATIVO\", 
					\"FORNECEDOR_ENDERECO\",
					\"FORNECEDOR_UF\",
					\"FORNECEDOR_CIDADE\",
					\"FORNECEDOR_CNPJ\", 
					\"FORNECEDOR_CEP\",
					\"FORNECEDOR_FONE\",
					\"FORNECEDOR_CONTATO\",
					\"FORNECEDOR_EMAIL\", 
					\"FORNECEDOR_BAIRRO\"	
						 FROM \"FORNECEDOR\"";

				$result = pg_query($conn,$sql);
				if (pg_num_rows($result) > 0){
					$tam = pg_num_rows($result);		
						for($i=0; $i < $tam; $i++){
							$row = pg_fetch_array($result);	
							$vetor[$i] = $row['FORNECEDOR_ID'].'@@'
										.$row['FORNECEDOR_NOME'].'@@'
										.$row['FORNECEDOR_ATIVO'].'@@'
										.$row['FORNECEDOR_ENDERECO'].'@@'
										.$row['FORNECEDOR_UF'].'@@'
										.$row['FORNECEDOR_CIDADE'].'@@'
										.$row['FORNECEDOR_CNPJ'].'@@'
										.$row['FORNECEDOR_CEP'].'@@'
										.$row['FORNECEDOR_FONE'].'@@'
										.$row['FORNECEDOR_CONTATO'].'@@'
										.$row['FORNECEDOR_EMAIL'].'@@'
										.$row['FORNECEDOR_BAIRRO'];
						}
				}
		return $vetor;
		pg_close($conn);
	  }	
	  
	  function pegaRepresentante() {
				$vetor = array();
				
				include '../include/conexao.php';
				$sql = "SELECT 
					\"REP_CODIGO\",
					\"REP_SENHA\",
					\"REP_RAZAO\"	
						 FROM \"REPRESENTANTE\" WHERE \"REP_ATIVO\" = 'S'";
						 
				$result = pg_query($conn,$sql);
				if (pg_num_rows($result) > 0){
					$tam = pg_num_rows($result);		
						for($i=0; $i < $tam; $i++){
							$row = pg_fetch_array($result);	
							$vetor[$i] = $row['REP_CODIGO'].'@@'
										.$row['REP_SENHA'].'@@'
										.$row['REP_RAZAO'];
						}
				}
		return $vetor;
		pg_close($conn);
	  }	
//registro do serviço
$server->addFunction("pegaCliente");
$server->addFunction("pegaFornecedor");
$server->addFunction("pegaProduto");
$server->addFunction("pegaRepresentante");
// chamada do método para atender as requisição do serviço 
// se a chamada for um POST executa, senão apenas mostra as funções “cadastradas”
if ($_SERVER["REQUEST_METHOD"]== "POST") {
		$server->handle();
} else {
	$functions = $server->getFunctions();
	foreach ($functions as $func) {
		print $func. "<br>";
	}
}
?>

