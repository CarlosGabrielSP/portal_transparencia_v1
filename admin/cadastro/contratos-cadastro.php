<?php include_once('../include/header.php') ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastro Contrato</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST" enctype="multipart/form-data">
    		<input type="hidden" name="elemento" value="contratos">
			<div class="fields">
				<div class="two wide field">
					<label>Exercício</label>
					<input type="text" name="exercicio" required="required">
				</div>
				<div class="five wide field">
					<label>Órgão</label>
					<input type="text" name="orgao" required="required">
				</div>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>Número</label>
					<input type="text" name="numero" required="required">
				</div>
			</div>
			<div class="field">
				<label>Ementa</label>
				<textarea name="ementa" required="required" rows="4"></textarea>
			</div>
			<div class="six wide field">
				<label>Arquivo</label>
				<input type="file" name="arquivo" id="arquivo" required="required" accept=".pdf">
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