<?php include_once('header.php') ?>

<form id="formAjax">
	<label>
		Nome
		<input type="text" name="empenho">
	</label>
	<label>
		Valor
		<input type="text" name="valor">
	</label>
	<label>
		Data
		<input type="date" name="data">
	</label>
	<input type="submit" value="Enviar">
</form>
<div id="campoNome"></div>
<br>
<div id="campoValor"></div>
<script>
	$(function(){
		$("#formAjax").submit(function(){
			let dados = $(this).serialize();
			let request = $.ajax({
				method: "GET",
				url: "teste4.php",
				data: dados
			});

			request.done(function(e){
				console.log(e);
			});

			return false;
		});

	});
</script>
<?php include_once('footer.php') ?>