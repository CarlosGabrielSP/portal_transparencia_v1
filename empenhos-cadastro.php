<?php include_once('header.php'); ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastrar Empenho</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST">
    		<input type="hidden" name="elemento" value="empenhos">
			<div class="fields">
				<div class="two wide field">
					<label>Exercício</label>
					<input type="text" name="exercicio" required>
				</div>
				<div class="five wide field">
					<label>Órgão</label>
					<input type="text" name="orgao" required>
				</div>
			</div>
			<div class="fields">
				<div class="three wide field">
					<label>numero</label>
					<input type="text" name="numero" required>
				</div>
				<div class="seven wide field">
					<label>favorecido</label>
					<input type="text" name="favorecido" required>
				</div>
				<div class="three wide field">
					<label>valor</label>
					<input type="text" name="valor" required>
				</div>
				<div class="three wide field">
					<label>Data</label>
					<input type="date" name="data">
				</div>
			</div>
			<div class="field">
				<label>Objeto</label>
				<textarea name="objeto" rows="4" required></textarea>
			</div>
			<div class="fields">
				<div class="four wide field">
					<label>Procedimento Licitatório</label>
					<input type="text" name="procedimento_lic">
				</div>
				<div class="four wide field">
					<label>Unidade Orçamentária</label>
					<input type="text" name="unidade_orc">
				</div>
				<div class="four wide field">
					<label>Função</label>
					<input type="text" name="funcao">
				</div>
				<div class="four wide field">
					<label>Subfunção</label>
					<input type="text" name="subfuncao">
				</div>
			</div>
			<div class="fields">
				<div class="four wide field">
					<label>Natureza</label>
					<input type="text" name="natureza">
				</div>
				<div class="four wide field">
					<label>Fonte</label>
					<input type="text" name="fonte">
				</div>
			</div>
			<button id="carregamento" type="submit" class="ui right labeled icon black circular button">
				Salvar
				<i class="save icon"></i>
			</button>
		</form>
  	</div>
</div>
<script>
	// $("#carregamento").click(function(){
	// 	$(this).addClass("loading");
	// });
</script>

<?php include_once('footer.php'); ?>