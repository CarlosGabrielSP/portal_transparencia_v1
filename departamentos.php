<?php 
include_once('departamentos-logica.php');
include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Secretarias e Departamentos
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Secretarias e Departamentos</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="ui accordion">
		<?php foreach ($array_departamentos as $departamento) { ?>
			<div class="ui segment">
				<div class="title">
					<?= $departamento->getNome() ?>
				</div>
				<div class="content">
					<div class="ui divider"></div>
					<div class="ui grid">
						<div class="three wide column">
							<h3><?= $departamento->getTituloResponsavel() ?></h3>
							<div class="ui card">
								<div class="image foto-responsavel">
									<img src="<?php
										if (file_exists($departamento->getFotoResponsavel())) {
										    echo $departamento->getFotoResponsavel();
										} else {
										    echo "img/user.png";
										}
									?>">
								</div>
								<div class="content">
									<div class="header"><?= $departamento->getResponsavel() ?></div>
								</div>
							</div>
						</div>
						<div class="six wide column">
							<h3>Endereço:</h3>
							<div><?= $departamento->getEndereco() ?></div>
							<h3>Telefone:</h3>
							<div><?= $departamento->getTelefone() ?></div>
							<h3>Email:</h3>
							<div><?= $departamento->getEmail() ?></div>
							<h3>Horário de Atendimento:</h3>
							<div><?= $departamento->getHorario() ?></div>
						</div>
						<div class="seven wide column">
							<h3>Competências:</h3>
							<p><?= $departamento->getCompetencia() ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>

<script>
	$('.ui.accordion').accordion();
</script>
<?php include_once('footer.php'); ?>