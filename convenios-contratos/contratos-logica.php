<?php 
require_once('../classes/ContratoDAO.class.php');

if (isset($_GET['numero']) && !empty($_GET['numero'])) {
	$filtro['numero'] = trim($_GET['numero']);
}
if (isset($_GET['procLicitatorio']) && !empty($_GET['procLicitatorio'])) {
	$filtro['procLicitatorio'] = trim($_GET['procLicitatorio']);
}
if (isset($_GET['objeto']) && !empty($_GET['objeto'])) {
	$filtro['objeto'] = trim($_GET['objeto']);
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = trim($_GET['valor']);
}
if (isset($_GET['contratado']) && !empty($_GET['contratado'])) {
	$filtro['contratado'] = trim($_GET['contratado']);
}
if (isset($_GET['data']) && !empty($_GET['data'])) {
	$filtro['data'] = trim($_GET['data']);
}
if (isset($_GET['vigencia']) && !empty($_GET['vigencia'])) {
	$filtro['vigencia'] = trim($_GET['vigencia']);
}
if (isset($_GET['orgao']) && !empty($_GET['orgao'])) {
	$filtro['orgao'] = trim($_GET['orgao']);
}
if (isset($_GET['exercicio']) && !empty($_GET['exercicio'])) {
	$filtro['exercicio'] = trim($_GET['exercicio']);
}

$contratoDAO 		= new ContratoDAO();
$array_exercicios 	= $contratoDAO->getExerciciosContratos();
$array_orgaos 		= $contratoDAO->getOrgaoContratos();
$array_contratos	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? 'Todos';
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'exercicio';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	// $filtro['orgao'] 		= $orgao;

	$array_contratos = $contratoDAO->getContratos($filtro,$ordenadoPor,$ordem);	
}