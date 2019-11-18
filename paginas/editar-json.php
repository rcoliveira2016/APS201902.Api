<?php
$url_json = '../perguntas.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fp = fopen($url_json, "w+");
 
    //Escreve no arquivo aberto.
    fwrite($fp, $_POST['text_json']);
     
    //Fecha o arquivo.
    fclose($fp);
}

$texto_json = file_get_contents($url_json);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Json</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
	body{
		font-family: 'Roboto', sans-serif;
	}
  </style>
</head>
<body>

  <div class="container p-3 mb-2 bg-light text-dark border">
    <h1>Editar Json</h1>
    <form method="post">
      <div class="form-group mt-5">
        <label for="exampleFormControlTextarea1">Perguntas e repostas</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="text_json" rows="25"><?= $texto_json?></textarea>
      </div>
	  <div class="form-group">
        <button type="submit" class="btn btn-outline-dark">Enviar</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
