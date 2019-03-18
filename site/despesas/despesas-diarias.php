<?php 
	require_once('../classes/ZDespesaDAO.php');
	require_once('../classes/ZEntidadeDAO.php');

	$exercicio = $_GET['exercicio'] ?? "2018";
	$codEntidade = $_GET['codEntidade'] ?? "2";

	$entidadeDAO = new ZEntidadeDAO($exercicio);
	$todasEntidades = $entidadeDAO->getTodasEntidades();

	$despesaDAO = new ZDespesaDAO($exercicio);
	$despesasDiarias = $despesaDAO->getDespesasDiarias($codEntidade);

	include_once(__DIR__.'/../include/header.php');
?>
<div class="ui breadcrumb">
	<a href="../index/" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="../despesas" class="section">Despesas</a>
	<i class="right angle icon divider"></i>
	Diárias
</div>

<h1 class="ui header titulo-pag">Diárias</h1>

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
				<select class="ui fluid dropdown" name="codEntidade" onchange="envia()">
				<?php foreach ($todasEntidades as $entidade) { ?>
					<option value="<?= $entidade->EMPRESA ?>" <?= $codEntidade==$entidade->EMPRESA ? 'selected' : 'PREFEITURA MUNICIPAL DE GURUPA' ?>>
						<?= utf8_encode($entidade->NOME) ?>
					</option>
				<?php } ?>
				</select>
			</div>
		</div>
	</form>
</div>
<?php if(count($despesasDiarias)){ ?>
<div class="bloco-tabela">
	<table class="ui red selectable celled striped compact table" style="width:100%">
		<thead>
			<tr>
				<th>Empenho</th>
				<th>Data</th>
				<th>Favorecido</th>
				<th>Cargo</th>
				<th>Devolução</th>
				<th>Descrição</th>
				<th>Nome Elemento</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$somaValor = 0;
			foreach ($despesasDiarias as $linha) { 
		?>
			<tr>
				<td><?= $linha->NEMPG ?></td>
				<td><?= date('d/m/Y', strtotime(substr($linha->DATA, 0,10))) ?></td>
				<td><?= utf8_encode($linha->FAVORECIDO); ?></td>
				<td><?= utf8_encode($linha->CARGO); ?></td>
				<td><?= $linha->DEVOLUCAO ?></td>
				<td><?= ibase_blob_echo($despesaDAO->getConexaoFirebird()->getConexaoSCPI(),$linha->DESCRICAO); ?></td>
				<td><?= utf8_encode($linha->NOME_ELEMENTO); ?></td>
				<td class="right aligned"><?= number_format($linha->VALOR, 2, ',', '.') ?></td>
			</tr>
		<?php 
				$somaValor += $linha->VALOR;
			} 
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6" class="right aligned"><strong>TOTAL:</strong></th>
				<th class="right aligned"><?= number_format($somaValor, 2, ',', '.') ?></th>
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
<?php include_once(__DIR__.'/../include/footer.php'); ?>