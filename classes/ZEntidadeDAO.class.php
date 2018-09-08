<?php 
require_once('../cnx/ZConexao.class.php');

class ZEntidadeDAO {
	private $conexaoFirebird;

    public function __construct($exercicio){
        $this->conexaoFirebird = new ZConexao($exercicio);
    }

    public function getConexaoFirebird(){
    	return $this->conexaoFirebird;
    }

    public function getTodasEntidades(){
    	$scpi = $this->conexaoFirebird->getConexaoSCPI();
    	$qry = "SELECT EMPRESA, NOME FROM TABEMPRESA ORDER BY EMPRESA";
    	$resultado = ibase_query($scpi,$qry);
    	$arrayResultado = array();
    	while($linha = ibase_fetch_object($resultado)) :
    		array_push($arrayResultado, $linha);
    	endwhile;
		ibase_free_result($resultado);
		ibase_close($scpi);
    	return $arrayResultado;
    }

    public function getEntidade($codigo){
    	$scpi = $this->conexaoFirebird->getConexaoSCPI();
    	$qry = "SELECT EMPRESA, NOME FROM TABEMPRESA WHERE EMPRESA = {$codigo} ORDER BY EMPRESA";
    	$resultado = ibase_query($scpi,$qry);
    	$entidade = ibase_fetch_object($resultado);
		ibase_free_result($resultado);
		ibase_close($scpi);
    	return $entidade;
    }
}
?>