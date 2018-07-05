<?php
require_once('classes/Conexao.php');
require_once('classes/Convenio.php');

class ConvenioDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setConvenio(Convenio $convenio){
        $numero     = $this->conexao->real_escape_string($convenio->getNumero());
        $objeto     = $this->conexao->real_escape_string($convenio->getObjeto());
        $concedente = $this->conexao->real_escape_string($convenio->getConcedente());
        $data       = $this->conexao->real_escape_string($convenio->getData());
        $valor      = $this->conexao->real_escape_string($convenio->getValor());
        $vigencia   = $this->conexao->real_escape_string($convenio->getVigencia());
        $arquivo    = $this->conexao->real_escape_string($convenio->getArquivo());
        $orgao      = $this->conexao->real_escape_string($convenio->getOrgao());
        $exercicio  = $this->conexao->real_escape_string($convenio->getExercicio());

        $qry = "INSERT INTO convenio
                        (numero,
                        objeto,
                        concedente,
                        data,
                        valor,
                        vigencia,
                        arquivo,
                        orgao,
                        exercicio)
                VALUES
                        ('{$numero}',
                        '{$objeto}',
                        '{$concedente}',
                        '{$data}',
                        {$valor},
                        '{$vigencia}',
                        '{$arquivo}',
                        '{$orgao}',
                        {$exercicio})";
        return $this->conexao->query($qry);
    }

    public function getConvenios($filtro=[],$ordenaPor='exercicio',$ordem='DESC'){
        $Convenios = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT * FROM convenio WHERE 1";
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'numero':
                    $qry .= " AND numero LIKE '%{$pesquisa}%'";
                    break;
                case 'objeto':
                    $qry .= " AND objeto LIKE '%{$pesquisa}%'";
                    break;
                case 'concedente':
                    $qry .= " AND concedente LIKE '%{$pesquisa}%'";
                    break;
                case 'data':
                    $qry .= " AND data = '{$pesquisa}'";
                    break;
                case 'valor':
                    $qry .= " AND valor = {$pesquisa}";
                    break;
                case 'vigencia':
                    $qry .= " AND vigencia = '{$pesquisa}'";
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
        while($convenio = $resultado->fetch_object('convenio')){
            $convenios[] = $convenio;
        }
        $resultado->free_result();
        return $convenios;
    }

    public function getExerciciosConvenios(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM convenio ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoConvenios(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM convenio ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}