<?php 
require_once('classes/LiquidacaoDAO.php');

if (isset($_GET['numeroEmpenho']) && !empty($_GET['numeroEmpenho'])) {
	$filtro['numeroEmpenho'] = $_GET['numeroEmpenho'];
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = $_GET['tipo'];
	$tipo = $_GET['tipo'];
}else{
	$tipo = "";
}
if (isset($_GET['favorecido']) && !empty($_GET['favorecido'])) {
	$filtro['favorecido'] = $_GET['favorecido'];
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = $_GET['valor'];
}
if (isset($_GET['data']) && !empty($_GET['data'])) {
	$filtro['data'] = $_GET['data'];
}
if (isset($_GET['exercicio']) && !empty($_GET['exercicio'])) {
	$filtro['exercicio'] = $_GET['exercicio'];
}
if (isset($_GET['orgao']) && !empty($_GET['orgao'])) {
	$filtro['orgao'] = $_GET['orgao'];
}

$liquidacaoDAO 		= new LiquidacaoDAO();
$array_exercicios 	= $liquidacaoDAO->getExerciciosLiquidacoes();
$array_orgaos 		= $liquidacaoDAO->getOrgaoLiquidacoes();
$array_liquidacoes	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? 'PREFEITURA MUNICIPAL DE GURUPÁ';
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'numero';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	$filtro['orgao'] 		= $orgao;

	$array_liquidacoes = $liquidacaoDAO->getLiquidacoes($filtro,$ordenadoPor,$ordem);
}
?>