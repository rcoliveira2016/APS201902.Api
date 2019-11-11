<?php
try {
    $keyApi = 'at_8oIJWGMuZTOaiEQN8K6O52JtcgQ6j';
	$urlApi = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$keyApi&domainName=";

	$url = $_POST['url'];
	$domain = parse_url($url, PHP_URL_HOST);

	$xml = file_get_contents("$urlApi$domain");
	$whois = new SimpleXMLElement($xml);
	$emailContato = $whois->contactEmail;

	// emails para quem será enviado o formulário
	//$emailenviar = "roramon7@gmail.com";
	$emailenviar = $emailContato;
	$destino = $emailenviar;
	$assunto = "LGPD Helper";

	// É necessário indicar que o formato do e-mail é html
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: LGPD-Helper";

	$conteudo = "<h1>LGPD Helper</h1><p>Verificar os seguintes pontos sobre segurança de dados</p>";

	$enviaremail = mail($destino, $assunto, $conteudo, $headers);

	if($enviaremail){		
		http_response_code(200);
		echo $emailContato;
	}
	else{
		http_response_code(500);
		echo 'erro';
	}
} catch (Exception $e) {
	http_response_code(505);
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}


?>