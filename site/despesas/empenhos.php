<?php 
include_once(__DIR__.'/../logica/empenhos-logica.php');
include_once(__DIR__.'/../include/header.php');
?>

<div class="ui breadcrumb">
	<a href="../index/" class="section">Início</a>
	<i class="right angle icon divider"></i>
	<a href="../despesas/" class="section">Despesas</a>
	<i class="right angle icon divider"></i>
	Empenho das despesas
</div>

<div class="ui segments">
	<div class="ui segment">
		<h1>
			Empenho das Despesas <?php if($tipo){
				echo $tipo == "OR" ? "Orçamentárias" : "Extraorçamentárias";
			} ?>
		</h1>
	</div>
 	<div class="ui secondary segment">
		<div class="painel-form">
			<form class="ui form" action="empenhos.php" method="GET">
				<input type="hidden" name="tipo" value="<?=$tipo?>">
				<input type="hidden" name="restosapagar" value="<?=$restosapagar?>">
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
							<label>Número</label>
							<input value="<?= $_GET['numero'] ?? '' ?>" type="text" name="numero">
						</div>
						<div class="three wide field">
							<label>Favorecido</label>
							<input value="<?= $_GET['favorecido'] ?? '' ?>" type="text" name="favorecido">
						</div>
						<div class="three wide field">
							<label>Valor</label>
							<input value="<?= $_GET['valor'] ?? '' ?>" type="text" name="valor">
						</div>
						<div class="three wide field">
							<label>Objeto</label>
							<input value="<?= $_GET['objeto'] ?? '' ?>" type="text" name="objeto">
						</div>
						<div class="three wide field">
							<label>Data</label>
							<input value="<?= $_GET['data'] ?? '' ?>" type="date" name="data">
						</div>
					</div>
					<div class="fields">
						<div class="three wide field">
							<label>Procedimento</label>
							<input value="<?= $_GET['procedimento_lic'] ?? '' ?>" type="text" name="procedimento_lic">
						</div>
						<div class="three wide field">
							<label>Uniddade Orçamentária</label>
							<input value="<?= $_GET['unidade_orc'] ?? '' ?>" type="text" name="unidade_orc">
						</div>
						<div class="three wide field">
							<label>Função</label>
							<input value="<?= $_GET['funcao'] ?? '' ?>" type="text" name="funcao">
						</div>
						<div class="three wide field">
							<label>Subfunção</label>
							<input value="<?= $_GET['subfuncao'] ?? '' ?>" type="text" name="subfuncao">
						</div>
					</div>
					<div class="fields">
						<div class="three wide field">
							<label>Natureza da Despesa</label>
							<input value="<?= $_GET['natureza'] ?? '' ?>" type="text" name="natureza">
						</div>
						<div class="three wide field">
							<label>Fonte do Recurso</label>
							<input value="<?= $_GET['fonte'] ?? '' ?>" type="text" name="fonte">
						</div>
					</div>
					<button class="ui circular black button" type="submit">Pesquisar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(count($array_empenhos)){ ?>
<div class="bloco-tabela">
	<table class="ui brown selectable celled striped compact table">
		<thead>
			<tr>
				<th>Número</th>
				<th>Data</th>
				<th>Fornecedor</th>
				<th>Objeto</th>
				<th>Procedimento Lic.</th>
				<th>Unid. Orçamentária</th>
				<th>Função</th>
				<th>SubFunção</th>
				<th>Natureza</th>
				<th>Fonte</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($array_empenhos as $linha) { 
		?>
			<tr>
				<td class="center aligned"><?= $linha->getNumero() ?></td>
				<td><?= date('d/m/Y', strtotime($linha->getData())) ?></td>
				<td><?= $linha->getFavorecido() ?></td>
				<td><?= $linha->getObjeto() ?></td>
				<td><?= $linha->getProcedimento_lic() ?></td>
				<td><?= $linha->getUnidade_orc() ?></td>
				<td><?= $linha->getFuncao() ?></td>
				<td><?= $linha->getSubfuncao() ?></td>
				<td><?= $linha->getNatureza() ?></td>
				<td><?= $linha->getFonte() ?></td>
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
	        "order": [[ 1, "desc" ],[0,"desc"]],
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