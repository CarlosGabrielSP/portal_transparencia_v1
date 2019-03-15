<?php
require_once('zlogica-empenhos.php');

include_once('../include/header.php');

if(count($arrayResultado)){ 
?>
    <div class="bloco-tabela">
        <table class="ui brown selectable celled striped compact table">
            <thead>
                <tr>
                    <th>Empenho</th>
                    <th>Data</th>
                    <th>Favorecido</th>
                    <th>Objeto</th>
                    <th>Procedimento Licitatório</th>
                    <th>Unidade Orç</th>
                    <th>Função</th>
                    <th>Subfunção</th>
                    <th>Natureza</th>
                    <th>Fonte</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($arrayResultado as $linha) {
                ?>
                <tr>
                    <td><?= $linha->EMPENHO ?></td>
                    <td><?= date('d/m/Y', strtotime(substr($linha->DATA_EMPENHO, 0,10))) ?></td>
                    <td><?= utf8_encode($linha->FAVORECIDO); ?></td>
                    <td><?= utf8_encode(ibase_blob_echo($linha->HISTORICO)) ?></td>
                    <td><?= utf8_encode($linha->PROCED_LIC) ?></td>
                    <td><?= utf8_encode($linha->UNIDADE_ORC) ?></td>
                    <td><?= utf8_encode($linha->FUNCAO) ?></td>
                    <td><?= utf8_encode($linha->SUBFUNCAO) ?></td>
                    <td><?= utf8_encode($linha->NATUREZA) ?></td>
                    <td><?= utf8_encode($linha->FONTE) ?></td>
                    <td class="right aligned"><?= number_format($linha->VALOR, 2, ',', '.') ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    Nenhum registro encontrado
<?php } ?>
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
<?php include_once('../include/footer.php'); ?>
