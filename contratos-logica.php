<?php 
require_once('classes/ContratoDAO.php');

if (isset($_GET['numero']) && !empty($_GET['numero'])) {
	$filtro['numero'] = $_GET['numero'];
}
if (isset($_GET['ementa']) && !empty($_GET['ementa'])) {
	$filtro['ementa'] = $_GET['ementa'];
}

$contratoDAO 		= new ContratoDAO();
$array_exercicios 	= $contratoDAO->getExerciciosContratos();
$array_orgaos 		= $contratoDAO->getOrgaoContratos();
$array_contratos	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? end($array_orgaos)['orgao'];
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'exercicio';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	$filtro['orgao'] 		= $orgao;

	$array_contratos = $contratoDAO->getContratos($filtro,$ordenadoPor,$ordem);	
}