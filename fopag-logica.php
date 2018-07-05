<?php 
require_once('classes/SalarioDAO.php');

if (isset($_GET['matricula']) && !empty($_GET['matricula'])) {
	$filtro['matricula'] = trim($_GET['matricula']);
}
if (isset($_GET['nome']) && !empty($_GET['nome'])) {
	$filtro['nome'] = trim($_GET['nome']);
}
if (isset($_GET['cargo']) && !empty($_GET['cargo'])) {
	$filtro['cargo'] = trim($_GET['cargo']);
}
if (isset($_GET['vinculo']) && !empty($_GET['vinculo'])) {
	$filtro['vinculo'] = trim($_GET['vinculo']);
}
if (isset($_GET['bruto']) && !empty($_GET['bruto'])) {
	$filtro['bruto'] = str_replace(',','.',trim($_GET['bruto']));
}
if (isset($_GET['desconto']) && !empty($_GET['desconto'])) {
	$filtro['desconto'] = str_replace(',','.',trim($_GET['desconto']));
}
if (isset($_GET['liquido']) && !empty($_GET['liquido'])) {
	$filtro['liquido'] = str_replace(',','.',trim($_GET['liquido']));
}
if (isset($_GET['orgao']) && !empty($_GET['orgao'])) {
	$filtro['orgao'] = trim($_GET['orgao']);
}

$salarioDAO 		= new SalarioDAO();
$array_meses		= $salarioDAO->getMesesSalarios();
$array_exercicios 	= $salarioDAO->getExerciciosSalarios();
$array_salarios		= array();

if($array_meses && $array_exercicios){
	$mes 			= $_GET['mes'] ?? end($array_meses)['mes'];
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'exercicio';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['mes']			= $mes;
	$filtro['exercicio']	= $exercicio;

	$array_salarios = $salarioDAO->getSalarios($filtro,$ordenadoPor,$ordem);
}
$nome_meses[1] = 'Janeiro';
$nome_meses[2] = 'Fevereiro';
$nome_meses[3] = 'Março';
$nome_meses[4] = 'Abril';
$nome_meses[5] = 'Maio';
$nome_meses[6] = 'Junho';
$nome_meses[7] = 'Julho';
$nome_meses[8] = 'Agosto';
$nome_meses[9] = 'Setembro';
$nome_meses[10] = 'Outubro';
$nome_meses[11] = 'Novembro';
$nome_meses[12] = 'Dezembro';
?>