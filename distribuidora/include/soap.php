<?php
// passando o endereço do servidor
$client = new SoapClient(null, array(
	// 'location' => 'http://server.ddcred.com.br/websvc/server.php',
	'location' => 'https://distribuidora.dnsget.org/websvc/server.php',
	//'uri' => 'http://server.ddcred.com.br/websvc/', 
	'uri' => 'https://distribuidora.dnsget.org/websvc/',
	'trace' => 1));
	
?>
