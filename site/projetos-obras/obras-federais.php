<?php 
include_once(__DIR__.'/../logica/obras-logica.php');
include_once(__DIR__.'/../include/header.php');
?>

<div class="ui breadcrumb">
	<a href="../index" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="../projetos-obras" class="section">Projetos e Obras</a>
	<i class="right angle icon divider"></i>
	Obras Federais
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>Obras Federais</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" action="obras-federais.php" method="GET">
				<input type="hidden" name="tipo" value="obra federal">
<!-- 				<div class="fields">
					<div class="two wide field">
						<label>Ano</label>
						<select class="ui fluid dropdown" name="anoTermo_convenio" onchange="envia()">
						<?php foreach ($array_anoTermo_convenios as $e) : ?>
							<option value="<?= $e['anoTermo_convenio'] ?>" <?= $anoTermo_convenio==$e['anoTermo_convenio'] ? 'selected' : '' ?>>
								<?= $e['anoTermo_convenio'] ?>
							</option>
						<?php endforeach ?>
						</select>
					</div>
					<div class="thirteen wide field">
					</div>
					<div class="one wide field">
						<button style="margin-top: 20px" id="mostrar" type="button" class="ui circular icon button rotate-reset">
							<i class="chevron down icon"></i>
						</button>
					</div>
				</div>
				<div class="oculto">
					<div class="ui divider"></div> -->
					<div class="fields">
						<div class="three wide field">
							<label>Nº Termo/Convênio</label>
							<input value="<?= $_GET['termo_convenio'] ?? '' ?>" type="text" name="termo_convenio">
						</div>
						<div class="four wide field">
							<label>Descrição</label>
							<input value="<?= $_GET['descricao'] ?? '' ?>" type="text" name="descricao">
						</div>
						<div class="four wide field">
							<label>Fornecedor</label>
							<input value="<?= $_GET['fornecedor'] ?? '' ?>" type="text" name="fornecedor">
						</div>
						<div class="four wide field">
							<label>Situação</label>
							<input value="<?= $_GET['situacao'] ?? '' ?>" type="text" name="situacao">
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
<?php if(count($array_obras)){ ?>
<div class="bloco-tabela">
	<table class="ui violet selectable celled striped table">
		<thead>
			<tr>
				<th>Ano </th>
				<th>Convenio/Contrato</th>
				<th>Descrição</th>
				<th>Fornecedor</th>
				<th>Situação</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_obras as $linha) { 
		?>
			<tr>
				<td><?= $linha->getAnoTermo_convenio() ?></td>
				<td><?= $linha->getTermo_convenio() ?></td>
				<td><?= $linha->getDescricao() ?></td>
				<td><?= $linha->getFornecedor() ?></td>
				<td><?= $linha->getSituacao() ?></td>
				<td><?= number_format($linha->getValor(), 2, ',', '.') ?></td>
			</tr>
		<?php 
			} 
		?>
		</tbody>
	</table>
</div>
<?php } else { ?>
	<h3>Nenhum registro encontrado</h3>
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
	        "order": [[ 0, "desc" ]],
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