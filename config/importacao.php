<?php include_once('../include/header.php'); ?>

<div class="ui breadcrumb">
	<a href="../index" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="../config" class="section">Configurações</a>
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
					<div id="select" class="ui selection dropdown">
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
				<div id="meses" class="ten wide field" style="display: none">
					<div class="ui grid fields">
						<div class="four wide field">
							<select name="mes" class="ui selection dropdown" required>
								<option value="1">01-Janeiro</option>
								<option value="2">02-Fevereiro</option>
								<option value="3">03-Março</option>
								<option value="4">04-Abril</option>
								<option value="5">05-Maio</option>
								<option value="6">06-Junho</option>
								<option value="7">07-Julho</option>
								<option value="8">08-Agosto</option>
								<option value="9">09-Setembro</option>
								<option value="10">10-Outubro</option>
								<option value="11">11-Novembro</option>
								<option value="12">12-Dezembro</option>
							</select>
						</div>
						<div class="one wide field">/</div>
						<div class="four wide field">
							<input type="text" name="ano" value="<?= date('Y') ?>" required>
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
	$('.ui.dropdown').dropdown();
	$("#select").change(function(event) {
		let elemento = $("input[name='elemento']").val();
		if(elemento == "fopag"){
			$("#meses").show();
		}else{
			$("#meses").hide()
		}
	});
</script>
<?php include_once('../include/footer.php'); ?>