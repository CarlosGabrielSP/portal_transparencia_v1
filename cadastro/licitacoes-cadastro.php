<?php include_once('../include/header.php'); ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastro Empenhos</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST" enctype="multipart/form-data">
    		<input type="hidden" name="elemento" value="licitacoes">
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
					<label>Processo</label>
					<input type="text" name="processo" required="required">
				</div>
				<div class="six wide field">
					<label>Modalidade</label>
					<input type="text" name="modalidade" required="required">
				</div>
				<div class="three wide field">
					<label>Tipo</label>
					<input type="text" name="tipo" required="required">
				</div>
			</div>
			<div class="field">
				<label>Objeto</label>
				<textarea name="objeto" rows="4" required="required"></textarea>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>Publicação</label>
					<input type="text" name="publicacao" required="required">
				</div>
				<div class="three wide field">
					<label>Data Publicação</label>
					<input type="date" name="data_publicacao" required="required">
				</div>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>Situação</label>
					<input type="text" name="situacao" required="required">
				</div>
				<div class="six wide field">
					<label>Empresa vencedora</label>
					<input type="text" name="vencedor">
				</div>
				<div class="three wide field">
					<label>Valor</label>
					<input type="text" name="valor" required="required">
				</div>
			</div>
			<div class="six wide field">
				<label>Edital</label>
				<input type="file" name="edital" id="edital" required="required" accept=".pdf">
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
<?php include_once('../include/footer.php'); ?>