<?php
$arquivo = 'scpi.prt';
$caminho = $_POST['caminho'] ?? '';
$exercicios = $_POST['exercicios'] ?? '';
$userBD = $_POST['userBD'] ?? '';
$passBD = $_POST['passBD'] ?? '';

$conteudo = implode('|',[$caminho,$exercicios,$userBD,$passBD]);

$fp = fopen($arquivo,'w');
fwrite($fp,$conteudo);
fclose($fp);

header("location:./configuracao.php");