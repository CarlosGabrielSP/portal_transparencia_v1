<?php 
require_once(__DIR__.'/../../vendor/autoload.php');

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

$pagamentoDAO 		= new \CarlosGabriel\DAO\PagamentoDAO;
$array_exercicios 	= $pagamentoDAO->getExerciciosPagamentos();
$array_orgaos 		= $pagamentoDAO->getOrgaoPagamentos();
$array_pagamentos	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? 'PREFEITURA MUNICIPAL DE GURUPÁ';
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'numero';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	$filtro['orgao'] 		= $orgao;

	$array_pagamentos = $pagamentoDAO->getPagamentos($filtro,$ordenadoPor,$ordem);
}
?>