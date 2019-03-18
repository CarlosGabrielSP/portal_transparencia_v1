<!DOCTYPE html>
<html>
<head>
	<title>Portal de Transparência</title>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css"/>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker/dist/css/default/zebra_datepicker.min.css"> -->

	<script src="../assets/js/jquery-3.2.1.min.js"></script>
	<script src="../assets/js/semantic.min.js"></script>
	<script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/zebra_datepicker/dist/zebra_datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script> -->
</head>
<?php 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>
<body>
	<header>
		<div class="ui grid container">
			<div class="two wide column">
				<img class="ui centered image" src='../../site/assets/img/logo.png'>
			</div>
			<div class="eight wide middle aligned column">
				<h1 class="ui header">
					Prefeitura Municipal de Gurupá
					<div class="sub header">Governo da Reconstrução</div>
					<!-- <div class="sub header">Informação adicional</div> -->
				</h1>
			</div>
			<div class="six wide middle aligned column">
				<address class="ui segment right aligned">
					Endereço: Avenida São Benedito, S/N - Bairro: Centro<br>
					Atendimento: Segunda à Sexta - 8:00 às 13:00<br>
					Email: papmgurupa@gmail.com<br>
					Fone: (91) 98283-7414
				</address>
			</div>
		</div>

		<div class="ui icon stackable blue inverted menu">
			<div class="ui grid container">
				<a class=" item" href="../">
		    		<i class="home icon"></i>
					&nbsp;&nbsp;Início
				</a>
				<a class="item" href="../site/institucional">
		    		<i class="university icon"></i>
					&nbsp;&nbsp;Institucional
				</a>
				<a class="item" href="../site/legislacao">
		    		<i class="book icon"></i>
					&nbsp;&nbsp;Legislação
				</a>
				<a class="item" target="_blank" href="https://rhonline.fenix.com.br/gurupa">
		    		<i class="id card icon"></i>
					&nbsp;&nbsp;Contracheque Online
				</a>
				<a class="item" href="http://www.gurupa.pa.gov.br/ordem-servico/bcid/39/?e-sic---pedido-de-informacoes.html">
		    		<i class="info circle icon"></i>
					&nbsp;&nbsp;E-SIC
				</a>
				<a class="item" href="./site/info/perguntas-frequentes">
		    		<i class="help circle outline icon"></i>
					&nbsp;&nbsp;Perguntas frequentes
				</a>
			</div>
		</div>
	</header>
	<div id="preloader">
		<img class="ui centered tiny image" src="../assets/img/loading4.gif">
	</div>
	<main id="principal" style="display: none" class="ui container">
			