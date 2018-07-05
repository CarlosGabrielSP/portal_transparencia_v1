<?php 
	require_once('classes/DespesaDAO.php');
	require_once('classes/EntidadeDAO.php');

	$exercicio = $_GET['exercicio'] ?? "2017";
	$codEntidade = $_GET['codEntidade'] ?? "1";

	$entidadeDAO = new EntidadeDAO($exercicio);
	$todasEntidades = $entidadeDAO->getTodasEntidades();

	$despesaDAO = new DespesaDAO($exercicio);
	$despesasPorOrgao = $despesaDAO->getDespesasPorOrgao($codEntidade);

	include_once('header.php');
?>
<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="despesas.php" class="section">Despesas</a>
	<i class="right angle icon divider"></i>
	Despesas por Órgão
</div>

<h1 class="ui header titulo-pag">Despesas por Órgão</h1>

<div class="ui message">
	<form class="ui form" action="">
		<div class="fields">
			<div class="four wide field">
				<label>Exercício</label>
				<select class="ui fluid dropdown" name="exercicio" onchange="envia()">
					<option value="2017" <?= $exercicio=='2017' ? 'selected' : '' ?>>2017</option>
					<option value="2018" <?= $exercicio=='2018' ? 'selected' : '' ?>>2018</option>
				</select>
			</div>
			<div class="twelve wide field">
				<label>Entidades</label>
				<select class="ui fluid dropdown" name="codEntidade" onchange="envia()">
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
<?php if(count($despesasPorOrgao)){ ?>
<div class="bloco-tabela">
	<table id="tabela" class="ui red selectable striped celled compact table" style="width:100%">
		<thead>
			<tr>
				<!-- <th>Empenho</th> -->
				<th>Órgão</th>
				<th>Dotação Inicial</th>
				<th>Alt. de Dotação</th>
				<th>Dotação Atualizada</th>
				<th>Valor Empenhado</th>
				<th>Valor Liquidado</th>
				<th>Valor Pago</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$somaValorEmpenhado = 0;
			$somaValorLiquidado = 0;
			$somaValorPago = 0;
			foreach ($despesasPorOrgao as $linha) { 
		?>
			<tr>
				<!-- <td><?= $linha->CODIGO ?></td> -->
				<td><?= utf8_encode($linha->DESCRICAO); ?></td>
				<td class="right aligned"><?= number_format($linha->DOTAC, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->ALTDO, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->DOTACAO_ATUALIZADA, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->EMPENHADO, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->LIQUIDADO, 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->PAGO, 2, ',', '.') ?></td>
			</tr>
		<?php 
				$somaValorEmpenhado	+= $linha->EMPENHADO;
				$somaValorLiquidado	+= $linha->LIQUIDADO;
				$somaValorPago		+= $linha->PAGO;
			} 
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4" class="right aligned"><strong>TOTAL:</strong></th>
				<th class="right aligned"><?= number_format($somaValorEmpenhado, 2, ',', '.') ?></th>
				<th class="right aligned"><?= number_format($somaValorLiquidado, 2, ',', '.') ?></th>
				<th class="right aligned"><?= number_format($somaValorPago, 2, ',', '.') ?></th>
			</tr>
		</tfoot>
	</table>
</div>
<?php } else { ?>
	Nenhum registro encontrado
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
		$.fn.dataTable.moment = function ( format, locale ) {
		    var types = $.fn.dataTable.ext.type;
		 
		    // Add type detection
		    types.detect.unshift( function ( d ) {
		        return moment( d, format, locale, true ).isValid() ?
		            'moment-'+format :
		            null;
		    } );
		 
		    // Add sorting method - use an integer for the sorting
		    types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
		        return moment( d, format, locale, true ).unix();
		    };
		};
		$.fn.dataTable.moment( 'DD/MM/YYYY' );
		
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