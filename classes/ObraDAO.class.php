<?php
require_once('../cnx/Conexao.class.php');
require_once('Obra.class.php');

class ObraDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setObra(Obra $obra){
        $descricao          = $this->conexao->real_escape_string($obra->getDescricao());
        $tipo               = $this->conexao->real_escape_string($obra->getTipo());
        $valor              = $this->conexao->real_escape_string($obra->getValor());
        $termo_convenio     = $this->conexao->real_escape_string($obra->getTermo_convenio());
        $anoTermo_convenio  = $this->conexao->real_escape_string($obra->getAnoTermo_convenio());
        $fornecedor         = $this->conexao->real_escape_string($obra->getfornecedor());
        $situacao           = $this->conexao->real_escape_string($obra->getSituacao());

        $qry = "INSERT INTO Obra
                        (descricao,
                        tipo,
                        valor,
                        termo_convenio,
                        anoTermo_convenio,
                        fornecedor,
                        situacao)
                VALUES
                        ('{$descricao}',
                        '{$tipo}',
                        {$valor},
                        '{$termo_convenio}',
                        {$anoTermo_convenio},
                        '{$fornecedor}',
                        '{$situacao}')";
        // var_dump($qry);
        return $this->conexao->query($qry);
    }

     public function getObras($filtro=[],$ordenaPor='anoTermo_convenio',$ordem='DESC'){
        $obras = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'DESC';
        $qry = "SELECT * FROM Obra WHERE 1";
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'descricao':
                    $qry .= " AND descricao LIKE '%{$pesquisa}%'";
                    break;
                case 'tipo':
                    $qry .= " AND tipo = '{$pesquisa}'";
                    break;
                case 'valor':
                    $qry .= " AND valor = {$pesquisa}";
                    break;
                case 'termo_convenio':
                    $qry .= " AND termo_convenio LIKE '%{$pesquisa}%'";
                    break;
                case 'anoTermo_convenio':
                    $qry .= " AND anoTermo_convenio = {$pesquisa}";
                    break;
                case 'fornecedor':
                    $qry .= " AND fornecedor = '{$pesquisa}'";
                    break;
                case 'situacao':
                    $qry .= " AND situacao LIKE '%{$pesquisa}%'";
                    break;
            }
        }
        $qry .= " ORDER BY {$ordenaPor} {$ordem}";

        $resultado = $this->conexao->query($qry);

        while ($obra = $resultado->fetch_object('Obra')) {
            $obras[] = $obra;
        }
        $resultado->free_result();
        return $obras;
    }

    public function getAnoTermo_conveniosObras(){
        $anoTermo_convenios = array();
        $qry = "SELECT DISTINCT anoTermo_convenio FROM Obra ORDER BY anoTermo_convenio";
        $resultado = $this->conexao->query($qry);
        while($anoTermo_convenio = $resultado->fetch_assoc()){
            $anoTermo_convenios[] = $anoTermo_convenio;
        }
        $resultado->free_result();
        return $anoTermo_convenios;
    }
}