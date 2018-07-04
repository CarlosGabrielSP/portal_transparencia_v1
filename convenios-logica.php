<?php 
require_once('classes/ConvenioDAO.php');

if (isset($_GET['numero']) && !empty($_GET['numero'])) {
	$filtro['numero'] = $_GET['numero'];
}
if (isset($_GET['objeto']) && !empty($_GET['objeto'])) {
	$filtro['objeto'] = $_GET['objeto'];
}
if (isset($_GET['concedente']) && !empty($_GET['concedente'])) {
	$filtro['concedente'] = $_GET['concedente'];
}
if (isset($_GET['data']) && !empty($_GET['data'])) {
	$filtro['data'] = $_GET['data'];
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = $_GET['valor'];
}
if (isset($_GET['vigencia']) && !empty($_GET['vigencia'])) {
	$filtro['vigencia'] = $_GET['vigencia'];
}

$convenioDAO 		= new ConvenioDAO();
$array_exercicios 	= $convenioDAO->getExerciciosConvenios();
$array_orgaos 		= $convenioDAO->getOrgaoConvenios();
$array_convenios	= array();

if($array_exercicios && $array_orgaos){
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? end($array_orgaos)['orgao'];
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'exercicio';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] 	= $exercicio;
	$filtro['orgao'] 		= $orgao;

	$array_convenios = $convenioDAO->getConvenios($filtro,$ordenadoPor,$ordem);
}