<?php 
require_once('classes/LiquidacaoDAO.php');

if (isset($_GET['numeroEmpenho']) && !empty($_GET['numeroEmpenho'])) {
	$filtro['numeroEmpenho'] = trim($_GET['numeroEmpenho']);
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = trim($_GET['tipo']);
	$tipo = trim($_GET['tipo']);
}else{
	$tipo = "";
}
if (isset($_GET['favorecido']) && !empty($_GET['favorecido'])) {
	$filtro['favorecido'] = trim($_GET['favorecido']);
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = str_replace(',','.',trim($_GET['valor']));
}
if (isset($_GET['data']) && !empty($_GET['data'])) {
	$filtro['data'] = trim($_GET['data']);
}
if (isset($_GET['exercicio']) && !empty($_GET['exercicio'])) {
	$filtro['exercicio'] = trim($_GET['exercicio']);
}
if (isset($_GET['orgao']) && !empty($_GET['orgao'])) {
	$filtro['orgao'] = trim($_GET['orgao']);
}

$liquidacaoDAO 		= new LiquidacaoDAO();
$array_exercicios 	= $liquidacaoDAO->getExerciciosLiquidacoes();
$array_orgaos 		= $liquidacaoDAO->getOrgaoLiquidacoes();
$array_liquidacoes	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? 'PREFEITURA MUNICIPAL DE GURUPÁ';
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'data';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] = $exercicio;

	$array_liquidacoes = $liquidacaoDAO->getLiquidacoes($filtro,$ordenadoPor,$ordem);
}
?>