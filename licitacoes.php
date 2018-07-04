<?php 
include_once('licitacoes-logica.php');
include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	Licitações
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Licitações</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" action="licitacoes.php" method="GET">
				<div class="fields">
					<div class="four wide field">
						<label>Exercício</label>
						<select class="ui fluid dropdown" name="exercicio" onchange="envia()">
						<?php foreach ($array_exercicios as $e) : ?>
							<option value="<?= $e['exercicio'] ?>" <?= $exercicio==$e['exercicio'] ? 'selected' : '' ?>>
								<?= $e['exercicio'] ?>
							</option>
						<?php endforeach ?>
						</select>
					</div>
					<div class="twelve wide field">
						<label>Órgão</label>
						<select class="ui fluid dropdown" name="orgao" onchange="envia()">
						<?php foreach ($array_orgaos as $o) : ?>
							<option value="<?= ($o['orgao']) ?>" <?= $orgao==($o['orgao']) ? 'selected' : '' ?>>
								<?= ($o['orgao']) ?>
							</option>
						<?php endforeach ?>
						</select>
					</div>
				</div>
				<button id="mostrar" type="button" class="ui circular icon button rotate-reset">
					<i class="chevron down icon"></i>
				</button>
				<div class="oculto">
					<div class="ui divider"></div>
					<div class="fields">
						<div class="three wide field">
							<label>Processo</label>
							<input value="<?= $_GET['processo'] ?? '' ?>" type="text" name="processo">
						</div>
						<div class="three wide field">
							<label>Modalidade</label>
							<input value="<?= $_GET['modalidade'] ?? '' ?>" type="text" name="modalidade">
						</div>
						<div class="three wide field">
							<label>Tipo</label>
							<input value="<?= $_GET['tipo'] ?? '' ?>" type="text" name="tipo">
						</div>
						<div class="three wide field">
							<label>Objeto</label>
							<input value="<?= $_GET['objeto'] ?? '' ?>" type="text" name="objeto">
						</div>
						<div class="three wide field">
							<label>Situação</label>
							<input value="<?= $_GET['situacao'] ?? '' ?>" type="text" name="situacao">
						</div>
					</div>
					<div class="fields">
						<div class="three wide field">
							<label>Publicação</label>
							<input value="<?= $_GET['publicacao'] ?? '' ?>" type="text" name="publicacao">
						</div>
						<div class="three wide field">
							<label>Data Publicação</label>
							<input value="<?= $_GET['data_publicacao'] ?? '' ?>" type="date" name="data_publicacao">
						</div>
						<div class="three wide field">
							<label>Empresa vencedora</label>
							<input value="<?= $_GET['vencedor'] ?? '' ?>" type="text" name="vencedor">
						</div>
						<div class="three wide field">
							<label>Valor</label>
							<input value="<?= $_GET['valor'] ?? '' ?>" type="text" name="valor">
						</div>
					</div>
					<button class="ui circular black button" type="submit">Pesquisar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(count($array_licitacoes)){ ?>
<div class="bloco-tabela">
	<table class="ui brown selectable celled striped compact table">
		<thead>
			<tr>
				<th>Processo</th>
				<th>Data Publicação</th>
				<th>Modalidade</th>
				<th>Tipo</th>
				<th>Objeto</th>
				<th>Publicação</th>
				<th>Situação</th>
				<th>Valor</th>
				<th>Vencedor</th>
				<th>Edital</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_licitacoes as $linha) { 
		?>
			<tr>
				<td><?= $linha->getProcesso() ?></td>
				<td><?= date('d/m/Y', strtotime($linha->getData_publicacao())) ?></td>
				<td><?= $linha->getModalidade() ?></td>
				<td><?= $linha->getTipo() ?></td>
				<td><?= $linha->getObjeto() ?></td>
				<td><?= $linha->getPublicacao() ?></td>
				<td><?= $linha->getSituacao() ?></td>
				<td class="right aligned"><?= number_format($linha->getValor(), 2, ',', '.') ?></td>
				<td><?= $linha->getVencedor() ?></td>
				<td>
					<?php if(file_exists($linha->getEdital())): ?>
						<a href="<?= $linha->getEdital()?>">Download</a>
					<?php endif ?>
				</td>
			</tr>
		<?php 
			} 
		?>
		</tbody>
	</table>
</div>
<?php } else { ?>
	Nenhum registro encontrado
<?php } ?>

<script>
	 $(document).ready(function(){
    	$(".oculto").hide();
	});

	$("#mostrar").click(
		function(){
			$(".oculto").transition('slide');
			$(this).toggleClass('rotate');
    		$(this).toggleClass('rotate-reset');
		}
	);

	function envia(){
		$('form').submit();
	}
</script>
<script>
	$('select.dropdown').dropdown();

	$(document).ready(function() {
		var tituloPag = $(".titulo-pag").text();
	    $('table').DataTable( {
	    	"language": {
        		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
        	},
        	"pagingType": "full_numbers",
	    	"searching": false,
	    	"info":     false,
	        "scrollX": true,
	        "order": [[ 1, "desc" ]],
			dom: 'Bfrtip',
	        buttons: [
	        	{
		            extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',
	                text: 'Download <i class="pdf file red icon"></i>',
	                title: tituloPag
		        },
	            {
		            extend: 'print',
		            text: 'Imprimir <i class="print blue icon"></i>',
		            title: tituloPag
		        },
	        ]
	    } );
	} );
</script>
<?php include_once('footer.php'); ?>