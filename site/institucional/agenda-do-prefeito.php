<?php 
include_once(__DIR__.'/../logica/agenda-logica.php');
include_once(__DIR__.'/../include/header.php');
?>

<div class="ui breadcrumb">
	<a href="../index/" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Agenda do Prefeito
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Agenda do Prefeito</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" method="POST">
				<div class="fields">
					<div class="two wide field">
						<label>Dia
						<select class="ui fluid dropdown" name="campoDia" onchange="envia()">
						<?php for($d=1;$d<=31;$d++){ ?>
							<option value="<?= $d ?>" <?= $d==$campoDia ? 'selected' : '' ?>>
								<?= $d ?>
							</option>
						<?php } ?>
						</select>
						</label>
					</div>
					<div class="two wide field">
						<label>Mês
						<select class="ui fluid dropdown" name="campoMes" onchange="envia()">
						<?php foreach($meses as $ind => $mes){ ?>
							<option value="<?= $ind ?>" <?= $ind==$campoMes ? 'selected' : '' ?>>
								<?= $mes ?>
							</option>
						<?php } ?>
						</select>
					</label>
					</div>
					<div class="two wide field">
						<label>Ano
						<select class="ui fluid dropdown" name="campoAno" onchange="envia()">
						<?php foreach($anos as $a){ ?>
							<option value="<?= $a['ano'] ?>" <?=$a['ano']==$campoAno ? 'selected' : '' ?>>
								<?= $a['ano'] ?>
							</option>
						<?php } ?>
						</select>
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<h3 style="text-transform: uppercase;" align="center"><?= strftime('%A, %d de %B de %Y', strtotime($data)); ?></h3>
<div class="ui grid">
	<div class="sixteen wide column">
		<?php if(count($array_eventos)){ ?>
		<div id="agenda">
		<?php foreach ($array_eventos as $linha) { ?>
			<?php $idCor = $linha->getId()%10; ?>
			<article  class="ui piled <?= $cores[$idCor] ?> segment">
				<h3><?= $linha->getTitulo() ?></h3>
				<p><?= substr($linha->getHora(), 0,5) ?></p>
				<p>Local: <?= $linha->getLocal() ?></p>
				<p><?= $linha->getDescricao() ?></p>
			</article>
		<?php } ?>
		</div>
		<?php } else { ?>
			<h3>Nada agendado para este dia.</h3>
		<?php } ?>
	</div>
</div>
<script>
	function envia(){
		$('form').submit();
	}
</script>

<?php include_once(__DIR__.'/../include/footer.php'); ?>