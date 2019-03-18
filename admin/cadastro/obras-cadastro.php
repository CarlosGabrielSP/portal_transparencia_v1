<?php include_once('../include/header.php') ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastro de Obras</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST">
    		<input type="hidden" name="elemento" value="obras">
			<div class="fields">
				<div class="two wide field">
					<label>Ano</label>
					<input type="text" name="anoTermo_convenio" required="required">
				</div>
				<div class="five wide field">
					<label>Tipo</label>
					<input type="text" name="tipo" required="required">
				</div>
			</div>
			<div class="field">
				<label>Descrição</label>
				<textarea name="descricao" required="required" rows="4"></textarea>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>Valor</label>
					<input type="text" name="valor">
				</div>
				<div class="five wide field">
					<label>Nº Termo/Convênio</label>
					<input type="text" name="termo_convenio">
				</div>
				<div class="eight wide field">
					<label>Fornecedor</label>
					<input type="text" name="fornecedor">
				</div>
			</div>
			<div class="six wide field">
				<label>Situação</label>
				<input type="text" name="situacao" >
			</div>
			<button id="carregamento" type="submit" class="ui right labeled icon black circular button">
				Salvar
				<i class="save icon"></i>
			</button>
		</form>
  	</div>
</div>
<script>
	$("#carregamento").click(function(){
		$(this).addClass("loading");
	});
</script>

<?php include_once('../include/footer.php') ?>