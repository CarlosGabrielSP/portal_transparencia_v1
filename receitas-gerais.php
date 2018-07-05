<?php 
	require_once('classes/ZReceitaDAO.php');
	require_once('classes/EntidadeDAO.php');

	$exercicio = $_GET['exercicio'] ?? "2018";
	$codEntidade = $_GET['codEntidade'] ?? "2";

	$entidadeDAO = new EntidadeDAO($exercicio);
	$todasEntidades = $entidadeDAO->getTodasEntidades();

	$receitaDAO = new ZReceitaDAO($exercicio);
	$receitasGerais = $receitaDAO->getReceitasGerais();

	include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="receitas.php">Receitas</a>
	<i class="right angle icon divider"></i>
	Receitas Gerais
</div>

<h1 class="ui header titulo-pag">Receitas Gerais</h1>

<div class="ui message">
	<form class="ui form" action="">
		<div class="fields">
			<div class="four wide field">
				<label>Exercício</label>
				<select class="ui fluid dropdown" name="exercicio" onchange="envia()">
					<option value="2018" <?= $exercicio=='2018' ? 'selected' : '' ?>>2018</option>
				</select>
			</div>
			<div class="twelve wide field">
				<label>Entidades</label>
				<select class="ui fluid dropdown disabled" name="codEntidade" onchange="envia()">
				<?php foreach ($todasEntidades as $entidade) { ?>
					<option value="<?= $entidade->EMPRESA ?>" <?= $codEntidade==$entidade->EMPRESA ? 'selected' : '' ?>>
						<?= utf8_encode($entidade->NOME) ?>
					</option>
				<?php } ?>
				</select>
			</div>
		</div>
	</form>
</div>
<?php if(count($receitasGerais)){ ?>
<div class="bloco-tabela">
	<table class="ui orange selectable celled striped compact table">
		<thead>
				<th>Código</th>
				<th>Especificação</th>
				<th>Prev. Inicial</th>
				<th>Prev. Atualizada</th>
				<th>Arrec. Período</th>
				<th>Arrec. Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$somaPrevInicial 		= 0;
			$somaPrevAtualziada 	= 0;
			$somaArrecAtualziada 	= 0;
			$somaArrecTotal 		= 0;
			foreach ($receitasGerais as $linha) { 
		?>
			<tr>
				<td><?= $linha->CODIGO ?></td>
				<td><?= utf8_encode($linha->NOME) ?></td>
				<td class="right aligned"><?= number_format($linha->PREVISAO_INICIAL, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->PREVISAO_ATUALIZADA, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->ARRECADADO_PERIODO, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->ARRECADADO_TOTAL, 2, ',', '.') ?></td>
			</tr>
		<?php 
				$somaPrevInicial		+= $linha->PREVISAO_INICIAL;
				$somaPrevAtualziada		+= $linha->PREVISAO_ATUALIZADA;
				$somaArrecAtualziada	+= $linha->ARRECADADO_PERIODO;
				$somaArrecTotal			+= $linha->ARRECADADO_TOTAL;
			} 
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2" class="right aligned"><strong>TOTAL:</strong></th>
				<th class="right aligned"><?= number_format($somaPrevInicial, 2, ',', '.') ?></th>
				<th class="right aligned"><?= number_format($somaPrevAtualziada, 2, ',', '.') ?></th>
				<th class="right aligned"><?= number_format($somaArrecAtualziada, 2, ',', '.') ?></th>
				<th class="right aligned"><?= number_format($somaArrecTotal, 2, ',', '.') ?></th>
			</tr>
		</tfoot>
	</table>
</div>
<?php } else { ?>
	<h3>Nenhum registro encontrado</h3>
<?php } ?>

<script>
	function envia(){
		$('form').submit();
	}
	$('select.dropdown').dropdown();
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
	        "order": [[ 0, "asc" ]],
	        "pageLength": 20,
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