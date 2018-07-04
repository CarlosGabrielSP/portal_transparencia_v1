<?php
require_once('classes/Conexao.php');
require_once('classes/Pagamento.php');
require_once('classes/EmpenhoDAO.php');

class PagamentoDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setPagamento(Pagamento $pagamento){
        $idEmpenho  = $pagamento->getEmpenho()->getId();
        $valor      = $this->conexao->real_escape_string($pagamento->getvalor());
        $data       = $this->conexao->real_escape_string($pagamento->getdata());
        $orgao      = $this->conexao->real_escape_string($pagamento->getOrgao());
        $exercicio  = $this->conexao->real_escape_string($pagamento->getExercicio());

        $qry = "INSERT INTO Pagamento
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

    public function getPagamentos($filtro=[],$ordenaPor='data',$ordem='DESC'){
        $pagamentos = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT 
                     p.*, e.numero as numeroEmpenho, e.favorecido, e.tipo, e.unidade_orc
                FROM 
                    pagamento as p
                INNER JOIN 
                    empenho AS e ON p.idEmpenho = e.id
                WHERE 1";

        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'id':
                    $qry .= " AND p.id = {$pesquisa}";
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
                    $qry .= " AND p.valor = {$pesquisa}";
                    break;
                case 'data':
                    $qry .= " AND p.data = '{$pesquisa}'";
                    break;
                case 'orgao':
                    $qry .= " AND p.orgao = '{$pesquisa}'";
                    break;
                case 'exercicio':
                    $qry .= " AND p.exercicio = {$pesquisa}";
                    break;
            }
        }

        $qry .= " ORDER BY {$ordenaPor} {$ordem}";

        $resultado = $this->conexao->query($qry);
        while($row = $resultado->fetch_assoc()){
            $pagamento['id']               = $row['id'];
            $pagamento['numeroEmpenho']    = $row['numeroEmpenho'];
            $pagamento['tipo']             = $row['tipo'];
            $pagamento['unidade_orc']      = $row['unidade_orc'];
            $pagamento['favorecido']       = $row['favorecido'];
            $pagamento['valor']            = $row['valor'];
            $pagamento['data']             = $row['data'];
            $pagamento['exercicio']        = $row['exercicio'];
            $pagamento['orgao']            = $row['orgao'];
            $pagamentos[] = $pagamento;
        }
        $resultado->free_result();
        return $pagamentos;
    }

    public function getExerciciosPagamentos(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM Pagamento ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoPagamentos(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM Pagamento ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}