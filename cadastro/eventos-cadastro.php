<?php include_once('../include/header.php') ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastrar Evento</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST">
    		<input type="hidden" name="elemento" value="eventos">
			<div class="fields">
				<div class="six wide field">
					<label>Título</label>
					<input type="text" name="titulo" required="required">
				</div>
				<div class="five wide field">
					<label>Tipo</label>
					<input type="text" name="tipo" required="required">
				</div>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>Data</label>
					<input type="date" name="data" required="required">
				</div>
				<div class="two wide field">
					<label>Hora</label>
					<input type="time" name="hora" required="required">
				</div>
				<div class="six wide field">
					<label>Local</label>
					<input type="text" name="local" required="required">
				</div>
			</div>
			<div class="field">
				<label>Descrição</label>
				<textarea name="descricao" required="required" rows="4"></textarea>
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