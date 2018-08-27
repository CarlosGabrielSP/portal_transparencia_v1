<?php
require_once('../cnx/ZConexao.php');

class ZDespesaDAO
{
	private $conexaoFirebird;

    public function __construct($exercicio){
    	$this->conexaoFirebird = new ZConexao($exercicio);
    }

    public function getConexaoFirebird(){
        return $this->conexaoFirebird;
    }

    public function getDespesasGerais($codEntidade){
        $query = 
            "SELECT DESDIS.EMPRESA, A.PKEMP, DESPES.PKEMPA, A.NEMPG AS CODIGO, A.TPEM AS TIPO, A.CODIF, CAST(DESFOR.NOME AS VARCHAR(80)) AS DESCRICAO, DESDIS.CODLO, DESDIS.CFPRO, DESDIS.FUNCAO, TABFUNCAO.NOME AS NOMEFUNCAO, DESDIS.SUBFUNCAO, TABSUBFUNCAO.NOME AS NOMESUBFUNCAO, A.CATEC, DESDIS.FONGRUPO, FONGRUPO.FONGRUPODESC, DESDIS.FONCODIGO, FONCODIGO.FONCODIGODESC, SUM(A.VADEM) AS EMPENHADO, SUM(A.VALIQ) AS LIQUIDADO, SUM(A.VAPAG) AS PAGO 
            FROM CALCULA_SITUACAO('{$this->conexaoFirebird->getExercicio()}-12-31') AS A 
            INNER JOIN DESDIS ON DESDIS.FICHA = A.FICHA 
            INNER JOIN DESFOR ON DESFOR.CODIF = A.CODIF 
            LEFT JOIN FONGRUPO ON FONGRUPO.FONGRUPO = DESDIS.FONGRUPO 
            LEFT JOIN FONCODIGO ON FONCODIGO.FONCODIGO = DESDIS.FONCODIGO 
            LEFT JOIN TABFUNCAO ON TABFUNCAO.FUNCAO = DESDIS.FUNCAO 
            LEFT JOIN TABSUBFUNCAO ON TABSUBFUNCAO.SUBFUNCAO = DESDIS.SUBFUNCAO 
            LEFT JOIN DESPES ON DESPES.PKEMP = A.PKEMP 
            WHERE 
                DESDIS.EMPRESA = {$codEntidade} AND DESDIS.EXTRA= 'N' AND (A.DATAE >= '{$this->conexaoFirebird->getExercicio()}-01-01' AND A.DATAE <= '{$this->conexaoFirebird->getExercicio()}-12-31') 
            GROUP BY 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 
            HAVING(( SUM(A.VADEM) ) <> 0 OR ( SUM(A.VALIQ) <> 0 ) OR ( SUM(A.VAPAG) <> 0) ) 
            ORDER BY 4";

        $scpi = $this->conexaoFirebird->getConexaoSCPI();
        $resultado = ibase_query($scpi,$query);
        $arrayResultado = array();

        while($linha = ibase_fetch_object($resultado)) :
            array_push($arrayResultado, $linha);
        endwhile;

        ibase_free_result($resultado);
        ibase_close($this->conexaoFirebird->getConexaoSCPI());

        return $arrayResultado;
    }

     public function getDespesasPorOrgao($codEntidade){
        $query = "SELECT DESDIS.EMPRESA, CAST(DESDIS.PODER||DESDIS.ORGAO||DESDIS.UNIDADE AS VARCHAR(20)) AS CODIGO, CAST(CASE WHEN DESDIS.EXTRA='S' THEN EXTRA.DESCRICAO ELSE TABUNIDADE.NOME END AS VARCHAR(80)) AS DESCRICAO, SUM(A.EMPMES) AS EMPENHADO, SUM(A.LIQMES) AS LIQUIDADO, SUM(A.PAGOMES) AS PAGO, SUM(A.DOTAC) AS DOTAC, SUM(A.ALTDO) AS ALTDO, SUM(COALESCE(A.DOTAC,0) + COALESCE(A.ALTDO,0)) AS DOTACAO_ATUALIZADA FROM DESPESA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN DESDIS ON DESDIS.FICHA = A.FICHA LEFT  JOIN TABUNIDADE ON TABUNIDADE.PODER = DESDIS.PODER AND TABUNIDADE.ORGAO = DESDIS.ORGAO AND TABUNIDADE.UNIDADE = DESDIS.UNIDADE LEFT JOIN EXTRA ON EXTRA.EMPRESA=DESDIS.EMPRESA AND EXTRA.EXTRA=DESDIS.FICHA_EXTRA WHERE DESDIS.EMPRESA = {$codEntidade} GROUP BY DESDIS.EMPRESA, DESDIS.PODER,DESDIS.ORGAO,DESDIS.UNIDADE, CASE WHEN DESDIS.EXTRA='S' THEN EXTRA.DESCRICAO ELSE TABUNIDADE.NOME END HAVING ((SUM(A.EMPMES)) <> 0 or (SUM(A.LIQMES) <> 0) or (SUM(A.PAGOMES) <> 0)) ORDER BY DESDIS.PODER||DESDIS.ORGAO||DESDIS.UNIDADE";
        var_dump($qry);
        $scpi = $this->conexaoFirebird->getConexaoSCPI();
        $resultado = ibase_query($scpi,$query);
        $arrayResultado = array();

        while($linha = ibase_fetch_object($resultado)) :
            array_push($arrayResultado, $linha);
        endwhile;

        ibase_free_result($resultado);
        ibase_close($this->conexaoFirebird->getConexaoSCPI());

        return $arrayResultado;
    }

    public function getDespesasDiarias($codEntidade){
        $query = "
            SELECT D.NEMPG, D.datae AS DATA, D.codif, F.NOME AS FAVORECIDO, F.CARGO AS CARGO, D.VADEM AS VALOR, (SELECT SUM(D2.VALOR) FROM DESPES D2 WHERE D2.pkempa = D.PKEMP AND D2.tpem IN ('DA','AN')) AS DEVOLUCAO, D.produ AS DESCRICAO, D.pkemp, TE.NOME AS NOME_ELEMENTO
            FROM DESPES D
            INNER JOIN DESFOR F ON F.CODIF = D.CODIF
            INNER JOIN DESDIS FI ON FI.FICHA = D.FICHA
            LEFT JOIN TABELEMENTO TE ON TE.ELEMENTO = D.ELEMENTO
            WHERE FI.EMPRESA = {$codEntidade} 
                AND D.ELEMENTO in ('14')
                AND (D.DATAE >= '{$this->conexaoFirebird->getExercicio()}-01-01'
                AND D.DATAE <= '{$this->conexaoFirebird->getExercicio()}-12-31')
            ORDER by F.NOME, D.DATAE";

        $scpi = $this->conexaoFirebird->getConexaoSCPI();
        $resultado = ibase_query($scpi,$query);
        $arrayResultado = array();

        while($linha = ibase_fetch_object($resultado)) :
            $arrayResultado[] = $linha;
        endwhile;

        ibase_free_result($resultado);
        ibase_close($this->conexaoFirebird->getConexaoSCPI());

        return $arrayResultado;
    }
}