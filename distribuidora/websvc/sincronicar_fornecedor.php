
<?php
include '../include/soap.php';
// chamada do serviço SOAP
//$result = $client->select($_POST["nome"]);
$result = $client->pegaFornecedor($_POST["nome"]); 
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
		mysqli_query($con,"DELETE FROM FORNECEDOR");
		$tam = count($result);		
			for($i=0; $i < $tam; $i++){
				list($sfornecedor_id,
				     $sfornecedor_nome, 
				     $sfornecedor_ativo, 
				     $sfornecedor_endereco, 
				     $sfornecedor_uf, 
				     $sfornecedor_cidade, 
				     $sfornecedor_cnpj, 
				     $sfornecedor_cep, 
				     $sfornecedor_fone, 
				     $sfornecedor_contato,
				     $sfornecedor_email, 
				     $sfornecedor_bairro) = explode('@@', $result[$i]);
				mysqli_query($con,"INSERT INTO FORNECEDOR ( 
				     FORNECEDOR_ID, 
				     FORNECEDOR_NOME, 
				     FORNECEDOR_ATIVO, 
				     FORNECEDOR_ENDERECO, 
				     FORNECEDOR_UF, 
				     FORNECEDOR_CIDADE, 
				     FORNECEDOR_CNPJ, 
				     FORNECEDOR_CEP, 
				     FORNECEDOR_FONE, 
				     FORNECEDOR_CONTATO, 
				     FORNECEDOR_EMAIL, 
				     FORNECEDOR_BAIRRO) VALUES ('"
				     .$sfornecedor_id."', '"
				     .$sfornecedor_nome."', '"
				     .$sfornecedor_ativo."', '"
				     .$sfornecedor_endereco."', '"
				     .$sfornecedor_uf."', '"
				     .$sfornecedor_cidade."', '"
				     .$sfornecedor_cnpj."', '"
				     .$sfornecedor_cep."', '"
				     .$sfornecedor_fone."', '"
				     .$sfornecedor_contato."', '"
				     .$sfornecedor_email."', '"
				     .$sfornecedor_bairro."')");
				     
				 }
				     
		mysqli_close($con);
		echo "<script>alert('Concluido!')</script>";
		print_r($result);
		echo "<meta http-equiv=\"refresh\" content=\"3;url=cliente.php\">";

	}

?>
