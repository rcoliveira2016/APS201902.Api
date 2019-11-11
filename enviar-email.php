<?php
$keyApi = 'at_8oIJWGMuZTOaiEQN8K6O52JtcgQ6j';
$urlApi = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$keyApi&domainName=";

$url = $_POST['url'];
echo $url;
$domain = parse_url($url, PHP_URL_HOST);

$xml = file_get_contents("$urlApi$domain");
$whois = new SimpleXMLElement($xml);
$emailContato = $whois->contactEmail;
?>