<?php
require_once('../cnx/Conexao.class.php');
require_once('Licitacao.class.php');

class LicitacaoDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setLicitacao(Licitacao $licitacao){
        $processo = $this->conexao->real_escape_string($licitacao->getProcesso());
        $modalidade = $this->conexao->real_escape_string($licitacao->getModalidade());
        $tipo = $this->conexao->real_escape_string($licitacao->getTipo());
        $objeto = $this->conexao->real_escape_string($licitacao->getobjeto());
        $publicacao = $this->conexao->real_escape_string($licitacao->getPublicacao());
        $data_publicacao = $this->conexao->real_escape_string($licitacao->getData_publicacao());
        $situacao = $this->conexao->real_escape_string($licitacao->getSituacao());
        $valor = $this->conexao->real_escape_string($licitacao->getValor());
        $vencedor = $this->conexao->real_escape_string($licitacao->getVencedor());
        $edital = $this->conexao->real_escape_string($licitacao->getEdital());
        $orgao = $this->conexao->real_escape_string($licitacao->getOrgao());
        $exercicio = $this->conexao->real_escape_string($licitacao->getExercicio());

        $qry = "INSERT INTO licitacao
                        (processo,
                        modalidade,
                        tipo,
                        objeto,
                        publicacao,
                        data_publicacao,
                        situacao,
                        valor,
                        vencedor,
                        edital,
                        orgao,
                        exercicio)
                VALUES
                        ('{$processo}',
                        '{$modalidade}',
                        '{$tipo}',
                        '{$objeto}',
                        '{$publicacao}',
                        '{$data_publicacao}',
                        '{$situacao}',
                        {$valor},
                        '{$vencedor}',
                        '{$edital}',
                        '{$orgao}',
                        {$exercicio})";
        return $this->conexao->query($qry);
    }

    public function getLicitacoes($filtro=[],$ordenaPor='data_publicacao',$ordem='DESC'){
        $licitacoes = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT * FROM licitacao WHERE 1";
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'processo':
                    $qry .= " AND processo LIKE '%{$pesquisa}%'";
                    break;
                case 'modalidade':
                    $qry .= " AND modalidade = '{$pesquisa}'";
                    break;
                case 'tipo':
                    $qry .= " AND tipo = '{$pesquisa}'";
                    break;
                case 'objeto':
                    $qry .= " AND objeto LIKE '%{$pesquisa}%'";
                    break;
                case 'publicacao':
                    $qry .= " AND publicacao LIKE '%{$pesquisa}%'";
                    break;
                case 'data_publicacao':
                    $qry .= " AND data_publicacao = '{$pesquisa}'";
                    break;
                case 'situacao':
                    $qry .= " AND situacao = '{$pesquisa}'";
                    break;
                case 'valor':
                    $qry .= " AND valor = {$pesquisa}";
                    break;
                case 'vencedor':
                    $qry .= " AND vencedor LIKE '%{$pesquisa}%'";
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
        $resultado = $this->conexao->query($qry);
        while($licitacao = $resultado->fetch_object('licitacao')){
            $licitacoes[] = $licitacao;
        }
        $resultado->free_result();
        return $licitacoes;
    }

    public function getExerciciosLicitacoes(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM licitacao ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoLicitacoes(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM licitacao ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}