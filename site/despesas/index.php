<?php include_once(__DIR__.'/../include/header.php'); ?>

<div class="ui breadcrumb">
	<a href="../index" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Despesas
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Despesas</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="ui divided list">
			<!-- <div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="despesas-gerais.php">Despesas Gerais</a>
					</h3>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="despesas-por-orgaos.php">Despesas por Órgãos</a>
					</h3>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="despesas-diarias.php">Diárias</a>
					</h3>
				</div>
			</div> -->

			<!-- <div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="empenhos.php">Empenhos</a>
					</h3>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="liquidacoes.php">Liquidações</a>
					</h3>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="pagamentos.php">Pagamentos</a>
					</h3>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<h3 class="header">
						<i class="right triangle icon"></i>
						<a href="despesas-diarias.php">Diárias</a>
					</h3>
				</div>
			</div> -->

			<div class="item">
				<div class="content">
					<div class="ui header accordion lista-despesas">
						<div class="title">
							<i class="right triangle icon"></i>
							<a>Despesas Orçamentárias</a>
						</div>
						<div class="content">
							<i class="minus tiny icon"></i><a href="empenhos?tipo=OR">Empenhos</a><br>
							<i class="minus tiny icon"></i><a href="liquidacoes?tipo=OR">Liquidações</a><br>
							<i class="minus tiny icon"></i><a href="pagamentos?tipo=OR">Pagamentos</a><br>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="ui header accordion lista-despesas">
						<div class="title">
							<i class="right triangle icon"></i>
							<a>Despesas Extraorçamentárias</a>
						</div>
						<div class="content">
							<i class="minus tiny icon"></i><a href="empenhos?tipo=EX">Empenhos</a><br>
							<i class="minus tiny icon"></i><a href="liquidacoes?tipo=EX">Liquidações</a><br>
							<i class="minus tiny icon"></i><a href="pagamentos?tipo=EX">Pagamentos</a><br>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="ui header accordion lista-despesas">
						<div class="title">
							<i class="right triangle icon"></i>
							<a href="restos-a-pagar?restosapagar=S">Restos a Pagar</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="ui header accordion lista-despesas">
						<div class="title">
							<i class="right triangle icon"></i>
							<a href="despesas-diarias">Diárias</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.ui.accordion').accordion();
</script>
<div class="voltar">
	<a href="../index"><< Voltar</a>
</div>
<?php include_once(__DIR__.'/../include/footer.php'); ?>