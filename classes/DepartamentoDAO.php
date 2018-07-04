<?php
require_once('classes/Conexao.php');
require_once('classes/Departamento.php');

class DepartamentoDAO{
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setDepartamento(Departamento $departamento){
        $cnpj = $this->conexao->real_escape_string($departamento->getCnpj());
        $nome = $this->conexao->real_escape_string($departamento->getNome());
        $tipo = $this->conexao->real_escape_string($departamento->getTipo());
        $responsavel = $this->conexao->real_escape_string($departamento->getResponsavel());
        $tituloResponsavel = $this->conexao->real_escape_string($departamento->getTituloResponsavel());
        $fotoResponsavel = $this->conexao->real_escape_string($departamento->getFotoResponsavel());
        $municipio = $this->conexao->real_escape_string($departamento->getMunicipio());
        $endereco = $this->conexao->real_escape_string($departamento->getEndereco());
        $horario = $this->conexao->real_escape_string($departamento->getHorario());
        $telefone = $this->conexao->real_escape_string($departamento->getTelefone());
        $email = $this->conexao->real_escape_string($departamento->getEmail());
        $competencia = $this->conexao->real_escape_string($departamento->getCompetencia());

        $qry = "INSERT INTO Departamento
                        (cnpj,
                        nome,
                        tipo,
                        responsavel,
                        tituloResponsavel,
                        fotoResponsavel,
                        municipio,
                        endereco,
                        horario,
                        telefone,
                        email,
                        competencia)
                VALUES
                        ('{$cnpj}',
                        '{$nome}',
                        '{$tipo}',
                        '{$responsavel}',
                        '{$tituloResponsavel}',
                        '{$fotoResponsavel}',
                        '{$municipio}',
                        '{$endereco}',
                        '{$horario}',
                        '{$telefone}',
                        '{$email}',
                        '{$competencia}')";
        return $this->conexao->query($qry);
    }

    public function getDepartamentos(){
        $departamentos = array();
        $qry = "SELECT * FROM departamento ORDER BY nome ASC";
        $resultado = $this->conexao->query($qry);
        while($departamento = $resultado->fetch_object('departamento')){
            $departamentos[] = $departamento;
        }
        $resultado->free_result();
        return $departamentos;
    }

    public function getDepartamentosPorId($id){
        $departamentos = array();
        $qry = "SELECT * FROM departamento WHERE id = {$id} ORDER BY nome ASC";
        $resultado = $this->conexao->query($qry);
        while($departamento = $resultado->fetch_object('departamento')){
            $departamentos[] = $departamento;
        }
        $resultado->free_result();
        return $departamentos;
    }
}