<?php  
function MontarEmail($numerosRespostas, $dominio){
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
		<p style="color: #153643; font-family: Arial, sans-serif; font-size: 30px; text-align: center"><?= $titulo; ?></p>
		<p>Esse e-mail foi gerado pela extensão <b><?= $titulo; ?></b></p>
		<p style="color: #153643; font-family: Arial, sans-serif; font-size: 23px;">O que é <b><?= $titulo; ?></b>?</p>
		<p>A extensão tem como objetivo ajudar os administradores e desenvolvedores de sistemas, a se adequar às normas da <a href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/L13709.htm">Lei Geral de Proteção de Dados Pessoais (LGPD)</a>,  Isso é feito a partir de um questionário respondido na extensão, que será preenchido por um usuário que está ultilizando o sistema ou site, após o questionário respondido será gerado um e-mail.</p>
		<p style="color: #153643; font-family: Arial, sans-serif; font-size: 23px;">O que é <b>LGPD</b>?</p>
		<p>LGPD é a legislação brasileira que regula as atividades de tratamento de dados pessoais e que também altera os artigos 7º e 16 do Marco Civil da Internet.</p>
		<p style="color: #153643; font-family: Arial, sans-serif; font-size: 23px;"><b>Relatório do questionário</b>:</p>
		<p><b>Domínio que originou o relatório:</b> <?= $dominio; ?><p>
		<p>A Partir do questionário respondido pelo usuário  da extensão, foi apontado alguns pontos onde seu sistema ou site não está em conformidade com a LGPD:</p>
		<ul>
			<?php foreach($respostas as $resposta): ?>
			 	<li><?= $resposta->resposta ?></li>
			<?php endforeach; ?>
		</ul>
		<p style="color:red">ATENÇÃO!!</p>
		<p>Esse e-mail pode ser gerado por qualquer usuário da extensão, podendo se tratar de um leigo ou um técnico no assunto. Avaliar os pontos com cautela.</p>
	</body>
</html>
<?php
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  return  $pagemaincontent;
}
  
  echo MontarEmail(array(1,2,3), "www.hue.hue.com.br");
?>
