<?php include_once('../include/header.php'); ?>

<div class="ui segments">
	<div class="ui segment">
		<h1>Cadastrar Departamento</h1>
	</div>
 	<div class="ui secondary segment">
    	<form class="ui form" action="gerenciador-cadastro.php" method="POST" enctype="multipart/form-data">
    		<input type="hidden" name="elemento" value="departamentos">
			<div class="fields">
				<div class="four wide field">
					<label>Nome do Departamento</label>
					<input type="text" name="nome" required="required">
				</div>
				<div class="four wide field">
					<label>CNPJ</label>
					<input type="text" name="cnpj">
				</div>
				<div class="four wide field">
					<label>Município</label>
					<input type="text" name="municipio" required="required">
				</div>
				<div class="four wide field">
					<label>Tipo</label>
					<input type="text" name="tipo" required="required">
				</div>
			</div>
			<div class="fields">
				<div class="four wide field">
					<label>Endereço</label>
					<input type="text" name="endereco" required="required">
				</div>
				<div class="four wide field">
					<label>Telefone</label>
					<input type="text" name="telefone" required="required">
				</div>
				<div class="four wide field">
					<label>Email</label>
					<input type="text" name="email" required="required">
				</div>
				<div class="four wide field">
					<label>Horário de Atendimento</label>
					<input type="text" name="horario" required="required">
				</div>
			</div>
			<div class="fields">
				<div class="four wide field">
					<label>Responsável</label>
					<input type="text" name="responsavel" required="required">
				</div>
				<div class="four wide field">
					<label>Título do Responsável</label>
					<input type="text" name="tituloResponsavel" required="required">
				</div>
				
			</div>
			<div class="field">
				<label>Competência</label>
				<textarea name="competencia" required="required" rows="4"></textarea>
			</div>
			<div class="six wide field">
				<label>Foto</label>
				<input type="file" name="fotoResponsavel" id="fotoResponsavel" accept=".jpg,.png">
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