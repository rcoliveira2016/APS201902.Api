<?php
$keyApi = 'at_8oIJWGMuZTOaiEQN8K6O52JtcgQ6j';
$urlApi = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$keyApi&domainName=";

$url = $_POST['url'];
$domain = parse_url($url, PHP_URL_HOST);

$xml = file_get_contents("$urlApi$domain");
$whois = new SimpleXMLElement($xml);
$emailContato = $whois->contactEmail;

// emails para quem será enviado o formulário
  $emailenviar = "roramon7@gmail.com";
  $destino = $emailenviar;
  $assunto = "Contato pelo Site";
 
  // É necessário indicar que o formato do e-mail é html
  $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: $nome <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";
   
  $enviaremail = mail($destino, $assunto, null, $headers);

echo $emailContato;
?>