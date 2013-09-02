
<?php
include '../include/soap.php';
// chamada do serviço SOAP
//$result = $client->select($_POST["nome"]);
$result = $client->pegaCliente($_POST["nome"]); 
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
		mysqli_query($con,"DELETE FROM CLIENTE"); //Apaga tuTo!
		$tam = count($result);	// contar o tamanho do vetor	
			for($i=0; $i < $tam; $i++){
				list($sid,
				     $snome, 
				     $scnpj, 
				     $semail, 
				     $sativo, 
				     $sendereco, 
				     $sbairro, 
				     $scep, 
				     $scontato, 
				     $sfone1, 
				     $sult_compra, 
				     $scotacao, 
				     $sprecoesp, 
				     $sdtnasc, 
				     $smunic, 
				     $suf, 
				     $scidade, 
				     $srepr) = explode('@@', $result[$i]);
				mysqli_query($con,"INSERT INTO CLIENTE ( 
				     CLIENTE_ID, 
				     CLIENTE_Nome, 
				     CLIENTE_Cnpj, 
				     CLIENTE_Email, 
				     CLIENTE_Ativo, 
				     CLIENTE_ENDERECO, 
				     CLIENTE_BAIRRO, 
				     CLIENTE_CEP, 
				     CLIENTE_CONTATO, 
				     CLIENTE_FONE1, 
				     CLIENTE_COTACAO, 
				     CLIENTE_PRECOESP, 
				     CLIENTE_MUNIC, 
				     CLIENTE_UF, 
				     CLIENTE_CIDADE, 
				     CLIENTE_REPR) VALUES ("
				     .$sid.", '"
				     .$snome."', '"
				     .$scnpj."', '"
				     .$semail."', '"
				     .$sativo."', '"
				     .$sendereco."', '"
				     .$sbairro."', '"
				     .$scep."', '"
				     .$scontato."', '"
				     .$sfone1."', '"
				     .$scotacao."', '"
				     .$sprecoesp."', '"
				     .$smunic."', '"
				     .$suf."', '"
				     .$scidade."', '"
				     .$srepr."')");
			}
		
		mysqli_close($con);
		echo "<script>alert('Concluido!')</script>";
		print_r($result);
		echo "<meta http-equiv=\"refresh\" content=\"3;url=cliente.php\">";

	}

?>

