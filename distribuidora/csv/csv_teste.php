<?php
include '../include/conexao.php';

$caminho = "teste.csv";
//$campos = array('codigo','nome','preco','quantidade</code></span></span>');
$campos = array();

$cvs_array = CVStoArray($caminho,$campos);
echo '<pre>';
//var_dump($cvs_array);

$tam = count($cvs_array);	// contar o tamanho do vetor

foreach($cvs_array as $indice => $item)
{

   $sql="INSERT INTO \"PRODUTO\"(
	\"ID_FORNECEDOR\",
	\"Referencia\",
	\"Aplicacao\",
	\"Unidade\",
	\"Preco_cmp\",
	\"Preco_vda\",
	\"Qtd_Emb\",												
	\"Qtd_Estoque\",
	\"Ativo\",
	\"Cod_Barra\",
	\"MaxDesc\"						
	)VALUES(
	'".$item["ID_FORNECEDOR"]."',
	'".$item["Referencia"]."',
	'".$item["Aplicacao"]."',
	'".$item["Unidade"]."',
	'".$item["Preco_cmp"]."',
	'".$item["Preco_vda"]."',
	'".$item["Qtd_Emb"]."',
	'".$item["Qtd_Estoque"]."',
	'".$item["Ativo"]."',
	'".$item["Cod_Barra"]."',
	'".$item["MaxDesc"]."'			
)";

	if ($result=pg_query($conn,$sql)){
		$cmdtuples = pg_affected_rows($result);
		echo '<pre>';
		echo $sql;
	}

}
pg_close($conn);



function CVStoArray($arquivo,Array $campos=null,$separador=';') {
	$ponteiro = fopen($arquivo, "r"); // Abro o arquivo para somente leitura
	$colunas_nome = fgetcsv($ponteiro, 1000, $separador); // Pego a primeira linha onde tem os nomes dos campos
	$numero_colunas = count($colunas_nome);// Vejo quantas colunas o CSV tem para comparar com os $campos.

	if(count($campos) != $numero_colunas)
		$campos = $colunas_nome;

	// executo um looping até pegar todos os registros.

	while($valor = fgetcsv($ponteiro, 1000, $separador)) {
		$valores[] = $valor;
	}
	fclose($ponteiro); // fecho a conexão.
	$x = 0;
	$y = 0;

	// Aqui eu pego as colunas e linhas e vou adicionando os valores no $array.

	foreach($valores as $i) {
		foreach($campos as $z) { // looping para pegar as colunas de acordo com o nome dos campos informados.
			$array[$x][$z] = $i[$y];
			$y++; // incremento o valor para ir para a próxima coluna.
		}
		$y = 0; // zero o ponteiro das colunas para ir para a próxima linha.
		$x++; // incremento o valor da linha para o próximo registro
	}
return $array;
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

?>
