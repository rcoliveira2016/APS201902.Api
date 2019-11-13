<?php  
function MontarEmail($numerosRespostas){
	$url = './perguntas.json';
	$contents = file_get_contents($url);
	$contents = utf8_encode($contents);
	$respostas = json_decode($contents);
	$respostas =  array_filter($respostas, function($v, $k) use ($numerosRespostas) {
	    return in_array($v->numero, $numerosRespostas);
	}, ARRAY_FILTER_USE_BOTH);
	ob_start();
	$titulo = "LGPD Helper";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?= $titulo; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body style="margin: 0; padding: 0;">
		<p style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;"><?= $titulo; ?></p>
		<p>Esse e-mail foi gerado pela extenção <b><?= $titulo; ?></b></p>
		<p>A extenção tem como objetivo ajudar os administradores e devenvolvedores de sistemas, a se adequar as normas da <a href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/L13709.htm">Lei Geral de Proteção de Dados Pessoais (LGPD)</a>, apartir de um questionario respondido por um usuário da extenção</p>
		<p>LGPD é a legislação brasileira que regula as atividades de tratamento de dados pessoais e que também altera os artigos 7º e 16 do Marco Civil da Interne</p>
		<p>Apartir do questionario foi apontado alguns pontos pelo usuário onde seu site não esta em conformidade com a LGPD </p>
		<ul>
			<?php foreach($respostas as $resposta): ?>
			 	<li><?= $resposta->resposta ?></li>
			<?php endforeach; ?>
		</ul>		
	</body>
</html>
<?php
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  return  $pagemaincontent;
}
  
  echo MontarEmail(array(1,2,3));
?>
