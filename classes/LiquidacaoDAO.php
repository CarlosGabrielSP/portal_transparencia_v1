<?php
require_once('classes/Conexao.php');
require_once('classes/Liquidacao.php');
require_once('classes/EmpenhoDAO.php');

class LiquidacaoDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setLiquidacao(Liquidacao $liquidacao){
        $idEmpenho  = $liquidacao->getEmpenho()->getId();
        $valor      = $this->conexao->real_escape_string($liquidacao->getvalor());
        $data       = $this->conexao->real_escape_string($liquidacao->getdata());
        $orgao      = $this->conexao->real_escape_string($liquidacao->getOrgao());
        $exercicio  = $this->conexao->real_escape_string($liquidacao->getExercicio());

        $qry = "INSERT INTO Liquidacao
                        (idEmpenho,
                        valor,
                        data,
                        orgao,
                        exercicio)
                VALUES
                        ({$idEmpenho},
                        {$valor},
                        '{$data}',
                        '{$orgao}',
                        {$exercicio})";
        return mysqli_query($this->conexao,$qry);
    }

    public function getLiquidacoes($filtro=[],$ordenaPor='data',$ordem='DESC'){
        $liquidacoes = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT 
                    l.*, e.numero as numeroEmpenho, e.favorecido, e.tipo, e.unidade_orc
                FROM 
                    liquidacao as l
                INNER JOIN 
                    empenho AS e ON l.idEmpenho = e.id
                WHERE 1";

        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'id':
                    $qry .= " AND l.id = {$pesquisa}";
                    break;
                case 'numeroEmpenho':
                    $qry .= " AND e.numero = {$pesquisa}";
                    break;
                case 'tipo':
                    $qry .= " AND e.tipo = '{$pesquisa}'";
                    break;
                case 'favorecido':
                    $qry .= " AND e.favorecido LIKE '%{$pesquisa}%'";
                    break;
                case 'valor':
                    $qry .= " AND l.valor = {$pesquisa}";
                    break;
                case 'data':
                    $qry .= " AND l.data = '{$pesquisa}'";
                    break;
                case 'orgao':
                    $qry .= " AND l.orgao = '{$pesquisa}'";
                    break;
                case 'exercicio':
                    $qry .= " AND l.exercicio = {$pesquisa}";
                    break;
            }
        }

        $qry .= " ORDER BY {$ordenaPor} {$ordem}";
        // var_dump($qry);
        $resultado = $this->conexao->query($qry);
        while($row = $resultado->fetch_assoc()){
            $liquidacao['id']               = $row['id'];
            $liquidacao['numeroEmpenho']    = $row['numeroEmpenho'];
            $liquidacao['tipo']             = $row['tipo'];
            $liquidacao['unidade_orc']      = $row['unidade_orc'];
            $liquidacao['favorecido']       = $row['favorecido'];
            $liquidacao['valor']            = $row['valor'];
            $liquidacao['data']             = $row['data'];
            $liquidacao['exercicio']        = $row['exercicio'];
            $liquidacao['orgao']            = $row['orgao'];

            /*$liquidacao = new Liquidacao();
            $empenhoDAO = new EmpenhoDAO();
            $empenho = $empenhoDAO->getEmpenhoPorId($row['idEmpenho']);
            $liquidacao->setId($row['id']);
            $liquidacao->setEmpenho($empenho);
            $liquidacao->setValor($row['valor']);
            $liquidacao->setData($row['data']);
            $liquidacao->setExercicio($row['exercicio']);
            $liquidacao->setOrgao($row['orgao']);*/
            $liquidacoes[] = $liquidacao;
        }
        $resultado->free_result();
        return $liquidacoes;
    }

    public function getExerciciosLiquidacoes(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM Liquidacao ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoLiquidacoes(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM Liquidacao ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}