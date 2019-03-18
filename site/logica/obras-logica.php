<?php 
require_once(__DIR__.'/../../vendor/autoload.php');

$filtro = array();

if (isset($_GET['descricao']) && !empty($_GET['descricao'])) {
	$filtro['descricao'] = trim($_GET['descricao']);
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = trim($_GET['tipo']);
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = trim($_GET['valor']);
}
if (isset($_GET['termo_convenio']) && !empty($_GET['termo_convenio'])) {
	$filtro['termo_convenio'] = trim($_GET['termo_convenio']);
}
if (isset($_GET['fornecedor']) && !empty($_GET['fornecedor'])) {
	$filtro['fornecedor'] = trim($_GET['fornecedor']);
}
if (isset($_GET['situacao']) && !empty($_GET['situacao'])) {
	$filtro['situacao'] = trim($_GET['situacao']);
}
if (isset($_GET['anoTermo_convenio']) && !empty($_GET['anoTermo_convenio'])) {
	$filtro['anoTermo_convenio'] = trim($_GET['anoTermo_convenio']);
}

$obraDAO		= new \CarlosGabriel\DAO\ObraDAO;
$array_obras	= array();

$ordenadoPor 		= $_GET['ordenadoPor'] ?? 'anoTermo_convenio';
$ordem 				= $_GET['ordem'] ?? 'DESC';
$array_obras = $obraDAO->getObras($filtro,$ordenadoPor,$ordem);	