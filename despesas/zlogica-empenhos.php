<?php
$param = "localhost/3050:C:\Fiorilli\SCPI_8\CIDADES\GURUPA_PM\ARQ2018\SCPI2018.FDB";

$conn = ibase_connect($param,"FSCSCPI8","scpi");

$filtro = array('exrcicio'=>2018,'tipo'=>'OR');

$query_select = 
    "SELECT D.NEMPG AS EMPENHO, F.NOME AS FAVORECIDO, D.VADEM AS VALOR, D.PRODU AS HISTORICO, D.TPEM AS TIPO_EMP, D.DATAE AS DATA_EMPENHO, D.LICIT AS PROCED_LIC,
    (DESDIS.PODER||DESDIS.ORGAO||TABUNIDADE.UNIDADE||' - '||TABUNIDADE.NOME) AS UNIDADE_ORC,
    TABFUNCAO.NOME AS FUNCAO,
    TABSUBFUNCAO.NOME AS SUBFUNCAO,
    (DESDIS.CATEC||' - '||TABCATEC.NOME) AS NATUREZA, 
    (COALESCE(D.FRC, DESDIS.FONCODIGO)||' - '||FONCODIGO.FONCODIGODESC) AS FONTE, 
    TABEMPRESA.NOME AS ORGAO,
    EXTRACT(YEAR FROM D.DATAE) AS EXERCICIO
    FROM DESPES D ";
    
$query_join = 
    "INNER JOIN DESDIS ON DESDIS.FICHA = D.FICHA
    INNER JOIN DESFOR F ON F.CODIF = D.CODIF
    INNER JOIN TABEMPRESA ON TABEMPRESA.EMPRESA = DESDIS.EMPRESA
    LEFT JOIN TABFUNCAO ON TABFUNCAO.FUNCAO = DESDIS.FUNCAO
    LEFT JOIN TABSUBFUNCAO ON TABSUBFUNCAO.SUBFUNCAO = DESDIS.SUBFUNCAO
    LEFT JOIN TABUNIDADE ON TABUNIDADE.PODER = DESDIS.PODER AND TABUNIDADE.ORGAO = DESDIS.ORGAO AND TABUNIDADE.UNIDADE = DESDIS.UNIDADE 
    LEFT JOIN TABCATEC ON TABCATEC.CATEC = DESDIS.CATEC
    LEFT JOIN FONCODIGO ON FONCODIGO.FONCODIGO = COALESCE(D.FRC, DESDIS.FONCODIGO) 
    LEFT JOIN EXTRA  ON EXTRA.EMPRESA=DESDIS.EMPRESA AND EXTRA.EXTRA=DESDIS.FICHA_EXTRA ";

$query_where = "WHERE (DESDIS.PODER||DESDIS.ORGAO||TABUNIDADE.UNIDADE||' - '||TABUNIDADE.NOME) NOT LIKE '%RESTOS A PAGAR%' ";

foreach($filtro as $key => $value){
    $pesquisa = trim($value);
    switch($key){
        case 'numero':
            $query_where .= " AND D.NEMPG = '{$pesquisa}'";
            break;
        case 'favorecido':
            $query_where .= " AND F.NOME LIKE '%{$pesquisa}%'";
            break;
        case 'valor':
            $query_where .= " AND D.VADEM = {$pesquisa}";
            break;
        case 'objeto':
            $query_where .= " AND D.PRODU LIKE '%{$pesquisa}%'";
            break;
        case 'tipo':
            $query_where .= " AND D.TPEM = '{$pesquisa}'";
            break;
        case 'data':
            $query_where .= " AND D.DATAE = '{$pesquisa}'";
            break;
        case 'procedimento_lic':
            $query_where .= " AND D.LICIT LIKE '%{$pesquisa}%'";
            break;
        case 'unidade_orc':
            $query_where .= " AND (DESDIS.PODER||DESDIS.ORGAO||TABUNIDADE.UNIDADE||' - '||TABUNIDADE.NOME) LIKE '%{$pesquisa}%'";
            break;
        case 'funcao':
            $query_where .= " AND TABFUNCAO.NOME LIKE '%{$pesquisa}%'";
            break;
        case 'subfuncao':
            $query_where .= " AND TABSUBFUNCAO.NOME LIKE '%{$pesquisa}%'";
            break;
        case 'natureza':
            $query_where .= " AND (DESDIS.CATEC||' - '||TABCATEC.NOME) LIKE '%{$pesquisa}%'";
            break;
        case 'fonte':
            $query_where .= " AND (COALESCE(D.FRC, DESDIS.FONCODIGO)||' - '||FONCODIGO.FONCODIGODESC) LIKE '%{$pesquisa}%'";
            break;
        case 'orgao':
            $query_where .= " AND TABEMPRESA.NOME = '{$pesquisa}'";
            break;
        case 'exercicio':
            $query_where .= " AND EXTRACT(YEAR FROM D.DATAE) = {$pesquisa}";
            break;
    }
}

$query_order = " ORDER BY D.NEMPG DESC";

$query = $query_select . $query_join . $query_where . $query_order;

$resultado = ibase_query($conn,$query);
$arrayResultado = array();

while($row = ibase_fetch_object($resultado)) :
    $arrayResultado[] = $row;
endwhile;

ibase_free_result($resultado);
ibase_close($conn);