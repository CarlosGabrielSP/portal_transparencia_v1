<?php 
include_once('pagamentos-logica.php');
include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="./despesas.php" class="section">Despesas</a>
	<i class="right angle icon divider"></i>
	Pagamento das despesas
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Pagamento das despesas</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" action="pagamentos.php" method="GET">
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
							<option value="">Todos</option>
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
							<label>Empenho</label>
							<input value="<?= $_GET['numeroEmpenho'] ?? '' ?>" type="text" name="numeroEmpenho">
						</div>
						<div class="three wide field">
							<label>Favorecido</label>
							<input value="<?= $_GET['favorecido'] ?? '' ?>" type="text" name="favorecido">
						</div>
						<div class="three wide field">
							<label>Valor</label>
							<input value="<?= $_GET['Valor'] ?? '' ?>" type="text" name="Valor">
						</div>
						<div class="three wide field">
							<label>Data</label>
							<input value="<?= $_GET['data'] ?? '' ?>" type="date" name="data">
						</div>
					</div>
					<button class="ui circular black button" type="submit">Pesquisar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(count($array_pagamentos)){ ?>
<div class="bloco-tabela">
	<table class="ui brown selectable celled striped compact table">
		<thead>
			<tr>
				<th>Empenho</th>
				<th>Tipo</th>
				<th>Data da Pagamento</th>
				<th>Fornecedor</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_pagamentos as $linha) { 
		?>
			<tr>
				<td class="center aligned">
					<?php 
						$uri = "?tipo={$linha['tipo']}&exercicio={$linha['exercicio']}&orgao={$linha['orgao']}&numero={$linha['numeroEmpenho']}";
						if(strpos($linha['unidade_orc'],"RESTOS A PAGAR")){
							$uri.= "&restosapagar=S";
						}else{
							$uri.= "&restosapagar=N";
						}
					?>
					<a href="empenhos.php<?=$uri?>">
						<?= $linha['numeroEmpenho'] ?>
					</a>					
				</td>
				<td class="center aligned"><?= $linha['tipo'] ?></td>
				<td class="center aligned"><?= date('d/m/Y', strtotime($linha['data'])) ?></td>
				<td><?= $linha['favorecido'] ?></td>
				<td><?= number_format($linha['valor'], 2, ',', '.') ?></td>
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
	        "order": [[ 0, "desc" ]],
			dom: 'Bfrtip',
			"pageLength": 20,
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