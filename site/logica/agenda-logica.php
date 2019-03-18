<?php 
require_once(__DIR__.'/../../vendor/autoload.php');

$campoDia = $_POST['campoDia'] ?? date('d');
$campoMes = $_POST['campoMes'] ?? date('m');
$campoAno = $_POST['campoAno'] ?? date('Y');

$data = $campoAno.'-'.$campoMes.'-'.$campoDia;

$eventoDAO 		= new eventoDAO();
$anos			= $eventoDAO->getAnosAgenda();
$array_eventos	= array();

$array_eventos 	= $eventoDAO->getEventoPorTipoData("agenda",$data);
$cores 			= ['red','orange','yellow','olive','green','teal','blue','violet','purple','pink'];
$meses[1] = 'Janeiro';
$meses[2] = 'Fevereiro';
$meses[3] = 'Março';
$meses[4] = 'Abril';
$meses[5] = 'Maio';
$meses[6] = 'Junho';
$meses[7] = 'Julho';
$meses[8] = 'Agosto';
$meses[9] = 'Setembro';
$meses[10] = 'Outubro';
$meses[11] = 'Novembro';
$meses[12] = 'Dezembro';