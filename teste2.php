<?php

$param = "localhost/3050:C:\Fiorilli\SCPI_8\CIDADES\GURUPA_PM\ARQ2018\SCPI2018.FDB";

$conn = ibase_connect($param,"FSCSCPI8","scpi");

$query = "SELECT D.NEMPG, D.datae AS DATA, D.codif, F.NOME AS FAVORECIDO, CASE WHEN NOT F.CARGO IS NULL THEN F.CARGO ELSE (SELECT FIRST 1 S.cargo FROM SENHA S WHERE S.CODIF = D.CODIF) END AS CARGO, D.VADEM AS VALOR, (SELECT SUM(D2.VALOR) FROM DESPES D2 WHERE D2.pkempa = D.PKEMP AND D2.tpem IN ('DA','AN')) AS DEVOLUCAO, D.produ AS DESCRICAO, D.pkemp, TE.NOME AS NOME_ELEMENTO  FROM DESPES D  INNER JOIN DESFOR F ON F.CODIF = D.CODIF  INNER JOIN DESDIS FI ON FI.FICHA = D.FICHA  LEFT JOIN TABELEMENTO TE ON TE.ELEMENTO = D.ELEMENTO WHERE FI.EMPRESA = 1 AND D.ELEMENTO in ('14', '33')  AND (D.DATAE >= '2018-01-01' AND D.DATAE <= '2018-01-31') ORDER by F.NOME, D.DATAE";

$query2 = "SELECT EXTRACT(YEAR FROM D.DATAE) AS ANO, D.DATAE, D.PKEMP, D.NEMPG, D.TPEM, DESDIS.EMPRESA, F.NOME, F.INSMF, D.VADEM AS EMPENHADO, 
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
    array_push($arrayResultado, $row);
endwhile;

ibase_free_result($resultado);
ibase_close($conn);

include_once('header.php');

 if(count($arrayResultado)){ ?>
    <div class="bloco-tabela">
        <table id="tabela" border="1">
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
            foreach ($arrayResultado as  $linha) {
                ?>
                <tr>
                    <td><?= $linha->NEMPG ?></td>
                    <td><?= substr($linha->DATA, 0,10) ?></td>
                    <td><?= utf8_encode($linha->FAVORECIDO); ?></td>
                    <td><?= utf8_encode($linha->CARGO); ?></td>
                    <td><?= $linha->DEVOLUCAO ?></td>
                    <td><?= ibase_blob_echo($linha->DESCRICAO); ?></td>
                    <td><?= utf8_encode($linha->NOME_ELEMENTO); ?></td>
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
    function envia(){
        $('form').submit();
    }
    $('select.dropdown').dropdown();
    $('#datepicker').Zebra_DatePicker();
</script>
<?php include_once('footer.php'); ?>
