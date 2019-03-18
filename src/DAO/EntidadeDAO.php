<?php
namespace CarlosGabriel\DAO;
require_once(__DIR__.'/../../vendor/autoload.php');

class EntidadeDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new \CarlosGabriel\Conexao\ConexaoMysql;
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setEntidade(Entidade $entidade){
        $municipio      = $this->conexao->real_escape_string($entidade->getmunicipio());
        $codigoIBGE     = $this->conexao->real_escape_string($entidade->getcodigoIBGE());
        $endereco       = $this->conexao->real_escape_string($entidade->getendereco());
        $telefone       = $this->conexao->real_escape_string($entidade->gettelefone());
        $tipo           = $this->conexao->real_escape_string($entidade->getTipo());
        $email          = $this->conexao->real_escape_string($entidade->getemail());
        $mesorregiao    = $this->conexao->real_escape_string($entidade->getmesorregiao());
        $cnpj           = $this->conexao->real_escape_string($entidade->getcnpj());
        
        $qry = "INSERT INTO Entidade
                        (municipio,
                        codigoIBGE,
                        endereco,
                        telefone,
                        tipo,
                        email,
                        mesorregiao,
                        cnpj)
                VALUES
                        ('{$municipio}',
                        {$codigoIBGE},
                        '{$endereco}',
                        '{$telefone}',
                        '{$tipo}',
                        '{$email}',
                        '{$mesorregiao}',
                        '{$cnpj}')";
        return $this->conexao->query($qry);
    }

    public function getEntidades(){
        $entidades = array();
        
        $qry .= " ORDER BY {$ordenaPor} {$ordem}";
        // var_dump($qry);
        $resultado = $this->conexao->query($qry);
        while($entidade = $resultado->fetch_object('\CarlosGabriel\Classes\Entidade')){
        	$entidades[] = $entidade;
        }
        $resultado->free_result();
        return $entidades;
    }

    public function getEntidadePorId($id){
        $qry = "SELECT * FROM Entidade WHERE id = {$id}";
        $resultado = $this->conexao->query($qry);
        $entidade = $resultado->fetch_object('\CarlosGabriel\Classes\Entidade');
        $resultado->free_result();
        return $entidade;
    }

}