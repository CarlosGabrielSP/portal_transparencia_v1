<?php
require_once('../cnx/Conexao.php');
require_once('Empenho.php');

class EmpenhoDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setEmpenho(Empenho $empenho){
        $numero             = $this->conexao->real_escape_string($empenho->getnumero());
        $favorecido         = $this->conexao->real_escape_string($empenho->getfavorecido());
        $valor              = $this->conexao->real_escape_string($empenho->getvalor());
        $objeto             = $this->conexao->real_escape_string($empenho->getobjeto());
        $tipo               = $this->conexao->real_escape_string($empenho->getTipo());
        $data               = $this->conexao->real_escape_string($empenho->getdata());
        $procedimento_lic   = $this->conexao->real_escape_string($empenho->getprocedimento_lic());
        $unidade_orc        = $this->conexao->real_escape_string($empenho->getunidade_orc());
        $funcao             = $this->conexao->real_escape_string($empenho->getfuncao());
        $subfuncao          = $this->conexao->real_escape_string($empenho->getsubfuncao());
        $natureza           = $this->conexao->real_escape_string($empenho->getnatureza());
        $fonte              = $this->conexao->real_escape_string($empenho->getfonte());
        $orgao              = $this->conexao->real_escape_string($empenho->getOrgao());
        $exercicio          = $this->conexao->real_escape_string($empenho->getExercicio());

        $qry = "INSERT INTO empenho
                        (numero,
                        favorecido,
                        valor,
                        objeto,
                        tipo,
                        data,
                        procedimento_lic,
                        unidade_orc,
                        funcao,
                        subfuncao,
                        natureza,
                        fonte,
                        orgao,
                        exercicio)
                VALUES
                        ({$numero},
                        '{$favorecido}',
                        {$valor},
                        '{$objeto}',
                        '{$tipo}',
                        '{$data}',
                        '{$procedimento_lic}',
                        '{$unidade_orc}',
                        '{$funcao}',
                        '{$subfuncao}',
                        '{$natureza}',
                        '{$fonte}',
                        '{$orgao}',
                        {$exercicio})";
        return $this->conexao->query($qry);
    }

    public function getEmpenhos($filtro=[],$ordenaPor='numero',$ordem='DESC',$restosapagar){
        $empenhos = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT * FROM empenho WHERE ";
        if($restosapagar == 'S'){
            $qry .= "unidade_orc LIKE '%restos a pagar%'";
        }else{
            $qry .= "unidade_orc NOT LIKE '%restos a pagar%'";
        }
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'id':
                    $qry .= " AND id = {$pesquisa}";
                    break;
                case 'numero':
                    $qry .= " AND numero = '{$pesquisa}'";
                    break;
                case 'favorecido':
                    $qry .= " AND favorecido LIKE '%{$pesquisa}%'";
                    break;
                case 'valor':
                    $qry .= " AND valor = {$pesquisa}";
                    break;
                case 'objeto':
                    $qry .= " AND objeto LIKE '%{$pesquisa}%'";
                    break;
                case 'tipo':
                    $qry .= " AND tipo = '{$pesquisa}'";
                    break;
                case 'data':
                    $qry .= " AND data = '{$pesquisa}'";
                    break;
                case 'procedimento_lic':
                    $qry .= " AND procedimento_lic LIKE '%{$pesquisa}%'";
                    break;
                case 'unidade_orc':
                    $qry .= " AND unidade_orc LIKE '%{$pesquisa}%'";
                    break;
                case 'funcao':
                    $qry .= " AND funcao LIKE '%{$pesquisa}%'";
                    break;
                case 'subfuncao':
                    $qry .= " AND subfuncao LIKE '%{$pesquisa}%'";
                    break;
                case 'natureza':
                    $qry .= " AND natureza LIKE '%{$pesquisa}%'";
                    break;
                case 'fonte':
                    $qry .= " AND fonte LIKE '%{$pesquisa}%'";
                    break;
                case 'orgao':
                    $qry .= " AND orgao = '{$pesquisa}'";
                    break;
                case 'exercicio':
                    $qry .= " AND exercicio = {$pesquisa}";
                    break;
            }
        }
        $qry .= " ORDER BY {$ordenaPor} {$ordem}";
        // var_dump($qry);
        $resultado = $this->conexao->query($qry);
        while($empenho = $resultado->fetch_object('empenho')){
        	$empenhos[] = $empenho;
        }
        $resultado->free_result();
        return $empenhos;
    }

    public function getEmpenhoPorId($id){
        $qry = "SELECT * FROM empenho WHERE id = {$id}";
        $resultado = $this->conexao->query($qry);
        $empenho = $resultado->fetch_object('empenho');
        $resultado->free_result();
        return $empenho;
    }

    public function getEmpenhoPorNumero($numero){
        $qry = "SELECT * FROM empenho WHERE numero = {$numero}";
        $resultado = $this->conexao->query($qry);
        $empenho = $resultado->fetch_object('empenho');
        $resultado->free_result();
        return $empenho;
    }

    public function getEmpenhoPorNumeroTipo($numero,$tipo){
        $qry = "SELECT * FROM empenho WHERE numero = {$numero} AND tipo = '{$tipo}'";
        $resultado = $this->conexao->query($qry);
        $empenho = $resultado->fetch_object('empenho');
        $resultado->free_result();
        return $empenho;
    }

    public function getExerciciosEmpenhos(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM empenho ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){ 
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoEmpenhos(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM empenho ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}