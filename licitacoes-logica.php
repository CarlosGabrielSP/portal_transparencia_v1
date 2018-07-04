<?php 
require_once('classes/licitacaoDAO.php');

if (isset($_GET['processo']) && !empty($_GET['processo'])) {
	$filtro['processo'] = $_GET['processo'];
}
if (isset($_GET['modalidade']) && !empty($_GET['modalidade'])) {
	$filtro['modalidade'] = $_GET['modalidade'];
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = $_GET['tipo'];
}
if (isset($_GET['objeto']) && !empty($_GET['objeto'])) {
	$filtro['objeto'] = $_GET['objeto'];
}
if (isset($_GET['situacao']) && !empty($_GET['situacao'])) {
	$filtro['situacao'] = $_GET['situacao'];
}
if (isset($_GET['data_publicacao']) && !empty($_GET['data_publicacao'])) {
	$filtro['data_publicacao'] = $_GET['data_publicacao'];
}
if (isset($_GET['publicacao']) && !empty($_GET['publicacao'])) {
	$filtro['publicacao'] = $_GET['publicacao'];
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = $_GET['valor'];
}
if (isset($_GET['vencedor']) && !empty($_GET['vencedor'])) {
	$filtro['vencedor'] = $_GET['vencedor'];
}

$licitacaoDAO 		= new LicitacaoDAO();
$array_exercicios 	= $licitacaoDAO->getExerciciosLicitacoes();
$array_orgaos 		= $licitacaoDAO->getOrgaoLicitacoes();
$array_licitacoes	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? end($array_orgaos)['orgao'];
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'data_publicacao';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	$filtro['orgao'] 		= $orgao;

	$array_licitacoes = $licitacaoDAO->getLicitacoes($filtro,$ordenadoPor,$ordem);
}
?>