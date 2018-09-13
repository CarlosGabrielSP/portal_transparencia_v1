<?php include_once('../include/header.php'); ?>

<div class="ui breadcrumb">
	<a href="../index/" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Gestão Fiscal
</div>

<h1 class="ui header titulo-pag">Gestão Fiscal</h1>

<div class="ui blue pointing secondary menu">
	<a class="item active" data-tab="rreo"><h3>RREO - Relatório Resumido da Execução Orçamentária</h3></a>
	<a class="item" data-tab="rgf"><h3>RGF - Relatório de Gestão Fiscal</h3></a>
	<a class="item" data-tab="rci"><h3>Relatório Anual do Controle Interno</h3></a>
</div>
<div class="ui tab message active" data-tab="rreo">
	<div class="ui accordion">
		<div class="title active">
			<i class="dropdown icon"></i>
			2018
		</div>
		<div class="content active">
			<div class="ui list">
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2018/RREO-2018-PRIMEIRO-BIMESTRE.pdf">1º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2018/RREO-2018-SEGUNDO-BIMESTRE.pdf">2º Bimestre</a>
					</div>
				</div>
			</div>
		</div>
		<div class="title">
			<i class="dropdown icon"></i>
			2017
		</div>
		<div class="content">
			<div class="ui list">
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-PRIMEIRO-BIMESTRE.pdf">1º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-SEGUNDO-BIMESTRE.pdf">2º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-TERCEIRO-BIMESTRE.pdf">3º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-QUARTO-BIMESTRE.pdf">4º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-QUINTO-BIMESTRE.pdf">5º Bimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rreo/2017/RREO-2017-SEXTO-BIMESTRE.pdf">6º Bimestre</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ui tab message" data-tab="rgf">
	<div class="ui accordion">
		<div class="title active">
			<i class="dropdown icon"></i>
			2018
		</div>
		<div class="content active">
			<div class="ui list">
				<div class="item">
					<div class="content">
						<a href="../arquivo/rgf/2018/RGF-2018-PRIMEIRO-QUADRIMESTRE.pdf">1º Quadrimestre</a>
					</div>
				</div>
			</div>
		</div>
		<div class="title">
			<i class="dropdown icon"></i>
			2017
		</div>
		<div class="content">
			<div class="ui list">
				<div class="item">
					<div class="content">
						<a href="../arquivo/rgf/2017/RGF-2017-PRIMEIRO-QUADRIMESTRE.pdf">1º Quadrimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rgf/2017/RGF-2017-SEGUNDO-QUADRIMESTRE.pdf">2º Quadrimestre</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<a href="../arquivo/rgf/2017/RGF-2017-TERCEIRO-QUADRIMESTRE.pdf">3º Quadrimestre</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ui tab message" data-tab="rci">
	<div class="ui big middle aligned selection list">
		<a href="../arquivo/rci/2017/RCI 2017.pdf" class="item">
			<div class="content">
				<div class="header">Relatório Anual do Controle Interno - Exercício 2017</div>
				<!-- <div class="description">
					Relatório Anual do Controle Interno - Exercício 2017
				</div> -->
			</div>
		</a>
	</div>
</div>

<script>
	$('.menu .item').tab();
	$('.ui.accordion').accordion();
</script>

<?php include_once('../include/footer.php'); ?>