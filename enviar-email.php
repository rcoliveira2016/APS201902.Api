<?php
try {
	
	if(!isset($_POST['perguntas']) || !isset($_POST['url'])){
		http_response_code(500);
		die();
	}
	
    $keyApi = 'at_8oIJWGMuZTOaiEQN8K6O52JtcgQ6j';
	$urlApi = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$keyApi&domainName=";

	$url = $_POST['url'];
	$domain = parse_url($url, PHP_URL_HOST);

	$xml = file_get_contents("$urlApi$domain");
	$whois = new SimpleXMLElement($xml);
	$emailContato = $whois->contactEmail;


	$emailenviar = "roramon7@gmail.com";
	if(!empty($emailContato))
		$emailenviar .= ",$emailContato";
	$destino = $emailenviar;
	$assunto = "LGPD Helper";


	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: LGPD-Helper";
	
	include_once "./montar-email.php";
	$urlBaseSite = $url;
	$conteudo = MontarEmail($_POST['perguntas'], $urlBaseSite);

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
	http_response_code(500);
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}


?>
