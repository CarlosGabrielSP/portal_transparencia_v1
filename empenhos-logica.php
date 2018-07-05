<?php 
require_once('classes/EmpenhoDAO.php');
$restosapagar = "N";
if (isset($_GET['restosapagar']) && !empty($_GET['restosapagar']) && $_GET['restosapagar']=="S") {
	$restosapagar = trim($_GET['restosapagar']);
}
if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
	$filtro['tipo'] = trim($_GET['tipo']);
	$tipo = trim($_GET['tipo']);
}else{
	$tipo = "";
}
if (isset($_GET['numero']) && !empty($_GET['numero'])) {
	$filtro['numero'] = trim($_GET['numero']);
}
if (isset($_GET['favorecido']) && !empty($_GET['favorecido'])) {
	$filtro['favorecido'] = trim($_GET['favorecido']);
}
if (isset($_GET['valor']) && !empty($_GET['valor'])) {
	$filtro['valor'] = str_replace(',','.',trim($_GET['valor']));
}
if (isset($_GET['objeto']) && !empty($_GET['objeto'])) {
	$filtro['objeto'] = trim($_GET['objeto']);
}
if (isset($_GET['data']) && !empty($_GET['data'])) {
	$filtro['data'] = trim($_GET['data']);
}
if (isset($_GET['procedimento_lic']) && !empty($_GET['procedimento_lic'])) {
	$filtro['procedimento_lic'] = trim($_GET['procedimento_lic']);
}
if (isset($_GET['unidade_orc']) && !empty($_GET['unidade_orc'])) {
	$filtro['unidade_orc'] = trim($_GET['unidade_orc']);
}
if (isset($_GET['funcao']) && !empty($_GET['funcao'])) {
	$filtro['funcao'] = trim($_GET['funcao']);
}
if (isset($_GET['subfuncao']) && !empty($_GET['subfuncao'])) {
	$filtro['subfuncao'] = trim($_GET['subfuncao']);
}
if (isset($_GET['natureza']) && !empty($_GET['natureza'])) {
	$filtro['natureza'] = trim($_GET['natureza']);
}
if (isset($_GET['fonte']) && !empty($_GET['fonte'])) {
	$filtro['fonte'] = trim($_GET['fonte']);
}
if (isset($_GET['orgao']) && !empty($_GET['orgao'])) {
	$filtro['orgao'] = trim($_GET['orgao']);
}
if (isset($_GET['exercicio']) && !empty($_GET['exercicio'])) {
	$filtro['exercicio'] = trim($_GET['exercicio']);
}

$empenhoDAO 		= new EmpenhoDAO();
$array_exercicios 	= $empenhoDAO->getExerciciosEmpenhos();
$array_orgaos 		= $empenhoDAO->getOrgaoEmpenhos();
$array_empenhos		= array();

if($array_exercicios && $array_orgaos){
	$ordem 			= $_GET['tipo'] ?? 'OR';
	$exercicio 		= $_GET['exercicio'] ?? end($array_exercicios)['exercicio'];
	$orgao 			= $_GET['orgao'] ?? "PREFEITURA MUNICIPAL DE GURUPÁ";
	$ordenadoPor 	= $_GET['ordenadoPor'] ?? 'data';
	$ordem 			= $_GET['ordem'] ?? 'DESC';

	$filtro['exercicio'] = $exercicio;

	$array_empenhos = $empenhoDAO->getEmpenhos($filtro,$ordenadoPor,$ordem,$restosapagar);
}
?>