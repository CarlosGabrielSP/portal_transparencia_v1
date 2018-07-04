<?php

$param = "localhost/3050:C:\Fiorilli\SCPI_8\CIDADES\GURUPA_PM\ARQ2018\SCPI2018.FDB";

$conn = ibase_connect($param,"FSCSCPI8","scpi");

$query = "SELECT EXTRACT(YEAR FROM D.DATAE) AS ANO, D.DATAE, D.NEMPG, D.TPEM, DESDIS.EMPRESA, F.NOME, D.VADEM AS EMPENHADO, 
D.PROC, D.LICIT, D.NUMLIC, D.PROCLIC, (DESDIS.PODER||DESDIS.ORGAO||' - '||TABORGAO.NOME) AS ORGAO, 
(DESDIS.PODER||DESDIS.ORGAO||TABUNIDADE.UNIDADE||' - '||CASE WHEN DESDIS.EXTRA='S' THEN EXTRA.DESCRICAO ELSE TABUNIDADE.NOME END) AS UNIDADE, 
(DESDIS.PROJATIV||' - '||TABPROJATIV.NOME) AS PROJETOATIVIDADE, (D.VINGRUPO||D.VINCODIGO||' - '||VINCODIGO.VINCODIGONOME) AS VINCULO, 
(COALESCE(D.FRG, DESDIS.FONGRUPO)||' - '||FONGRUPO.FONGRUPODESC) AS FONGRUPO, (COALESCE(D.FRC, DESDIS.FONCODIGO)||' - '||FONCODIGO.FONCODIGODESC) AS FONCODIGO, 
DESDIS.BALCO, (DESDIS.CATEC||' - '||TABCATEC.NOME) AS ELEMENTO, D.PRODU AS HISTORICO 
FROM DESPES D 
INNER   JOIN DESDIS         ON DESDIS.FICHA = D.FICHA 
INNER   JOIN DESFOR F       ON F.CODIF = D.CODIF 
LEFT    JOIN TABORGAO       ON TABORGAO.PODER = DESDIS.PODER AND TABORGAO.ORGAO = DESDIS.ORGAO 
LEFT    JOIN TABUNIDADE     ON TABUNIDADE.PODER = DESDIS.PODER AND TABUNIDADE.ORGAO = DESDIS.ORGAO AND TABUNIDADE.UNIDADE = DESDIS.UNIDADE 
LEFT    JOIN TABPROJATIV    ON TABPROJATIV.PROJATIV = DESDIS.PROJATIV 
LEFT    JOIN TABCATEC       ON TABCATEC.CATEC = DESDIS.CATEC 
LEFT    JOIN VINCODIGO      ON VINCODIGO.VINGRUPO = DESDIS.VINGRUPO AND VINCODIGO.VINCODIGO = DESDIS.VINCODIGO 
LEFT    JOIN FONGRUPO       ON FONGRUPO.FONGRUPO = COALESCE(D.FRG, DESDIS.FONGRUPO) 
LEFT    JOIN FONCODIGO      ON FONCODIGO.FONCODIGO = COALESCE(D.FRC, DESDIS.FONCODIGO) 
LEFT    JOIN EXTRA          ON EXTRA.EMPRESA=DESDIS.EMPRESA AND EXTRA.EXTRA=DESDIS.FICHA_EXTRA

ORDER BY D.NEMPG ASC";

$resultado = ibase_query($conn,$query);
$arrayResultado = array();

while($row = ibase_fetch_object($resultado)) :
    $arrayResultado[] = $row;
endwhile;

ibase_free_result($resultado);
ibase_close($conn);

include_once('header.php');

 if(count($arrayResultado)){ ?>
    <div class="bloco-tabela">
        <table id="tabela" class="ui red selectabled striped compact table" style="width:100%">
            <thead>
            <tr>
                <!-- <th>ANO</th> -->
                <th>Data</th>
                <!-- <th>PKEMP</th> -->
                <th>Empenho</th>
                <th>Tipo</th>
                <!-- <th>EMPRESA</th> -->
                <th>Favorecido</th>
                <!-- <th>INSMF</th> -->
                <th>Valor</th>
                <!-- <th>PROC</th> -->
                <th>Proced. Lic.</th>
                <!-- <th>NUMLIC</th> -->
                <!-- <th>PROCLIC</th> -->
                <!-- <th>ORGAO</th> -->
                <!-- <th>UNIDADE</th> -->
                <!-- <th>PROJETOATIVIDADE</th> -->
                <!-- <th>VINCULO</th> -->
                <!-- <th>FONGRUPO</th> -->
                <!-- <th>FONCODIGO</th> -->
                <!-- <th>BALCO</th> -->
                <th>Classif. Orçmentária</th>
                <th>Descrição</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($arrayResultado as  $linha) {
                ?>
                <tr>
                    <!-- <td><?= $linha->ANO ?></td> -->
                    <td><?= $linha->DATAE ?></td>
                    <!-- <td><?= $linha->PKEMP ?></td> -->
                    <td><?= $linha->NEMPG ?></td>
                    <td><?= $linha->TPEM ?></td>
                    <!-- <td><?= $linha->EMPRESA ?></td> -->
                    <td><?= $linha->NOME ?></td>
                    <!-- <td><?= $linha->INSMF ?></td> -->
                    <td><?= $linha->EMPENHADO ?></td>
                    <!-- <td><?= $linha->PROC ?></td> -->
                    <td><?= $linha->LICIT ?></td>
                    <!-- <td><?= $linha->NUMLIC ?></td> -->
                    <!-- <td><?= $linha->PROCLIC ?></td> -->
                    <!-- <td><?= $linha->ORGAO ?></td> -->
                    <!-- <td><?= $linha->UNIDADE ?></td> -->
                    <!-- <td><?= $linha->PROJETOATIVIDADE ?></td> -->
                    <!-- <td><?= $linha->VINCULO ?></td> -->
                    <!-- <td><?= $linha->FONGRUPO ?></td> -->
                    <!-- <td><?= $linha->FONCODIGO ?></td> -->
                    <!-- <td><?= $linha->BALCO ?></td> -->
                    <td><?= $linha->ELEMENTO ?></td>
                    <td><?= ibase_blob_echo($linha->HISTORICO) ?></td>
                </tr>

            <?php } ?>
            </tbody>
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
    $('#datepicker').Zebra_DatePicker({
        always_visible: $('#campoData'),
        format: 'd/m/Y',
        days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        show_clear_date: false,
        show_select_today: 'Hoje'
    });
</script>
<?php include_once('footer.php'); ?>