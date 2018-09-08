<?php
require_once('../cnx/ZConexao.class.php');

class ZReceitaDAO
{
	private $conexaoFirebird;

    public function __construct($exercicio){
        $this->conexaoFirebird = new ZConexao($exercicio);
    }

    public function getConexaoFirebird(){
        return $this->conexaoFirebird;
    }

    public function getReceitasGerais(){
        $query = "SELECT CAST( 1 AS INTEGER) AS ORDEM, N1 AS CODIGO, CAST( NOME1 AS VARCHAR(80) ) AS NOME, CAST( SUM( ORCADA_INICIAL ) AS NUMERIC(14, 2) ) AS PREVISAO_INICIAL, CAST( SUM( ORCADA_ATUAL ) AS NUMERIC(14, 2) ) AS PREVISAO_ATUALIZADA, CAST( SUM( MES ) AS NUMERIC(14,2) ) AS ARRECADADO_PERIODO, CAST( SUM( ATUAL ) AS NUMERIC(14, 2) ) AS ARRECADADO_TOTAL FROM RECEITA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN RECDIS ON RECDIS.FICHA = A.FICHA WHERE N1 IS NOT NULL GROUP BY  1, 2, 3 UNION SELECT CAST( '2' AS INTEGER) AS ORDEM, N2 AS CODIGO, CAST( NOME2 AS VARCHAR(80) ) AS NOME, CAST( SUM( ORCADA_INICIAL ) AS NUMERIC(14, 2) ) AS PREVISAO_INICIAL, CAST( SUM( ORCADA_ATUAL )AS NUMERIC(14, 2) ) AS PREVISAO_ATUALIZADA, CAST( SUM( MES ) AS NUMERIC(14,2) ) AS ARRECADADO_PERIODO, CAST( SUM( ATUAL ) AS NUMERIC(14, 2) ) AS ARRECADADO_TOTAL FROM RECEITA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN RECDIS ON RECDIS.FICHA = A.FICHA WHERE N2 IS NOT NULL GROUP BY  1, 2, 3 UNION SELECT CAST( '3' AS INTEGER) AS ORDEM, N3 AS CODIGO, CAST( NOME3 AS VARCHAR(80) ) AS NOME, CAST( SUM( ORCADA_INICIAL ) AS NUMERIC(14, 2) ) AS PREVISAO_INICIAL, CAST( SUM( ORCADA_ATUAL ) AS NUMERIC(14, 2) ) AS PREVISAO_ATUALIZADA, CAST( SUM( MES ) AS NUMERIC(14,2) ) AS ARRECADADO_PERIODO, CAST( SUM( ATUAL ) AS NUMERIC(14, 2) ) AS ARRECADADO_TOTAL FROM RECEITA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN RECDIS ON RECDIS.FICHA = A.FICHA WHERE N3 IS NOT NULL AND N3 <> N2 GROUP BY  1, 2, 3 UNION SELECT CAST( '4' AS INTEGER) AS ORDEM, N4 AS CODIGO, CAST( NOME4 AS VARCHAR(80) ) AS NOME, CAST( SUM( ORCADA_INICIAL ) AS NUMERIC(14, 2) ) AS PREVISAO_INICIAL, CAST( SUM( ORCADA_ATUAL )AS NUMERIC(14, 2) ) AS PREVISAO_ATUALIZADA, CAST( SUM( MES ) AS NUMERIC(14,2) ) AS ARRECADADO_PERIODO, CAST( SUM( ATUAL ) AS NUMERIC(14, 2) ) AS ARRECADADO_TOTAL FROM RECEITA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN RECDIS ON RECDIS.FICHA = A.FICHA  WHERE N4 IS NOT NULL AND N4 <> N3 GROUP BY  1, 2, 3 UNION SELECT CAST( '7' AS INTEGER) AS ORDEM, N7 AS CODIGO, CAST( NOME7 AS VARCHAR(80) ) AS NOME, CAST( SUM( ORCADA_INICIAL ) AS NUMERIC(14, 2) ) AS PREVISAO_INICIAL, CAST( SUM( ORCADA_ATUAL )AS NUMERIC(14, 2) ) AS PREVISAO_ATUALIZADA, CAST( SUM( MES ) AS NUMERIC(14,2) ) AS ARRECADADO_PERIODO, CAST( SUM( ATUAL ) AS NUMERIC(14, 2) ) AS ARRECADADO_TOTAL FROM RECEITA_NIVEL('{$this->conexaoFirebird->getExercicio()}-01-01','{$this->conexaoFirebird->getExercicio()}-12-31') A INNER JOIN RECDIS ON RECDIS.FICHA = A.FICHA WHERE N7 IS NOT NULL GROUP BY  1, 2, 3 ORDER BY 2,1";

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
}