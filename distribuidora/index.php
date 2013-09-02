    <html>
    <head>
    </head>
    <body>
    <form action="websvc/cliente.php" method="post">
    <input type="hidden" name="url" value="https://distribuidora.dnsget.org:9443">
    <input type="submit" value="OK">
    </form>
    <b>Status:</b> <?
    //$url = 'http://server.ddcred.com.br';
    $url = 'https://distribuidora.dnsget.org:9443';
    if ($url)
    {
    $sitio = @fopen($url,"r");
     
    if ($sitio){
    echo "<font color=green> <b>Online </b></font>";
    
include './include/soap.php';

// chamada do serviço SOAP
//$result = $client->select($_POST["nome"]);
$result = $client->pegaRepresentante(); 
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
		mysqli_query($con,"DELETE FROM REPRESENTANTE");
		$tam = count($result);		
			for($i=0; $i < $tam; $i++){
				list($srep_codigo,
				     $srep_senha, 
				     $srep_razao) = explode('@@', $result[$i]);
				mysqli_query($con,"INSERT INTO REPRESENTANTE ( 
				     REP_CODIGO, 
				     REP_SENHA, 
				     REP_RAZAO) VALUES ('"
				     .$srep_codigo."', '"
				     .$srep_senha."', '"
				     .$srep_razao."')");
			}
		
		mysqli_close($con);
		echo "<script>alert('Atualizado com sucesso!')</script>";
		print_r($result);
		//echo "<meta http-equiv=\"refresh\" content=\"3;url=cliente.php\">";

	}

    
    }else{
    echo "<font color=red> <b>Offline </b></font>";
    }
    }
    ?>
     
    <hr>
     
    </body>
    </html>
