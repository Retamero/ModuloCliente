
<?php
include '../include/soap.php';
// chamada do serviço SOAP
//$result = $client->select($_POST["nome"]);
$result = $client->pegaProduto($_POST["nome"]); 
// verifica erros na execução do serviço e exibe o resultado
if (is_soap_fault($result)){
	trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
	faultstring: {$result->faulstring})", E_ERROR);
}else{
		$con=mysqli_connect("localhost","root","mudar123","mydb");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_query($con,"DELETE FROM PRODUTO");
		$tam = count($result);		
			for($i=0; $i < $tam; $i++){
				list($sid_fornecedor,
				     $sid_produto, 
				     $sreferencia, 
				     $saplicacao, 
				     $sunidade, 
				     $spreco_cmp, 
				     $sqtd_emb, 
				     $sqtd_estoque, 
				     $sativo, 
				     $ssimilar,
				     $svalor_cotacao, 
				     $scod_barra, 
				     $smaxdesc, 
				     $spreco_vda) = explode('@@', $result[$i]);
				mysqli_query($con,"INSERT INTO PRODUTO ( 
				     ID_FORNECEDOR, 
				     ID_PRODUTO, 
				     Referencia, 
				     Aplicacao, 
				     Unidade, 
				     Preco_cmp, 
				     Qtd_Emb, 
				     Qtd_Estoque, 
				     Ativo, 
				     Similar, 
				     Valor_Cotacao, 
				     Cod_Barra, 
				     MaxDesc, 
				     Preco_vda) VALUES ('"
				     .$sid_fornecedor."', '"
				     .$sid_produto."', '"
				     .$sreferencia."', '"
				     .$saplicacao."', '"
				     .$sunidade."', '"
				     .$spreco_cmp."', '"
				     .$sqtd_emb."', '"
				     .$sqtd_estoque."', '"
				     .$sativo."', '"
				     .$ssimilar."', '"
				     .$svalor_cotacao."', '"
				     .$scod_barra."', '"
				     .$smaxdesc."', '"
				     .$spreco_vda."')");
			}
		
		mysqli_close($con);
		echo "<script>alert('Concluido!')</script>";
		print_r($result);
		echo "<meta http-equiv=\"refresh\" content=\"3;url=cliente.php\">";

	}

?>

