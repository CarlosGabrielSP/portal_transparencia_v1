<?php 
require_once(__DIR__.'/../../vendor/autoload.php');

if (isset($_GET['processo']) && !empty($_GET['processo'])) {
	$filtro['processo'] = trim($_GET['processo']);
}
if (isset($_GET['modalidade']) && !empty($_GET['modalidade'])) {
	$filtro['modalidade'] = trim($_GET['modalidade']);
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = trim($_GET['tipo']);
}
if (isset($_GET['objeto']) && !empty($_GET['objeto'])) {
	$filtro['objeto'] = trim($_GET['objeto']);
}
if (isset($_GET['situacao']) && !empty($_GET['situacao'])) {
	$filtro['situacao'] = trim($_GET['situacao']);
}
if (isset($_GET['data_publicacao']) && !empty($_GET['data_publicacao'])) {
	$filtro['data_publicacao'] = trim($_GET['data_publicacao']);
}
if (isset($_GET['publicacao']) && !empty($_GET['publicacao'])) {
	$filtro['publicacao'] = trim($_GET['publicacao']);
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = str_replace(',','.',trim($_GET['valor']));
}
if (isset($_GET['vencedor']) && !empty($_GET['vencedor'])) {
	$filtro['vencedor'] = trim($_GET['vencedor']);
}

$licitacaoDAO 		= new \CarlosGabriel\DAO\LicitacaoDAO;
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