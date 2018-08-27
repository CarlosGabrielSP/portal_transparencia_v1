<?php include_once('../include/header.php'); ?>

<div class="ui breadcrumb">
	<a href="../index/" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Orçamento
</div>

<!-- <h1 class="ui header titulo-pag">Orçamento</h1> -->
<div class="ui segments">
	<div class="ui segment">
		<h1>Orçamento</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="ui blue pointing secondary fluid four item menu">
			<a class="item active" data-tab="ppa"><h3>PPA - Plano Pluri Anual</h3></a>
			<a class="item" data-tab="ldo"><h3>LDO - Lei de Diretrizes Orçamentárias</h3></a>
			<a class="item" data-tab="loa"><h3>LOA - Lei de Orçamento Anual</h3></a>
			<a class="item" data-tab="lom"><h3>Lei Orgânica Municipal</h3></a>
		</div>
		<div class="ui tab active" data-tab="ppa">
			<p class="ui large">O PPA define diretrizes, objetivos e metas de médio prazo (quatro anos) da administração pública para as despesas de capital e outras delas decorrentes e para as relativas aos programas de duração continuada. Nenhum investimento cuja execução ultrapasse um exercício financeiro poderá ser iniciado sem ser incluído no PPA.</p>

			<div class="ui big middle aligned selection list">
				<a href="arquivo/ppa/2018-2021/PPA 2018-2021.pdf" class="item">
					<div class="content">
						<div class="header">2018-2021</div>
						<div class="description">
							Lei 1.229/2017, de 18 de outubro de 2017 - Dispõe sobre o Plano Plurianual para o período de 2018/2021 e dá outras providências.
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="ui tab" data-tab="ldo">
			<p>A LDO estabelece as metas e prioridades da administração pública, incluindo as despesas de capital para o exercício subsequente, orienta a elaboração da lei orçamentária anual, dispõe sobre os critérios e a forma de limitação de empenho, entre outras funções.</p>

			<div class="ui big middle aligned selection list">
				<a href="arquivo/ldo/2018/LDO-2018.pdf" class="item">
					<div class="content">
						<div class="header">2018</div>
						<div class="description">
							Lei 1.227/2017, de 25 de julho de 2017 - Dispõe sobre as Diretrizes Orçamentárias para o exercício financeiro de 2018 e dá outras providências.
						</div>
					</div>
				</a>
				<a href="arquivo/ldo/2018/LDO-2017.pdf" class="item">
					<div class="content">
						<div class="header">2017</div>
						<div class="description">
							Lei 1.210/2017, de 4 de julho de 2016 - Dispõe sobre as diretrizes gerais para a elaboração da Lei Orçamentária de 2017, e dá outras providências.
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="ui tab" data-tab="loa">
			<p>A LOA é o orçamento propriamente dito, uma lei que estima as receitas e fixa as despesas públicas para o período de um exercício financeiro.</p>

			<div class="ui big middle aligned selection list">
				<a href="arquivo/loa/2018/LOA-2018.pdf" class="item">
					<div class="content">
						<div class="header">2018</div>
						<div class="description">
							Lei 1.230/2017, de 19 de dezembro de 2017 - Estima a receita e fixa a despesa do município de Gurupá para o exercício financeiro de 2018 e dá outras providências.
						</div>
					</div>
				</a>
				<a href="arquivo/loa/2018/LOA-2017.pdf" class="item">
					<div class="content">
						<div class="header">2017</div>
						<div class="description">
							Lei 1.216/2016, de 4 de julho de 2016 - Estima a receita e fixa a despesa do município de Gurupá para o exercício de 2017.
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="ui tab" data-tab="lom">
			<p>A lei orgânica do município, como o nome indica, é a lei que “organiza” o exercício do poder local, reafirmando os princípios e preceitos constitucionais, indicando as competências do poder executivo e do poder legislativo e determinando as diretrizes locais para as políticas de tributação e de finanças, de desenvolvimento econômico, social, ambiental e urbano.</p>

			<div class="ui big middle aligned selection list">
				<a href="arquivo/lom/LOA.pdf" class="item">
					<div class="content">
						<div class="header">Lei Orgânica Municipal nº 1.121/2009</div>
						<div class="description">
							Dispõe sobre a Organização Administrativa do município de Gurupá-Pa e dá outras providências.
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<script>
	$('.menu .item').tab();
</script>
<?php include_once('../include/footer.php'); ?>