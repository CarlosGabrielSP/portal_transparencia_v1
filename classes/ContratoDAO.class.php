<?php
require_once('../cnx/Conexao.class.php');
require_once('Contrato.class.php');

class ContratoDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setContrato(Contrato $contrato){
        $numero = $this->conexao->real_escape_string($contrato->getNumero());
        $procLicitatorio = $this->conexao->real_escape_string($contrato->getProcLicitatorio());
        $objeto = $this->conexao->real_escape_string($contrato->getObjeto());
        $valor = $this->conexao->real_escape_string($contrato->getValor());
        $contratado = $this->conexao->real_escape_string($contrato->getContratado());
        $data = $this->conexao->real_escape_string($contrato->getData());
        $vigencia = $this->conexao->real_escape_string($contrato->getVigencia());
        $arquivo = $this->conexao->real_escape_string($contrato->getArquivo());
        $orgao = $this->conexao->real_escape_string($contrato->getOrgao());
        $exercicio = $this->conexao->real_escape_string($contrato->getExercicio());

        $qry = "INSERT INTO contrato
                        (numero,
                        procLicitatorio,
                        objeto,
                        valor,
                        contratado,
                        data,
                        vigencia,
                        arquivo,
                        orgao,
                        exercicio)
                VALUES
                        ('{$numero}',
                        '{$procLicitatorio}',
                        '{$objeto}',
                        {$valor},
                        '{$contratado}',
                        '{$data}',
                        '{$vigencia}',
                        '{$arquivo}',
                        '{$orgao}',
                        {$exercicio})";
        return $this->conexao->query($qry);
        // return mysqli_query($this->conexao,$qry);
    }

     public function getContratos($filtro=[],$ordenaPor='exercicio',$ordem='DESC'){
        $contratos = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT * FROM contrato WHERE 1";
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'numero':
                    $qry .= " AND numero LIKE '%{$pesquisa}%'";
                    break;
                case 'procLicitatorio':
                    $qry .= " AND procLicitatorio LIKE '%{$pesquisa}%'";
                    break;
                case 'objeto':
                    $qry .= " AND objeto LIKE '%{$pesquisa}%'";
                    break;
                case 'valor':
                    $qry .= " AND valor = '{$pesquisa}'";
                    break;
                case 'contratado':
                    $qry .= " AND contratado LIKE '%{$pesquisa}%'";
                    break;
                case 'data':
                    $qry .= " AND data = '{$pesquisa}'";
                    break;
                case 'vigencia':
                    $qry .= " AND vigencia LIKE '%{$pesquisa}%'";
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

            while ($contrato = $resultado->fetch_object('contrato')) {
                $contratos[] = $contrato;
            }
            $resultado->free_result();
            return $contratos;
    }

    public function getExerciciosContratos(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM contrato ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoContratos(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM contrato ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}