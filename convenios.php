<?php 
include_once('convenios-logica.php');
include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="contratos-e-convenios.php" class="section">Contratos e Convênios</a>
	<i class="right angle icon divider"></i>
	Convênios
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Convênios</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" action="convenios.php" method="GET">
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
						<div class="four wide field">
							<label>Número</label>
							<input value="<?= $_GET['numero'] ?? '' ?>" type="text" name="numero">
						</div>
						<div class="twelve wide field">
							<label>Objeto</label>
							<input value="<?= $_GET['objeto'] ?? '' ?>" type="text" name="objeto">
						</div>
					</div>
					<button class="ui circular black button" type="submit">Pesquisar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(count($array_convenios)){ ?>
<div class="bloco-tabela">
	<table class="ui teal selectable celled striped compact table">
		<thead>
			<tr>
				<th>Número</th>
				<th>Objeto</th>
				<th>Concedente</th>
				<th>Data</th>
				<th>Vigência</th>
				<th>Valor</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_convenios as $linha) { 
		?>
			<tr>
				<td><?= $linha->getNumero() ?></td>
				<td><?= $linha->getObjeto() ?></td>
				<td><?= $linha->getConcedente() ?></td>
				<td><?= date('d/m/Y', strtotime($linha->getData())) ?></td>
				<td><?= date('d/m/Y', strtotime($linha->getVigencia())) ?></td>
				<td><?= $linha->getValor() ?></td>
				<td>
					<?php if(file_exists($linha->getArquivo())): ?>
						<a href="<?= $linha->getArquivo()?>">Download</a>
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