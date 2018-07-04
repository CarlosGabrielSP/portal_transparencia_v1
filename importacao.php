<?php include_once('header.php'); ?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="./" class="section">Configurações</a>
	<i class="right angle icon divider"></i>
	Importação
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Importar Planilha Excel</h1>
	</div>
 	<div class="ui secondary segment">
		<form class="ui form" method="POST" action="importacao-excel.php" enctype="multipart/form-data">
			<div class="fields">
				<div class="six wide field">
					<div class="ui selection dropdown">
						<input type="hidden" name="elemento">
						<i class="dropdown icon"></i>
						<div class="default text">Selecione</div>
						<div class="menu">
							<div class="item" data-value="empenhos">Empenhos</div>
							<div class="item" data-value="liquidacoes">Liquidações</div>
							<div class="item" data-value="pagamentos">Pagamentos</div>
							<div class="divider"></div>
							<div class="item" data-value="licitacoes">Licitações</div>
							<div class="item" data-value="contratos">Contratos</div>
							<div class="item" data-value="convenios">Convênios</div>
							<div class="divider" ></div>
							<div class="item" data-value="fopag">Folha de Pagamentos</div>
						</div>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<input type="file" name="arquivo" id="arquivo" required="required" accept=".xlsx,.xls">
				</div>
			</div>
			<button id="carregamento" type="submit" class="ui right labeled icon green circular button">
				Importar
				<i class="upload icon"></i>
			</button>
		</form>
  	</div>
</div>

<script type="text/javascript">
	$("#carregamento").click(function(){
		$(this).addClass("loading");
	});
	// $('select.dropdown').dropdown();
	$('.ui.dropdown').dropdown();
</script>
<?php include_once('footer.php'); ?>