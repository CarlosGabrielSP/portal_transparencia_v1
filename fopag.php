<?php 
include_once('fopag-logica.php');
include_once('header.php');
?>

<div class="ui breadcrumb">
	<a href="./" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="#" class="section">Despesas com Pessoal</a>
	<i class="right angle icon divider"></i>
	Folha de Pagamento
</div>

<h1 class="ui header titulo-pag">Folha de Pagamento</h1>

<div class="ui message painel-form">
	<form class="ui form" action="fopag.php" method="GET">
		<div class="fields">
			<div class="three wide field">
				<label>Mês</label>
				<select class="ui fluid dropdown" name="mes" onchange="envia()">
				<?php foreach ($array_meses as $e) : ?>
					<option value="<?= $e['mes'] ?>" <?= $mes==$e['mes'] ? 'selected' : '' ?>>
						<?= $nome_meses[$e['mes']] ?>
					</option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="three wide field">
				<label>Exercício</label>
				<select class="ui fluid dropdown" name="exercicio" onchange="envia()">
				<?php foreach ($array_exercicios as $e) : ?>
					<option value="<?= $e['exercicio'] ?>" <?= $exercicio==$e['exercicio'] ? 'selected' : '' ?>>
						<?= $e['exercicio'] ?>
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
				<div class="two wide field">
					<label>Matrícula</label>
					<input value="<?= $_GET['matricula'] ?? '' ?>" type="text" name="matricula">
				</div>
				<div class="six wide field">
					<label>Nome</label>
					<input value="<?= $_GET['nome'] ?? '' ?>" type="text" name="nome">
				</div>
				<div class="four wide field">
					<label>Cargo</label>
					<input value="<?= $_GET['cargo'] ?? '' ?>" type="text" name="cargo">
				</div>
				<div class="four wide field">
					<label>Vínculo</label>
					<input value="<?= $_GET['vinculo'] ?? '' ?>" type="text" name="vinculo">
				</div>
			</div>
			<div class="fields">
				<div class="seven wide field">
					<label>Órgão</label>
					<input value="<?= $_GET['orgao'] ?? '' ?>" type="text" name="orgao">
				</div>
				<div class="three wide field">
					<label>Valor bruto</label>
					<input value="<?= $_GET['bruto'] ?? '' ?>" type="text" name="bruto">
				</div>
				<div class="three wide field">
					<label>Valor Desconto</label>
					<input value="<?= $_GET['desconto'] ?? '' ?>" type="text" name="desconto">
				</div>
				<div class="three wide field">
					<label>Valor Líquido</label>
					<input value="<?= $_GET['liquido'] ?? '' ?>" type="text" name="liquido">
				</div>
			</div>
			<button class="ui circular black button" type="submit">Pesquisar</button>
		</div>
	</form>
</div>
<?php if(count($array_salarios)){ ?>
<div class="bloco-tabela">
	<table class="ui olive selectable celled striped compact table">
		<thead>
			<tr>
				<th>Matrícula</th>
				<th>Nome</th>
				<th>Cargo</th>
				<th>Vínculo</th>
				<th>Órgão</th>
				<th>Bruto (R$)</th>
				<th>Desconto (R$)</th>
				<th>Líquido (R$)</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_salarios as $linha) { 
		?>
			<tr>
				<td class="center aligned">
					<?= str_pad($linha->getMatricula(), 4, 0, STR_PAD_LEFT);  ?>
				</td>
				<td><?= $linha->getNome() ?></td>
				<td><?= $linha->getCargo() ?></td>
				<td><?= $linha->getVinculo() ?></td>
				<td><?= $linha->getOrgao() ?></td>
				<td class="right aligned"><?= number_format($linha->getBruto(), 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->getDesconto(), 2, ',', '.') ?></td>
				<td class="right aligned"><?= number_format($linha->getLiquido(), 2, ',', '.') ?></td>
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
	        "order": [[ 1, "asc" ]],
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